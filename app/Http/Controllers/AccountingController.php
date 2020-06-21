<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

use PDF;
use Auth;
use Carbon\Carbon;
use App\BahanBaku;
use App\Warna;
use App\Brand;
use App\BarangJadi;
use App\Supplier;
use App\Costumer;
use App\Cmt;
use App\Acc;
use App\Proses;
use App\Bank;
use App\So;
use App\Param;
use App\Art;
use App\CatatanProduksi;
use App\PembelianBB;
use App\PembelianBBDetail;
use App\PembelianAcc;
use App\PembelianAccDetail;
use App\PembelianBJ;
use App\PembelianBJDetail;
use App\Barang;
use App\MasterBB;
use App\MasterAcc;
use App\MasterBJ;
use App\Payment;
use App\Category;
use App\Ledger;
use App\Journal;
use App\JournalTransaction;
use App\Akun;
use App\Skb;
use App\SkbDetail;
use App\Invoice;
use App\KartuPersediaanBB;
use Excel;
use App\Hutang;
use App\PembayaranHutang;
use App\PembayaranDetailHutang;

/**
 * Kontroller Khusus Modul Akunting
 */

class AccountingController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function pembelian_index()
  {
    $data = [
      'title' => 'Pembelian Bahan Baku',
      'title2' => 'Pembelian Accessoris',
      'title3' => 'Pembelian Barang Jadi',
      'tag' => 'pembelian_bahan_baku',
      'tag2' => 'pembelian_acc',
      'tag3' => 'pembelian_bj',
      'tanggal_order' => $this->datenowtoview(),
    ];

    return view('accounting.pembelian', $data);
  }

  public function pembelian_bb_index()
  {
    $title = 'Pembelian Bahan Baku';
    $tag = 'pembelian_bahan_baku';
    $tanggal_order = $this->datenowtoview();
    $newid = $this->genid('PembelianBB', 'BP');

    return view('accounting.pembelian_bb', [
      'title' => $title, 'tag' => $tag,
      'tanggal' => $tanggal_order, 'newid' => $newid
    ]);
  }

  public function pembelian_bb_create(Request $request)
  {
    $index = $this->genindex('PembelianBB');
    $data = [
      'id' => $request['id'],
      'index' => $index,
      'tanggal' => $this->datetodb($request['tanggal']),
      'id_faktur' => $request['id_faktur'],
      'tgl_faktur' => $this->datetodb($request['tgl_faktur']),
      'id_supplier' => $request['id_supplier'],
      'pembayaran' => $request['pembayaran'],
      'tempo' => ($request['tempo'] == null) ? 0 : $request['tempo'],
      'total_trans' => $this->ribuantodb($request['total']),
      'isactive' => 'A'
    ];
    // dd($data);

    for ($i = 0; $i < count($request['id_bb']); $i++) {

      $bb = BahanBaku::where('id', $request['id_bb'][$i])->get();
      $warna = Warna::where('id', $request['id_warna'][$i])->get();
      $data_detail = [
        'id_bp' => $request['id'],
        'index' => $i,
        'name' => $bb[0]->name . ' ' . $warna[0]->name,
        'tanggal' => $this->datetodb($request['tanggal']),
        'kode_bb' => $request['kode_bb'][$i],
        'id_bb' => $request['id_bb'][$i],
        'id_warna' => $request['id_warna'][$i],
        'id_supplier' => $request['id_supplier'],
        'qty' => $this->ribuantodb($request['qty'][$i]),
        'id_satuan' => $request['id_satuan'][$i],
        'harga' => $this->ribuantodb($request['harga'][$i]),
        'jumlah' => $this->ribuantodb($request['jumlah'][$i]),
        'isactive' => 'A'
      ];
      // dd($data_detail);
      $master_bb = MasterBB::where('id', $request['kode_bb'][$i])->get();
      if (!isset($master_bb[0])) {
        $data_stock = [
          'id' => $request['kode_bb'][$i],
          'index' => $i,
          'name' => $bb[0]->name . ' ' . $warna[0]->name,
          'id_bb' => $request['id_bb'][$i],
          'id_warna' => $request['id_warna'][$i],
          'id_supplier' => $request['id_supplier'],
          'stock' => $this->ribuantodb($request['qty'][$i]),
          'id_satuan' => $request['id_satuan'][$i],
          'isactive' => 'A'
        ];
        MasterBB::create($data_stock);
      } 
      else {
        $data_stock = [
          'stock' => $master_bb[0]['stock'] + $this->ribuantodb($request['qty'][$i]),
          'id_satuan' => $request['id_satuan'][$i],
          'isactive' => 'A'
        ];
        MasterBB::where('id', $request['kode_bb'][$i])->update($data_stock);
      }

      PembelianBBDetail::create($data_detail);

    //Fungsi Kartu Persediaan
      $jenis_persediaan = 'BB';
      $id_barang = $request['kode_bb'][$i];
      $id_ref = $request['id'];
      $type_ref = 'B'; // B/P'; + Beli B, - Pemakaian P, 
      $qty_persediaan = floatval($this->ribuantodb($request['qty'][$i]));
      $satuan = $request['id_satuan'][$i];
      $harga_persediaan = floatval($this->ribuantodb($request['harga'][$i]));

      $data_kartu_persediaan = [
        'jenis' => $jenis_persediaan,
        'id_barang' => $id_barang,
        'id_ref' => $id_ref,
        'type_ref' => $type_ref,
        'qty' => $qty_persediaan,
        'satuan' => $satuan,
        'jumlah' => $qty_persediaan*$harga_persediaan,
        'harga' => $harga_persediaan,
      ];

      $this->create_kartu_persediaan($data_kartu_persediaan);
    }
    PembelianBB::create($data);

    if( $request['pembayaran'] == 'C'){
      $id_akun_tujuan = $request[ 'id_akun'];
    } else {
      $get_id_akun_supplier = Supplier::select('akun_id')
        ->where('id', '=', $request['id_supplier'])
        ->get();

      if (isset($get_id_akun_supplier[0]['akun_id'])) {
        $id_akun_tujuan = $get_id_akun_supplier[0]['akun_id'];
      } else {
        $id_akun_tujuan = '';
      }

      // Pengisian ke hutang
      $id_hutang = $this->genid('Hutang', 'H');
      $index_hutang = $this->genindex('Hutang');
      $type_hutang = 'bb';
      $tanggal_faktur = $this->datetodb($request['tgl_faktur']);
      $tanggal = Carbon::createFromDate(substr($request['tgl_faktur'], 6, 4), substr($request['tgl_faktur'], 3, 2), substr($request['tgl_faktur'], 0, 2), 0);
      $tempo = ($request['tempo'] == null) ? 0 : $request['tempo'];
      $tanggal_jatuh_tempo = $tanggal->addDays((int)$tempo);
      $data_hutang = [
        'id' => $id_hutang,
        'index' => $index_hutang,
        'id_supplier' => $request['id_supplier'],
        'type' => $type_hutang,
        'no_faktur' => $request['id'],
        'tanggal_faktur' => $tanggal_faktur,
        'total_hutang' => $this->ribuantodb($request['total']),
        'total_bayar' => 0,
        'total_sisa' => $this->ribuantodb($request['total']),
        'tempo' => $tempo,
        'tanggal_jatuh_tempo' => $tanggal_jatuh_tempo,
        'status' => 0,
      ];
      
      // dd($data_hutang);
      Hutang::create($data_hutang);

    }
    
    //Fungsi Akuntansi  
    $id = ['1101070001', $id_akun_tujuan];
    $debit = [(int)$this->ribuantodb($request['total']), 0];
    $credit = [0, (int)$this->ribuantodb($request['total'])];
    $ref_type = ['pembelian_bb', 'pembelian_bb'];
    $ref_id = [$request['id'], $request['id']];
    $memo = ['PEMBELIAN BAHAN BAKU DENGAN ID : ' . $request['id'], 'PEMBELIAN BAHAN BAKU DENGAN ID : ' . $request['id']];
    $date = [$this->datenowtodb(),$this->datenowtodb()];
    $currency = ['IDR','IDR'];

    $data = [
      'akun_id' => $id,
      'debit' => $debit,
      'credit' => $credit,
      'ref_type' => $ref_type,
      'ref_id' => $ref_id,
      'memo' => $memo,
      'date' => $date,
      'currency' => $currency,
    ];
    // dd($data);
    $create_jurnal = $this->create_jurnal($data);

    $newid = $this->genid('PembelianBB', 'BP');

    return response()->json([
      'status' => true,
      'message' => 'PembelianBB created',
      'newid' => $newid
    ]);
  }

  public function pembelian_bb_api()
  {
    $pembelian_bb = DB::table('pembelian_bb')
      ->select('pembelian_bb.*', 'supplier.name as nama_supplier')
      ->join('supplier', 'pembelian_bb.id_supplier', '=', 'supplier.id')
      ->get();

    return DataTables::of($pembelian_bb)
      ->editColumn('total_trans', function ($pembelian_bb) {
        return 'Rp. ' . number_format($pembelian_bb->total_trans, 2);
      })
      ->addColumn('action', function ($pembelian_bb) {
        return
      '<a onclick="viewData(\''.$pembelian_bb->id.'\',\'bb\')" class="btn btn-success btn-xs">View</a>';
      })
      ->make(true);
  }


  public function pembelian_acc_index()
  {
    $title = 'Pembelian Accessoris';
    $tag = 'pembelian_acc';
    $tanggal_order = $this->datenowtoview();
    $newid = $this->genid('PembelianAcc', 'BA');

    return view('accounting.pembelian_acc', [
      'title' => $title, 'tag' => $tag,
      'tanggal' => $tanggal_order, 'newid' => $newid
    ]);
  }

  public function pembelian_acc_create(Request $request) 
  {
    $index = $this->genindex('PembelianAcc');
    // dd($request->all());
    $data = [
      'id' => $request['id'],
      'index' => $index,
      'tanggal' => $this->datetodb($request['tanggal']),
      'id_faktur' => $request['id_faktur'],
      'tgl_faktur' => $this->datetodb($request['tgl_faktur']),
      'id_supplier' => $request['id_supplier'],
      'pembayaran' => $request['pembayaran'],
      'tempo' => ($request['tempo'] == null) ? 0 : $request['tempo'],
      'total_trans' => $this->ribuantodb($request['total']),
      'isactive' => 'A'
    ];

    for ($i = 0; $i < count($request['id_acc']); $i++) {

      $bb = Acc::where('id', $request['id_acc'][$i])->get();
      $brand = Brand::where('id', $request['id_brand'][$i])->get();
      $data_detail = [
        'id_bp' => $request['id'],
        'index' => $i,
        'name' => $bb[0]->name . ' ' . $brand[0]->name,
        'tanggal' => $this->datetodb($request['tanggal']),
        'kode_acc' => $request['kode_acc'][$i],
        'id_acc' => $request['id_acc'][$i],
        'id_brand' => $request['id_brand'][$i],
        'id_supplier' => $request['id_supplier'],
        'qty' => $this->ribuantodb($request['qty'][$i]),
        'id_satuan' => $request['id_satuan'][$i],
        'harga' => $this->ribuantodb($request['harga'][$i]),
        'jumlah' => $this->ribuantodb($request['jumlah'][$i]),
        'isactive' => 'A'
      ];
      // dd($data_detail);
      $master_acc = MasterAcc::where('id', $request['kode_acc'][$i])->get();
      if (!isset($master_acc[0])) {
        $data_stock = [
          'id' => $request['kode_acc'][$i],
          'index' => $i,
          'name' => $bb[0]->name . ' ' . $brand[0]->name,
          'id_acc' => $request['id_acc'][$i],
          'id_brand' => $request['id_brand'][$i],
          'id_supplier' => $request['id_supplier'],
          'stock' => $this->ribuantodb($request['qty'][$i]),
          'id_satuan' => $request['id_satuan'][$i],
          'harga_default' => $this->ribuantodb($request['harga'][$i]),
          'isactive' => 'A'
        ];
        MasterAcc::create($data_stock);
      } else {
        $data_stock = [
          'stock' => $master_acc[0]['stock'] + $this->ribuantodb($request['qty'][$i]),
          'id_satuan' => $request['id_satuan'][$i],
          'harga_default' => $this->ribuantodb($request['harga'][$i]),
          'isactive' => 'A'
        ];
        MasterAcc::where('id', $request['kode_acc'][$i])->update($data_stock);
      }
      PembelianAccDetail::create($data_detail);

    //Fungsi Kartu Persediaan
      $jenis_persediaan = 'Acc';
      $id_barang = $request['kode_acc'][$i];
      $id_ref = $request['id'];
      $type_ref = 'B'; // B/P'; + Beli B, - Pemakaian P, 
      $qty_persediaan = floatval($this->ribuantodb($request['qty'][$i]));
      $satuan = $request['id_satuan'][$i];
      $harga_persediaan = floatval($this->ribuantodb($request['harga'][$i]));

      $data_kartu_persediaan = [
        'jenis' => $jenis_persediaan,
        'id_barang' => $id_barang,
        'id_ref' => $id_ref,
        'type_ref' => $type_ref,
        'qty' => $qty_persediaan,
        'satuan' => $satuan,
        'jumlah' => $qty_persediaan*$harga_persediaan,
        'harga' => $harga_persediaan,
      ];

      $this->create_kartu_persediaan($data_kartu_persediaan);
    }

    PembelianAcc::create($data);

    if( $request['pembayaran'] == 'C'){
      $id_akun_tujuan = $request[ 'id_akun'];
    } else {
      $get_id_akun_supplier = Supplier::select('akun_id')
        ->where('id', '=', $request['id_supplier'])
        ->get();

      if (isset($get_id_akun_supplier[0]['akun_id'])) {
        $id_akun_tujuan = $get_id_akun_supplier[0]['akun_id'];
      } else {
        $id_akun_tujuan = '';
      }

      // Pengisian ke hutang
      $id_hutang = $this->genid('Hutang', 'H');
      $index_hutang = $this->genindex('Hutang');
      $type_hutang = 'acc';
      $tanggal_faktur = $this->datetodb($request['tgl_faktur']);
      $tanggal = Carbon::createFromDate(substr($request['tgl_faktur'], 6, 4), substr($request['tgl_faktur'], 3, 2), substr($request['tgl_faktur'], 0, 2), 0);
      $tempo = ($request['tempo'] == null) ? 0 : $request['tempo'];
      $tanggal_jatuh_tempo = $tanggal->addDays((int)$tempo);
      $data_hutang = [
        'id' => $id_hutang,
        'index' => $index_hutang,
        'id_supplier' => $request['id_supplier'],
        'type' => $type_hutang,
        'no_faktur' => $request['id'],
        'tanggal_faktur' => $tanggal_faktur,
        'total_hutang' => $this->ribuantodb($request['total']),
        'total_bayar' => 0,
        'total_sisa' => $this->ribuantodb($request['total']),
        'tempo' => $tempo,
        'tanggal_jatuh_tempo' => $tanggal_jatuh_tempo,
        'status' => 0,
      ];
      
      // dd($data_hutang);
      Hutang::create($data_hutang);

      }

    //Fungsi Akuntansi  
    $id = ['1101070001', $id_akun_tujuan];
    $debit = [(int)$this->ribuantodb($request['total']), 0];
    $credit = [0, (int)$this->ribuantodb($request['total'])];
    $ref_type = ['pembelian_acc', 'pembelian_acc'];
    $ref_id = [$request['id'], $request['id']];
    $memo = ['Pembelian Accessories dengan id : ' . $request['id'], 'Pembelian Accessories dengan id : ' . $request['id']];
    $date = [$this->datenowtodb(),$this->datenowtodb()];
    $currency = ['IDR','IDR'];

    $data = [
      'akun_id' => $id,
      'debit' => $debit,
      'credit' => $credit,
      'ref_type' => $ref_type,
      'ref_id' => $ref_id,
      'memo' => $memo,
      'date' => $date,
      'currency' => $currency,
    ];

    $create_jurnal = $this->create_jurnal($data);

    $newid = $this->genid('PembelianAcc', 'BA');

    return response()->json([
      'status' => true,
      'message' => 'PembelianAcc created',
      'newid' => $newid
    ]);
  }

  public function pembelian_acc_api()
  {
    $pembelian_acc = DB::table('pembelian_acc')
      ->select('pembelian_acc.*', 'supplier.name as nama_supplier')
      ->join('supplier', 'pembelian_acc.id_supplier', '=', 'supplier.id')
      ->get();

    return DataTables::of($pembelian_acc)
      ->editColumn('total_trans', function ($pembelian_acc) {
        return 'Rp. ' . number_format($pembelian_acc->total_trans, 2);
      })
      ->addColumn('action', function ($pembelian_acc) {
        return
      '<a onclick="viewData(\''.$pembelian_acc->id.'\',\'acc\')" class="btn btn-success btn-xs">View</a>';
      })
      ->make(true);
  }

  public function pembelian_bj_index()
  {
    $title = 'Pembelian Barang Jadi';
    $tag = 'pembelian_barang_jadi';
    $tanggal_order = $this->datenowtoview();
    $newid = $this->genid('PembelianBJ', 'BJ');

    return view('accounting.pembelian_bj', [
      'title' => $title, 'tag' => $tag,
      'tanggal' => $tanggal_order, 'newid' => $newid
    ]);
  }

  public function pembelian_bj_create(Request $request)
  {
    $index = $this->genindex('PembelianBJ');
    // dd($request);
    $data = [
      'id' => $request['id'],
      'index' => $index,
      'type' => $request['type'],
      'id_so' => $request['id_so'],
      'tanggal' => $this->datetodb($request['tanggal']),
      'id_faktur' => $request['id_faktur'],
      'tgl_faktur' => $this->datetodb($request['tgl_faktur']),
      'id_supplier' => $request['id_supplier'],
      'pembayaran' => $request['pembayaran'],
      'tempo' => ($request['tempo'] == null) ? 0 : $request['tempo'],
      'total_trans' => $this->ribuantodb($request['total']),
      'isactive' => 'A'
    ];
    for ($i = 0; $i < count($request['kode_bj']); $i++) {
      $bj = BarangJadi::where('id', $request['id_bj'][$i])->get();
      $data_detail = [
        'id' => $request['id'],
        'index' => $i,
        'name' => $request['nama_barang_jadi'][$i],
        'tanggal' => $this->datetodb($request['tanggal']),
        'kode_bj' => $request['kode_bj'][$i],
        'id_bj' => $request['id_bj'][$i],
        'id_warna' => '',
        'id_supplier' => $request['id_supplier'],
        'qty' => $this->ribuantodb($request['qty'][$i]),
        'id_satuan' => $request['id_satuan'][$i],
        'harga' => $this->ribuantodb($request['harga'][$i]),
        'jumlah' => $this->ribuantodb($request['jumlah'][$i]),
        'isactive' => 'A'
      ];
      $master_bj = MasterBJ::where('id', $request['kode_bj'][$i])->get();
      if (!isset($master_bj[0])) {
        $data_stock = [
          'id' => $request['kode_bj'][$i],
          'index' => $i,
          'name' => $request['nama_barang_jadi'][$i],
          'id_bj' => $request['id_bj'][$i],
          'id_warna' => '',
          'id_supplier' => $request['id_supplier'],
          'stock' => $this->ribuantodb($request['qty'][$i]),
          'id_satuan' => $request['id_satuan'][$i],
          'harga_default' => $this->ribuantodb($request['harga'][$i]),
          'isactive' => 'A'
        ];
        MasterBJ::create($data_stock);

      } else {

        $data_stock = [
          'stock' => $master_bj[0]['stock'] + $this->ribuantodb($request['qty'][$i]),
          'id_satuan' => $request['id_satuan'][$i],
          'harga_default' => $this->ribuantodb($request['harga'][$i]),
          'isactive' => 'A'
        ];
        MasterBJ::where('id', $request['kode_bj'][$i])->update($data_stock);

      }

      PembelianBJDetail::create($data_detail);
    }

    PembelianBJ::create($data);

    if($request['pembayaran'] == 'C') {
        $id_akun_tujuan = $request[ 'id_akun'];
    } else {
        $get_id_akun_supplier = Supplier::select('akun_id')
        ->where('id', '=', $request['id_supplier'])
        ->get();

        if (isset($get_id_akun_supplier[0]['akun_id'])) {
            $id_akun_tujuan = $get_id_akun_supplier[0]['akun_id'];
        } else {
            $id_akun_tujuan = '';
        }

    // Pengisian ke hutang
    $id_hutang = $this->genid('Hutang', 'H');
    $index_hutang = $this->genindex('Hutang');
    $type_hutang = 'bj';
    $tanggal_faktur = $this->datetodb($request['tgl_faktur']);
    $tanggal = Carbon::createFromDate(substr($request['tgl_faktur'], 6, 4), substr($request['tgl_faktur'], 3, 2), substr($request['tgl_faktur'], 0, 2), 0);
    $tempo = ($request['tempo'] == null) ? 0 : $request['tempo'];
    $tanggal_jatuh_tempo = $tanggal->addDays((int)$tempo);
    $data_hutang = [
    'id' => $id_hutang,
    'index' => $index_hutang,
    'id_supplier' => $request['id_supplier'],
    'type' => $type_hutang,
    'no_faktur' => $request['id'],
    'tanggal_faktur' => $tanggal_faktur,
    'total_hutang' => $this->ribuantodb($request['total']),
    'total_bayar' => 0,
    'total_sisa' => $this->ribuantodb($request['total']),
    'tempo' => $tempo,
    'tanggal_jatuh_tempo' => $tanggal_jatuh_tempo,
    'status' => 0,
    ];
      
    // dd($data_hutang);
    Hutang::create($data_hutang);

  }

    //Fungsi Akuntansi  
    $id = ['1101070001', $id_akun_tujuan];
    $debit = [(int)$this->ribuantodb($request['total']), 0];
    $credit = [0, (int)$this->ribuantodb($request['total'])];
    $ref_type = ['pembelian_bj', 'pembelian_bj'];
    $ref_id = [$request['id'], $request['id']];
    $memo = ['Pembelian Barang Jadi dengan id : ' . $request['id'], 'Pembelian Barang Jadi dengan id : ' . $request['id']];
    $date = [$this->datenowtodb(),$this->datenowtodb()];
    $currency = ['IDR','IDR'];

    $data = [
      'akun_id' => $id,
      'debit' => $debit,
      'credit' => $credit,
      'ref_type' => $ref_type,
      'ref_id' => $ref_id,
      'memo' => $memo,
      'date' => $date,
      'currency' => $currency,
    ];

    $create_jurnal = $this->create_jurnal($data);
    $newid = $this->genid('PembelianBJ', 'BJ');

    return response()->json([
      'status' => true,
      'message' => 'PembelianBJ created',
      'newid' => $newid
    ]);
  }

  public function pembelian_bj_api()
  {
    $pembelian_bj = DB::table('pembelian_bj')
      ->select('pembelian_bj.*', 'supplier.name as nama_supplier')
      ->join('supplier', 'pembelian_bj.id_supplier', '=', 'supplier.id')
      ->get();

    return DataTables::of($pembelian_bj)
      ->editColumn('total_trans', function ($pembelian_bj) {
        return 'Rp. ' . number_format($pembelian_bj->total_trans, 2);
      })
      ->addColumn('action', function ($pembelian_bj) {
        return
      '<a onclick="viewData(\''.$pembelian_bj->id.'\',\'bj\')" class="btn btn-success btn-xs">View</a>';
      })
      ->make(true);
  }



  public function penjualan_index()
  {
    $data = [
      'title' => 'Penjualan',
      'tag' => 'penjualan',
      'tanggal' => $this->datenowtoview(),
    ];

    return view('accounting.income.penjualan', $data);
  }

  public function penjualan_create(Request $request)
  {
    $r = $request->all();
    $so = So::Select('so.id', 'costumer_id', 'costumer.name as nama_costumer', 'so.nilai_pekerjaan', 'akun.*', 'so.sisa_pembayaran', 'so.status_pembayaran')
      ->where('so.id', $r['so'])
      ->leftJoin('costumer', 'so.costumer_id', '=', 'costumer.id')
      ->leftJoin('akun_costumer', 'costumer.id', '=', 'akun_costumer.id_costumer')
      ->leftJoin('akun', 'akun_costumer.id_akun', '=', 'akun.id')
      ->get();
    $amount = $r['jumlah'];
    $reftype = 'costumer';
    $refid = $so[0]['costumer_id'];
    $currency = 'IDR';
    $memo = $r['memo'];
    $tag = '';
    $id_akun = [$r['id_akun'], '1-10100'];
    $dataproses = ['cash', 'piutang'];
    $type_kelompok = ['asset', 'asset'];
    $r['id_so'] = $r['so'];
    $r['jumlah'] = $this->ribuantodb($r['jumlah']);


    for ($i = 0; $i < count($dataproses); $i++) {

      // Create Ledger
      $dataLedger = [
        'name' => $r['deskripsi'],
        'type' => $type_kelompok[$i],
      ];
      $create_ledger = Ledger::create($dataLedger);

      $nilai_ballance = Journal::select('accounting_journals.balance')
        ->where('accounting_journals.akun_id', '=', $id_akun[$i])
        ->orderBy('id', 'desc')
        ->get();

      $debit = 0;
      $kredit = 0;

      if ($type_kelompok[$i] == 'asset') {
        if ($dataproses[$i] == 'cash') {
          $debit = floatval($r['jumlah']);
        } else {
          $kredit = floatval($r['jumlah']);
        }

        if (!isset($nilai_ballance[0]->balance)) {
          $balance = floatval($debit);
        } else {
          $balance = floatval($nilai_ballance[0]->balance) - floatval($r['jumlah']);
        }
      }

      // Create Journal
      $dataJournal = [
        'ledger_id' => $create_ledger->id,
        'balance' => $balance,
        'currency' => $currency,
        'akun_id' => $id_akun[$i],
      ];
      $create_jurnal = Journal::create($dataJournal);
      $this->updateBalance($id_akun[$i], $balance);

      // Create Journal Transaction
      $newid = $this->genidtrans('JournalTransaction');
      $index = $this->genindex('JournalTransaction');

      $dataJournalTransaction = [
        'id' => $newid,
        'index' => $index,
        'transaction_group' => $type_kelompok[$i],
        'journal_id' => $create_jurnal->id,
        'debit' => $debit,
        'credit' => $kredit,
        'currency' => $currency,
        'memo' => $dataproses[$i] . ' dari So : ' . $r['id_so'],
        'tags' => $r['id_so'],
        'type' => ($dataproses[$i] == 'cash') ? 'd' : 'k',
        'akun_id' => $id_akun[$i],
        'ref_type' => $reftype,
        'ref_id' => $refid,
        'so_id' => $r['id_so'],
        'post_date' => $this->datenowtodb(),
      ];

      $journaltransaction = JournalTransaction::create($dataJournalTransaction);

    } // End For

    $sisa_pembayaran = floatval($this->ribuantodb($r['sisa'])) - floatval($this->ribuantodb($r['jumlah']));
    $status_pembayaran = ($sisa_pembayaran == 0) ? 1 : 0;
    $so = So::findOrFail($r['id_so']);
    // dd($sisa_pembayaran);
    $data = [
      'sisa_pembayaran' => $sisa_pembayaran,
      'status_pembayaran' => ($status_pembayaran),
    ];
    $so->update($data);

    return response()->json([
      'status' => true,
      'message' => 'Success created',
    ]);

  }


  public function penjualan_api()
  {
    $data = DB::table('invoice')
      ->select('invoice.*', 'costumer.name as nama_costumer')
      ->join('costumer', 'invoice.id_costumer', '=', 'costumer.id')
      ->get();
    // dd($data);
    return DataTables::of($data)
      ->editColumn('tanggal_order', function ($data) {
        return $this->datedbtoview($data->tanggal);
      })
      ->editColumn('tanggal_akhir', function ($data) {
        return $this->datedbtoview($data->jatuh_tempo);
      })
      ->editColumn('sisa_tagihan', function ($data) {
        return '';
      })
      ->editColumn('total', function ($data) {
        return number_format($data->grand_total, 2);
      })
      ->editColumn('status_pembayaran', function ($data) {
        $status = '';
        if ($data->isactive == 'N') {
          $status = 'Open';
        } elseif ($data->isactive == 'A') {
          $status = 'Paid';
        }
        return $status;
      })
      ->addColumn('action', function ($data) {
        return
      '<div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Tindakan
      <span class="caret"></span></button>
      <ul class="dropdown-menu">
      <li><a onclick="editInvoice(\''.$data->id.'\')"> Terima Pembayaran</a></li>
      </ul>
      </div>';
        '';
      })
      ->make(true);
  }

  public function payment_expense_index()
  {
    $data = [
      'title' => 'Biaya',
      'tag' => 'payment_expense',
      'tanggal' => $this->datenowtoview(),
    ];

    return view('accounting.expense.payment', $data);
  }

  public function payment_expense_create(Request $request)
  {
    $r = $request->all();
     
    //Fungsi Akuntansi 
    $id = [$r['id_akun']];
    $debit = [0];
    $credit = [(int)$this->ribuantodb($r['total'])];
    $ref_type = ['biaya'];
    $ref_id = [$r['no_ref']];
    $memo = [$r['deskripsi'][0]];
    $date = [$this->datenowtodb()];
    $currency = ['IDR'];

    for ($i = 0; $i < count($r['id_akun_biaya']); $i++) {
      array_push($id, $r['id_akun_biaya'][$i]);
      array_push($debit, (int)$this->ribuantodb($r['jumlah'][$i]));
      array_push($credit, 0);
      array_push($ref_type, 'biaya');
      array_push($ref_id, $r['no_ref']);
      array_push($memo, $r['deskripsi'][$i]);
    }

    $data = [
      'akun_id' => $id,
      'debit' => $debit,
      'credit' => $credit,
      'ref_type' => $ref_type,
      'ref_id' => $ref_id,
      'memo' => $memo,
      'date' => $date,
      'currency' => $currency,
    ];

    $create_jurnal = $this->create_jurnal($data);


    return response()->json([
      'status' => true,
      'message' => 'Success created',
    ]);
  }

  public function expense_api()
  {
    $data = DB::table('so')
      ->select('so.*', 'costumer.name as nama_costumer')
      ->join('costumer', 'so.costumer_id', '=', 'costumer.id')
      ->where('ispost', '=', 'P')
      ->get();
    // dd($data);
    return DataTables::of($data)
      ->editColumn('tanggal_order', function ($data) {
        return $this->datedbtoview($data->tanggal_order);
      })
      ->editColumn('tanggal_akhir', function ($data) {
        return $this->datedbtoview($data->tanggal_akhir);
      })
      ->editColumn('sisa_tagihan', function ($data) {
        return number_format($data->sisa_pembayaran, 2);
      })
      ->editColumn('total', function ($data) {
        return number_format($data->nilai_pekerjaan, 2);
      })
      ->editColumn('status_pembayaran', function ($data) {
        $status = '';
        if ($data->status_pembayaran == '0') {
          $status = 'Partial';
        } elseif ($data->status_pembayaran == '1') {
          $status = 'Paid';
        } else {
          $status = 'Open';
        }
        return $status;
      })
      ->addColumn('action', function ($data) {
        return
          '<div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Tindakan
      <span class="caret"></span></button>
      <ul class="dropdown-menu">
      <li><a onclick="editInvoice(\'' . $data->id . '\')"> Terima Pembayaran</a></li>
      </ul>
      </div>';
      })->make(true);
  }

  // CRUD PAYMENT
  public function payment_index()
  {
    $title = 'Payment';
    $tag = 'payment';
    $newid = $this->genid('Payment', '');

    return view('accounting.setting.payment', ['newid' => $newid, 'title' => $title, 'tag' => $tag]);
  }

  public function payment_create(Request $request)
  {
    $index = $this->genindex('Payment');
    $data = [
      'id' => $request['id'],
      'index' => $index,
      'name' => $request['name'],
      'isactive' => $request['isactive']
    ];

    $payment = Payment::where('name', $request['name'])->count();
    $newid = $this->genid('Payment', '');

    if ($payment > 0) {
      return response()->json([
        'status' => false,
        'message' => 'Payment already exists!',
        'newid' => $newid
      ]);
    }

    Payment::create($data);
    $newid = $this->genid('Payment', '');

    return response()->json([
      'status' => true,
      'message' => 'Payment created',
      'newid' => $newid
    ]);
  }

  public function payment_edit($id)
  {
    $payment = Payment::findOrFail($id);
    return $payment;
  }

  public function payment_update(Request $request, $id)
  {
    $payment = Payment::findOrFail($request['id_edit']);
    $data = [
      'name' => $request['name_edit'],
      'isactive' => $request['isactive_edit']
    ];
    $payment->update($data);
    return response()->json([
      'status' => true,
      'message' => 'Payment Updated'
    ]);
  }

  public function payment_delete($id)
  {
    $payment = Payment::findOrFail($id);
    Payment::destroy($id);
    $newid = $this->genid('Payment', '');
    return response()->json([
      'status' => true,
      'message' => 'Payment Deleted',
      'newid' => $newid
    ]);
  }

  public function payment_api()
  {
    $payment = Payment::all();
    return DataTables::of($payment)
      ->editColumn('isactive', function ($payment) {
        return ($payment->isactive == 'A') ? 'Active' : 'Non Active';
      })
      ->addColumn('action', function ($payment) {
        return
          '<a onclick="editData(\'' . $payment->id . '\')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> &nbsp;' .
          '<a onclick="deleteData(\'' . $payment->id . '\')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
      })->make(true);
  }

  // CRUD CATEGORY
  public function category_index()
  {
    $title = 'Category';
    $tag = 'category';
    // $newid  = $this->genid('Category','');

    return view('accounting.setting.category', ['title' => $title, 'tag' => $tag]);
  }

  public function category_create(Request $request)
  {
    $index = $this->genindex('Category');
    $data = [
      'id' => $request['id'],
      'index' => $index,
      'name' => $request['name'],
      'type' => $request['type'],
      'isactive' => $request['isactive']
    ];

    $category = Category::where('name', $request['name'])->count();
    // $newid = $this->genid('Category','');

    if ($category > 0) {
      return response()->json([
        'status' => false,
        'message' => 'Category already exists!',
        // 'newid'   => $newid
      ]);
    }

    Category::create($data);
    // $newid = $this->genid('Category','');

    return response()->json([
      'status' => true,
      'message' => 'Category created',
      // 'newid'   => $newid
    ]);
  }

  public function category_edit($id)
  {
    $category = Category::findOrFail($id);
    return $category;
  }

  public function category_update(Request $request, $id)
  {
    $category = Category::findOrFail($request['id_edit']);
    $data = [
      'name' => $request['name_edit'],
      'isactive' => $request['isactive_edit']
    ];
    $category->update($data);
    return response()->json([
      'status' => true,
      'message' => 'Category Updated'
    ]);
  }

  public function category_delete($id)
  {
    $category = Category::findOrFail($id);
    Category::destroy($id);
    $newid = $this->genid('Category', '');
    return response()->json([
      'status' => true,
      'message' => 'Category Deleted',
      'newid' => $newid
    ]);
  }

  public function category_api()
  {
    $category = Category::all();
    return DataTables::of($category)
      ->editColumn('isactive', function ($category) {
        return ($category->isactive == 'A') ? 'Active' : 'Non Active';
      })
      ->addColumn('action', function ($category) {
        return
          '<a onclick="editData(\'' . $category->id . '\')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> &nbsp;' .
          '<a onclick="deleteData(\'' . $category->id . '\')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
      })->make(true);
  }


  // GET SELECT 2
  public function get_costumer(Request $request)
  {
    $r = $request->all();
    $param = (!isset($r['search'])) ? '' : $r['search'];
    $data = Costumer::select('id as id', 'name as text')
      ->where('name', 'like', '%' . $param . '%')
      ->where('isactive', 'A')
      ->get();
    return response()->json($data);
  }

  public function get_payment(Request $request)
  {
    $r = $request->all();
    $param = (!isset($r['search'])) ? '' : $r['search'];
    $data = Payment::select('id as id', 'name as text')
      ->where('name', 'like', '%' . $param . '%')
      ->where('isactive', 'A')
      ->get();
    return response()->json($data);
  }

  public function get_category(Request $request)
  {
    $r = $request->all();
    $param = (!isset($r['search'])) ? '' : $r['search'];
    $data = Category::select('id as id', 'name as text')
      ->where('name', 'like', '%' . $param . '%')
      ->where('isactive', 'A')
      ->orderBy('id', 'ASC')
      ->get();
    return response()->json($data);
  }

  public function get_k(Request $request)
  {
    $r = $request->all();
    // dd($r);
    $param = (!isset($r['search'])) ? '' : $r['search'];
    $level = (!isset($r['level'])) ? '' : $r['level'];
    $id_kategori = (!isset($r['id_kategori'])) ? '' : $r['id_kategori'];
    $data = Akun::select('id as id', 'name as text')
      ->where('name', 'like', '%' . $param . '%')
      ->where('level', $level)
      ->where('id_kategori', $id_kategori)
      ->where('isactive', 'A')
      ->get();
    return response()->json($data);
  }

  public function get_id_akun(Request $request)
  {
    $r = $request->all();
    // dd($r);
    $index = Akun::select('akun.*')->orderBy('index', 'desc')
      ->where('level', $r['level'])
      ->where('id_kategori', $r['id_kategori']);

    if ($r['level'] == '3') {
      $index->where('k2', $r['parent']);
    }

    if ($r['level'] == '4') {
      $index->where('k3', $r['parent']);
    }

    $i = $index->take(1)->get();
    // dd($i);
    if (!isset($i[0])) {
      if ($r['level'] == '4') {
        $newid = '0001';
      } else {
        $newid = '01';
      }
    } else {
      if ($r['level'] == '4') {
        // dd($i[0]->index);
        $new = $i[0]->index + 1;
        $pad = str_pad($new, 4, '0', STR_PAD_LEFT);
        $newid = $pad;
      } else {
        $new = $i[0]->index + 1;
        $pad = str_pad($new, 2, '0', STR_PAD_LEFT);
        $newid = $pad;
      }

    }

    return response()->json($newid);
  }

  // REPORT
  public function income_index()
  {
    $y = Carbon::now()->year;
    $month = [0 => 'Januari', 1 => 'Februari', 2 => 'Maret', 3 => 'April', 4 => 'Mei', 5 => 'Juni', 6 => 'Juli', 7 => 'Agustus', 8 => 'September', 9 => 'Oktober', 10 => 'November', 11 => 'Desember'];
    $report = array();
    for ($i = 1; $i < 13; $i++) {
      $query = DB::select('select * from (select transaction_group, sum(credit) as amount,
      EXTRACT(month from created_at) AS m,
      EXTRACT(year from created_at) AS y
      from accounting_journal_transactions group by m,y,transaction_group) ss
      where m = ' . $i . ' and y = ' . $y . ' and transaction_group = \'income\'');
      if (isset($query[0]->amount)) {
        array_push($report, $query[0]->amount);
      } else {
        array_push($report, 0);
      }
    }

    $report2 = [
      0 => $report[0],
      1 => $report[1],
      2 => $report[2],
      3 => $report[3],
      4 => $report[4],
      5 => $report[5],
      6 => $report[6],
      7 => $report[7],
      8 => $report[8],
      9 => $report[9],
      10 => $report[10],
      11 => $report[11],
    ];


    $data = [
      'title' => 'Income',
      'tag' => 'income',
      'tanggal' => $this->datenowtoview(),
      'report' => $report2,
      'month' => $month,
    ];
    return view('accounting.report.income', $data);
  }

  public function expense_index()
  {
    $y = Carbon::now()->year;
    $month = [0 => 'Januari', 1 => 'Februari', 2 => 'Maret', 3 => 'April', 4 => 'Mei', 5 => 'Juni', 6 => 'Juli', 7 => 'Agustus', 8 => 'September', 9 => 'Oktober', 10 => 'November', 11 => 'Desember'];
    $report = array();
    for ($i = 1; $i < 13; $i++) {
      $query = DB::select('select * from (select transaction_group, sum(debit) as amount,
      EXTRACT(month from created_at) AS m,
      EXTRACT(year from created_at) AS y
      from accounting_journal_transactions group by m,y,transaction_group) ss
      where m = ' . $i . ' and y = ' . $y . ' and transaction_group = \'expense\'');
      if (isset($query[0]->amount)) {
        array_push($report, $query[0]->amount);
      } else {
        array_push($report, 0);
      }
    }

    $report2 = [
      0 => $report[0],
      1 => $report[1],
      2 => $report[2],
      3 => $report[3],
      4 => $report[4],
      5 => $report[5],
      6 => $report[6],
      7 => $report[7],
      8 => $report[8],
      9 => $report[9],
      10 => $report[10],
      11 => $report[11],
    ];


    $data = [
      'title' => 'Expense',
      'tag' => 'expense',
      'tanggal' => $this->datenowtoview(),
      'report' => $report2,
      'month' => $month,
    ];
    return view('accounting.report.income', $data);
  }

  public function incomeexpense_index()
  {
    $y = Carbon::now()->year;
    $month = [0 => 'Januari', 1 => 'Februari', 2 => 'Maret', 3 => 'April', 4 => 'Mei', 5 => 'Juni', 6 => 'Juli', 7 => 'Agustus', 8 => 'September', 9 => 'Oktober', 10 => 'November', 11 => 'Desember'];
    $report_income = array();
    for ($i = 1; $i < 13; $i++) {
      $query = DB::select('select * from (select transaction_group, sum(credit) as amount,
      EXTRACT(month from created_at) AS m,
      EXTRACT(year from created_at) AS y
      from accounting_journal_transactions group by m,y,transaction_group) ss
      where m = ' . $i . ' and y = ' . $y . ' and transaction_group = \'income\'');
      if (isset($query[0]->amount)) {
        array_push($report_income, $query[0]->amount);
      } else {
        array_push($report_income, 0);
      }
    }

    $report_income2 = [
      0 => $report_income[0],
      1 => $report_income[1],
      2 => $report_income[2],
      3 => $report_income[3],
      4 => $report_income[4],
      5 => $report_income[5],
      6 => $report_income[6],
      7 => $report_income[7],
      8 => $report_income[8],
      9 => $report_income[9],
      10 => $report_income[10],
      11 => $report_income[11],
    ];

    $report_expense = array();
    for ($i = 1; $i < 13; $i++) {
      $query = DB::select('select * from (select transaction_group, sum(debit) as amount,
      EXTRACT(month from created_at) AS m,
      EXTRACT(year from created_at) AS y
      from accounting_journal_transactions group by m,y,transaction_group) ss
      where m = ' . $i . ' and y = ' . $y . ' and transaction_group = \'expense\'');
      if (isset($query[0]->amount)) {
        array_push($report_expense, $query[0]->amount);
      } else {
        array_push($report_expense, 0);
      }
    }

    $report_expense2 = [
      0 => $report_expense[0],
      1 => $report_expense[1],
      2 => $report_expense[2],
      3 => $report_expense[3],
      4 => $report_expense[4],
      5 => $report_expense[5],
      6 => $report_expense[6],
      7 => $report_expense[7],
      8 => $report_expense[8],
      9 => $report_expense[9],
      10 => $report_expense[10],
      11 => $report_expense[11],
    ];


    $data = [
      'title' => 'Profit',
      'tag' => 'expense',
      'tanggal' => $this->datenowtoview(),
      'report_income' => $report_income2,
      'report_expense' => $report_expense2,
      'month' => $month,
    ];
    // dd($data);
    return view('accounting.report.incomeexpense', $data);
  }



  // CRUD AKUN
  public function akun_index()
  {
    $k1 = Akun::where('level', 'k1')->get();
    $k2 = Akun::where('level', 'k2')->get();
    $k3 = Akun::where('level', 'k3')->get();

    $data = [
      'title' => 'Akun',
      'tag' => 'akun',
      'k1' => $k1,
      'k2' => $k2,
      'k3' => $k3,
    ];

    return view('accounting.akun', $data);
  }

  public function akun_create(Request $request)
  {
    $currency = 'IDR';
    $index = Akun::orderBy('index', 'desc')
      ->where('level', $request['id_level'])
      ->where('id_kategori', $request['id_category'])
      ->take(1)
      ->get();

    if (!isset($index[0])) {
      $index = 1;
    } else {
      $index = $index[0]->index + 1;
    }

    if ($request['id_category'] == '11' || $request['id_category'] == '22' || $request['id_category'] == '33') {
      $kategori_laporan = 'N';
    } else {
      $kategori_laporan = 'LR';
    }

    $data = [
      'id' => $request['id'],
      'index' => $index,
      'name' => $request['name'],
      'deskripsi' => $request['deskripsi'],
      'saldo_awal' => $this->ribuantodb($request['saldo']),
      'saldo' => $this->ribuantodb($request['saldo']),
      'id_kategori' => $request['id_category'],
      'level' => $request['id_level'],
      'k1' => $request['id_category'],
      'k2' => $request['k2'],
      'k3' => $request['k3'],
      'kategori_laporan' => $kategori_laporan,
      'isactive' => $request['isactive']
    ];
    $akun = Akun::where('id', $request['id'])->count();

    if ($akun > 0) {
      return response()->json([
        'status' => false,
        'message' => 'Kode Akun already exists!',
      ]);
    }

    // dd($akun);
    Akun::create($data);

    $get_type = Category::select('category.type')
      ->where('id', $request['id_category'])
      ->get();

    $type = $get_type[0]->type;

    $data_ledger = [
      'name' => $request['name'],
      'type' => $type,
      'created_at' => $this->datenowtodb(),
    ];
    $create_ledger = Ledger::create($data_ledger);

    $data_jurnal = [
      'ledger_id' => $create_ledger->id,
      'balance' => floatval($this->ribuantodb($request['saldo'])),
      'currency' => $currency,
      'akun_id' => $request['id'],
      'tanggal' => $this->datenowtodb(),
    ];
    $create_jurnal = Journal::create($data_jurnal);

    $debit = 0;
    $kredit = 0;
    $value = floatval($this->ribuantodb($request['saldo']));

    if ($type == 'asset') {
      $debit = $value;
      $jenis = 'd';
    } elseif ($type == 'liability') {
      $kredit = $value;
      $jenis = 'k';
    } elseif ($type == 'equity') {
      $kredit = $value;
      $jenis = 'k';
    } elseif ($type == 'income') {
      $kredit = $value;
      $jenis = 'k';
    } elseif ($type == 'expense') {
      $debit = $value;
      $jenis = 'd';
    }

    $newid = $this->genidtrans('JournalTransaction');
    $index = $this->genindex('JournalTransaction');
    $dataJournalTransaction = [
      'id' => $newid,
      'index' => $index,
      'transaction_group' => $get_type[0]->type,
      'journal_id' => $create_jurnal->id,
      'debit' => $debit,
      'credit' => $kredit,
      'currency' => $currency,
      'memo' => 'Saldo Awal',
      'type' => $jenis,
      'akun_id' => $request['id'],
      'post_date' => $this->datenowtodb(),
    ];
    $journaltransaction = JournalTransaction::create($dataJournalTransaction);

    return response()->json([
      'status' => true,
      'message' => 'Akun created',
    ]);
  }

  public function akun_edit($id)
  {
    $akun = Akun::findOrFail($id);
    return $akun;
  }

  public function akun_update(Request $request, $id)
  {
    $akun = Akun::findOrFail($request['id_edit']);
    $data = [
      'name' => $request['name_edit'],
      'isactive' => $request['isactive_edit']
    ];
    $akun->update($data);
    return response()->json([
      'status' => true,
      'message' => 'Akun Updated'
    ]);
  }

  public function akun_delete($id)
  {
    $akun = Akun::findOrFail($id);
    Akun::destroy($id);
    return response()->json([
      'status' => true,
      'message' => 'Akun Deleted'
    ]);
  }

  public function akun_api()
  {
    $id_category = $_POST['id_category'];
    if ($id_category == ''){
      $akun = DB::select(DB::raw("select id, name, level, saldo_awal as saldo_awal, saldo as saldo_akhir, isactive, (select name from akun k where id = a.k1) as nama_kategori
      from akun a
      where level = '4'"));
    } else {
      $akun = DB::select(DB::raw("select id, name, level, saldo_awal as saldo_awal, saldo as saldo_akhir, isactive, (select name from akun k where id = a.k1) as nama_kategori
      from akun a
      where level = '4' and id_kategori = '".$id_category."' "));
    }
    // var_dump(1);
    // var_dump($_POST['id_category']);

    return DataTables::of($akun)
      ->editColumn('kategori', function ($akun) {
        return $akun->nama_kategori;
      })
      ->editColumn('saldo_awal', function ($akun) {
        return 'Rp. ' . number_format($akun->saldo_awal, 2);
      })
      ->editColumn('saldo_akhir', function ($akun) {
        return 'Rp. ' . number_format($akun->saldo_akhir, 2);
      })
      ->editColumn('isactive', function ($akun) {
        return ($akun->isactive == 'A') ? 'Active' : 'Non Active';
      })
      ->addColumn('action', function ($akun) {
        return '<div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
      <span class="caret"></span></button>
      <ul class="dropdown-menu">
      <li><a onclick="editData(\'' . $akun->id . '\')"> Edit</a></li>
      <li><a onclick="deleteData(\'' . $akun->id . '\')"> Delete</a></li>
      </ul>
      </div>';
      })->make(true);
  }

  //Jurnal

  public function jurnal_index()
  {
    $data = [
      'title' => 'Jurnal',
      'tag' => 'jurnal',
      'tanggal' => $this->datenowtoview(),
    ];

    return view('accounting.jurnal', $data);
  }

  public function jurnal_create(Request $request)
  {
    $r = $request->all();
    
    //Fungsi Akuntansi  
    $id = [];
    $debit = [];
    $credit = [];[];
    $ref_type = [];
    $ref_id = [];
    $memo = [];
    $date = [];
    $currency = [];

    for ($i = 0; $i < count($r['id_akun']); $i++) {
        array_push($id,$r['id_akun'][$i]);
        array_push($debit,(int)$this->ribuantodb($r['debit'][$i]));
        array_push($credit,(int)$this->ribuantodb($r['kredit'][$i]));
        array_push($ref_type,'jurnal');
        array_push($ref_id,$r['no_ref']);
        array_push($memo,$r['deskripsi'][$i]);  
        array_push($date,$this->datenowtodb());  
        array_push($currency,'IDR');  
    }

    $data = [
      'akun_id' => $id,
      'debit' => $debit,
      'credit' => $credit,
      'ref_type' => $ref_type,
      'ref_id' => $ref_id,
      'memo' => $memo,
      'date' => $date,
      'currency' => $currency,
    ];
    // dd($data);
    $create_jurnal = $this->create_jurnal($data);
    
    return response()->json([
      'status' => true,
      'message' => 'Jurnal created',
    ]);
  }

  public function jurnal_api(Request $request)
  {
    $r = $request->all();
    $f = Carbon::createFromFormat('Y-m-d H:i:s', substr($r['from'], 6, 4).'-'. substr($r['from'], 3, 2) .'-'. substr($r['from'], 0, 2).' 00:00:00');
    $t = Carbon::createFromFormat('Y-m-d H:i:s', substr($r['to'], 6, 4) . '-' . substr($r['to'], 3, 2) . '-' . substr($r['to'], 0, 2) . ' 23:59:00');
    $data = DB::table('accounting_journal_transactions')
      ->select('accounting_journal_transactions.journal_id as id', 'accounting_journal_transactions.akun_id as kode_akun', 
      'akun.name as nama_akun', 'accounting_journal_transactions.created_at as tanggal', 
      'accounting_journal_transactions.debit', 'accounting_journal_transactions.credit')
      ->leftJoin('accounting_journals', 'accounting_journal_transactions.journal_id', '=', 'accounting_journals.id')
      ->leftJoin('akun', 'accounting_journal_transactions.akun_id', '=', 'akun.id')
      ->whereBetween('accounting_journal_transactions.created_at', [$f,$t])
      ->get();
      
    return DataTables::of($data)
      ->editColumn('tanggal', function ($data) {
        return Carbon::parse($data->tanggal)->format('d/m/Y');
      })
      ->editColumn('debit', function ($data) {
          if($data->debit > 0) {
            return 'Rp. ' . number_format($data->debit, 2);
          } else {
            return '';
          }
      })
      ->editColumn('kredit', function ($data) {
          if($data->credit > 0){
            return 'Rp. ' . number_format($data->credit, 2);
          } else {
            return '';
          }
      })
      ->addColumn('action', function ($data) {
        return
      '<div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Aksi
      <span class="caret"></span></button>
      <ul class="dropdown-menu">
      <li><a onclick="validasiData(\''.$data->id.'\',\'edit\')"> Edit</a></li>
      <li><a onclick="validasiData(\''.$data->id.'\',\'update\')"> Update Saldo</a></li>
      </ul>
      </div>';
        '';
      })
      ->make(true);
  }

  public function buku_besar_index()
  {
    $data = [
      'title' => 'Buku Besar',
      'tag' => 'buku_besar',
      'date_now' => $this->datenowtorange(),
    ];
    // dd($data);
    return view('accounting.report.buku_besar', $data);
  }

  public function buku_besar_api(Request $request)
  {
    $r = $request->all();
    $f = Carbon::createFromFormat('Y-m-d H:i:s', substr($r['from'], 6, 4) . '-' . substr($r['from'], 3, 2) . '-' . substr($r['from'], 0, 2) . ' 00:00:00');
    $t = Carbon::createFromFormat('Y-m-d H:i:s', substr($r['to'], 6, 4) . '-' . substr($r['to'], 3, 2) . '-' . substr($r['to'], 0, 2) . ' 23:59:00');
    $data = DB::table('accounting_journal_transactions')
      ->select('accounting_journal_transactions.journal_id as id', 'accounting_journal_transactions.akun_id as kode_akun', 
      'akun.name as nama_akun', 'accounting_journal_transactions.created_at as tanggal', 'accounting_journal_transactions.created_at as tanggal', 
      'accounting_journal_transactions.debit', 'accounting_journal_transactions.credit', 'accounting_journals.balance as balance')
      ->leftJoin('accounting_journals', 'accounting_journal_transactions.journal_id', '=', 'accounting_journals.id')
      ->leftJoin('akun', 'accounting_journal_transactions.akun_id', '=', 'akun.id')
      ->whereBetween('accounting_journal_transactions.created_at', [$f,$t]);
      // ->get();

    if (isset($r['id_akun'])) {
      $data = $data->where('accounting_journals.akun_id', '=', $r['id_akun'])->get();
    } else {
      $data = $data->get();
    }

    return DataTables::of($data)
      ->editColumn('tanggal', function ($data) {
        return Carbon::parse($data->tanggal)->format('d/m/Y');
      })
      ->editColumn('debit', function ($data) {
          if($data->debit > 0) {
            return 'Rp. ' . number_format($data->debit, 2);
          } else {
            return '';
          }
      })
      ->editColumn('kredit', function ($data) {
          if($data->credit > 0){
            return 'Rp. ' . number_format($data->credit, 2);
          } else {
            return '';
          }
      })
      ->editColumn('balance', function ($data) {
          if(isset($data->balance)){
            return 'Rp. ' . number_format($data->balance, 2);
          } else {
            return '';
          }
      })
      ->make(true);
  }

  public function export_buku_besar(Request $request)
  {
    global $title, $tag;
    $title = 'Buku Besar';
    $tag = 'buku_besar';
    $r = $request->all();
    $file = $r['id_akun'] . '/' . $r['bulan'] . '/' . $r['tahun'];
    $data = JournalTransaction::select('accounting_journal_transactions.journal_id as id_jurnal', 'accounting_journal_transactions.memo as deskripsi', 'accounting_journal_transactions.ref_id as ref_id', 'accounting_journal_transactions.created_at as tanggal_jurnal', 'accounting_journal_transactions.debit as debit', 'accounting_journal_transactions.credit as kredit', 'accounting_journals.balance as saldo')
      ->leftJoin('accounting_journals', 'accounting_journal_transactions.journal_id', '=', 'accounting_journals.id')
      ->whereMonth('accounting_journal_transactions.created_at', '=', $r['bulan'])
      ->whereYear('accounting_journal_transactions.created_at', '=', '20' . $r['tahun']);
    if (isset($r['id_akun'])) {
      $data = $data->where('accounting_journals.akun_id', '=', $r['id_akun'])->get();
    } else {
      $data = $data->where('accounting_journals.akun_id', '=', 'xyz')->get();
    }

    $myFile = Excel::create($tag, function ($excel) use ($data) {
      global $title, $tag;
      $excel->setTitle($title);
      $excel->sheet($tag, function ($sheet) use ($data) {
        $sheet->fromArray($data, null, 'A1', true, true);
      });
    });

    $myFile = $myFile->string('xlsx');
    $response = array(
      'name' => "export_" . $tag . '/' . $file . ".xlsx",
      'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," . base64_encode($myFile)
    );

    return response()->json($response);

  }

  public function view_buku_besar($from,$to,$id)
  {
    $f = Carbon::createFromFormat('Y-m-d H:i:s', substr($from, 6, 4) . '-' . substr($from, 3, 2) . '-' . substr($from, 0, 2) . ' 00:00:00');
    $t = Carbon::createFromFormat('Y-m-d H:i:s', substr($to, 6, 4) . '-' . substr($to, 3, 2) . '-' . substr($to, 0, 2) . ' 23:59:00');


    $title      = 'Buku Besar';
    $data       = JournalTransaction::select('akun.name as nama_akun', 'accounting_journal_transactions.journal_id as id_jurnal', 
    'accounting_journal_transactions.memo as deskripsi', 'accounting_journal_transactions.ref_id as ref_id', 
    'accounting_journal_transactions.created_at as tanggal_jurnal', 'accounting_journal_transactions.debit as debit', 
    'accounting_journal_transactions.credit as kredit', 'accounting_journals.balance as saldo'
    )
    ->leftJoin('accounting_journals', 'accounting_journal_transactions.journal_id', '=', 'accounting_journals.id')
    ->leftJoin('akun', 'accounting_journals.akun_id', '=', 'akun.id')
    ->whereBetween('accounting_journal_transactions.created_at', [$f,$t])
        ->when($id != 'null', function ($query) use ($id) {
            return $query->where('accounting_journals.akun_id', '=', $id); })
    // ->where('accounting_journals.akun_id', '=', $id)
    ->orderBy('accounting_journal_transactions.journal_id','ASC')
    ->get();

    if($id!='null'){
      $nama_akun = Akun::select('akun.name')    
     ->where('id', '=', $id)
     ->get();
     $nama_akun = $nama_akun[0]['name'];
    } else {
      $id = '-';
      $nama_akun = '-';
    }

    //  $data_total_debit = JournalTransaction::select(DB::raw('sum(debit) as total'))    
    // ->whereBetween('created_at', [$f,$t])
    // ->when($id != 'null', function ($query) use ($id) {
    //         return $query->where('akun_id', '=', $id); })
    // ->get();

    //  $data_total_kredit = JournalTransaction::select(DB::raw('sum(credit) as total'))    
    // ->whereBetween('created_at', [$f,$t])
    // ->when($id != 'null', function ($query) use ($id) {
    //     return $query->where('akun_id', '=', $id); })
    // ->get();

    // $total_debit = 0;
    // $total_kredit = 0;
    // if(isset($data_total_debit[0]['total'])){
    //   $total_debit = $data_total_debit[0]['total'];
    // }
    // if(isset($data_total_kredit[0]['total'])){
    //   $total_kredit = $data_total_kredit[0]['total'];
    // }

    // dd($data);

      $currency = 'Rp';
      $data_perusahaan = Param::all();
      $data_send = [
        'title'       =>  $title,
        'data'        =>  $data,
        'name_company'=>  $data_perusahaan[0]['name_perusahaan'],
        'alamat'      =>  'Office : '.$data_perusahaan[0]['alamat'],
        'telepon'     =>  'Telepon : '.$data_perusahaan[0]['telepon'],
        'logo'        =>  $data_perusahaan[0]['logo_perusahaan'],
        'currency'    =>  $currency,
        'kode_perkiraan' =>  $id.' / NAMA PERKIRAAN : '.$nama_akun,
        'priode'      =>  $f->addDay()->format('d/m/Y').' sampai '.$t->format('d/m/Y'),
        // 'total_debit' =>  $total_debit,
        // 'total_kredit'=>  $total_kredit,
      ];
      // dd($data_send);
      $pdf  = PDF::loadView('accounting.report.print.print_buku_besar', $data_send);
      $pdf->setPaper('a4', 'landscape');
      return $pdf->stream();
  }

  public function saldo_akun(Request $request)
  {
    $r = $request->all();

    $akun = DB::table('accounting_journals')
      ->select('balance', 'created_at')
      ->whereMonth('created_at', '=', $r['bulan'])
      ->whereYear('created_at', '=', '20' . $r['tahun'])
      ->where('akun_id', '=', $r['id_akun'])
      ->limit(1)
      ->orderBy('created_at', 'desc')
      ->get();

    $saldo = (isset($akun[0]->balance)) ? number_format($akun[0]->balance, 2) : '0,00';
    return response()->json([
      'status' => true,
      'saldo' => $saldo,
    ]);
  }

  public function jurnalreport_index()
  {
    $data = [
      'title' => 'Jurnal',
      'tag' => 'jurnalreport',
      // 'bulan' => $this->getbulan(),
      // 'tahun' => $this->gettahun(),
      // 'tanggal' => $this->datenowtoview(),
    ];
    return view('accounting.report.jurnal', $data);
  }

  public function jurnalreport_api(Request $request)
  {
    $r = $request->all();
    $akun = DB::table('accounting_journal_transactions')
      ->select('accounting_journal_transactions.id', 'accounting_journal_transactions.journal_id', 'accounting_journals.akun_id as akun', 'akun.name as nama_akun', 'accounting_journal_transactions.created_at', 'accounting_journal_transactions.debit', 'accounting_journal_transactions.credit', 'accounting_journals.balance as saldo')
      ->leftJoin('accounting_journals', 'accounting_journal_transactions.journal_id', '=', 'accounting_journals.id')
      ->leftJoin('akun', 'accounting_journals.akun_id', '=', 'akun.id')
      ->whereMonth('accounting_journal_transactions.created_at', '=', $r['bulan'])
      ->whereYear('accounting_journal_transactions.created_at', '=', '20' . $r['tahun'])
      ->orderBy('created_at', 'desc')
      ->get();

    return DataTables::of($akun)
      ->editColumn('tanggal', function ($akun) {
        return Carbon::parse($akun->created_at)->format('d/m/Y');
      })
      ->editColumn('debit', function ($akun) {
        return 'Rp. ' . number_format($akun->debit, 2);
      })
      ->editColumn('kredit', function ($akun) {
        return 'Rp. ' . number_format($akun->credit, 2);
      })
      ->editColumn('akun', function ($akun) {
        return $akun->akun;
      })
      ->editColumn('nama_akun', function ($akun) {
        return $akun->nama_akun;
      })
      ->make(true);
  }


  public function get_jurnal(Request $request)
  {
    $r = $request->all();
    $data = DB::table('accounting_journal_transactions')
      ->select('accounting_journal_transactions.*','akun.name as nama_akun')
      ->leftJoin('akun','akun.id','=','accounting_journal_transactions.akun_id')
      ->where('accounting_journal_transactions.journal_id', '=', $r['jurnal_id'])
      ->get();
      
    return response()->json([
      'status' => true,
      'data' => $data,
      'message' => 'Jurnal Updated'
    ]);
  }

  public function update_saldo(Request $request)
  {
    $r = $request->all();
    $data = DB::table('accounting_journal_transactions')
      ->select('accounting_journal_transactions.akun_id', 'accounting_journal_transactions.transaction_group','accounting_journal_transactions.debit','accounting_journal_transactions.credit','accounting_journal_transactions.created_at','akun.name as nama_akun')
      ->leftJoin('akun','akun.id','=','accounting_journal_transactions.akun_id')
      ->where('accounting_journal_transactions.journal_id', '=', $r['jurnal_id'])
      ->get();

    $data_send = [
      'akun_id' => $data[0]->akun_id,
      'jurnal_id' => $r['jurnal_id'],
      'type' => $data[0]->transaction_group,
      'debit' => $data[0]->debit,
      'credit' => $data[0]->credit,
    ];

    $data_result = $this->proses_update_saldo($data_send);

    $check_after_journal =  Journal::select('accounting_journals.id as jurnal_id', 'accounting_journals.balance', 'accounting_journals.akun_id', 'accounting_journal_transactions.debit', 'accounting_journal_transactions.credit', 'accounting_journal_transactions.transaction_group')
      ->leftJoin('accounting_journal_transactions', 'accounting_journal_transactions.journal_id', '=', 'accounting_journals.id')
      ->where('accounting_journals.akun_id', $data_result['akun_id'])
      ->where('accounting_journals.id', '>', $data_result['jurnal_id'])
      ->orderBy('accounting_journals.id', 'asc')
      ->get();
    if(isset($check_after_journal[0])){
      foreach ($check_after_journal as $i => $v) {
        $data_loop = [
          'akun_id' => $v->akun_id,
          'jurnal_id' => $v->jurnal_id,
          'type' => $v->transaction_group,
          'debit' => $v->debit,
          'credit' => $v->credit,
        ];
        $this->proses_update_saldo($data_loop);
      }  
    }
      
    return response()->json([
      'status' => true,
      'data' => $data,
      'message' => 'Saldo Jurnal Updated'
    ]);
  }

  public function jurnal_update(Request $request)
  {
    $r = $request->all();
    $data = JournalTransaction::where('journal_id',$r['id_jurnal_edit']);
    // dd($data);
    $data_update = [
      'debit' => $r['debit_edit'],
      'credit' => $r['kredit_edit']
    ];
    $data->update($data_update);
    return response()->json([
      'status' => true,
      'message' => 'Jurnal Updated'
    ]);
  }

  public function export_jurnalreport(Request $request)
  {
    global $title, $tag;
    $title = 'Jurnal';
    $tag = 'jurnal';
    $r = $request->all();
    $file = $r['bulan'] . '/' . $r['tahun'];
    $data = JournalTransaction::select(
      'accounting_journal_transactions.journal_id as id_jurnal',
      'accounting_journals.akun_id as akun',
      'akun.name as nama_akun',
      'accounting_journal_transactions.created_at as tanggal_jurnal',
      'accounting_journal_transactions.debit as debit',
      'accounting_journal_transactions.credit as kredit'
    )
      ->leftJoin('accounting_journals', 'accounting_journal_transactions.journal_id', '=', 'accounting_journals.id')
      ->leftJoin('akun', 'accounting_journals.akun_id', '=', 'akun.id')
      ->whereMonth('accounting_journal_transactions.created_at', '=', $r['bulan'])
      ->whereYear('accounting_journal_transactions.created_at', '=', '20' . $r['tahun'])
      ->get();

    $myFile = Excel::create($tag, function ($excel) use ($data) {
      global $title, $tag;
      $excel->setTitle($title);
      $excel->sheet($tag, function ($sheet) use ($data) {
        $sheet->fromArray($data, null, 'A1', true, true);
      });
    });

    $myFile = $myFile->string('xlsx');
    $response = array(
      'name' => "export_" . $tag . '/' . $file . ".xlsx",
      'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," . base64_encode($myFile)
    );

    return response()->json($response);

  }

  public function view_jurnal($from,$to)
  {
    $f = Carbon::createFromFormat('Y-m-d H:i:s', substr($from, 6, 4) . '-' . substr($from, 3, 2) . '-' . substr($from, 0, 2) . ' 00:00:00');
    $t = Carbon::createFromFormat('Y-m-d H:i:s', substr($to, 6, 4) . '-' . substr($to, 3, 2) . '-' . substr($to, 0, 2) . ' 23:59:00');

    $title      = 'Jurnal';
    $data       = JournalTransaction::select('akun.id as id_akun','akun.name as nama_akun', 'accounting_journal_transactions.journal_id as id_jurnal', 
    'accounting_journal_transactions.memo as deskripsi', 'accounting_journal_transactions.ref_id as ref_id', 
    'accounting_journal_transactions.created_at as tanggal_jurnal', 'accounting_journal_transactions.debit as debit', 
    'accounting_journal_transactions.credit as kredit', 'accounting_journals.balance as saldo'
    )
    ->leftJoin('accounting_journals', 'accounting_journal_transactions.journal_id', '=', 'accounting_journals.id')
    ->leftJoin('akun', 'accounting_journals.akun_id', '=', 'akun.id')
    ->whereBetween('accounting_journal_transactions.created_at', [$f,$t])
    ->orderBy('accounting_journal_transactions.journal_id','ASC')
    ->get();

     $data_total_debit = JournalTransaction::select(DB::raw('sum(debit) as total'))    
    ->whereBetween('created_at', [$f,$t])
    ->get();

     $data_total_kredit = JournalTransaction::select(DB::raw('sum(credit) as total'))    
    ->whereBetween('created_at', [$f,$t])
    ->get();

    $total_debit = 0;
    $total_kredit = 0;
    if(isset($data_total_debit[0]['total'])){
      $total_debit = $data_total_debit[0]['total'];
    }
    if(isset($data_total_kredit[0]['total'])){
      $total_kredit = $data_total_kredit[0]['total'];
    }

    // dd($data);

      $currency = 'Rp';
      $data_perusahaan = Param::all();
      $data_send = [
        'title'       =>  $title,
        'data'        =>  $data,
        'name_company'=>  $data_perusahaan[0]['name_perusahaan'],
        'alamat'      =>  'Office : '.$data_perusahaan[0]['alamat'],
        'telepon'     =>  'Telepon : '.$data_perusahaan[0]['telepon'],
        'logo'        =>  $data_perusahaan[0]['logo_perusahaan'],
        'currency'    =>  $currency,
        'priode'      =>  $f->addDay()->format('d/m/Y').' sampai '.$t->format('d/m/Y'),
        'total_debit' =>  $total_debit,
        'total_kredit'=>  $total_kredit,
      ];
      // dd($data_send);
      $pdf  = PDF::loadView('accounting.report.print.print_jurnal', $data_send);
      $pdf->setPaper('a4', 'landscape');
      return $pdf->stream();
  }

  public function neraca_saldo_index()
  {
    $data = [
      'title' => 'Neraca Saldo',
      'tag' => 'neraca_saldo',
      'bulan' => $this->getbulan(),
      'tahun' => $this->gettahun(),
      'tanggal' => $this->datenowtoview(),
    ];
    return view('accounting.report.neraca_saldo', $data);
  }

  public function neraca_saldo_api(Request $request)
  {
    $r = $request->all();

    $akun = DB::table('accounting_journal_transactions')
      ->select('accounting_journal_transactions.akun_id as akun', 'akun.name as nama_akun', 'akun.id as akun_id', DB::raw('(select category.name from category left join akun on akun.id_kategori = category.id where akun.id = akun_id) as category'), DB::raw('SUM(accounting_journal_transactions.debit) as debit'), DB::raw('SUM(accounting_journal_transactions.credit) as credit'))
      ->leftJoin('akun', 'accounting_journal_transactions.akun_id', '=', 'akun.id')
      ->whereMonth('accounting_journal_transactions.created_at', '=', $r['bulan'])
      ->whereYear('accounting_journal_transactions.created_at', '=', '20' . $r['tahun'])
      ->groupBy('akun', 'akun.id', 'akun.name')
      ->get();
    // dd($akun);
    return DataTables::of($akun)
      ->editColumn('debit', function ($akun) {
        return 'Rp. ' . number_format($akun->debit, 2);
      })
      ->editColumn('kredit', function ($akun) {
        return 'Rp. ' . number_format($akun->credit, 2);
      })
      ->editColumn('akun', function ($akun) {
        return $akun->akun;
      })
      ->editColumn('nama_akun', function ($akun) {
        return $akun->nama_akun;
      })
      ->make(true);
  }

  public function export_neraca_saldo(Request $request)
  {
    global $title, $tag;
    $title = 'Neraca Saldo';
    $tag = 'neraca_saldo';
    $r = $request->all();
    $file = $r['bulan'] . '/' . $r['tahun'];
    $data = JournalTransaction::select('accounting_journal_transactions.akun_id as akun', 'akun.name as nama_akun', DB::raw('SUM(accounting_journal_transactions.debit) as debit'), DB::raw('SUM(accounting_journal_transactions.credit) as credit'))
      ->leftJoin('akun', 'accounting_journal_transactions.akun_id', '=', 'akun.id')
      ->whereMonth('accounting_journal_transactions.created_at', '=', $r['bulan'])
      ->whereYear('accounting_journal_transactions.created_at', '=', '20' . $r['tahun'])
      ->groupBy('akun', 'akun.name')
      ->get();

    $myFile = Excel::create($tag, function ($excel) use ($data) {
      global $title, $tag;
      $excel->setTitle($title);
      $excel->sheet($tag, function ($sheet) use ($data) {
        $sheet->fromArray($data, null, 'A1', true, true);
      });
    });

    $myFile = $myFile->string('xlsx');
    $response = array(
      'name' => "export_" . $tag . '/' . $file . ".xlsx",
      'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," . base64_encode($myFile)
    );

    return response()->json($response);

  }



  /**
   * Work Sheet Report Controller
   */

  public function work_sheet_index()
  {
    $data = [
      'title' => 'Work Sheet',
      'tag' => 'work_sheet',
      'bulan' => $this->getbulan(),
      'tahun' => $this->gettahun(),
      'tanggal' => $this->datenowtoview(),
    ];
    return view('accounting.report.work_sheet', $data);
  }

  public function work_sheet_api(Request $request)
  {
    $r = $request->all();
    
    $akun = DB::table('akun')
      ->select('akun.name as nama_akun', 'akun.id as akun_id', 'akun.id_kategori', 'accounting_journal_transactions.akun_id as akun', DB::raw("CONCAT('0.00','') as dumy"), 
      DB::raw('(select name from category where id = akun.id_kategori) as category'), 
      DB::raw('SUM(accounting_journal_transactions.debit) as debit'), 
      DB::raw('SUM(accounting_journal_transactions.credit) as credit'),
      DB::raw('(select SUM(accounting_journal_transactions.debit) from akun where id = akun_id and kategori_laporan = \'LR\'  )  as laba_rugi_debit'),
      DB::raw('(select SUM(accounting_journal_transactions.credit) from akun where id = akun_id and kategori_laporan = \'LR\'  )  as laba_rugi_credit'),
      DB::raw('(select SUM(accounting_journal_transactions.debit) from akun where id = akun_id and kategori_laporan = \'N\'  )  as neraca_debit'),
      DB::raw('(select SUM(accounting_journal_transactions.credit) from akun where id = akun_id and kategori_laporan = \'N\'  )  as neraca_credit')
      )
      ->leftJoin('accounting_journal_transactions', 'accounting_journal_transactions.akun_id', '=', 'akun.id')
      // ->whereMonth('accounting_journal_transactions.created_at', '=', $r['bulan'])
      // ->whereYear('accounting_journal_transactions.created_at', '=', '20' . $r['tahun'])
      ->groupBy('akun', 'akun.id', 'akun.name', 'akun.id_kategori')
      ->where('akun.level', 4)
      ->orderBy('akun.id', 'ASC')
      ->get();
    // dd($akun);
    return DataTables::of($akun)
      ->editColumn('debit', function ($akun) {
        return number_format($akun->debit, 2);
        // return 'Rp. ' . number_format($akun->debit, 2);
      })
      ->editColumn('kredit', function ($akun) {
        return number_format($akun->credit, 2);
        // return 'Rp. ' . number_format($akun->credit, 2);
      })
      ->editColumn('laba_rugi_debit', function ($akun) {
        return number_format($akun->laba_rugi_debit, 2);
        // return 'Rp. ' . number_format($akun->credit, 2);
      })
      ->editColumn('laba_rugi_credit', function ($akun) {
        return number_format($akun->laba_rugi_credit, 2);
        // return 'Rp. ' . number_format($akun->credit, 2);
      })
      ->editColumn('neraca_debit', function ($akun) {
        return number_format($akun->neraca_debit, 2);
        // return 'Rp. ' . number_format($akun->credit, 2);
      })
      ->editColumn('neraca_credit', function ($akun) {
        return number_format($akun->neraca_credit, 2);
        // return 'Rp. ' . number_format($akun->credit, 2);
      })
      ->editColumn('akun', function ($akun) {
        return $akun->akun;
      })
      ->editColumn('nama_akun', function ($akun) {
        return $akun->nama_akun;
      })
      ->editColumn('id', function ($akun) {
        return $akun->akun_id;
      })
      ->make(true);
  }

  /* End Work Sheet */


  public function neraca_index()
  {
    $data = [
      'title' => 'Neraca',
      'tag' => 'neraca',
      'bulan' => $this->getbulan(),
      'tahun' => $this->gettahun(),
      'tanggal' => $this->datenowtoview(),
    ];
    return view('accounting.report.neraca', $data);
  }

  public function neraca_aktiva_api(Request $request)
  {
    $r = $request->all();
    $akun = DB::table('accounting_journal_transactions')
      ->select('accounting_journal_transactions.akun_id as akun', 'akun.name as nama_akun', DB::raw('SUM(accounting_journal_transactions.debit - accounting_journal_transactions.credit) as saldo'))
      ->leftJoin('akun', 'accounting_journal_transactions.akun_id', '=', 'akun.id')
      ->whereMonth('accounting_journal_transactions.created_at', '=', $r['bulan'])
      ->whereYear('accounting_journal_transactions.created_at', '=', '20' . $r['tahun'])
      ->groupBy('akun', 'akun.name')
      ->get();
    return DataTables::of($akun)
      ->editColumn('saldo', function ($akun) {
        return 'Rp. ' . number_format($akun->saldo, 2);
      })
      ->editColumn('akun', function ($akun) {
        return $akun->akun;
      })
      ->editColumn('nama_akun', function ($akun) {
        return $akun->nama_akun;
      })
      ->make(true);
  }

  public function export_neraca(Request $request)
  {
    global $title, $tag;
    $title = 'Neraca';
    $tag = 'neraca';
    $r = $request->all();
    $file = $r['bulan'] . '/' . $r['tahun'];
    $data = JournalTransaction::select('accounting_journal_transactions.akun_id as akun', 'akun.name as nama_akun', DB::raw('SUM(accounting_journal_transactions.debit) as debit'), DB::raw('SUM(accounting_journal_transactions.credit) as credit'))
      ->leftJoin('akun', 'accounting_journal_transactions.akun_id', '=', 'akun.id')
      ->whereMonth('accounting_journal_transactions.created_at', '=', $r['bulan'])
      ->whereYear('accounting_journal_transactions.created_at', '=', '20' . $r['tahun'])
      ->groupBy('akun', 'akun.name')
      ->get();

    $myFile = Excel::create($tag, function ($excel) use ($data) {
      global $title, $tag;
      $excel->setTitle($title);
      $excel->sheet($tag, function ($sheet) use ($data) {
        $sheet->fromArray($data, null, 'A1', true, true);
      });
    });

    $myFile = $myFile->string('xlsx');
    $response = array(
      'name' => "export_" . $tag . '/' . $file . ".xlsx",
      'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," . base64_encode($myFile)
    );

    return response()->json($response);

  }

  public function laba_rugi_index()
  {
    $data = [
      'title' => 'Laba Rugi',
      'tag' => 'laba_rugi',
      'bulan' => $this->getbulan(),
      'tahun' => $this->gettahun(),
      'tanggal' => $this->datenowtoview(),
    ];
    return view('accounting.report.laba_rugi', $data);
  }

  public function laba_rugi_income_api(Request $request)
  {
    $r = $request->all();
    $akun = DB::table('accounting_journal_transactions')
      ->select(
        'accounting_journal_transactions.akun_id as akun',
        'akun.name as nama_akun',
        DB::raw('SUM(accounting_journal_transactions.credit) as nilai')
      )
      ->leftJoin('akun', 'accounting_journal_transactions.akun_id', '=', 'akun.id')
      ->whereMonth('accounting_journal_transactions.created_at', '=', $r['bulan'])
      ->whereYear('accounting_journal_transactions.created_at', '=', '20' . $r['tahun'])
      ->where('accounting_journal_transactions.transaction_group', '=', 'income')
      ->groupBy('akun', 'akun.name')
      ->get();

    return DataTables::of($akun)
      ->editColumn('nilai', function ($akun) {
        return 'Rp. ' . number_format($akun->nilai, 2);
      })
      ->editColumn('akun', function ($akun) {
        return $akun->akun;
      })
      ->editColumn('nama_akun', function ($akun) {
        return $akun->nama_akun;
      })
      ->make(true);
  }

  public function laba_rugi_expense_api(Request $request)
  {
    $r = $request->all();
    $akun = DB::table('accounting_journal_transactions')
      ->select(
        'accounting_journal_transactions.akun_id as akun',
        'akun.name as nama_akun',
        DB::raw('SUM(accounting_journal_transactions.debit) as nilai')
      )
      ->leftJoin('akun', 'accounting_journal_transactions.akun_id', '=', 'akun.id')
      ->whereMonth('accounting_journal_transactions.created_at', '=', $r['bulan'])
      ->whereYear('accounting_journal_transactions.created_at', '=', '20' . $r['tahun'])
      ->where('accounting_journal_transactions.transaction_group', '=', 'expense')
      ->groupBy('akun', 'akun.name')
      ->get();

    return DataTables::of($akun)
      ->editColumn('nilai', function ($akun) {
        return 'Rp. ' . number_format($akun->nilai, 2);
      })
      ->editColumn('akun', function ($akun) {
        return $akun->akun;
      })
      ->editColumn('nama_akun', function ($akun) {
        return $akun->nama_akun;
      })
      ->make(true);
  }

  public function get_laba(Request $request)
  {
    $r = $request->all();
    $data_income = DB::table('accounting_journal_transactions')
      ->select(DB::raw('SUM(accounting_journal_transactions.credit) as nilai'))
      ->whereMonth('accounting_journal_transactions.created_at', '=', $r['bulan'])
      ->whereYear('accounting_journal_transactions.created_at', '=', '20' . $r['tahun'])
      ->where('accounting_journal_transactions.transaction_group', '=', 'income')
      ->get();

    $income = (isset($data_income[0]->nilai)) ? $data_income[0]->nilai : 0;

    $data_expense = DB::table('accounting_journal_transactions')
      ->select(DB::raw('SUM(accounting_journal_transactions.debit) as nilai'))
      ->whereMonth('accounting_journal_transactions.created_at', '=', $r['bulan'])
      ->whereYear('accounting_journal_transactions.created_at', '=', '20' . $r['tahun'])
      ->where('accounting_journal_transactions.transaction_group', '=', 'expense')
      ->get();

    $expense = (isset($data_expense[0]->nilai)) ? $data_expense[0]->nilai : 0;
    $laba = $income - $expense;

    return response()->json([
      'status' => true,
      'income' => number_format($income, 2),
      'expense' => number_format($expense, 2),
      'laba' => number_format($laba, 2),
    ]);
  }

  public function export_income_laba_rugi(Request $request)
  {
    global $title, $tag;
    $title = 'Laba Rugi';
    $tag = 'laba_rugi';
    $r = $request->all();
    $file = $r['bulan'] . '/' . $r['tahun'];
    $data = JournalTransaction::select(
      'accounting_journal_transactions.akun_id as akun',
      'akun.name as nama_akun',
      DB::raw('SUM(accounting_journal_transactions.credit) as nilai')
    )
      ->leftJoin('akun', 'accounting_journal_transactions.akun_id', '=', 'akun.id')
      ->whereMonth('accounting_journal_transactions.created_at', '=', $r['bulan'])
      ->whereYear('accounting_journal_transactions.created_at', '=', '20' . $r['tahun'])
      ->where('accounting_journal_transactions.transaction_group', '=', 'income')
      ->groupBy('akun', 'akun.name')
      ->get();

    $myFile = Excel::create($tag, function ($excel) use ($data) {
      global $title, $tag;
      $excel->setTitle($title);
      $excel->sheet($tag, function ($sheet) use ($data) {
        $sheet->fromArray($data, null, 'A1', true, true);
      });
    });

    $myFile = $myFile->string('xlsx');
    $response = array(
      'name' => "export_income_" . $tag . '/' . $file . ".xlsx",
      'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," . base64_encode($myFile)
    );

    return response()->json($response);
  }


  public function pembelian_view($type,$id)
    {
      // dd($type,$id);
      $titletype = '';
      if($type == 'bb'){
        $data = PembelianBB::findOrFail($id);
        $titletype = 'BAHAN BAKU';
      } elseif ($type == 'acc') {
        $data = PembelianAcc::findOrFail($id);
        $titletype = 'ACCESSORIES';
      } else {
        $data = PembelianBJ::findOrFail($id);
        $titletype = 'BARANG JADI';
      }
      // dd($data);
      if (!isset($data)) {
        abort(404);
      } else {
        $title      = 'DETAIL PEMBELIAN '.$titletype;

        if($type == 'bb'){
        $data  = DB::table('pembelian_bb_detail')->select( 'pembelian_bb.*', 'pembelian_bb_detail.*', 'pembelian_bb_detail.kode_bb as kode_barang', 'supplier.name as nama_supplier', 'satuan.name as nama_satuan', 'warna.name as nama_warna_or_brand', 'master_bb.name as nama_barang' )
        ->leftJoin('warna', 'pembelian_bb_detail.id_warna', '=', 'warna.id')->leftJoin('satuan', 'pembelian_bb_detail.id_satuan', '=', 'satuan.id')->leftJoin('supplier', 'pembelian_bb_detail.id_supplier', '=', 'supplier.id')->leftJoin('master_bb', 'pembelian_bb_detail.kode_bb', '=', 'master_bb.id')->leftJoin('pembelian_bb', 'pembelian_bb.id', '=', 'pembelian_bb_detail.id_bp')->where('pembelian_bb.id', '=', $id)->get();
        $total = DB::table('pembelian_bb_detail')->select( DB::raw('sum(harga) as total_harga'), DB::raw('sum(jumlah) as total_jumlah') )->where('id_bp', '=', $id)->get();
        } elseif ($type == 'acc') {
        $data  = DB::table('pembelian_acc_detail')->select( 'pembelian_acc.*', 'pembelian_acc_detail.*', 'pembelian_acc_detail.kode_acc as kode_barang', 'supplier.name as nama_supplier', 'satuan.name as nama_satuan', 'brand.name as nama_warna_or_brand', 'master_acc.name as nama_barang' )
        ->leftJoin('brand', 'pembelian_acc_detail.id_brand', '=', 'brand.id')->leftJoin('satuan', 'pembelian_acc_detail.id_satuan', '=', 'satuan.id')->leftJoin('supplier', 'pembelian_acc_detail.id_supplier', '=', 'supplier.id')->leftJoin('master_acc', 'pembelian_acc_detail.kode_acc', '=', 'master_acc.id')->leftJoin('pembelian_acc', 'pembelian_acc.id', '=', 'pembelian_acc_detail.id_bp')->where('pembelian_acc.id', '=', $id)->get();
        $total = DB::table('pembelian_acc_detail')->select( DB::raw('sum(harga) as total_harga'), DB::raw('sum(jumlah) as total_jumlah') )->where('id_bp', '=', $id)->get();
        } else {
        $data  = DB::table('pembelian_bj_detail')->select( 'pembelian_bj.*', 'pembelian_bj_detail.*', 'pembelian_bj_detail.id as id_bp', 'pembelian_bj_detail.kode_bj as kode_barang', 'supplier.name as nama_supplier', 'satuan.name as nama_satuan', 'warna.name as nama_warna_or_brand', 'master_bj.name as nama_barang' )
        ->leftJoin('warna', 'pembelian_bj_detail.id_warna', '=', 'warna.id')->leftJoin('satuan', 'pembelian_bj_detail.id_satuan', '=', 'satuan.id')->leftJoin('supplier', 'pembelian_bj_detail.id_supplier', '=', 'supplier.id')->leftJoin('master_bj', 'pembelian_bj_detail.kode_bj', '=', 'master_bj.id')->leftJoin('pembelian_bj', 'pembelian_bj.id', '=', 'pembelian_bj_detail.id')->where('pembelian_bj.id', '=', $id)->get();
        $total = DB::table('pembelian_bj_detail')->select( DB::raw('sum(harga) as total_harga'), DB::raw('sum(jumlah) as total_jumlah') )->where('id', '=', $id)->get();
        }
        // $data  = DB::table('pembelian_bb_detail')->select( 'pembelian_bb.*', 'pembelian_bb_detail.*', 'supplier.name as nama_supplier', 'satuan.name as nama_satuan', 'warna.name as nama_warna', 'master_bb.name as nama_bb' )
        // ->leftJoin('warna', 'pembelian_bb_detail.id_warna', '=', 'warna.id')->leftJoin('satuan', 'pembelian_bb_detail.id_satuan', '=', 'satuan.id')->leftJoin('supplier', 'pembelian_bb_detail.id_supplier', '=', 'supplier.id')->leftJoin('master_bb', 'pembelian_bb_detail.kode_bb', '=', 'master_bb.id')->leftJoin('pembelian_bb', 'pembelian_bb.id', '=', 'pembelian_bb_detail.id_bp')->where('pembelian_bb.id', '=', $id)->get();
        // $total = DB::table('pembelian_bb_detail')->select( DB::raw('sum(harga) as total_harga'), DB::raw('sum(jumlah) as total_jumlah') )->where('id_bp', '=', $id)->get();

          $data = [
            'title'       =>  $title,
            'data'        =>  $data,
            'total'        =>  $total
          ];

          $pdf  = PDF::loadView('accounting.print.pembelian', $data);
          $pdf->setPaper('a4', 'landscape');
          return $pdf->stream();
        }
      }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

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
use App\Art;
use App\CatatanProduksi;
use App\PermintaanBB;
use App\PermintaanBBDetail;
use App\PermintaanAcc;
use App\PermintaanAccDetail;
use App\PemakaianBB;
use App\PemakaianBBDetail;
use App\PemakaianAcc;
use App\PemakaianAccDetail;
use App\ReturBB;
use App\ReturBBDetail;
use App\ReturAcc;
use App\ReturAccDetail;
use App\MasterBB;
use App\MasterAcc;
use App\KeluarBB;
use App\KeluarBBDetail;
use App\KeluarAcc;
use App\KeluarAccDetail;
use App\KartuPersediaanBB;
use App\KartuPersediaanAcc;
use App\KartuPersediaanBJ;
use App\PostArtDetail;

class ProduksiController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function permintaan_bb_index()
  {
    $kode = 'BP';
    $title = 'Permintaan Bahan Baku';
    $tag = 'permintaan_bb';
    $tanggal = $this->datenowtoview();
    $newid = $this->genid('PermintaanBB', 'BP');

    return view('produksi.permintaan_bb', ['newid' => $newid, 'title' => $title, 'tag' => $tag, 'tanggal' => $tanggal]);
  }

  public function permintaan_bb_create(Request $request)
  {

    $index = $this->genindex('PermintaanBB');
    $data = [
      'id' => $request['no_bukti_permintaan'],
      'index' => $index,
      'tanggal' => $this->datetodb($request['tanggal']),
      'id_so' => $request['id_so'],
      'total' => floatval($request['total']),
      'id_satuan' => $request['satuan_id'][0],
      'isactive' => 'A'
    ];

    for ($i = 0; $i < count($request['id_bb']); $i++) {
      $data_detail = [
        'no_bukti_permintaan' => $request['no_bukti_permintaan'],
        'tanggal' => $this->datetodb($request['tanggal']),
        'index' => $i,
        'kode_bb' => $request['kode_bb'][$i],
        'id_bb' => $request['id_bb'][$i],
        'id_warna' => $request['id_warna'][$i],
        'id_supplier' => $request['id_supplier'][$i],
        'qty' => floatval($this->ribuantodb($request['qty'][$i])),
        'id_satuan' => $request['satuan_id'][$i],
        'ket' => $request['ket'][$i],
        'isactive' => 'A'
      ];

      PermintaanBBDetail::create($data_detail);
    }

    PermintaanBB::create($data);
    $update_status = So::where('id', $request['id_so'])->update([
      'permintaan_bb_post' => 'Y',
      'updated_at' => Carbon::now()
    ]);
    $newid = $this->genid('PermintaanBB', 'BP');
    return response()->json([
      'status' => true,
      'message' => 'PermintaanBB created',
      'newid' => $newid
    ]);
  }

  public function permintaan_bb_api()
  {
    $data = DB::table('permintaan_bb')
      ->select('permintaan_bb.*', 'so.produksi_id as id_produksi', 'so.name as nama_produk', 'satuan.name as nama_satuan')
      ->join('so', 'permintaan_bb.id_so', '=', 'so.id')
      ->join('satuan', 'permintaan_bb.id_satuan', '=', 'satuan.id')
      ->get();
    return DataTables::of($data)
      ->editColumn('qty', function ($data) {
        return number_format($data->total, 2) . ' ' . $data->nama_satuan;
      })
      ->make(true);
  }

  public function permintaan_acc_index()
  {
    $kode = 'BP';
    $title = 'Permintaan Accessories';
    $tag = 'permintaan_acc';
    $tanggal = $this->datenowtoview();
    $newid = $this->genid('PermintaanAcc', 'BP');

    return view('produksi.permintaan_acc', ['newid' => $newid, 'title' => $title, 'tag' => $tag, 'tanggal' => $tanggal]);
  }

  public function permintaan_acc_create(Request $request)
  {

    $index = $this->genindex('PermintaanAcc');
    $data = [
      'id' => $request['no_bukti_permintaan'],
      'index' => $index,
      'tanggal' => $this->datetodb($request['tanggal']),
      'id_so' => $request['id_so'],
      'total' => $request['total'],
      'id_satuan' => $request['satuan_id'][0],
      'isactive' => 'A'
    ];

    for ($i = 0; $i < count($request['id_acc']); $i++) {
      $data_detail = [
        'no_bukti_permintaan' => $request['no_bukti_permintaan'],
        'tanggal' => $this->datetodb($request['tanggal']),
        'index' => $i,
        'kode_acc' => $request['kode_acc'][$i],
        'id_acc' => $request['id_acc'][$i],
        'id_brand' => $request['id_brand'][$i],
        'id_supplier' => $request['id_supplier'][$i],
        'qty' => $this->ribuantodb($request['qty'][$i]),
        'id_satuan' => $request['satuan_id'][$i],
        'ket' => $request['ket'][$i],
        'isactive' => 'A'
      ];

      PermintaanAccDetail::create($data_detail);
    }

    PermintaanAcc::create($data);
    $update_status = So::where('id', $request['id_so'])->update([
      'permintaan_acc_post' => 'Y',
      'updated_at' => Carbon::now()
    ]);
    $newid = $this->genid('PermintaanAcc', 'BP');
    return response()->json([
      'status' => true,
      'message' => 'PermintaanAcc created',
      'newid' => $newid
    ]);
  }

  public function permintaan_acc_api()
  {
    $data = DB::table('permintaan_acc')
      ->select('permintaan_acc.*', 'so.produksi_id as id_produksi', 'so.name as nama_produk', 'satuan.name as nama_satuan')
      ->join('so', 'permintaan_acc.id_so', '=', 'so.id')
      ->join('satuan', 'permintaan_acc.id_satuan', '=', 'satuan.id')
      ->get();
    return DataTables::of($data)
      ->editColumn('qty', function ($data) {
        return number_format($data->total, 2) . ' ' . $data->nama_satuan;
      })
      ->make(true);
  }

  public function pemakaian_bb_index()
  {
    $title = 'Pemakaian Bahan Baku';
    $tag = 'pemakaian_bb';
    $tanggal = $this->datenowtoview();
    $index = $this->genindex('PemakaianBB');
    $newid = $this->genid('PemakaianBB', 'PB');

    return view('produksi.pemakaian_bb', ['newid' => $newid, 'title' => $title, 'tag' => $tag, 'tanggal' => $tanggal]);
  }

  public function pemakaian_bb_create(Request $request)
  {
    $jumlah = 0;
    $status_retur = 'N';
    for ($i = 0; $i < count($request['acc']); $i++) {
      $c = $request['acc'][$i];

      // Validasi Stok
      $master_bb = MasterBB::where('id', $request['kode_bb'][$c])->get();
    
      //Validasi Jumlah pengeluaran 
      $keluar_bb = KeluarBBDetail::where('id_permintaan', $request['no_bukti_permintaan'])
        ->where('kode_bb', $request['kode_bb'][$c])
        ->sum('qty');

      if ($this->ribuantodb($request['qty_pemakaian'][$c]) > $keluar_bb) {
        return response()->json([
          'status' => false,
          'message' => 'Pemakaian Melebihi Pengeluaran',
        ]);
      }

    }

    for ($i = 0; $i < count($request['acc']); $i++) {
      $c = $request['acc'][$i];
      $harga = MasterBB::where('id', $request['kode_bb'][$c])->get();
      if (isset($harga)) {
        $harga = $harga[0]['harga_default'];
      } else {
        $harga = 0;
      }

      $keluar_bb = KeluarBBDetail::where('id_keluar', $request['no_bukti_keluar'])
        ->where('id_permintaan', $request['no_bukti_permintaan'])
        ->where('kode_bb', $request['kode_bb'][$c])
        ->sum('qty');

      ($keluar_bb - floatval($this->ribuantodb($request['qty_pemakaian'][$c])) > 0) ? $status_retur = 'Y' : 'N';
      $jumlah = $jumlah + (floatval($harga) * floatval($this->ribuantodb($request['qty_pemakaian'][$c])));
      $data_detail = [
        'no_bukti_pemakaian' => $request['no_bukti_pemakaian'],
        'no_bukti_permintaan' => $request['no_bukti_permintaan'],
        'index' => $i,
        'tanggal' => $this->datetodb($request['tanggal']),
        'kode_bb' => $request['kode_bb'][$c],
        'id_bb' => $request['id_bb'][$c],
        'id_warna' => $request['id_warna'][$c],
        'id_supplier' => $request['id_supplier'][$c],
        'qty' => floatval($this->ribuantodb($request['qty_pemakaian'][$c])),
        'qty_retur' => $keluar_bb - floatval($this->ribuantodb($request['qty_pemakaian'][$c])),
        'jumlah' => (floatval($harga) * floatval($this->ribuantodb($request['qty_pemakaian'][$c]))),
        'hasil_cutt' => floatval($this->ribuantodb($request['hasil_cutt'][$c])),
        'ket' => $request['ket'][$c],
        'isactive' => 'A'
      ];
      PemakaianBBDetail::create($data_detail);
    }

    $cek_pemakaian = PemakaianBB::select('jumlah')->where('id', $request['no_bukti_pemakaian'])->get();
    if (isset($cek_pemakaian[0]['jumlah'])) {
      $data = [
        'jumlah' => floatval($jumlah) + floatval($cek_pemakaian[0]['jumlah']),
      ];
      $pemakaian_create = PemakaianBB::where('id', $request['no_bukti_pemakaian'])->update($data);
    } else {
      $index = $this->genindex('PemakaianBB');
      $data = [
        'id' => $request['no_bukti_pemakaian'],
        'id_cmt' => $request['id_cmt'],
        'id_bukti_permintaan' => $request['no_bukti_permintaan'],
        'index' => $index,
        'jumlah' => floatval($jumlah),
        'tanggal' => $this->datetodb($request['tanggal']),
        'id_so' => $request['id_so'],
        'status_retur' => $status_retur,
        'isactive' => 'A'
      ];
      $pemakaian_create = PemakaianBB::create($data);
    }

    $get_total_pengeluaran = KeluarBBDetail::where('id_keluar',$request['no_bukti_keluar'])->sum('qty');
    $get_total_pemakaian = PemakaianBBDetail::where('no_bukti_permintaan',$request['no_bukti_permintaan'])->sum('qty');

    if($get_total_pengeluaran > $get_total_pemakaian){
      $data_status_retur = [
        'status_retur' => 'Y',
      ];
      PemakaianBB::where('id', $request['no_bukti_pemakaian'])->update($data_status_retur);
    }

    return response()->json([
      'status' => true,
      'message' => 'Pemakaian BB created',
    ]);
  }

  public function pemakaian_bb_update(Request $request)
  {
    $jumlah = 0;
    $status_retur = 'N';
    // dd($request->all());
    for ($i = 0; $i < count($request['kode_bb_edit']); $i++) {
      $c = $request['kode_bb_edit'][$i];
      // Validasi Stok
      // $master_bb = MasterBB::where('id', $request['kode_bb'][$c])->get();
    
      //Validasi Jumlah pengeluaran 
      $keluar_bb = KeluarBBDetail::where('id_permintaan', $request['no_bukti_permintaan_edit'])
      ->where('kode_bb', $request['kode_bb_edit'][$i])
        ->sum('qty');

        if ($this->ribuantodb($request['qty_pemakaian_edit'][$i]) > $keluar_bb) {
        return response()->json([
          'status' => false,
          'message' => 'Pemakaian Melebihi Pengeluaran',
          ]);
        }
        
        // dd($i);
    }

    for ($i = 0; $i < count($request['kode_bb_edit']); $i++) {
      $c = $i;
      $harga = MasterBB::where('id', $request['kode_bb_edit'][$c])->get();
      // dd($request['kode_bb_edit'][$c]);
      if (isset($harga[0])) {
        $harga = $harga[0]['harga_default'];
      } else {
        $harga = 0;
      }
      // dd($harga);
      $keluar_bb = KeluarBBDetail::where('id_keluar', $request['no_bukti_keluar_edit'])
        ->where('id_permintaan', $request['no_bukti_permintaan_edit'])
        ->where('kode_bb', $request['kode_bb_edit'][$c])
        ->sum('qty');

      ($keluar_bb - floatval($this->ribuantodb($request['qty_pemakaian_edit'][$c])) > 0) ? $status_retur = 'Y' : 'N';
      $jumlah = $jumlah + (floatval($harga) * floatval($this->ribuantodb($request['qty_pemakaian_edit'][$c])));
      $data_detail = [
        'no_bukti_pemakaian' => $request['no_bukti_pemakaian_edit'],
        'no_bukti_permintaan' => $request['no_bukti_permintaan_edit'],
        'index' => $i,
        'tanggal' => $this->datetodb($request['tanggal_edit']),
        'kode_bb' => $request['kode_bb_edit'][$c],
        'id_bb' => $request['id_bb_edit'][$c],
        'id_warna' => $request['id_warna_edit'][$c],
        'id_supplier' => $request['id_supplier_edit'][$c],
        'qty' => floatval($this->ribuantodb($request['qty_pemakaian_edit'][$c])),
        'qty_retur' => $keluar_bb - floatval($this->ribuantodb($request['qty_pemakaian_edit'][$c])),
        'jumlah' => (floatval($harga) * floatval($this->ribuantodb($request['qty_pemakaian_edit'][$c]))),
        'hasil_cutt' => floatval($this->ribuantodb($request['hasil_cutt_edit'][$c])),
        'ket' => $request['ket_edit'][$c],
        'isactive' => 'A'
      ];
      PemakaianBBDetail::where('kode_bb',$request['kode_bb_edit'][$c])->delete();
      PemakaianBBDetail::create($data_detail);
    }

    $index = $this->genindex('PemakaianBB');
    $data = [
      'id' => $request['no_bukti_pemakaian_edit'],
      'id_bukti_permintaan' => $request['no_bukti_permintaan_edit'],
      'index' => $index,
      'jumlah' => floatval($jumlah),
      'tanggal' => $this->datetodb($request['tanggal_edit']),
      'id_so' => $request['id_so_edit'],
      'id_cmt' => $request['id_cmt_edit'],
      'status_retur' => $status_retur,
      'isactive' => 'A'
    ];
    // dd($data);
    $delete_create = PemakaianBB::where('id',$request['no_bukti_pemakaian_edit'])->delete();
    $pemakaian_create = PemakaianBB::create($data);

    $get_total_pengeluaran = KeluarBBDetail::where('id_keluar',$request['no_bukti_keluar_edit'])->sum('qty');
    $get_total_pemakaian = PemakaianBBDetail::where('no_bukti_permintaan',$request['no_bukti_permintaan_edit'])->sum('qty');

    if($get_total_pengeluaran > $get_total_pemakaian){
      $data_status_retur = [
        'status_retur' => 'Y',
      ];
      PemakaianBB::where('id', $request['no_bukti_pemakaian_edit'])->update($data_status_retur);
    }

    return response()->json([
      'status' => true,
      'message' => 'Pemakaian BB Updated',
    ]);
  }

  public function pemakaian_bb_api()
  {
    $pemakaian_bb = DB::table('pemakaian_bb')
      ->select('pemakaian_bb.id', 'pemakaian_bb.id_so as id_so', 'pemakaian_bb.jumlah as jumlah', 'pemakaian_bb.tanggal', 'so.produksi_id as id_produksi', 'so.ispost as ispost', DB::raw('SUM(pemakaian_bb_detail.qty) As qty'), DB::raw('SUM(pemakaian_bb_detail.hasil_cutt) As hasil_cutt'), 'satuan.name as nama_satuan')
      ->leftjoin('so', 'pemakaian_bb.id_so', '=', 'so.id')
      ->leftjoin('pemakaian_bb_detail', 'pemakaian_bb.id', '=', 'pemakaian_bb_detail.no_bukti_pemakaian')
      ->leftjoin('satuan', 'pemakaian_bb_detail.id_satuan', '=', 'satuan.id')
      ->groupBy('pemakaian_bb.id')
      ->groupBy('pemakaian_bb.id_so')
      ->groupBy('pemakaian_bb.jumlah')
      ->groupBy('pemakaian_bb.tanggal')
      ->groupBy('so.ispost')
      ->groupBy('so.produksi_id')
      ->groupBy('satuan.name')
      ->get();

    return DataTables::of($pemakaian_bb)
      ->editColumn('tanggal', function ($pembelian_bb) {
        return $this->datetoview($pembelian_bb->tanggal);
      })
      ->editColumn('qty', function ($pembelian_bb) {
        return number_format($pembelian_bb->qty, 2) . ' ' . $pembelian_bb->nama_satuan;
      })
      ->editColumn('hasil_cutt', function ($pembelian_bb) {
        return number_format($pembelian_bb->hasil_cutt) . ' Pcs ';
      })
      ->editColumn('jumlah', function ($pembelian_bb) {
        return 'Rp. ' . number_format($pembelian_bb->jumlah);
      })
      ->make(true);
  }

  public function pemakaian_bb_so_api()
  {
    $pemakaian_bb = DB::table('pemakaian_bb')
      ->select('pemakaian_bb.id', 'so.name as nama_produk', 'pemakaian_bb.id_so as id_so', 'pemakaian_bb.jumlah as jumlah', 'pemakaian_bb.tanggal', 'so.produksi_id as id_produksi', 'so.ispost as ispost', DB::raw('SUM(pemakaian_bb_detail.qty) As qty_pemakaian'), DB::raw('SUM(pemakaian_bb_detail.hasil_cutt) As hasil_cutt'))
      ->leftjoin('so', 'pemakaian_bb.id_so', '=', 'so.id')
      ->leftjoin('pemakaian_bb_detail', 'pemakaian_bb.id', '=', 'pemakaian_bb_detail.no_bukti_pemakaian')
      // ->leftjoin('satuan', 'pemakaian_bb_detail.id_satuan', '=', 'satuan.id')
      ->groupBy('pemakaian_bb.id')
      ->groupBy('pemakaian_bb.id_so')
      ->groupBy('pemakaian_bb.jumlah')
      ->groupBy('pemakaian_bb.tanggal')
      ->groupBy('so.ispost')
      ->groupBy('so.produksi_id')
      ->groupBy('so.name')
      // ->groupBy('satuan.name')
      ->get();

    return DataTables::of($pemakaian_bb)
      ->editColumn('qty_pemakaian', function ($pemakaian_bb) {
        return number_format($pemakaian_bb->qty_pemakaian, 2);
      })
      ->editColumn('hasil_cutt', function ($pemakaian_bb) {
        return number_format($pemakaian_bb->hasil_cutt) . ' Pcs ';
      })
      ->editColumn('action', function ($pemakaian_bb) {
        if ($pemakaian_bb->ispost == 'Y') {
          return 'Sudah Di Posting';
        } else {
          return '<a class="btn btn-warning btn-xs" onclick="editData(\'' . $pemakaian_bb->id_so . '\')"><i class="fa fa-pencil"></i> Edit</a>
          <a data-toggle="modal" data-target="#modalPost" onclick="modalPenyerian(\'' . $pemakaian_bb->id_so . '\')" class="btn btn-primary btn-xs" onclick="modalPenyerian(\'' . $pemakaian_bb->id_so . '\')"><i class="fa fa-child"></i> Art</a>';
        }
      })
      ->make(true);
  }

  public function get_permintaan_bb(Request $request)
  {

    $data = DB::table('permintaan_bb')
      ->select(
        'permintaan_bb.*',
        'so.produksi_id as id_produksi',
        'so.name as nama_produk',
        'permintaan_bb_detail.qty as qty',
        'permintaan_bb_detail.kode_bb as kode_bb',
        'permintaan_bb_detail.*',
        'bahan_baku.name as nama_bb',
        'warna.name as nama_warna',
        'supplier.name as nama_supplier',
        'satuan.name as nama_satuan'
      )
      ->join('so', 'permintaan_bb.id_so', '=', 'so.id')
      ->join('permintaan_bb_detail', 'permintaan_bb.id', '=', 'permintaan_bb_detail.no_bukti_permintaan')
      ->join('bahan_baku', 'permintaan_bb_detail.id_bb', '=', 'bahan_baku.id')
      ->join('warna', 'permintaan_bb_detail.id_warna', '=', 'warna.id')
      ->join('supplier', 'permintaan_bb_detail.id_supplier', '=', 'supplier.id')
      ->join('satuan', 'permintaan_bb_detail.id_satuan', '=', 'satuan.id')
      ->where('so.id', '=', $request['id'])
      ->where('isactive', '=', 'A')
      ->get();

    return response()->json($data);
  }


  public function pemakaian_acc_index()
  {
    $kode = 'PA';
    $title = 'Pemakaian Accessoris';
    $tag = 'pemakaian_acc';
    $tanggal = $this->datenowtoview();
    $index = $this->genindex('PemakaianAcc');
    $newid = $this->genid('PemakaianAcc', 'PA');

    return view('produksi.pemakaian_acc', ['newid' => $newid, 'title' => $title, 'tag' => $tag, 'tanggal' => $tanggal]);
  }

  public function pemakaian_acc_create(Request $request)
  {
    $jumlah = 0;
    $status_retur = 'N';
    for ($i = 0; $i < count($request['acc']); $i++) {
      $c = $request['acc'][$i];

      // Validasi Stok
      $master_acc = MasterAcc::where('id', $request['kode_acc'][$c])->get();
    
      //Validasi Jumlah pengeluaran 
      $keluar_acc = KeluarAccDetail::where('id_permintaan', $request['no_bukti_permintaan'])
        ->where('kode_acc', $request['kode_acc'][$c])
        ->sum('qty');

      if ($this->ribuantodb($request['qty_pemakaian'][$c]) > $keluar_acc) {
        return response()->json([
          'status' => false,
          'message' => 'Pemakaian Melebihi Pengeluaran',
        ]);
      }

    }

    for ($i = 0; $i < count($request['acc']); $i++) {
      $c = $request['acc'][$i];
      $harga = MasterAcc::where('id', $request['kode_acc'][$c])->get();
      if (isset($harga)) {
        $harga = $harga[0]['harga_default'];
      } else {
        $harga = 0;
      }

      $keluar_acc = KeluarAccDetail::where('id_keluar', $request['no_bukti_keluar'])
        ->where('id_permintaan', $request['no_bukti_permintaan'])
        ->where('kode_acc', $request['kode_acc'][$c])
        ->sum('qty');

      ($keluar_acc - floatval($this->ribuantodb($request['qty_pemakaian'][$c])) > 0) ? $status_retur = 'Y' : 'N';
      $jumlah = $jumlah + (floatval($harga) * floatval($this->ribuantodb($request['qty_pemakaian'][$c])));
      $data_detail = [
        'no_bukti_pemakaian' => $request['no_bukti_pemakaian'],
        'no_bukti_permintaan' => $request['no_bukti_permintaan'],
        'index' => $i,
        'tanggal' => $this->datetodb($request['tanggal']),
        'kode_acc' => $request['kode_acc'][$c],
        'id_acc' => $request['id_acc'][$c],
        'id_brand' => $request['id_brand'][$c],
        'id_supplier' => $request['id_supplier'][$c],
        'qty' => floatval($this->ribuantodb($request['qty_pemakaian'][$c])),
        'qty_retur' => $keluar_acc - floatval($this->ribuantodb($request['qty_pemakaian'][$c])),
        'jumlah' => (floatval($harga) * floatval($this->ribuantodb($request['qty_pemakaian'][$c]))),
        'hasil_cutt' => floatval($this->ribuantodb($request['hasil_cutt'][$c])),
        'ket' => $request['ket'][$c],
        'isactive' => 'A'
      ];
      PemakaianAccDetail::create($data_detail);
      // dd($data_detail);
    }

    $cek_pemakaian = PemakaianAcc::select('jumlah')->where('id', $request['no_bukti_pemakaian'])->get();
    if (isset($cek_pemakaian[0]['jumlah'])) {
      $data = [
        'jumlah' => floatval($jumlah) + floatval($cek_pemakaian[0]['jumlah']),
      ];
      $pemakaian_create = PemakaianAcc::where('id', $request['no_bukti_pemakaian'])->update($data);
    } else {
      $index = $this->genindex('PemakaianAcc');
      $data = [
        'id' => $request['no_bukti_pemakaian'],
        'id_bukti_permintaan' => $request['no_bukti_permintaan'],
        'index' => $index,
        'jumlah' => floatval($jumlah),
        'tanggal' => $this->datetodb($request['tanggal']),
        'id_so' => $request['id_so'],
        'status_retur' => $status_retur,
        'isactive' => 'A'
      ];
      $pemakaian_create = PemakaianAcc::create($data);
    }

    $get_total_pengeluaran = KeluarAccDetail::where('id_keluar',$request['no_bukti_keluar'])->sum('qty');
    $get_total_pemakaian = PemakaianAccDetail::where('no_bukti_permintaan',$request['no_bukti_permintaan'])->sum('qty');

    if($get_total_pengeluaran > $get_total_pemakaian){
      $data_status_retur = [
        'status_retur' => 'Y',
      ];
      PemakaianAcc::where('id', $request['no_bukti_pemakaian'])->update($data_status_retur);
    }

    $get_permintaan = PermintaanAccDetail::select('kode_acc')->where('no_bukti_permintaan',$request['no_bukti_permintaan'])
    ->groupBy('kode_acc')
    ->get();
    $get_pemakaian = PemakaianAccDetail::select('kode_acc')->where('no_bukti_permintaan',$request['no_bukti_permintaan'])
    ->groupBy('kode_acc')
    ->get();

    if(count($get_permintaan) == count($get_pemakaian)){
      $data_status_pemakaian = [
        'pemakaian_acc_post' => 'Y',
      ];
      So::where('id', $request['id_so'])->update($data_status_pemakaian);
    }

    return response()->json([
      'status' => true,
      'message' => 'Pemakaian Accessories Created',
    ]);
  }

  public function pemakaian_acc_api()
  {
    $pemakaian_acc = DB::table('pemakaian_acc')
      ->select('pemakaian_acc.id', 'pemakaian_acc.id_so as id_so', 'pemakaian_acc.jumlah as jumlah', 'pemakaian_acc.tanggal', 'so.produksi_id as id_produksi', 'so.ispost as ispost', DB::raw('SUM(pemakaian_acc_detail.qty) As qty'), 'satuan.name as nama_satuan')
      ->leftjoin('so', 'pemakaian_acc.id_so', '=', 'so.id')
      ->leftjoin('pemakaian_acc_detail', 'pemakaian_acc.id', '=', 'pemakaian_acc_detail.no_bukti_pemakaian')
      ->leftjoin('satuan', 'pemakaian_acc_detail.id_satuan', '=', 'satuan.id')
      ->groupBy('pemakaian_acc.id')
      ->groupBy('pemakaian_acc.id_so')
      ->groupBy('pemakaian_acc.jumlah')
      ->groupBy('pemakaian_acc.tanggal')
      ->groupBy('so.ispost')
      ->groupBy('so.produksi_id')
      ->groupBy('satuan.name')
      ->get();

    return DataTables::of($pemakaian_acc)
      ->editColumn('tanggal', function ($pembelian_acc) {
        return $this->datetoview($pembelian_acc->tanggal);
      })
      ->editColumn('qty', function ($pembelian_acc) {
        return number_format($pembelian_acc->qty, 2) . ' ' . $pembelian_acc->nama_satuan;
      })
      ->editColumn('jumlah', function ($pembelian_acc) {
        return 'Rp. ' . number_format($pembelian_acc->jumlah);
      })
      ->make(true);
  }

  public function pemakaian_acc_so_api()
  {
    $pemakaian_acc = DB::table('pemakaian_acc')
      ->select(
        'pemakaian_acc.id_so as id_so',
        'so.name as nama_produk',
        'so.ispost as ispost',
        DB::raw('SUM(pemakaian_acc_detail.qty) As qty'),
        DB::raw('SUM(keluar_acc_detail.qty) As qty_keluar'),
        'satuan.name as nama_satuan'
      )
      ->leftjoin('so', 'pemakaian_acc.id_so', '=', 'so.id')
      ->leftjoin('permintaan_acc', 'permintaan_acc.id_so', '=', 'so.id')
      ->leftjoin('keluar_acc_detail', 'keluar_acc_detail.id_permintaan', '=', 'permintaan_acc.id')
      ->leftjoin('pemakaian_acc_detail', 'pemakaian_acc.id', '=', 'pemakaian_acc_detail.no_bukti_pemakaian')
      ->leftjoin('satuan', 'pemakaian_acc_detail.id_satuan', '=', 'satuan.id')
      ->groupBy('pemakaian_acc.id_so')
      ->groupBy('so.ispost')
      ->groupBy('so.name')
      ->groupBy('satuan.name')
    ->toSql();
      // ->get();
    // dd($pemakaian_acc);
        dd($pemakaian_acc);
    return DataTables::of($pemakaian_acc)
      ->editColumn('qty_keluar', function ($pembelian_acc) {
        return number_format($pembelian_acc->qty_keluar, 2) . ' ' . $pembelian_acc->nama_satuan;
      })
      ->editColumn('qty', function ($pembelian_acc) {
        return number_format($pembelian_acc->qty, 2) . ' ' . $pembelian_acc->nama_satuan;
      })
      ->editColumn('sisa', function ($pembelian_acc) {
        return number_format($pembelian_acc->qty_keluar - $pembelian_acc->qty, 2) . ' ' . $pembelian_acc->nama_satuan;
      })
      ->editColumn('action', function ($pembelian_acc) {
        if ($pembelian_acc->ispost == 'Y') {
          return 'Sudah Di Posting';
        } else {
          return '<a data-toggle="modal" data-target="#modalPost" onclick="modalPenyerian(\'' . $pembelian_acc->id_so . '\')" class="btn btn-primary btn-xs" onclick="modalPenyerian(\'' . $pembelian_acc->id_so . '\')"><i class="fa fa-child"></i> Art</a>';
        }
      })
      ->make(true);
  }

  public function get_permintaan_acc(Request $request)
  {
    // dd(1);
    $data = DB::table('permintaan_acc')
      ->select(
        'permintaan_acc.*',
        'so.produksi_id as id_produksi',
        'so.name as nama_produk',
        'permintaan_acc_detail.qty as qty',
        'permintaan_acc_detail.kode_acc as kode_acc',
        'permintaan_acc_detail.*',
        'acc.name as nama_acc',
        'brand.name as nama_brand',
        'supplier.name as nama_supplier',
        'satuan.name as nama_satuan'
      )
      ->join('so', 'permintaan_acc.id_so', '=', 'so.id')
      ->join('permintaan_acc_detail', 'permintaan_acc.id', '=', 'permintaan_acc_detail.no_bukti_permintaan')
      ->join('acc', 'permintaan_acc_detail.id_acc', '=', 'acc.id')
      ->join('brand', 'permintaan_acc_detail.id_brand', '=', 'brand.id')
      ->join('supplier', 'permintaan_acc_detail.id_supplier', '=', 'supplier.id')
      ->join('satuan', 'permintaan_acc_detail.id_satuan', '=', 'satuan.id')
      ->where('so.id', '=', $request['id'])
      ->get();
    if (isset($data)) {
      return response()->json($data);
    } else {
      return response()->json([
        'status' => false,
      ]);
    }
  }

  public function get_pemakaian_bb(Request $request)
  {

    $data = DB::table('pemakaian_bb')
      ->select(
        'pemakaian_bb.*',
        'so.produksi_id as id_produksi',
        'so.name as nama_produk',
        'pemakaian_bb_detail.qty as qty',
        'pemakaian_bb_detail.kode_bb as kode_bb',
        'pemakaian_bb_detail.*',
        'bahan_baku.name as nama_bb',
        'warna.name as nama_warna',
        'brand.name as nama_brand',
        'supplier.name as nama_supplier',
        'satuan.name as nama_satuan'
      )
      ->join('so', 'pemakaian_bb.id_so', '=', 'so.id')
      ->join('pemakaian_bb_detail', 'pemakaian_bb.id', '=', 'pemakaian_bb_detail.no_bukti_pemakaian')
      ->join('bahan_baku', 'pemakaian_bb_detail.id_bb', '=', 'bahan_baku.id')
      ->join('warna', 'pemakaian_bb_detail.id_warna', '=', 'warna.id')
    // ->join('brand', 'pemakaian_bb_detail.id_brand', '=', 'brand.id')
      ->join('supplier', 'pemakaian_bb_detail.id_supplier', '=', 'supplier.id')
      ->join('satuan', 'pemakaian_bb_detail.id_satuan', '=', 'satuan.id')
      ->where('so.id', '=', $request['id'])
      ->get();

    return response()->json($data);
  }

  public function get_pemakaian_acc(Request $request)
  {

    $data = DB::table('pemakaian_acc')
      ->select(
        'pemakaian_acc.*',
        'so.produksi_id as id_produksi',
        'so.name as nama_produk',
        'pemakaian_acc_detail.qty as qty',
        'pemakaian_acc_detail.kode_acc as kode_acc',
        'pemakaian_acc_detail.*',
        'bahan_baku.name as nama_acc',
        'brand.name as nama_brand',
        'brand.name as nama_brand',
        'supplier.name as nama_supplier',
        'satuan.name as nama_satuan'
      )
      ->join('so', 'pemakaian_acc.id_so', '=', 'so.id')
      ->join('pemakaian_acc_detail', 'pemakaian_acc.id', '=', 'pemakaian_acc_detail.no_bukti_pemakaian')
      ->join('bahan_baku', 'pemakaian_acc_detail.id_acc', '=', 'bahan_baku.id')
      ->join('brand', 'pemakaian_acc_detail.id_brand', '=', 'brand.id')
      ->join('supplier', 'pemakaian_acc_detail.id_supplier', '=', 'supplier.id')
      ->join('satuan', 'pemakaian_acc_detail.id_satuan', '=', 'satuan.id')
      ->where('so.id', '=', $request['id'])
      ->get();

    return response()->json($data);
  }

public function posting_art(Request $request)
    {
      $r      = $request->all(); 
      // dd($r);
      $so_id  = $r['data'][0]['so'];
      for ($i = 0; $i < count($r['data']); $i++) {        
        for ($x = 0; $x < count($r['data'][$i]['qty']); $x++) {
        if ($this->ribuantodb($r['data'][$i]['qty'][$x]) < 0 ) {
          return response()->json([
            'status' => false,
            'message' => 'Qty Harus terisi',
          ]);
        }

      }
    }
 
      for ($i=0; $i < count($r['data']) ; $i++) {
        for ($y=0; $y < count($r['data'][$i]['qty']) ; $y++) {
          $data_detail = [
              'so_id' => $r['data'][$i]['so'],
              'art_id' => $r['data'][$i]['art'],
              'qty_art_total' => (int)$this->ribuantodb($r['data'][$i]['qty_so']),
              'qty_art_detail' => (int)$this->ribuantodb($r['data'][$i]['qty'][$y]),
              'isactive' => 'A'
            ];
            
            PostArtDetail::create($data_detail);
            }

            $cek_proses_awal = Art::select('art.*')
            ->where('so_id', $r['data'][$i]['so'])
            ->where('art_id', $r['data'][$i]['art'])
            ->get();

            $proses_awal = substr($cek_proses_awal[0]['alur_proses'],0,1);

            $p = $proses_awal;
            if ($p == 'P') {
              $p = 'printing';
            } elseif ($p == 'E') {
              $p = 'embro';   
            } elseif ($p == 'S') {
              $p = 'sewing';
            } elseif ($p == 'W') {
              $p = 'washing';
            } elseif ($p == 'L') {
              $p = 'lain2';
            } elseif ($p == 'F') {
              $p = 'finishing';
            }
            
            $update   = Art::where('so_id', $r['data'][$i]['so'])
            ->where('art_id', $r['data'][$i]['art'])
            ->update([    
              'qty'         => (int)$this->ribuantodb($r['data'][$i]['qty_so']),
              'stock_'.$p    => (int)$this->ribuantodb($r['data'][$i]['qty_so']),
              'status_'.$p  => 'R',
              'ispost'      => 'Y',
              'updated_at'  => Carbon::now()
              ]);
            }
            
        $count_data_art = Art::where('so_id', $r['data'][0]['so'])->count();
        $count_data_art_db = Art::where('so_id', $r['data'][0]['so'])->where('ispost','Y')->count();
      
      if ($count_data_art == $count_data_art_db) {
        $update_status = So::where('id',$so_id)->update([
          'ispost' => 'Y',
          'isactive' => 'A',
        ]);
      } else {
          $update_status = So::where('id',$so_id)->update([
            'ispost' => 'P',
            'isactive' => 'A',
          ]);
      }
      echo json_encode(array("data"=>$update_status));
    }

     public function retur_bb_index()
    {

      $kode = 'RB';
      $title = 'Retur Bahan Baku';
      $tag = 'retur_bb';
      $tanggal = $this->datenowtoview();
      $index = $this->genindex('ReturBB');
      $newid = $this->genid('ReturBB', 'RB');

      return view('produksi.retur_bb', ['newid' => $newid, 'title' => $title, 'tag' => $tag, 'tanggal' => $tanggal]);
    }

    public function retur_bb_create(Request $request)
    {
      
      for ($i = 0; $i < count($request['id_bb']); $i++) {
        if (floatval($request['qty_retur'][$i]) > (floatval($request['qty_keluar'][$i]) - floatval($request['qty_pemakaian'][$i]))) {
          return response()->json([
            'status' => false,
            'message' => 'Qty Retur Tidak Boleh Lebih Dari Qty Keluar!',
          ]);
        }
      }

      $kode = 'RB';
      $index = $this->genindex('ReturBB');

      $data = [
        'id' => $request['id'],
        'index' => $index,
        'tanggal' => $this->datetodb($request['tanggal']),
        'id_so' => $request['id_so'],
        'id_jenis_bb' => '',
        'isactive' => 'N'
      ];

      $jumlah = 0;
      $total_qty = 0;
      for ($i = 0; $i < count($request['id_bb']); $i++) {
        if($request['qty_retur'][$i] != '' ){
          if($request['qty_retur'][$i] > 0){
          $data_detail = [
          'no_bukti_retur' => $request['id'],
          'no_bukti_pemakaian' => $request['no_bukti_pemakaian'],
          'index' => $i,
          'tanggal' => $this->datetodb($request['tanggal']),
          'kode_bb' => $request['kode_bb'][$i],
          'id_bb' => $request['id_bb'][$i],
          'id_warna' => $request['id_warna'][$i],
          'id_supplier' => $request['id_supplier'][$i],
          'id_satuan' => $request['id_satuan'][$i],
          'qty_retur' => floatval($request['qty_retur'][$i]),
          'qty_retur_sisa' => floatval($request['qty_retur'][$i]),
          'ket' => $request['ket'][$i],
          'isactive' => 'N'
        ];
        ReturBBDetail::create($data_detail);

        $nilai_retur = PemakaianBBDetail::where('no_bukti_pemakaian', $request['no_bukti_pemakaian'])
        ->where('kode_bb', $request['kode_bb'][$i])
        ->sum('qty_retur');
        $nilai_sudah_retur = ReturBBDetail::where('no_bukti_pemakaian', $request['no_bukti_pemakaian'])
        ->where('kode_bb', $request['kode_bb'][$i])
        ->sum('qty_retur');
        $sisa_retur = $nilai_retur - floatval($request['qty_retur'][$i]);
        // dd();
        PemakaianBBDetail::where('no_bukti_pemakaian', $request['no_bukti_pemakaian'])->where('kode_bb', $request['kode_bb'][$i])->update(['qty_retur'=>$sisa_retur]);
        
        // $harga = MasterBB::where('id', $request['kode_bb'][$i])->get();
        // if (isset($harga)) {
        //   $harga = $harga[0]['harga_default'];
        // } else {
        //   $harga = 0;
        // }
        // $jumlah = $jumlah + (floatval($harga) *  $request['qty_retur'][$i]);


        // Fungsi Kartu Persediaan
        // $jenis_persediaan = 'BB';
        // $id_barang = $request['kode_bb'][$i];
        // $id_ref = $request['id'];
        // $type_ref = 'R'; // B/P/R'; + Beli B, - Pemakaian P - Retur R, 
        // $qty_persediaan = str_ireplace(',', '', $request['qty_retur'][$i]);
        // $satuan = $request['id_satuan'][$i];
        // $harga_persediaan = floatval($this->ribuantodb($harga));

        // $data_kartu_persediaan = [
        //   'jenis' => $jenis_persediaan,
        //   'id_barang' => $id_barang,
        //   'id_ref' => $id_ref,
        //   'type_ref' => $type_ref,
        //   'qty' => $qty_persediaan,
        //   'satuan' => $satuan,
        //   'harga' => $harga_persediaan,
        //   'jumlah' => $qty_persediaan * $harga_persediaan,
        // ];
        // $this->create_kartu_persediaan($data_kartu_persediaan);
        }
        }
      }
      ReturBB::create($data);

      //Fungsi Akuntansi 
      // $id = ['1101050001', '5501010001'];
      // $debit = [round($jumlah), 0];
      // $credit = [0, round($jumlah)];
      // $ref_type = ['retur_bb', 'retur_bb'];
      // $ref_id = [$request['id'], $request['id']];
      // $memo = ['RETUR BAHAN BAKU DENGAN ID : ' . $request['id'], 'RETUR BAHAN BAKU DENGAN ID : ' . $request['id']];
      // $date = $this->datenowtodb();
      // $currency = 'IDR';

      // $data = [
      //   'akun_id' => $id,
      //   'debit' => $debit,
      //   'credit' => $credit,
      //   'ref_type' => $ref_type,
      //   'ref_id' => $ref_id,
      //   'memo' => $memo,
      //   'date' => $date,
      //   'currency' => $currency,
      // ];

      // $create_jurnal = $this->create_jurnal($data);  

      $qty_all_retur = PemakaianBBDetail::where('no_bukti_pemakaian', $request['no_bukti_pemakaian'])->sum('qty_retur');
      // dd($qty_all_retur);
      if($qty_all_retur > 0){
        PemakaianBB::where('id_bukti_permintaan',$request['no_bukti_permintaan'])->update(['status_retur'=>'Y']);
      } else {
        PemakaianBB::where('id_bukti_permintaan',$request['no_bukti_permintaan'])->update(['status_retur'=>'N']);
      }

      $index = ReturBB::orderBy('index', 'desc')->take(1)->get();
      if (!isset($index[0])) {
        $newid = $kode . '00001';
      } else {
        $index = $index[0]->index + 1;
        $pad = str_pad($index, 5, '0', STR_PAD_LEFT);
        $newid = $kode . $pad;
      }

      return response()->json([
        'status' => true,
        'message' => 'Retur Bahan Baku Created',
        'newid' => $newid
      ]);
    }

    public function retur_bb_api()
    {
      $retur_bb = DB::table('retur_bb')
        ->select('retur_bb.*', 'so.produksi_id as id_produksi', 'so.name as nama_produk', 'retur_bb_detail.qty_retur as qty_retur')
        ->join('so', 'retur_bb.id_so', '=', 'so.id')
        ->join('retur_bb_detail', 'retur_bb.id', '=', 'retur_bb_detail.no_bukti_retur')
        ->get();

      return DataTables::of($retur_bb)
        ->make(true);
    }
     public function retur_acc_index()
    {

      $kode = 'RA';
      $title = 'Retur Bahan Baku';
      $tag = 'retur_acc';
      $tanggal = $this->datenowtoview();
      $index = $this->genindex('ReturAcc');
      $newid = $this->genid('ReturAcc', 'RA');

      return view('produksi.retur_acc', ['newid' => $newid, 'title' => $title, 'tag' => $tag, 'tanggal' => $tanggal]);
    }

    public function retur_acc_create(Request $request)
    {
      
      for ($i = 0; $i < count($request['id_acc']); $i++) {
        if (floatval($request['qty_retur'][$i]) > (floatval($request['qty_keluar'][$i]) - floatval($request['qty_pemakaian'][$i]))) {
          return response()->json([
            'status' => false,
            'message' => 'Qty Retur Tidak Boleh Lebih Dari Qty Keluar!',
          ]);
        }
      }

      $kode = 'RA';
      $index = $this->genindex('ReturAcc');

      $data = [
        'id' => $request['id'],
        'index' => $index,
        'tanggal' => $this->datetodb($request['tanggal']),
        'id_so' => $request['id_so'],
        'id_jenis_acc' => '',
        'isactive' => 'N'
      ];

      $jumlah = 0;
      $total_qty = 0;
      for ($i = 0; $i < count($request['id_acc']); $i++) {
        if($request['qty_retur'][$i] != '' ){
          if($request['qty_retur'][$i] > 0){
          $data_detail = [
          'no_bukti_retur' => $request['id'],
          'no_bukti_pemakaian' => $request['no_bukti_pemakaian'],
          'index' => $i,
          'tanggal' => $this->datetodb($request['tanggal']),
          'kode_acc' => $request['kode_acc'][$i],
          'id_acc' => $request['id_acc'][$i],
          'id_brand' => $request['id_brand'][$i],
          'id_supplier' => $request['id_supplier'][$i],
          'id_satuan' => $request['id_satuan'][$i], 
          'qty_retur' => floatval($request['qty_retur'][$i]),
          'qty_retur_sisa' => floatval($request['qty_retur'][$i]),
          'ket' => $request['ket'][$i],
          'isactive' => 'N'
        ];
        ReturAccDetail::create($data_detail);

        $nilai_retur = PemakaianAccDetail::where('no_bukti_pemakaian', $request['no_bukti_pemakaian'])
        ->where('kode_acc', $request['kode_acc'][$i])
        ->sum('qty_retur');
        $nilai_sudah_retur = ReturAccDetail::where('no_bukti_pemakaian', $request['no_bukti_pemakaian'])
        ->where('kode_acc', $request['kode_acc'][$i])
        ->sum('qty_retur');
        $sisa_retur = $nilai_retur - floatval($request['qty_retur'][$i]);
        // dd();
        PemakaianAccDetail::where('no_bukti_pemakaian', $request['no_bukti_pemakaian'])->where('kode_acc', $request['kode_acc'][$i])->update(['qty_retur'=>$sisa_retur]);
        
        // $harga = MasterAcc::where('id', $request['kode_acc'][$i])->get();
        // if (isset($harga)) {
        //   $harga = $harga[0]['harga_default'];
        // } else {
        //   $harga = 0;
        // }
        // $jumlah = $jumlah + (floatval($harga) *  $request['qty_retur'][$i]);


        // Fungsi Kartu Persediaan
        // $jenis_persediaan = 'Acc';
        // $id_barang = $request['kode_acc'][$i];
        // $id_ref = $request['id'];
        // $type_ref = 'R'; // B/P/R'; + Beli B, - Pemakaian P - Retur R, 
        // $qty_persediaan = str_ireplace(',', '', $request['qty_retur'][$i]);
        // $satuan = $request['id_satuan'][$i];
        // $harga_persediaan = floatval($this->ribuantodb($harga));

        // $data_kartu_persediaan = [
        //   'jenis' => $jenis_persediaan,
        //   'id_barang' => $id_barang,
        //   'id_ref' => $id_ref,
        //   'type_ref' => $type_ref,
        //   'qty' => $qty_persediaan,
        //   'satuan' => $satuan,
        //   'harga' => $harga_persediaan,
        //   'jumlah' => $qty_persediaan * $harga_persediaan,
        // ];
        // $this->create_kartu_persediaan($data_kartu_persediaan);
        }
        }
      }
      ReturAcc::create($data);

      //Fungsi Akuntansi 
      // $id = ['1101050001', '5501010001'];
      // $debit = [round($jumlah), 0];
      // $credit = [0, round($jumlah)];
      // $ref_type = ['retur_acc', 'retur_acc'];
      // $ref_id = [$request['id'], $request['id']];
      // $memo = ['RETUR BAHAN BAKU DENGAN ID : ' . $request['id'], 'RETUR BAHAN BAKU DENGAN ID : ' . $request['id']];
      // $date = $this->datenowtodb();
      // $currency = 'IDR';

      // $data = [
      //   'akun_id' => $id,
      //   'debit' => $debit,
      //   'credit' => $credit,
      //   'ref_type' => $ref_type,
      //   'ref_id' => $ref_id,
      //   'memo' => $memo,
      //   'date' => $date,
      //   'currency' => $currency,
      // ];

      // $create_jurnal = $this->create_jurnal($data);  

      $qty_all_retur = PemakaianAccDetail::where('no_bukti_pemakaian', $request['no_bukti_pemakaian'])->sum('qty_retur');
      // dd($qty_all_retur);
      if($qty_all_retur > 0){
        PemakaianAcc::where('id_bukti_permintaan',$request['no_bukti_permintaan'])->update(['status_retur'=>'Y']);
      } else {
        PemakaianAcc::where('id_bukti_permintaan',$request['no_bukti_permintaan'])->update(['status_retur'=>'N']);
      }

      $index = ReturAcc::orderBy('index', 'desc')->take(1)->get();
      if (!isset($index[0])) {
        $newid = $kode . '00001';
      } else {
        $index = $index[0]->index + 1;
        $pad = str_pad($index, 5, '0', STR_PAD_LEFT);
        $newid = $kode . $pad;
      }

      return response()->json([
        'status' => true,
        'message' => 'Retur Accessories Created',
        'newid' => $newid
      ]);
    }

    public function retur_acc_api()
    {
      $retur_acc = DB::table('retur_acc')
        ->select('retur_acc.*', 'so.produksi_id as id_produksi', 'so.name as nama_produk', 'retur_acc_detail.qty_retur as qty_retur')
        ->join('so', 'retur_acc.id_so', '=', 'so.id')
        ->join('retur_acc_detail', 'retur_acc.id', '=', 'retur_acc_detail.no_bukti_retur')
        ->get();

      return DataTables::of($retur_acc)
        ->make(true);
    }

}

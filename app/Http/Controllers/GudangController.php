<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Auth;
use Carbon\Carbon;
use App\BahanBaku;
use App\MasukBarang;
use App\ProdukStok;
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
use App\MasterBB;
use App\MasterAcc;
use App\KeluarBB;
use App\KeluarBBDetail;
use App\KeluarAcc;
use App\KeluarAccDetail;
use App\PermintaanBB;
use App\PermintaanBBDetail;
use App\PermintaanAcc;
use App\PermintaanAccDetail;
use App\KartuPersediaanBB;
use App\KartuPersediaanAcc;
use App\ReturBB;
use App\ReturBBDetail;
use App\PemakaianBB;
use App\PemakaianBBDetail;
use App\ReturAcc;
use App\ReturAccDetail;
use App\PemakaianAcc;
use App\PemakaianAccDetail;

use PDF;

class GudangController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }
 
  public function keluar_bb()
  {
    $title = 'Keluar Bahan Baku';
    $tag = 'keluar_bahan_baku';
    $tanggal = $this->datenowtoview();
    $newid = $this->genid('KeluarBB', 'KB');
    return view('gudang.keluar_bahan_baku', ['title' => $title, 'tag' => $tag, 'tanggal' => $tanggal, 'newid' => $newid]);
  }

  public function keluar_bb_create(Request $request)
  {
    if (count($request['acc']) < 1) {
      return response()->json([
        'status' => false,
        'message' => 'Tidak ada yang di acc!',
      ]);
    }
    for ($i = 0; $i < count($request['acc']); $i++) {
      $c = $request['acc'][$i];
      $kode_bb = $request['kode_bb'][$c];
      $permintaan = floatval($this->ribuantodb($request['qty_permintaan'][$c]));
      $sisa = floatval($this->ribuantodb($request['qty_sisa'][$c]));
      $qty = floatval($this->ribuantodb($request['qty_keluar'][$c]));
      $master_bb = MasterBB::where('id', $kode_bb)->get();
      if (!isset($master_bb[0])) {
        return response()->json([
          'status' => false,
          'message' => 'Stock tidak tersedia!',
        ]);
      } else {
        $stok = $master_bb[0]['stock'];
        $qty = $this->ribuantodb($qty);

        if ($stok - $qty < 0) {
          return response()->json([
            'status' => false,
            'message' => 'Stock kurang!',
          ]);
        }
        if ($qty > $sisa) {
          return response()->json([
            'status' => false,
            'message' => 'Qty keluar tidak boleh melebihi permintaan!',
          ]);
        }

        if ($qty < 0) {
          return response()->json([
            'status' => false,
            'message' => 'Qty keluar harus lebih dari 0!',
          ]);
        }
      }
    }

    $id_keluar = $request['id_keluar'];
    for ($i = 0; $i < count($request['acc']); $i++) {
      $c = $request['acc'][$i];
      $kode_bb = $request['kode_bb'][$c];
      $qty = $this->ribuantodb($request['qty_keluar'][$c]);
      $master_bb = MasterBB::where('id', $kode_bb)->get();
      $stok = number_format($master_bb[0]['stock'], 2);
      $qty = number_format($this->ribuantodb($qty), 2);

      $jumlah = 0;
      $total_qty = 0;
      for ($i = 0; $i < count($request['acc']); $i++) {
        $c = $request['acc'][$i];
        $id_permintaan = $request['id_permintaan'];
        $kode_bb = $request['kode_bb'][$c];
        $qty = $this->ribuantodb($request['qty_keluar'][$c]);
        $id_satuan = $request['id_satuan'][$c];
        $ket = $request['ket'][$c];

        $data_detail = [
          'id_keluar' => $id_keluar,
          'id_permintaan' => $id_permintaan,
          'index' => $i,
          'kode_bb' => $kode_bb,
          'qty' => $qty,
          'id_satuan' => $id_satuan,
          'ket' => $ket,
          'isactive' => 'A'
        ];

        KeluarBBDetail::create($data_detail);

        $harga = MasterBB::where('id', $request['kode_bb'][$c])->get();
        if (isset($harga)) {
          $harga = $harga[0]['harga_default'];
        } else {
          $harga = 0;
        }

        $jumlah = $jumlah + (floatval($harga) * $qty);

        //Fungsi Kartu Persediaan
        $jenis_persediaan = 'BB';
        $id_barang = $kode_bb;
        $id_ref = $id_keluar;
        $type_ref = 'K'; // B/P'; + Beli B, - Pemakaian P, 
        $qty_persediaan = $qty;
        $satuan = 'ST001';
        $harga_persediaan = floatval($this->ribuantodb($harga));

        $data_kartu_persediaan = [
          'jenis' => $jenis_persediaan,
          'id_barang' => $id_barang,
          'id_ref' => $id_ref,
          'type_ref' => $type_ref,
          'qty' => $qty_persediaan,
          'satuan' => $satuan,
          'harga' => $harga_persediaan,
          'jumlah' => $qty_persediaan * $harga_persediaan,
        ];
        $this->create_kartu_persediaan($data_kartu_persediaan);
      }
    }

    //Fungsi Akuntansi 
    $id = ['5501010001', '1101050001'];
    $debit = [floatval($jumlah), 0];
    $credit = [0, floatval($jumlah)];
    $ref_type = ['pengeluaran_bb', 'pengeluaran_bb'];
    $ref_id = [$id_keluar, $id_keluar];
    $memo = ['PENGELUARAN BAHAN BAKU DENGAN ID : ' . $id_keluar, 'PENGELUARAN BAHAN BAKU DENGAN ID : ' . $id_keluar];
    $date = $this->datenowtodb();
    $currency = 'IDR';

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

    $keluar_bb = KeluarBB::select('id', 'total')
      ->where('id', $id_keluar)
      ->get();

    if (!isset($keluar_bb[0]->id)) {
      $index = $this->genindex('KeluarBB');
      $data = [
        'id' => $id_keluar,
        'total' => $total_qty,
        'id_satuan' => $id_satuan,
        'index' => $index,
        'tanggal' => $this->datetodb($request['tanggal']),
        'isactive' => 'A'
      ];
      KeluarBB::create($data);
    } else {
      $total = number_format($keluar_bb[0]->total, 2);
      $data = [
        'total' => number_format($keluar_bb[0]->total, 2) + number_format($qty, 2),
      ];
      KeluarBB::where('id', $id_keluar)->update($data);
    }

    $cek_keluar = KeluarBBDetail::where('id_permintaan', $request['id_permintaan'])->sum('qty');
    $cek_permintaan = PermintaanBB::where('id', $request['id_permintaan'])->sum('total');
    // dd($cek_keluar,$cek_permintaan);
    if ($cek_keluar == $cek_permintaan) {
      $data_update_status = [
        'isactive' => 'N',
      ];
      KeluarBB::where('id', $id_keluar)->update($data);
      $permintaan_update = PermintaanBB::where('id', $request['id_permintaan'])->update($data_update_status);
    }

    return response()->json([
      'status' => true,
      'message' => 'Keluar Bahan Baku Berhasil',
    ]);
  }

  public function keluar_bb_api()
  {
    $keluar_bb = DB::table('keluar_bb')
      ->select('keluar_bb.*', 'master_bb.name as nama_produk', 'keluar_bb_detail.qty as qty', 'satuan.id as nama_satuan', 'keluar_bb_detail.ket as ket')
      ->join('keluar_bb_detail', 'keluar_bb.id', '=', 'keluar_bb_detail.id_keluar')
      ->join('master_bb', 'keluar_bb_detail.kode_bb', '=', 'master_bb.id')
      ->join('satuan', 'keluar_bb_detail.id_satuan', '=', 'satuan.id')
      ->get();

    return DataTables::of($keluar_bb)
      ->make(true);
  }

  public function stock_bb()
  {
    $title = 'Stock Bahan Baku';
    $tag = 'stock_bb';
    $tanggal = $this->datenowtoview();
    return view('gudang.stock_bb', ['title' => $title, 'tag' => $tag, 'tanggal' => $tanggal]);
  }

  public function stock_bb_api(Request $request)
  {
    $r = $request->all();
    $stock_bb = DB::table('master_bb')
      ->select('master_bb.*', 'master_bb.harga_default', 'satuan.name as nama_satuan', 'supplier.name as nama_supplier')
      ->leftjoin('satuan', 'master_bb.id_satuan', '=', 'satuan.id')
      ->leftjoin('supplier', 'master_bb.id_supplier', '=', 'supplier.id');

    if (isset($r['bb_id'])) {
      $stock_bb = $stock_bb->where('master_bb.id_bb', '=', $r['bb_id']);
    }

    if (isset($r['warna_id'])) {
      $stock_bb = $stock_bb->where('master_bb.id_warna', '=', $r['warna_id']);
    }

    if (isset($r['supplier_id'])) {
      $stock_bb = $stock_bb->where('master_bb.id_supplier', '=', $r['supplier_id']);
    }

    if (isset($r['status'])) {
      if ($r['status'] == 'A') {
        $stock_bb = $stock_bb->where('master_bb.stock', '>=', 1)->get();
      } elseif ($r['status'] == 'B') {
        $stock_bb = $stock_bb->where('master_bb.stock', '<=', 100);
        $stock_bb = $stock_bb->where('master_bb.stock', '>=', 1)->get();
      } else {
        $stock_bb = $stock_bb->where('master_bb.stock', '<', 1)->get();
      }
    }

    return DataTables::of($stock_bb)
      ->editColumn('stock', function ($stock_bb) {
        return number_format($stock_bb->stock, 2) . ' ' . $stock_bb->nama_satuan;
      })
      ->editColumn('harga_default', function ($stock_bb) {
        return number_format($stock_bb->harga_default, 2);
      })
      ->addColumn('isactive', function ($stock_bb) {
        if ($stock_bb->stock >= 100) {
          return 'Ready';
        } else if ($stock_bb->stock <= 100 && $stock_bb->stock >= 1) {
          return 'Hampir Habis';
        } else {
          return 'Habis';
        }
      })
      ->addColumn('action', function ($stock_bb) {
        return
          '<a onclick="showDetail(\'' . $stock_bb->id . '\',\'' . $stock_bb->name . '\')" class="btn btn-success"> Detail</a>';
      })
      ->make(true);
  }

  public function stock_bb_kartu_persediaan_api(Request $request)
  {
    $r = $request->all();
    $data = KartuPersediaanBB::select('kode_bb', 'type_ref', 'id_ref', 'qty', 'harga', 'jumlah', 'saldo_qty', 'saldo_harga', 'saldo_jumlah', 'created_at as tanggal')
      ->where('kode_bb', $r['kode_bb'])
      ->get();

    return DataTables::of($data)
      ->editColumn('qty', function ($data) {
        return number_format($data->qty, 2);
      })
      ->editColumn('harga', function ($data) {
        return number_format($data->harga, 2);
      })
      ->editColumn('jumlah', function ($data) {
        return number_format($data->jumlah, 2);
      })
      ->editColumn('saldo_qty', function ($data) {
        return number_format($data->saldo_qty, 2);
      })
      ->editColumn('saldo_harga', function ($data) {
        return number_format($data->saldo_harga, 2);
      })
      ->editColumn('saldo_jumlah', function ($data) {
        return number_format($data->saldo_jumlah, 2);
      })
      ->addColumn('id', function ($data) {
        return $data->id_ref;
      })
      ->addColumn('type', function ($data) {
        if ($data->type_ref == 'B') {
          return 'Pembelian';
        } elseif ($data->type_ref == 'R') {
          return 'Retur';
        } else {
          return 'Pengeluaran';
        }
      })
      ->make(true);
  }

  public function keluar_acc()
  {
    $title = 'Keluar Accessories';
    $tag = 'keluar_acc';
    $tanggal = $this->datenowtoview();
    $newid = $this->genid('KeluarAcc', 'KA');
    return view('gudang.keluar_acc', ['title' => $title, 'tag' => $tag, 'tanggal' => $tanggal, 'newid' => $newid]);
  }

  public function keluar_acc_create(Request $request)
  {
    if (count($request['acc']) < 1) {
      return response()->json([
        'status' => false,
        'message' => 'Tidak ada yang di acc!',
      ]);
    }
    for ($i = 0; $i < count($request['acc']); $i++) {
      $c = $request['acc'][$i];
      $kode_acc = $request['kode_acc'][$c];
      $permintaan = floatval($this->ribuantodb($request['qty_permintaan'][$c]));
      $sisa = floatval($this->ribuantodb($request['qty_sisa'][$c]));
      $qty = floatval($this->ribuantodb($request['qty_keluar'][$c]));
      $master_acc = MasterAcc::where('id', $kode_acc)->get();
      if (!isset($master_acc[0])) {
        return response()->json([
          'status' => false,
          'message' => 'Stock tidak tersedia!',
        ]);
      } else {
        $stok = $master_acc[0]['stock'];
        $qty = $this->ribuantodb($qty);

        if ($stok - $qty < 0) {
          return response()->json([
            'status' => false,
            'message' => 'Stock kurang!',
          ]);
        }
        if ($qty > $sisa) {
          return response()->json([
            'status' => false,
            'message' => 'Qty keluar tidak boleh melebihi permintaan!',
          ]);
        }

        if ($qty < 0) {
          return response()->json([
            'status' => false,
            'message' => 'Qty keluar harus lebih dari 0!',
          ]);
        }
      }
    }

    $id_keluar = $request['id_keluar'];
    for ($i = 0; $i < count($request['acc']); $i++) {
      $c = $request['acc'][$i];
      $kode_acc = $request['kode_acc'][$c];
      $qty = $this->ribuantodb($request['qty_keluar'][$c]);
      $master_acc = MasterAcc::where('id', $kode_acc)->get();
      $stok = number_format($master_acc[0]['stock'], 2);
      $qty = number_format($this->ribuantodb($qty), 2);

      $jumlah = 0;
      $total_qty = 0;
      for ($i = 0; $i < count($request['acc']); $i++) {
        $c = $request['acc'][$i];
        $id_permintaan = $request['id_permintaan'];
        $kode_acc = $request['kode_acc'][$c];
        $qty = $this->ribuantodb($request['qty_keluar'][$c]);
        $id_satuan = $request['id_satuan'][$c];
        $ket = $request['ket'][$c];

        $data_detail = [
          'id_keluar' => $id_keluar,
          'id_permintaan' => $id_permintaan,
          'index' => $i,
          'kode_acc' => $kode_acc,
          'qty' => $qty,
          'id_satuan' => $id_satuan,
          'ket' => $ket,
          'isactive' => 'A'
        ];
        KeluarAccDetail::create($data_detail);

        $harga = MasterAcc::where('id', $request['kode_acc'][$c])->get();
        if (isset($harga)) {
          $harga = $harga[0]['harga_default'];
        } else {
          $harga = 0;
        }

        $jumlah = $jumlah + (floatval($harga) * $qty);

        //Fungsi Kartu Persediaan
        $jenis_persediaan = 'Acc';
        $id_barang = $kode_acc;
        $id_ref = $id_keluar;
        $type_ref = 'K'; // B/P'; + Beli B, - Pemakaian P, 
        $qty_persediaan = $qty;
        $satuan = 'ST001';
        $harga_persediaan = floatval($this->ribuantodb($harga));

        $data_kartu_persediaan = [
          'jenis' => $jenis_persediaan,
          'id_barang' => $id_barang,
          'id_ref' => $id_ref,
          'type_ref' => $type_ref,
          'qty' => $qty_persediaan,
          'satuan' => $satuan,
          'harga' => $harga_persediaan,
          'jumlah' => $qty_persediaan * $harga_persediaan,
        ];
        $this->create_kartu_persediaan($data_kartu_persediaan);
        // dd($data_kartu_persediaan);

      }
    }

    //Fungsi Akuntansi 
    $id = ['5501010001', '1101050001'];
    $debit = [floatval($jumlah), 0];
    $credit = [0, floatval($jumlah)];
    $ref_type = ['pengeluaran_acc', 'pengeluaran_acc'];
    $ref_id = [$id_keluar, $id_keluar];
    $memo = ['PENGELUARAN ACCESSORIES DENGAN ID : ' . $id_keluar, 'PENGELUARAN ACCESSORIES DENGAN ID : ' . $id_keluar];
    $date = $this->datenowtodb();
    $currency = 'IDR';

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

    $keluar_acc = KeluarAcc::select('id', 'total')
      ->where('id', $id_keluar)
      ->get();

    if (!isset($keluar_acc[0]->id)) {
      $index = $this->genindex('KeluarAcc');
      $data = [
        'id' => $id_keluar,
        'total' => $total_qty,
        'id_satuan' => $id_satuan,
        'index' => $index,
        'tanggal' => $this->datetodb($request['tanggal']),
        'isactive' => 'A'
      ];
      KeluarAcc::create($data);
    } else {
      $total = number_format($keluar_acc[0]->total, 2);
      $data = [
        'total' => number_format($keluar_acc[0]->total, 2) + number_format($qty, 2),
      ];
      KeluarAcc::where('id', $id_keluar)->update($data);
    }

    $cek_keluar = KeluarAccDetail::where('id_permintaan', $request['id_permintaan'])->sum('qty');
    $cek_permintaan = PermintaanAcc::where('id', $request['id_permintaan'])->sum('total');
    // dd($cek_keluar,$cek_permintaan);
    if ($cek_keluar == $cek_permintaan) {
      $data_update_status = [
        'isactive' => 'N',
      ];
      KeluarAcc::where('id', $id_keluar)->update($data);
      $permintaan_update = PermintaanAcc::where('id', $request['id_permintaan'])->update($data_update_status);
    }

    return response()->json([
      'status' => true,
      'message' => 'Keluar Accessoris Berhasil',
    ]);
  }

  public function keluar_acc_api()
  {
    $keluar_acc = DB::table('keluar_acc')
      ->select('keluar_acc.*', 'master_acc.name as nama_produk', 'keluar_acc_detail.qty as qty', 'satuan.id as nama_satuan', 'keluar_acc_detail.ket as ket')
      ->join('keluar_acc_detail', 'keluar_acc.id', '=', 'keluar_acc_detail.id_keluar')
      ->join('master_acc', 'keluar_acc_detail.kode_acc', '=', 'master_acc.id')
      ->join('satuan', 'keluar_acc_detail.id_satuan', '=', 'satuan.id')
      ->get();

    return DataTables::of($keluar_acc)
      ->make(true);
  }

  public function stock_acc()
  {
    $title = 'Stock Accessories';
    $tag = 'stock_acc';
    $tanggal = $this->datenowtoview();
    return view('gudang.stock_acc', ['title' => $title, 'tag' => $tag, 'tanggal' => $tanggal]);
  }

  public function stock_acc_api(Request $request)
  {
    $r = $request->all();
    $stock_acc = DB::table('master_acc')
      ->select('master_acc.*', 'satuan.name as nama_satuan', 'supplier.name as nama_supplier')
      ->leftjoin('satuan', 'master_acc.id_satuan', '=', 'satuan.id')
      ->leftjoin('supplier', 'master_acc.id_supplier', '=', 'supplier.id');
    if (isset($r['acc_id'])) {
      $stock_acc = $stock_acc->where('master_acc.id_acc', '=', $r['acc_id']);
    }

    if (isset($r['brand_id'])) {
      $stock_acc = $stock_acc->where('master_acc.id_brand', '=', $r['brand_id']);
    }

    if (isset($r['supplier_id'])) {
      $stock_acc = $stock_acc->where('master_acc.id_supplier', '=', $r['supplier_id']);
    }

    if (isset($r['status'])) {
      if ($r['status'] == 'A') {
        $stock_acc = $stock_acc->where('master_acc.stock', '>=', 1)->get();
      } elseif ($r['status'] == 'B') {
        $stock_acc = $stock_acc->where('master_acc.stock', '<=', 100);
        $stock_acc = $stock_acc->where('master_acc.stock', '>=', 1)->get();
      } else {
        $stock_acc = $stock_acc->where('master_acc.stock', '<', 1)->get();
      }
    }

    return DataTables::of($stock_acc)
      ->editColumn('stock', function ($stock_acc) {
        return number_format($stock_acc->stock, 2) . ' ' . $stock_acc->nama_satuan;;
      })
      ->addColumn('isactive', function ($stock_acc) {
        if ($stock_acc->stock >= 100) {
          return 'Ready';
        } else if ($stock_acc->stock <= 100 && $stock_acc->stock >= 1) {
          return 'Hampir Habis';
        } else {
          return 'Habis';
        }
      })
      ->addColumn('action', function ($stock_acc) {
        return
          '<a onclick="showDetail(\'' . $stock_acc->id . '\',\'' . $stock_acc->name . '\')" class="btn btn-success"> Detail</a>';
      })
      ->make(true);
  }


  public function stock_acc_kartu_persediaan_api(Request $request)
  {
    $r = $request->all();
    $data = KartuPersediaanAcc::select('kode_acc', 'type_ref', 'id_ref', 'qty', 'harga', 'jumlah', 'saldo_qty', 'saldo_harga', 'saldo_jumlah', 'created_at as tanggal')
      ->where('kode_acc', $r['kode_acc'])
      ->get();

    return DataTables::of($data)
      ->editColumn('qty', function ($data) {
        return number_format($data->qty, 2);
      })
      ->editColumn('harga', function ($data) {
        return number_format($data->harga, 2);
      })
      ->editColumn('jumlah', function ($data) {
        return number_format($data->jumlah, 2);
      })
      ->editColumn('saldo_qty', function ($data) {
        return number_format($data->saldo_qty, 2);
      })
      ->editColumn('saldo_harga', function ($data) {
        return number_format($data->saldo_harga, 2);
      })
      ->editColumn('saldo_jumlah', function ($data) {
        return number_format($data->saldo_jumlah, 2);
      })
      ->addColumn('id', function ($data) {
        return $data->id_ref;
      })
      ->addColumn('type', function ($data) {
        if ($data->type_ref == 'B') {
          return 'Pembelian';
        } elseif ($data->type_ref == 'R') {
          return 'Retur';
        } else {
          return 'Pengeluaran';
        }
      })
      ->make(true);
  }

  public function stock_bj()
  {
    $title = 'Stock Barang Jadi';
    $tag = 'stock_barang_jadi';
    $tanggal_order = $this->datenowtoview();
    return view('gudang.stock_bj', ['title' => $title, 'tag' => $tag, 'tanggal' => $tanggal_order]);
  }


  public function stock_bj_api(Request $request)
  {
    $r = $request->all();
    $stock_bj = DB::table('master_bj')
      ->select('master_bj.*', 'satuan.name as nama_satuan', 'supplier.name as nama_supplier')
      ->leftjoin('satuan', 'master_bj.id_satuan', '=', 'satuan.id')
      ->leftjoin('supplier', 'master_bj.id_supplier', '=', 'supplier.id');
    if (isset($r['bj_id'])) {
      $stock_bj = $stock_bj->where('master_bj.id_bj', '=', $r['bj_id']);
    }

    if (isset($r['brand_id'])) {
      $stock_bj = $stock_bj->where('master_bj.id_brand', '=', $r['brand_id']);
    }

    if (isset($r['supplier_id'])) {
      $stock_bj = $stock_bj->where('master_bj.id_supplier', '=', $r['supplier_id']);
    }

    if (isset($r['status'])) {
      if ($r['status'] == 'A') {
        $stock_bj = $stock_bj->where('master_bj.stock', '>=', 1)->get();
      } elseif ($r['status'] == 'B') {
        $stock_bj = $stock_bj->where('master_bj.stock', '<=', 100);
        $stock_bj = $stock_bj->where('master_bj.stock', '>=', 1)->get();
      } else {
        $stock_bj = $stock_bj->where('master_bj.stock', '<', 1)->get();
      }
    }

    return DataTables::of($stock_bj)
      ->editColumn('stock', function ($stock_bj) {
        return number_format($stock_bj->stock, 2) . ' ' . $stock_bj->nama_satuan;;
      })
      ->addColumn('isactive', function ($stock_bj) {
        if ($stock_bj->stock >= 100) {
          return 'Ready';
        } else if ($stock_bj->stock <= 100 && $stock_bj->stock >= 1) {
          return 'Hampir Habis';
        } else {
          return 'Habis';
        }
      })->make(true);
  }


  public function stock_print(Request $request)
  {
    $r = $request->all();
    $table = '';

    if ($r['param'] == 'stock_bb') {
      $table = 'master_bb';
    } elseif ($r['param'] == 'stock_acc') {
      $table = 'master_acc';
    } else {
      $table = 'master_bj';
    }

    $stock = DB::table($table)
      ->select($table . '.*', 'satuan.name as nama_satuan', 'supplier.name as nama_supplier')
      ->leftjoin('satuan', $table . '.id_satuan', '=', 'satuan.id')
      ->leftjoin('supplier', $table . '.id_supplier', '=', 'supplier.id');

    if (isset($r['bb_id'])) {
      $stock = $stock->where($table . '.id_bb', '=', $r['bb_id']);
    }

    if (isset($r['warna_id'])) {
      $stock = $stock->where($table . '.id_warna', '=', $r['warna_id']);
    }

    if (isset($r['brand_id'])) {
      $stock = $stock->where($table . '.id_brand', '=', $r['brand_id']);
    }

    if (isset($r['supplier_id'])) {
      $stock = $stock->where($table . '.id_supplier', '=', $r['supplier_id']);
    }

    if (isset($r['status'])) {
      if ($r['status'] == 'A') {
        $stock = $stock->where($table . '.stock', '>=', 1)->get();
      } elseif ($r['status'] == 'B') {
        $stock = $stock->where($table . '.stock', '<=', 100);
        $stock = $stock->where($table . '.stock', '>=', 1)->get();
      } else {
        $stock = $stock->where($table . '.stock', '<', 1)->get();
      }
    }

    $title = '';
    if ($r['param'] == 'stock_bb') {
      $title = 'BAHAN BAKU';
    } elseif ($r['param'] == 'stock_acc') {
      $title = 'ACCESSORIES';
    } else {
      $title = 'BARANG JADI';
    }

    $data = [
      'title' => $title,
      'data' => $stock,
    ];

    $pdf = PDF::loadView('gudang.print.master', $data);
    $pdf->setPaper('a4', 'potrait');
    return $pdf->stream();
    // return $pdf->download('report.pdf');
  }

  public function get_detail_permintaan_bb(Request $request)
  {
    $r = $request->all();
    // dd($r['id_so']);
    if (isset($r['id_so'])) {
      $get_id_permintaan = PermintaanBB::where('id_so', $r['id_so'])->get();
      $r['id'] = $get_id_permintaan[0]['id'];
    }
    // dd($get_id_permintaan[0]['id']);
    $id_cmt = '';
    $nama_cmt = '';
    $permintaan = DB::table('permintaan_bb')
      ->select('permintaan_bb.*', 'permintaan_bb_detail.kode_bb', 'permintaan_bb_detail.ket', 'permintaan_bb_detail.qty as qty_permintaan', 'permintaan_bb_detail.id_bb as id_bb', 'supplier.id as id_supplier', 'warna.id as id_warna', 'satuan.id as id_satuan', 'satuan.name as nama_satuan', 'supplier.name as nama_supplier', 'warna.name as nama_warna', 'bahan_baku.name as nama_bb', 'master_bb.stock as stock')
      ->join('permintaan_bb_detail', 'permintaan_bb_detail.no_bukti_permintaan', '=', 'permintaan_bb.id')
      ->join('bahan_baku', 'bahan_baku.id', '=', 'permintaan_bb_detail.id_bb')
      ->join('warna', 'warna.id', '=', 'permintaan_bb_detail.id_warna')
      ->join('satuan', 'satuan.id', '=', 'permintaan_bb_detail.id_satuan')
      ->join('supplier', 'supplier.id', '=', 'permintaan_bb_detail.id_supplier')
      ->leftJoin('master_bb', 'master_bb.id', '=', 'permintaan_bb_detail.kode_bb')
      ->where('permintaan_bb.id', $r['id'])
      ->orderBy('index', 'asc')
      ->get();

    $keluar = DB::table('keluar_bb_detail')
      ->select('kode_bb', DB::raw('SUM(qty) as qty_keluar'))
      ->where('id_permintaan', $r['id'])
      ->groupBy('kode_bb')
      ->get();

    $pemakaian = DB::table('pemakaian_bb_detail')
      ->select('kode_bb', DB::raw('SUM(qty) as qty_pemakaian'))
      ->where('no_bukti_permintaan', $r['id'])
      ->groupBy('kode_bb')
      ->get();

    $id = DB::table('keluar_bb_detail')
      ->select('id_keluar', 'id_permintaan')
      ->where('id_permintaan', $r['id'])
      ->get();

    if (!isset($id[0])) {
      $id = $this->genid('KeluarBB', 'KB');
    } else {
      $id = $id[0]->id_keluar;
    }
    // dd($pemakaian);
    $hasil_cutt = array();
    if (!isset($pemakaian[0])) {
      $id_pemakaian = $this->genid('PemakaianBB', 'PB');
    } else {
      if (isset($r['id_so'])) {
        $pemakaian_get = DB::table('pemakaian_bb')
          ->select('pemakaian_bb.id', 'pemakaian_bb.id_so', 'pemakaian_bb.id_cmt', 'cmt.name as nama_cmt')
          ->leftJoin('cmt', 'pemakaian_bb.id_cmt', '=', 'cmt.id')
          ->where('pemakaian_bb.id_so', $r['id_so'])
          ->limit(1)
          ->get();
        $id_pemakaian = $pemakaian_get[0]->id;
        $id_cmt = $pemakaian_get[0]->id_cmt;
        $nama_cmt = $pemakaian_get[0]->nama_cmt;
        $hasil_cutt = DB::table('pemakaian_bb_detail')
          ->select('kode_bb', DB::raw('SUM(hasil_cutt) as qty_cutt'))
          ->where('no_bukti_pemakaian', $id_pemakaian)
          ->groupBy('kode_bb')
          ->get();
      } else {
        $id_pemakaian = 0;
      }
    }

    // dd($pemakaian_get[0]->id);
    $data = [
      'id_keluar' => $id,
      'id_pemakaian' => $id_pemakaian,
      'id_cmt' => $id_cmt,
      'nama_cmt' => $nama_cmt,
      'permintaan' => $permintaan,
      'keluar' => $keluar,
      'pemakaian' => $pemakaian,
      'hasil_cutt' => $hasil_cutt,
    ];
    // dd($data);
    return response()->json($data);
  }

  public function get_detail_permintaan_acc(Request $request)
  {
    $r = $request->all();
    if (isset($r['id_so'])) {
      $get_id_permintaan = PermintaanAcc::where('id_so', $r['id_so'])->get();
      $r['id'] = $get_id_permintaan[0]['id'];
    }
    // dd($get_id_permintaan[0]['id']);

    $permintaan = DB::table('permintaan_acc')
      ->select(
        'permintaan_acc.*',
        'permintaan_acc_detail.kode_acc',
        'permintaan_acc_detail.ket',
        'permintaan_acc_detail.qty as qty_permintaan',
        'permintaan_acc_detail.id_acc as id_acc',
        'supplier.id as id_supplier',
        'brand.id as id_brand',
        'satuan.id as id_satuan',
        'satuan.name as nama_satuan',
        'supplier.name as nama_supplier',
        'brand.name as nama_brand',
        'acc.name as nama_acc',
        'master_acc.stock as stock'
      )
      ->leftJoin('permintaan_acc_detail', 'permintaan_acc_detail.no_bukti_permintaan', '=', 'permintaan_acc.id')
      ->leftJoin('acc', 'acc.id', '=', 'permintaan_acc_detail.id_acc')
      ->leftJoin('brand', 'brand.id', '=', 'permintaan_acc_detail.id_brand')
      ->leftJoin('satuan', 'satuan.id', '=', 'permintaan_acc_detail.id_satuan')
      ->leftJoin('supplier', 'supplier.id', '=', 'permintaan_acc_detail.id_supplier')
      ->leftJoin('master_acc', 'master_acc.id', '=', 'permintaan_acc_detail.kode_acc')
      ->where('permintaan_acc.id', $r['id'])
      ->orderBy('index', 'asc')
      ->get();
    // dd($r['id']);
    // dd($permintaan);
    $keluar = DB::table('keluar_acc_detail')
      ->select('kode_acc', DB::raw('SUM(qty) as qty_keluar'))
      ->where('id_permintaan', $r['id'])
      ->groupBy('kode_acc')
      ->get();

    $pemakaian = DB::table('pemakaian_acc_detail')
      ->select('kode_acc', DB::raw('SUM(qty) as qty_pemakaian'))
      ->where('no_bukti_permintaan', $r['id'])
      ->groupBy('kode_acc')
      ->get();

    $id = DB::table('keluar_acc_detail')
      ->select('id_keluar', 'id_permintaan')
      ->where('id_permintaan', $r['id'])
      ->get();

    if (!isset($id[0])) {
      $id = $this->genid('KeluarAcc', 'KB');
    } else {
      $id = $id[0]->id_keluar;
    }
    // dd($pemakaian);
    $hasil_cutt = array();
    if (!isset($pemakaian[0])) {
      $id_pemakaian = $this->genid('PemakaianAcc', 'PB');
    } else {
      if (isset($r['id_so'])) {
        $pemakaian_get = DB::table('pemakaian_acc')
          ->select('id', 'id_so')
          ->where('id_so', $r['id_so'])
          ->limit(1)
          ->get();
        $id_pemakaian = $pemakaian_get[0]->id;
        $hasil_cutt = DB::table('pemakaian_acc_detail')
          ->select('kode_acc')
          ->where('no_bukti_pemakaian', $id_pemakaian)
          ->groupBy('kode_acc')
          ->get();
      } else {
        $id_pemakaian = 0;
      }
    }

    // dd($pemakaian_get[0]->id);
    $data = [
      'id_keluar' => $id,
      'id_pemakaian' => $id_pemakaian,
      'permintaan' => $permintaan,
      'keluar' => $keluar,
      'pemakaian' => $pemakaian,
    ];
    // dd($data);
    return response()->json($data);
  }

  public function get_detail_retur_bb(Request $request)
  {
    $r = $request->all();
    // dd($r['id_so']);
    if (isset($r['id_so'])) {
      $get_id_permintaan = PermintaanBB::where('id_so', $r['id_so'])->get();
      $r['id'] = $get_id_permintaan[0]['id'];
    }
    // dd($get_id_permintaan[0]['id']);

    $permintaan = DB::table('permintaan_bb')
      ->select('permintaan_bb.*', 'permintaan_bb_detail.kode_bb', 'permintaan_bb_detail.ket', 'permintaan_bb_detail.qty as qty_permintaan', 'permintaan_bb_detail.id_bb as id_bb', 'supplier.id as id_supplier', 'warna.id as id_warna', 'satuan.id as id_satuan', 'satuan.name as nama_satuan', 'supplier.name as nama_supplier', 'warna.name as nama_warna', 'bahan_baku.name as nama_bb', 'master_bb.stock as stock')
      ->join('permintaan_bb_detail', 'permintaan_bb_detail.no_bukti_permintaan', '=', 'permintaan_bb.id')
      ->join('bahan_baku', 'bahan_baku.id', '=', 'permintaan_bb_detail.id_bb')
      ->join('warna', 'warna.id', '=', 'permintaan_bb_detail.id_warna')
      ->join('satuan', 'satuan.id', '=', 'permintaan_bb_detail.id_satuan')
      ->join('supplier', 'supplier.id', '=', 'permintaan_bb_detail.id_supplier')
      ->leftJoin('master_bb', 'master_bb.id', '=', 'permintaan_bb_detail.kode_bb')
      ->where('permintaan_bb.id', $r['id'])
      ->orderBy('index', 'asc')
      ->get();

    $keluar = DB::table('keluar_bb_detail')
      ->select('kode_bb', DB::raw('SUM(qty) as qty_keluar'))
      ->where('id_permintaan', $r['id'])
      ->groupBy('kode_bb')
      ->get();

    $pemakaian = DB::table('pemakaian_bb_detail')
      ->select('kode_bb', DB::raw('SUM(qty) as qty_pemakaian'), DB::raw('SUM(qty_retur) as qty_retur'))
      ->where('no_bukti_permintaan', $r['id'])
      ->groupBy('kode_bb')
      ->get();

    $id = DB::table('keluar_bb_detail')
      ->select('id_keluar', 'id_permintaan')
      ->where('id_permintaan', $r['id'])
      ->get();

    if (!isset($id[0])) {
      $id = $this->genid('KeluarBB', 'KB');
    } else {
      $id = $id[0]->id_keluar;
    }
    // dd($pemakaian);
    $hasil_cutt = array();
    if (!isset($pemakaian[0])) {
      $id_pemakaian = $this->genid('PemakaianBB', 'PB');
    } else {
      if (isset($r['id_so'])) {
        $pemakaian_get = DB::table('pemakaian_bb')
          ->select('id', 'id_so')
          ->where('id_so', $r['id_so'])
          ->limit(1)
          ->get();
        $id_pemakaian = $pemakaian_get[0]->id;
        $hasil_cutt = DB::table('pemakaian_bb_detail')
          ->select('kode_bb', DB::raw('SUM(hasil_cutt) as qty_cutt'))
          ->where('no_bukti_pemakaian', $id_pemakaian)
          ->groupBy('kode_bb')
          ->get();
      } else {
        $id_pemakaian = 0;
      }
    }

    // dd($pemakaian_get[0]->id);
    $data = [
      'id_permintaan' => $get_id_permintaan[0]['id'],
      'id_keluar' => $id,
      'id_pemakaian' => $id_pemakaian,
      'permintaan' => $permintaan,
      'keluar' => $keluar,
      'pemakaian' => $pemakaian,
      'hasil_cutt' => $hasil_cutt,
    ];
    // dd($data);
    return response()->json($data);
  }



  public function get_detail_retur_bb_gudang(Request $request)
  {
    $r = $request->all();
    $get_so = ReturBB::where('id', $r['id_retur'])->get();
    $data = ReturBBDetail::select(
      'retur_bb_detail.kode_bb',
      'retur_bb_detail.qty_retur',
      'retur_bb_detail.qty_retur_sisa',
      'supplier.id as id_supplier',
      'warna.id as id_warna',
      'warna.name as nama_warna',
      'satuan.id as id_satuan',
      'satuan.name as nama_satuan',
      'supplier.name as nama_supplier',
      'bahan_baku.name as nama_bb'
    )
      ->leftJoin('bahan_baku', 'bahan_baku.id', '=', 'retur_bb_detail.id_bb')
      ->leftJoin('warna', 'warna.id', '=', 'retur_bb_detail.id_warna')
      ->leftJoin('satuan', 'satuan.id', '=', 'retur_bb_detail.id_satuan')
      ->leftJoin('supplier', 'supplier.id', '=', 'retur_bb_detail.id_supplier')
      ->leftJoin('master_bb', 'master_bb.id', '=', 'retur_bb_detail.kode_bb')
      ->where('no_bukti_retur', $r['id_retur'])
      ->get();

    $data = [
      'id_so' => $get_so[0]['id_so'],
      'data' => $data,
    ];
    // dd($data);

    return response()->json($data);
  }

  public function get_detail_retur_acc(Request $request)
  {
    $r = $request->all();
    // dd($r);
    if (isset($r['id_so'])) {
      $get_id_permintaan = PermintaanAcc::where('id_so', $r['id_so'])->get();
      $r['id'] = $get_id_permintaan[0]['id'];
    }
    // dd($r['id']);
    $permintaan = DB::table('permintaan_acc')
      ->select(
        'permintaan_acc.*',
        'permintaan_acc_detail.kode_acc',
        'permintaan_acc_detail.ket',
        'permintaan_acc_detail.qty as qty_permintaan',
        'permintaan_acc_detail.id_acc as id_acc',
        'supplier.id as id_supplier',
        'brand.id as id_brand',
        'satuan.id as id_satuan',
        'satuan.name as nama_satuan',
        'supplier.name as nama_supplier',
        'brand.name as nama_brand',
        'acc.name as nama_acc',
        'master_acc.stock as stock'
      )
      ->join('permintaan_acc_detail', 'permintaan_acc_detail.no_bukti_permintaan', '=', 'permintaan_acc.id')
      ->join('acc', 'acc.id', '=', 'permintaan_acc_detail.id_acc')
      ->join('brand', 'brand.id', '=', 'permintaan_acc_detail.id_brand')
      ->join('satuan', 'satuan.id', '=', 'permintaan_acc_detail.id_satuan')
      ->join('supplier', 'supplier.id', '=', 'permintaan_acc_detail.id_supplier')
      ->leftJoin('master_acc', 'master_acc.id', '=', 'permintaan_acc_detail.kode_acc')
      ->where('permintaan_acc.id', $r['id'])
      ->orderBy('index', 'asc')
      ->get();

    $keluar = DB::table('keluar_acc_detail')
      ->select('kode_acc', DB::raw('SUM(qty) as qty_keluar'))
      ->where('id_permintaan', $r['id'])
      ->groupBy('kode_acc')
      ->get();

    $pemakaian = DB::table('pemakaian_acc_detail')
      ->select('kode_acc', DB::raw('SUM(qty) as qty_pemakaian'), DB::raw('SUM(qty_retur) as qty_retur'))
      ->where('no_bukti_permintaan', $r['id'])
      ->groupBy('kode_acc')
      ->get();

    $id = DB::table('keluar_acc_detail')
      ->select('id_keluar', 'id_permintaan')
      ->where('id_permintaan', $r['id'])
      ->get();

    if (!isset($id[0])) {
      $id = $this->genid('KeluarAcc', 'KA');
    } else {
      $id = $id[0]->id_keluar;
    }
    // dd($pemakaian);
    if (!isset($pemakaian[0])) {
      $id_pemakaian = $this->genid('PemakaianAcc', 'PA');
    } else {
      if (isset($r['id_so'])) {
        $pemakaian_get = DB::table('pemakaian_acc')
          ->select('id', 'id_so')
          ->where('id_so', $r['id_so'])
          ->limit(1)
          ->get();
        $id_pemakaian = $pemakaian_get[0]->id;
      } else {
        $id_pemakaian = 0;
      }
    }

    // dd($pemakaian_get[0]->id);
    $data = [
      'id_permintaan' => $get_id_permintaan[0]['id'],
      'id_keluar' => $id,
      'id_pemakaian' => $id_pemakaian,
      'permintaan' => $permintaan,
      'keluar' => $keluar,
      'pemakaian' => $pemakaian,
    ];
    // dd($data);
    return response()->json($data);
  }

  public function get_detail_retur_acc_gudang(Request $request)
  {
    $r = $request->all();
    // dd(1);
    $get_so = ReturAcc::where('id', $r['id_retur'])->get();
    $data = ReturAccDetail::select(
      'retur_acc_detail.kode_acc',
      'retur_acc_detail.qty_retur',
      'retur_acc_detail.qty_retur_sisa',
      'supplier.id as id_supplier',
      'brand.id as id_brand',
      'brand.name as nama_brand',
      'satuan.id as id_satuan',
      'satuan.name as nama_satuan',
      'supplier.name as nama_supplier',
      'acc.name as nama_acc'
    )
      ->leftJoin('acc', 'acc.id', '=', 'retur_acc_detail.id_acc')
      ->leftJoin('brand', 'brand.id', '=', 'retur_acc_detail.id_brand')
      ->leftJoin('satuan', 'satuan.id', '=', 'retur_acc_detail.id_satuan')
      ->leftJoin('supplier', 'supplier.id', '=', 'retur_acc_detail.id_supplier')
      ->leftJoin('master_acc', 'master_acc.id', '=', 'retur_acc_detail.kode_acc')
      ->where('no_bukti_retur', $r['id_retur'])
      ->get();
    $data = [
      'id_so' => $get_so[0]['id_so'],
      'data' => $data,
    ];
    // dd($data);

    return response()->json($data);
  }
  public function retur_bb_index()
  {

    $kode = 'RB';
    $title = 'Retur Bahan Baku Gudang';
    $tag = 'retur_bb';
    $tanggal = $this->datenowtoview();
    $index = $this->genindex('ReturBB');
    $newid = $this->genid('ReturBB', 'RB');

    return view('gudang.retur_bb', ['newid' => $newid, 'title' => $title, 'tag' => $tag, 'tanggal' => $tanggal]);
  }

  public function retur_bb_create(Request $request)
  {
    for ($i = 0; $i < count($request['id_bb']); $i++) {
      if (floatval($request['qty_retur_terima'][$i]) > floatval($request['qty_retur_sisa'][$i])) {
        return response()->json([
          'status' => false,
          'message' => 'Qty Retur Tidak Boleh Lebih Dari Qty Sisa!',
        ]);
      }
      if ($request['qty_retur_terima'][$i] != null) {
        if (floatval($request['qty_retur_terima'][$i]) <= 0) {
          return response()->json([
            'status' => false,
            'message' => 'Qty Retur Tidak Boleh Kurang Dari Nol!',
          ]);
        }
      }
    }
    // dd($request->all());

    $jumlah = 0;
    $total_qty = 0;
    for ($i = 0; $i < count($request['kode_bb']); $i++) {
      if ($request['qty_retur_terima'][$i] != null) {
        $sisa_qty     = floatval($request['qty_retur_sisa'][$i]) - floatval($request['qty_retur_terima'][$i]);
        $total_retur_terima = floatval($request['qty_retur'][$i]) - $sisa_qty;
        $status       = ($sisa_qty == 0) ? 'A' : 'N';
        $data_sisa = [
          'qty_retur_terima' => $total_retur_terima,
          'qty_retur_sisa' => $sisa_qty,
          'isactive' => $status,
        ];

        $update_sisa = ReturBBDetail::where('no_bukti_retur', $request['id_retur'])
          ->where('kode_bb', $request['kode_bb'][$i])
          ->update($data_sisa);

        $harga = MasterBB::where('id', $request['kode_bb'][$i])->get();
        if (isset($harga)) {
          $harga = $harga[0]['harga_default'];
        } else {
          $harga = 0;
        }

        $jumlah = $jumlah + (floatval($harga) *  $request['qty_retur'][$i]);
        $total_qty = $total_qty + $total_retur_terima;

        //Fungsi Kartu Persediaan
        $jenis_persediaan = 'BB';
        $id_barang = $request['kode_bb'][$i];
        $id_ref = $request['id_retur'];
        $type_ref = 'R'; // B/P/R'; + Beli B, - Pemakaian P - Retur R, 
        $qty_persediaan = floatval($request['qty_retur_terima'][$i]);
        $satuan = $request['id_satuan'][$i];
        $harga_persediaan = floatval($this->ribuantodb($harga));

        $data_kartu_persediaan = [
          'jenis' => $jenis_persediaan,
          'id_barang' => $id_barang,
          'id_ref' => $id_ref,
          'type_ref' => $type_ref,
          'qty' => $qty_persediaan,
          'satuan' => $satuan,
          'harga' => $harga_persediaan,
          'jumlah' => $qty_persediaan * $harga_persediaan,
        ];
        // dd($data_kartu_persediaan);
        $this->create_kartu_persediaan($data_kartu_persediaan);
      }
    }

    $qty_retur_all = ReturBBDetail::where('no_bukti_retur', $request['id_retur'])->sum('qty_retur');
    $qty_retur_all_terima = ReturBBDetail::where('no_bukti_retur', $request['id_retur'])->sum('qty_retur_terima');

    if ($qty_retur_all == $qty_retur_all_terima) {
      $data = [
        'isactive' => 'A'
      ];

      ReturBB::where('id', $request['id_retur'])->update($data);
    }


    //Fungsi Akuntansi 
    $id = ['1101050001', '5501010001'];
    $debit = [round($jumlah), 0];
    $credit = [0, round($jumlah)];
    $ref_type = ['retur_bb', 'retur_bb'];
    $ref_id = [$request['id'], $request['id']];
    $memo = ['RETUR BAHAN BAKU DENGAN ID : ' . $request['id'], 'RETUR BAHAN BAKU DENGAN ID : ' . $request['id']];
    $date = $this->datenowtodb();
    $currency = 'IDR';

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
      'message' => 'Retur Bahan Baku Created',
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
    $title = 'Retur Accessories';
    $tag = 'retur_acc';
    $tanggal = $this->datenowtoview();
    $index = $this->genindex('ReturAcc');
    $newid = $this->genid('ReturAcc', 'RA');

    return view('gudang.retur_acc', ['newid' => $newid, 'title' => $title, 'tag' => $tag, 'tanggal' => $tanggal]);
  }

  public function retur_acc_create(Request $request)
  {
    for ($i = 0; $i < count($request['id_acc']); $i++) {
      if (floatval($request['qty_retur_terima'][$i]) > floatval($request['qty_retur_sisa'][$i])) {
        return response()->json([
          'status' => false,
          'message' => 'Qty Retur Tidak Boleh Lebih Dari Qty Sisa!',
        ]);
      }
      if ($request['qty_retur_terima'][$i] != null) {
        if (floatval($request['qty_retur_terima'][$i]) <= 0) {
          return response()->json([
            'status' => false,
            'message' => 'Qty Retur Tidak Boleh Kurang Dari Nol!',
          ]);
        }
      }
    }
    // dd($request->all());

    $jumlah = 0;
    $total_qty = 0;
    for ($i = 0; $i < count($request['kode_acc']); $i++) {
      if ($request['qty_retur_terima'][$i] != null) {
        $sisa_qty     = floatval($request['qty_retur_sisa'][$i]) - floatval($request['qty_retur_terima'][$i]);
        $total_retur_terima = floatval($request['qty_retur'][$i]) - $sisa_qty;
        $status       = ($sisa_qty == 0) ? 'A' : 'N';
        $data_sisa = [
          'qty_retur_terima' => $total_retur_terima,
          'qty_retur_sisa' => $sisa_qty,
          'isactive' => $status,
        ];

        $update_sisa = ReturAccDetail::where('no_bukti_retur', $request['id_retur'])
          ->where('kode_acc', $request['kode_acc'][$i])
          ->update($data_sisa);

        $harga = MasterAcc::where('id', $request['kode_acc'][$i])->get();
        if (isset($harga)) {
          $harga = $harga[0]['harga_default'];
        } else {
          $harga = 0;
        }

        $jumlah = $jumlah + (floatval($harga) *  $request['qty_retur'][$i]);
        $total_qty = $total_qty + $total_retur_terima;

        //Fungsi Kartu Persediaan
        $jenis_persediaan = 'Acc';
        $id_barang = $request['kode_acc'][$i];
        $id_ref = $request['id_retur'];
        $type_ref = 'R'; // B/P/R'; + Beli B, - Pemakaian P - Retur R, 
        $qty_persediaan = floatval($request['qty_retur_terima'][$i]);
        $satuan = $request['id_satuan'][$i];
        $harga_persediaan = floatval($this->ribuantodb($harga));

        $data_kartu_persediaan = [
          'jenis' => $jenis_persediaan,
          'id_barang' => $id_barang,
          'id_ref' => $id_ref,
          'type_ref' => $type_ref,
          'qty' => $qty_persediaan,
          'satuan' => $satuan,
          'harga' => $harga_persediaan,
          'jumlah' => $qty_persediaan * $harga_persediaan,
        ];
        // dd($data_kartu_persediaan);
        $this->create_kartu_persediaan($data_kartu_persediaan);
      }
    }

    $qty_retur_all = ReturAccDetail::where('no_bukti_retur', $request['id_retur'])->sum('qty_retur');
    $qty_retur_all_terima = ReturAccDetail::where('no_bukti_retur', $request['id_retur'])->sum('qty_retur_terima');

    if ($qty_retur_all == $qty_retur_all_terima) {
      $data = [
        'isactive' => 'A'
      ];

      ReturAcc::where('id', $request['id_retur'])->update($data);
    }


    //Fungsi Akuntansi 
    $id = ['1101050001', '5501010001'];
    $debit = [round($jumlah), 0];
    $credit = [0, round($jumlah)];
    $ref_type = ['retur_acc', 'retur_acc'];
    $ref_id = [$request['id'], $request['id']];
    $memo = ['RETUR BAHAN BAKU DENGAN ID : ' . $request['id'], 'RETUR BAHAN BAKU DENGAN ID : ' . $request['id']];
    $date = $this->datenowtodb();
    $currency = 'IDR';

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
      'message' => 'Retur Accessories Created',
    ]);
  }

  public function retur_acc_api()
  {
    $retur_acc = DB::table('retur_acc')
      ->select('retur_acc.*', 'so.produksi_id as id_produksi', 'so.name as nama_produk', 'retur_acc_detail.qty_retur as qty', 'retur_acc_detail.qty_retur as qty_retur')
      ->join('so', 'retur_acc.id_so', '=', 'so.id')
      ->join('retur_acc_detail', 'retur_acc.id', '=', 'retur_acc_detail.no_bukti_retur')
      ->get();

    return DataTables::of($retur_acc)
      ->make(true);
  }


  public function masuk_barang_index()
  {
    $data = [
      'title' => 'Warehouse',
      'tag' => 'warehouse',
      'tanggal' => $this->datenowtoview(),
    ];
    return view('gudang.masuk_barang', $data);
  }

  public function masuk_barang_create(Request $request)
  {
    $user = Auth::user();
    $r    = $request->all();

    $saldo = ProdukStok::where('id_barang', $r['produk_id'])
      ->where('id_size', $r['size_id'])
      ->get();

    if (isset($saldo[0])) {
      if($r['type']=='m'){
        $data_stok = [
          'stok' => (int) $saldo[0]->stok + (int) $r['qty'],
        ];
      } elseif ($r['type'] == 'k'){
        $cek_saldo = (int)$saldo[0]->stok - (int) $r['qty'];
        if($cek_saldo < 0){
          return response()->json([
            'status'  => false,
            'message' => 'Stok Kurang'
          ]);
        }
        $data_stok = [
          'stok' => (int) $cek_saldo,
        ];
      } else {
        $data_stok = [
          'stok' => (int) $r['qty'],
        ];
      }
      ProdukStok::where('id_barang', $r['produk_id'])
        ->where('id_size', $r['size_id'])
        ->update($data_stok);
    } else {
      $i    = $this->genindex('ProdukStok');
      $data_stok = [
        'index' =>  $i,
        'id_barang' => $r['produk_id'],
        'id_size' => $r['size_id'],
        'stok' => $r['qty'],
        'status' => 'A',
        'created_at' => $this->datetodb($r['tanggal_create']),
      ];
      ProdukStok::create($data_stok);
    }

    $saldo = ProdukStok::where('id_barang', $r['produk_id'])
      ->where('id_size', $r['size_id'])
      ->get();
    $i    = $this->genindex('MasukBarang');
    $data = [
      'index' =>  $i,
      'id_barang' => $r['produk_id'],
      'id_size' => $r['size_id'],
      'qty' => (int)$r['qty'],
      'saldo' => (int)$saldo[0]->stok,
      'type' => $r['type'],
      'keterangan' => $r['keterangan'].' - Dibuat oleh : '. $user->name,
      'created_at' => $this->datetodb($r['tanggal_create']),
    ];
    MasukBarang::create($data);

    return response()->json([
      'status'  => true,
      'message' => 'Masuk Barang Created'
    ]);
  }

  public function masuk_barang_api(Request $request)
  {
    $r = $request->all();
    $f = Carbon::createFromFormat('Y-m-d H:i:s', substr($r['from'], 6, 4) . '-' . substr($r['from'], 3, 2) . '-' . substr($r['from'], 0, 2) . ' 00:00:00');
    $t = Carbon::createFromFormat('Y-m-d H:i:s', substr($r['to'], 6, 4) . '-' . substr($r['to'], 3, 2) . '-' . substr($r['to'], 0, 2) . ' 23:59:00');

    $data = DB::table('masuk_barang')
      ->select(
        'masuk_barang.id_barang',
        'masuk_barang.id_size',
        'produk.name as nama_barang',
        'masuk_barang.qty',
        'masuk_barang.type',
        'masuk_barang.keterangan',
        'masuk_barang.saldo',
        'masuk_barang.created_at'
      )
      ->leftJoin('produk', 'masuk_barang.id_barang', '=', 'produk.id')
      ->whereBetween('masuk_barang.created_at', [$f, $t])
      ->orderBy('created_at', 'desc')
      ->get();

    return DataTables::of($data)
      ->editColumn('tanggal', function ($data) {
        return Carbon::parse($data->created_at)->format('d/m/Y');
      })
      ->editColumn('type', function ($data) {
        if ($data->type == 'm') {
          return 'Masuk';
        } elseif ($data->type == 'k') {
          return 'Keluar';
        } else {
          return 'Adjust';
        }
      })
      ->editColumn('id_barang', function ($data) {
        return $data->id_barang;
      })
      ->editColumn('nama_barang', function ($data) {
        return $data->nama_barang;
      })
      ->editColumn('saldo', function ($data) {
        return number_format($data->saldo);
      })
      ->editColumn('qty', function ($data) {
        return number_format($data->qty);
      })
      ->addColumn('action', function ($data) {
        return
          '<div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Aksi
      <span class="caret"></span></button>
      <ul class="dropdown-menu">
      <li><a onclick="validasiData(\'' . $data->id_barang . '\',\'edit\')"> Edit</a></li>
      <li><a onclick="validasiData(\'' . $data->id_barang . '\',\'update\')"> Update Saldo</a></li>
      </ul>
      </div>';
        '';
      })
      ->make(true);
  }


  public function stok_produk_index()
  {
    $data = [
      'title' => 'Stok Produk',
      'tag' => 'stok_produk',
      'tanggal' => $this->datenowtoview(),
    ];
    return view('gudang.stock_produk', $data);
  }

  public function stok_produk_api(Request $request)
  {
    $r = $request->all();
    // $f = Carbon::createFromFormat('Y-m-d H:i:s', substr($r['from'], 6, 4) . '-' . substr($r['from'], 3, 2) . '-' . substr($r['from'], 0, 2) . ' 00:00:00');
    // $t = Carbon::createFromFormat('Y-m-d H:i:s', substr($r['to'], 6, 4) . '-' . substr($r['to'], 3, 2) . '-' . substr($r['to'], 0, 2) . ' 23:59:00');

    $data = DB::table('produk_stok')
      ->select(
        'produk_stok.id_barang',
        'produk_stok.id_size',
        'produk.name as nama_barang',
        'produk_stok.stok',
        'produk_stok.created_at'
      )
      ->leftJoin('produk', 'produk_stok.id_barang', '=', 'produk.id')
      // ->whereBetween('produk_stok.created_at', [$f, $t])
      // ->groupBy('produk_stok.id_barang', 'produk_stok.id_size', 'produk.name')
      ->orderBy('created_at', 'desc')
      ->get();

    return DataTables::of($data)
      ->editColumn('tanggal', function ($data) {
        return Carbon::parse($data->created_at)->format('d/m/Y');
      })
      ->editColumn('id_barang', function ($data) {
        return $data->id_barang;
      })
      ->editColumn('nama_barang', function ($data) {
        return $data->nama_barang;
      })
      ->editColumn('stok', function ($data) {
        return number_format($data->stok);
      })
      ->make(true);
  }



}

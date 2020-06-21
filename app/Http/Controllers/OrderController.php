<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Auth;
use PDF;
use Carbon\Carbon;
use App\Order;
use App\So;
use App\MasukBarang;
use App\Produk;
use App\ProdukStok;
use App\OrderDetail;
use DataTables;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

  public function order_list_ecommerce_index()
  {
    $title  = 'Order List';
    $tag    = 'order_list';
    $newid  = $this->genid('EKategori','');

    return view('order.order_list_ecommerce_index', ['title' => $title, 'tag' => $tag]);
  }

    public function order_list_ecommerce_api()
    {
      $data = Order::select('order.tanggal_order',
      'order.id',
      'order.status_order',
      'order.total_transaksi',
      'costumer.name as nama_customer')
      ->leftJoin('costumer','costumer.id','=','order.user_id')
      ->get();
      return DataTables::of($data)
      ->editColumn('tanggal_order', function($data){
        return Carbon::parse($data->tanggal_order)->format('d M Y');
      })
      ->editColumn('total_transaksi', function($data){
        return 'IDR '.number_format($data->total_transaksi);
      })
      ->editColumn('status_order', function($data){
        if($data->status_order == 'n'){
          $status = 'New';
        } elseif ($data->status_order == 'p') {
          $status = 'Process';
        } elseif ($data->status_order == 'b') {
        $status = 'Batal';
        } else {
          $status = 'Selesai';
        }
        return $status;
      })
      ->addColumn('action', function($data){
        if ($data->status_order == 'n'){
          // $disabled_edit = 'disabled';
          $disabled_approve = '';
          $disabled_no_resi = 'disabled';
          $disabled_selesai = 'disabled';
          $disabled_batal = '';
        } elseif ($data->status_order == 'p') {
          // $disabled_edit = 'disabled';
          $disabled_approve = 'disabled';
          $disabled_no_resi = '';
          $disabled_selesai = '';
          $disabled_batal = '';
        } elseif ($data->status_order == 'b') {
          // $disabled_edit = 'disabled';
          $disabled_approve = 'disabled';
          $disabled_no_resi = 'disabled';
          $disabled_selesai = 'disabled';
          $disabled_batal = 'disabled';
        } elseif ($data->status_order == 's') {
          // $disabled_edit = 'disabled';
          $disabled_approve = 'disabled';
          $disabled_no_resi = 'disabled';
          $disabled_selesai = 'disabled';
          $disabled_batal = 'disabled';
        } else {
          // $disabled_edit = 'disabled';
          $disabled_approve = 'disabled';
          $disabled_no_resi = 'disabled';
          $disabled_selesai = 'disabled';
          $disabled_batal = 'disabled';
        }
        return
        '<a onclick="view_print(\''.$data->id.'\')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-print"></i> View & Cetak</a> &nbsp;'.
        // '<a onclick="showEdit(\''.$data->id.'\')" class="btn btn-warning btn-xs '. $disabled_edit.'"><i class="glyphicon glyphicon-pencil"></i> Edit</a> &nbsp;'.
        '<a onclick="approve_order(\''.$data->id.'\')" class="btn btn-success btn-xs '.$disabled_approve.'" ><i class="glyphicon glyphicon-ok"></i> Approve</a> &nbsp;'.
        '<a onclick="input_no_resi(\''.$data->id.'\')" class="btn btn-info btn-xs '.$disabled_no_resi.'" data-toggle="modal" data-target="#modalInput"><i class="glyphicon glyphicon-send"></i> Input No Resi</a> &nbsp;'.
        '<a onclick="selesai_order(\''.$data->id.'\')" class="btn btn-primary btn-xs '.$disabled_selesai. '" ><i class="glyphicon glyphicon-ok"></i> Selesai</a> &nbsp;'.
        '<a onclick="batal_order(\''.$data->id.'\')" class="btn btn-danger btn-xs '.$disabled_batal.'" ><i class="glyphicon glyphicon-remove"></i> Batal</a>';
      })
      ->make(true);
    }
    
    public function batal_order(Request $request)
    {
    $r      = $request->all();
    Order::where('id', $r['id'])
      ->update([
        'status_order' => 'b',
        'updated_at'  => $this->datenowtodb()
      ]);

    return response()->json(
      [
        'status'  => true,
        'message' => 'Order dibatalkan!',
      ]
    );
    }

    public function selesai_order(Request $request)
    {
    $r      = $request->all();
    Order::where('id', $r['id'])
      ->update([
        'status_order' => 's',
        'updated_at'  => $this->datenowtodb()
      ]);

    return response()->json(
      [
        'status'  => true,
        'message' => 'Order selesai!',
      ]
    );
    }

    public function approve_order(Request $request)
    {
    $r      = $request->all();
    // dd($r);
    $user   = Auth::user();
    $data_detail = OrderDetail::select(
      'order.id',
      'order_detail.index',
      'order_detail.qty',
      'order_detail.total',
      'order_detail.harga as harga_total',
      'order_detail.size_id',
      'order_detail.barang_id',
      'produk.name',
      'produk.harga',
      'produk.photo'
    )
      ->where('order_detail.order_id', $r['id'])
      ->leftJoin('order', 'order.id', '=', 'order_detail.order_id')
      ->leftJoin('produk', 'produk.id', '=', 'order_detail.barang_id')
      ->get();
      // dd($data_detail);
      for($i=0; $i < count($data_detail); $i++){
      $saldo = ProdukStok::where('id_barang', $data_detail[$i]->barang_id)
        ->where('id_size', $data_detail[$i]->size_id)
        ->get();
        // dd($saldo);
      if (isset($saldo[0])) {
            $cek_saldo = (int) $saldo[0]->stok - (int) $data_detail[$i]->qty;
            if ($cek_saldo < 0) {
              return response()->json([
                'status'  => false,
                'message' => 'Stok kurang'
              ]);
            } 
        } else {
        return response()->json([
          'status'  => false,
          'message' => 'Ada barang yang habis'
        ]);
        }
      }
      // dd(count($data_detail));
      // dd('lolos validasi');
      for($i=0; $i < count($data_detail); $i++){
        $id_barang = $data_detail[$i]->barang_id;
        $id_size = $data_detail[$i]->size_id;
        $qty = $data_detail[$i]->qty;
      $saldo = ProdukStok::where('id_barang', $id_barang)
        ->where('id_size', $id_size)
        ->get();
        // dd($saldo[0]->stok);
      $cek_saldo = (int) $saldo[0]->stok - (int) $qty;
      $data_stok = [
        'stok' => (int) $cek_saldo,
      ];
      ProdukStok::where('id_barang', $id_barang)
      ->where('id_size', $id_size)
      ->update($data_stok);
      // dd($id_barang, $id_size);

      $i    = $this->genindex('MasukBarang');
      // dd($id_barang);
      $data = [
        'index' =>  $i,
        'id_barang' => $id_barang,
        'id_size ' => $id_size,
        'qty' => (int) $qty,
        'saldo' => (int) $cek_saldo,
        'type' => 'k',
        'keterangan' => 'Penjualan dengan no invoice ' . $r['id']. ' - Diapprove oleh : ' . $user->name,
        'created_at' => $this->datenowtodb(),
      ];
      // dd($data);
      MasukBarang::create($data);
      }

    Order::where('id', $r['id'])
      ->update([
        'status_order' => 'p',
        'updated_at'  => $this->datenowtodb()
      ]);

    return response()->json(
      [
        'status'  => true,
        'message' => 'Order diproses!',
      ]
    );
    }

    public function input_no_resi(Request $request)
    {
    $r      = $request->all();
    // dd($r);
    $data = Order::where('id', $r['invoice_id'])->get();
    $total_transaksi = (int) $data[0]->total_transaksi + (int) $r['ongkos_kirim'];
    Order::where('id', $r['invoice_id'])
      ->update([
        'ongkos_kirim' => $r['ongkos_kirim'],
        'no_resi' => $r['no_resi'],
        'total_transaksi' => $total_transaksi,
        'updated_at'  => $this->datenowtodb()
      ]);

    return response()->json([
      'status'  => true,
      'message' => 'Input no resi dan ongkir berhasil'
    ]);
    }

    public function order_ecommerce_view_print($id)
    {
      $role = Auth::user()->role;
      if((int)$role >= 2 ){
      abort(404);
      }
      $data = Order::select(
        'order.tanggal_order',
        'order.id',
        'order.status_order',
        'order.catatan_order',
        'order.potongan',
        'order.total_transaksi',
        'order.no_resi',
        'order.alamat_tujuan as alamat',
        'order.kota as kota',
        'order.telepon as no_hp',
        'order.kode_pos as kode_pos',
        'order.email as email',
        'order.nama_penerima as nama_customer',
        'costumer.id as id_customer'
      )
      ->leftJoin('costumer', 'costumer.id', '=', 'order.user_id')
      ->where('order.id','=',$id)
      ->get();

      $ongkos_kirim = Order::select(
        'order.ongkos_kirim'
      )
      ->where('order.id','=',$id)
      ->get();

      $potongan = Order::where('order.id','=',$id)
      ->sum('potongan');

      $total_transaksi = Order::select(
        'order.total_transaksi'
      )
      ->where('order.id','=',$id)
      ->get();

    $data_detail = OrderDetail::select(
      'order.id',
      'order_detail.index',
      'order_detail.qty',
      'order_detail.total',
      'order_detail.harga as harga_total',
      'order_detail.size_id',
      'order_detail.barang_id',
      'produk.name',
      'produk.harga',
      'produk.photo'
    )
      ->where('order_detail.order_id', $id)
      ->leftJoin('order', 'order.id', '=', 'order_detail.order_id')
      ->leftJoin('produk', 'produk.id', '=', 'order_detail.barang_id')
      ->get();
      // dd($data_detail);
      // dd($data);
      if (!isset($data[0])) {
        abort(404);
      } else {
        $title      = 'INVOICE';
        $data = [
          'title'         =>  $title,
          'data'          =>  $data,
          'data_detail'   =>  $data_detail,
          'ongkos_kirim'   =>  $ongkos_kirim[0]->ongkos_kirim,
          'potongan'   =>  $potongan,
          'total_transaksi'   =>  $total_transaksi[0]->total_transaksi,
        ];
        // dd($data);
        $pdf  = PDF::loadView('order.print.invoice', $data);
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream();
        }
      }


}

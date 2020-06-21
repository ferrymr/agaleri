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
use App\SkbDetail;

class HistoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // History
    public function history_spk()
    {
      $data = DB::table('art')
      ->join('so', 'so.id', '=', 'art.so_id')
      ->select('art.*', 'so.name as name')
      ->orderBy('so.id','desc')
      ->where('art.ispost','Y')
      ->get();
      return view('history.list_history_spk',['data'=>$data]);
    }
    public function history_art()
    {
      $data = DB::table('so')
      ->join('art', 'so.produksi_id', '=', 'art.produksi_id')
      ->join('costumer', 'so.costumer_id', '=', 'costumer.id')
      ->select('so.*','art.id as kode_art','costumer.name as nama_costumer')
      ->get();
      return view('history.list_history_art',['data'=>$data,'title'=>'Artikel','tag'=>'Artikel']);
    } 


    public function history_art_api(Request $request)
    {
      $r    = $request->all();
      $data = [];
      if (isset($r['art_id'])) {
        $data = DB::table('art')
          ->leftJoin('so', 'art.so_id', '=', 'so.id')
          ->leftJoin('costumer', 'so.costumer_id', '=', 'costumer.id')
          ->select('so.*','art.*','costumer.name as nama_costumer','so.id as so_id','so.qty as qty_so')
          ->where('art.so_id', '=', $r['so_id'])
          ->where('art.art_id', '=', $r['art_id'])
          ->get();
          // dd(0);
      }
      // dd($data);
      return DataTables::of($data)
        ->editColumn('qty_bj', function ($data) {
          return number_format($data->qty_bj);
        })
        ->addColumn('inv_cmt', function ($data) {
          $total = (int)$data->inv_cmt_embro + (int)$data->inv_cmt_finishing+ (int)$data->inv_cmt_lain2+ (int)$data->inv_cmt_printing+ (int)$data->inv_cmt_sewing+ (int)$data->inv_cmt_washing ;
          return number_format($total);
        })
        ->addColumn('cacat_bahan', function ($data) {
          $total = (int)$data->cacat_bahan_embro + (int)$data->cacat_bahan_finishing+ (int)$data->cacat_bahan_lain2+ (int)$data->cacat_bahan_printing+ (int)$data->cacat_bahan_sewing+ (int)$data->cacat_bahan_washing ;
          return number_format($total);
        })
        ->addColumn('wip', function ($data) {
          $total = (int)$data->stock_embro + (int)$data->stock_finishing+ (int)$data->stock_lain2+ (int)$data->stock_printing+ (int)$data->stock_sewing+ (int)$data->stock_washing ;
          return number_format($total);
        })
        ->addColumn('validasi', function ($data) {
          $total_wip = (int)$data->stock_embro + (int)$data->stock_finishing+ (int)$data->stock_lain2+ (int)$data->stock_printing+ (int)$data->stock_sewing+ (int)$data->stock_washing ;
          $total_cacat_bahan = (int)$data->cacat_bahan_embro + (int)$data->cacat_bahan_finishing+ (int)$data->cacat_bahan_lain2+ (int)$data->cacat_bahan_printing+ (int)$data->cacat_bahan_sewing+ (int)$data->cacat_bahan_washing ;
          $total_inv_cmt = (int)$data->inv_cmt_embro + (int)$data->inv_cmt_finishing+ (int)$data->inv_cmt_lain2+ (int)$data->inv_cmt_printing+ (int)$data->inv_cmt_sewing+ (int)$data->inv_cmt_washing ;
          $qty_cutt = $data->qty;
          $total =  $total_cacat_bahan+$total_inv_cmt+$total_wip;

          if ($total_wip > 0) {
            return 'Open';
          } else if ($qty_cutt == $total) {
            return 'Close';
          } else {
            return 'Please Check';
          }  
          return number_format($total);
        })
        ->addColumn('temp', function ($data) {
            return '';
        })
        ->make(true);
    }

    public function history_so()
    {
      $data = DB::table('so')
      ->join('art', 'so.produksi_id', '=', 'art.produksi_id')
      ->join('costumer', 'so.costumer_id', '=', 'costumer.id')
      ->select('so.*','art.id as kode_art','costumer.name as nama_costumer')
      ->get();
      return view('history.list_history_so',['data'=>$data,'title'=>'SO','tag'=>'SO']);
    }

    public function history_so_api(Request $request)
    {
      $r    = $request->all();
      $data = [];
      if (isset($r['so_id'])) {
        $data = DB::table('art')
          ->leftJoin('so', 'art.so_id', '=', 'so.id')
          ->leftJoin('costumer', 'so.costumer_id', '=', 'costumer.id')
          ->select('so.id as so_id','so.qty as qty_so','costumer.name as nama_costumer','so.name as name','so.bulan_id as bulan_id' ,DB::raw('SUM(art.qty_bj) as qty_bj'), DB::raw('SUM(art.qty) as qty'),
          DB::raw('SUM(art.inv_cmt_printing) as inv_cmt_printing'),
          DB::raw('SUM(art.inv_cmt_embro) as inv_cmt_embro'),
          DB::raw('SUM(art.inv_cmt_sewing) as inv_cmt_sewing'),
          DB::raw('SUM(art.inv_cmt_washing) as inv_cmt_washing'),
          DB::raw('SUM(art.inv_cmt_lain2) as inv_cmt_lain2'),
          DB::raw('SUM(art.inv_cmt_finishing) as inv_cmt_finishing'),
          
          DB::raw('SUM(art.cacat_bahan_printing) as cacat_bahan_printing'),
          DB::raw('SUM(art.cacat_bahan_embro) as cacat_bahan_embro'),
          DB::raw('SUM(art.cacat_bahan_sewing) as cacat_bahan_sewing'),
          DB::raw('SUM(art.cacat_bahan_washing) as cacat_bahan_washing'),
          DB::raw('SUM(art.cacat_bahan_lain2) as cacat_bahan_lain2'),
          DB::raw('SUM(art.cacat_bahan_finishing) as cacat_bahan_finishing'),

          DB::raw('SUM(art.stock_printing) as stock_printing'),
          DB::raw('SUM(art.stock_embro) as stock_embro'),
          DB::raw('SUM(art.stock_sewing) as stock_sewing'),
          DB::raw('SUM(art.stock_washing) as stock_washing'),
          DB::raw('SUM(art.stock_lain2) as stock_lain2'),
          DB::raw('SUM(art.stock_finishing) as stock_finishing')
          
          
          )
          ->where('so.id', '=', $r['so_id'])
          ->groupBy('so.id','costumer.name')
          ->get();
      }
      // dd($data);
      return DataTables::of($data)
        ->editColumn('qty_bj', function ($data) {
          return number_format($data->qty_bj);
        })
        ->addColumn('inv_cmt', function ($data) {
          $total = (int)$data->inv_cmt_embro + (int)$data->inv_cmt_finishing+ (int)$data->inv_cmt_lain2+ (int)$data->inv_cmt_printing+ (int)$data->inv_cmt_sewing+ (int)$data->inv_cmt_washing ;
          return number_format($total);
        })
        ->addColumn('cacat_bahan', function ($data) {
          $total = (int)$data->cacat_bahan_embro + (int)$data->cacat_bahan_finishing+ (int)$data->cacat_bahan_lain2+ (int)$data->cacat_bahan_printing+ (int)$data->cacat_bahan_sewing+ (int)$data->cacat_bahan_washing ;
          return number_format($total);
        })
        ->addColumn('wip', function ($data) {
          $total = (int)$data->stock_embro + (int)$data->stock_finishing+ (int)$data->stock_lain2+ (int)$data->stock_printing+ (int)$data->stock_sewing+ (int)$data->stock_washing ;
          return number_format($total);
        })
        ->addColumn('validasi', function ($data) {
          $total_wip = (int)$data->stock_embro + (int)$data->stock_finishing+ (int)$data->stock_lain2+ (int)$data->stock_printing+ (int)$data->stock_sewing+ (int)$data->stock_washing ;
          $total_cacat_bahan = (int)$data->cacat_bahan_embro + (int)$data->cacat_bahan_finishing+ (int)$data->cacat_bahan_lain2+ (int)$data->cacat_bahan_printing+ (int)$data->cacat_bahan_sewing+ (int)$data->cacat_bahan_washing ;
          $total_inv_cmt = (int)$data->inv_cmt_embro + (int)$data->inv_cmt_finishing+ (int)$data->inv_cmt_lain2+ (int)$data->inv_cmt_printing+ (int)$data->inv_cmt_sewing+ (int)$data->inv_cmt_washing ;
          $qty_cutt = $data->qty;
          $total =  $total_cacat_bahan+$total_inv_cmt+$total_wip;

          if ($total_wip > 0) {
            return 'Open';
          } else if ($qty_cutt == $total) {
            return 'Close';
          } else {
            return 'Please Check';
          }  
          return number_format($total);
        })
        ->addColumn('temp', function ($data) {
            return '';
        })
        ->make(true);
    }

    public function history_detail(Request $request)
    {
      $r = $request->all();
      $data = SkbDetail::select('cmt.name','skb_detail.total')
      ->leftJoin('cmt','cmt.id','=','skb_detail.cmt_id')
      ->leftJoin('skb','skb.id','=','skb_detail.skb_id')
      ->where('skb_detail.so_id',$r['so_id'])
      ->where('skb_detail.art_id',$r['art_id'])
      ->where('skb.proses_id',$r['proses_id'])
      ->where('skb.type','M')
      ->get();
      if (isset($data[0]['name'])){
      $cmt_name = $data[0]['name'];
      $price = $data[0]['total'];
      } else {
        $cmt_name = '';
        $price = '';
        }
      return response()->json([
        'cmt_name' => $cmt_name,
        'price' => $price,
      ]);
    }


}

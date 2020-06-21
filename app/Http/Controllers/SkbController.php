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
use App\Art;
use App\Skb;
use App\SkbDetail;
use App\Param;
use App\MasterBJ;
use App\User;

class SkbController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  // SKB
  public function skb_keluar_index()
  {
    $tanggal  = $this->datenowtoview();
    $title    = 'SKB Keluar';
    $tag      = 'skb_keluar';
    $newid    = $this->genid('Skb', 'SKK','type','K');
    return view('skb.skb_keluar', ['newid'=>$newid,'tanggal'=>$tanggal,'title'=>$title,'tag'=>$tag]);
  }

  //s1
  public function skb_keluar_create(Request $request)
  {
    $r  = $request->all();
    $i  = $this->genindex('Skb','type','K');

    $data = [
      'id'              => $r['id'],
      'index'           => $i,
      'tanggal'         => $this->datetodb($r['tanggal']),
      'type'            => 'K',
      'proses_id'       => $r['proses_id'],
      'cmt_id'          => $r['cmt_id'],
      'isactive'        => 'N',
    ];

    // dd($r);
    $p = $r['proses_now'];
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

    // Validasi
    // 1. Status Proses
    // 2. Sisa Qty
    // 3. Pengeluaran Penyerian

    for ($i=0; $i < count($r['so_id']) ; $i++) {
      $get_validasi_art = Art::select('art.*')
        ->leftJoin('so', 'art.so_id', '=', 'so.id')
        ->where('art.so_id',$r['so_id'][$i])
        ->where('art.art_id',$r['art_id'][$i])
        ->get();

      $status = 'status_'.$p;
      if($get_validasi_art[0]->$status == 'C' || $get_validasi_art[0]->$status == 'O'){
        return response()->json([
            'status'  => false,
            'message' => 'Terdapat artikel yang sedang dikerjakan atau sudah close!',
            ]);
      }

           $sum_qty_stock = Art::leftJoin('so', 'art.so_id', '=', 'so.id')
            ->where('art.so_id',$r['so_id'][$i])
            ->where('art.art_id',$r['art_id'][$i])
            ->sum('art.stock_'.$p);     

          if($sum_qty_stock < 0){
            return response()->json([
              'status'  => false,
              'message' => 'Terhadapat artikel yang tidak memiliki stock!',
              ]);
            }
  
          if((int)$this->ribuantodb($r['qty'][$i]) > $sum_qty_stock ){
            return response()->json([
              'status'  => false,
              'message' => 'Qty keluar lebih besar dari stock!',
              ]);
            }       

        }

    for ($i=0; $i < count($r['so_id']) ; $i++) {
      $status = 'status_'.$p;
      $data_art = So::select('so.name','art.id', 'art.qty_in_'.$p. ' as qty_in', 'art.qty_out_'.$p. ' as qty_out', 'art.out_perbaikan_'.$p.' as out_perbaikan', 'art.in_perbaikan_'.$p.' as in_perbaikan', 'art.cacat_bahan_'.$p.' as cacat_bahan', 'art.inv_cmt_'.$p.' as inv_cmt', 'art.sisa_'.$p.' as qty_sisa', 'art.qty_bj', 'art.alur_proses', 
      'art.sisa_printing as qty_sisa_printing', 'art.sisa_embro as qty_sisa_embro', 'art.sisa_sewing as qty_sisa_sewing', 'art.sisa_washing as qty_sisa_washing', 'art.sisa_lain2 as qty_sisa_lain2', 'art.sisa_finishing as qty_sisa_finishing',
      'art.stock_printing as stock_printing', 'art.stock_embro as stock_embro', 'art.stock_sewing as stock_sewing', 'art.stock_washing as stock_washing', 'art.stock_lain2 as stock_lain2', 'art.stock_finishing as stock_finishing')
      ->leftJoin('art','so.produksi_id','=','art.produksi_id')
      ->where('so.id', $r['so_id'][$i])
      ->where('art.art_id', $r['art_id'][$i])
      ->groupBy('art.id','so.name')
      ->get();
      
      $label_proses_stock = 'stock_'.$p;
      $qty_stock_awal     = (int)$data_art[0]->$label_proses_stock;
      $qty_out_awal       = (int)$data_art[0]->qty_out;
      $qty_sisa           = (int)$data_art[0]->qty_sisa;
      $qty_out_skb        = (int)$this->ribuantodb($r['qty'][$i]);
      $qty_out_now        = $qty_out_awal + $qty_out_skb;
      $qty_sisa_now       = $qty_sisa + $qty_out_skb;
      $qty_stock_now      = $qty_stock_awal - $qty_out_skb;
      // dd($qty_stock);

      $data_update_art = [
        'qty_out_'.$p             => $qty_out_now ,
        'sisa_'.$p                => $qty_sisa_now ,
        'stock_'.$p               => $qty_stock_now ,
        'catatan_'.$p             => $r['ket'][$i],
        'tgl_out_'.$p             => $this->datetodb($r['tanggal']),
        'cmt_id_'.$p              => $r['cmt_id'],
        'status_'.$p              => 'O',
      ];

      $data_detail_skb = [
        'skb_id'              => $r['id'],
        'so_id'               => $r['so_id'][$i],
        'art_id'              => $r['art_id'][$i],
        'index'               => $i,
        'name'                => $r['nama'][$i],
        'qty'                 => $this->ribuantodb($r['qty'][$i]),
        'satuan_id'           => $r['satuan_id'][$i],
        'cmt_id'              => $r['cmt_id'],
        'status_cmt'          => 'O',
        'ket'                 => $r['ket'][$i],
        'isactive'            => 'A',
        'qty_sisa'            => $this->ribuantodb($r['qty'][$i]),
      ];

      $art_detail = SkbDetail::create($data_detail_skb);
      $art = Art::where('art_id', $r['art_id'][$i])
      ->where('so_id', $r['so_id'][$i])
      ->update($data_update_art);
    }

    $create = Skb::create($data);
    $newid = $this->genid('Skb','SKK','type','K');

    return response()->json([
      'status'  => true,
      'message' => 'SKB Keluar created',
      'newid'   => $newid
    ]);
  }

  public function skb_keluar_api()
  {
    $data = SkbDetail::select('skb_detail.*', 'skb_detail.status_cmt as status', 'cmt.name as nama_cmt', 'proses.name as nama_proses','skb_detail.qty as qty_out','skb_detail.qty_sisa as qty_sisa', DB::raw('skb_detail.qty - skb_detail.qty_sisa as qty_in'))
    ->leftJoin('skb', 'skb_detail.skb_id', '=', 'skb.id')
    ->leftJoin('cmt', 'skb_detail.cmt_id', '=', 'cmt.id')
    ->leftJoin('proses', 'skb.proses_id', '=', 'proses.id')
    ->where('skb.type','K')
    ->get();

    return DataTables::of($data)
    ->editColumn('status', function($data){
      if ($data->status == 'O') {
        return 'Open';
      } else if ($data->status == 'C') {
        return 'Close';
      } else if ($data->status == 'P') {
        return 'Proses';
      } else {
        return 'Undefined';
      }
    })
    ->editColumn('qty_out', function($data){
        return number_format($data->qty_out,0).' PCS';
    })
    ->editColumn('qty_in', function($data){
        return number_format($data->qty_in,0).' PCS';
    })
    ->editColumn('qty_sisa', function($data){
        return number_format($data->qty_sisa,0).' PCS';
    })
    ->addColumn('action', function($data){
      $status_button = '';
      $button_edit = '<button onclick="editData(\''.$data->skb_id.'\',\''.$data->so_id.'\',\''.$data->art_id.'\')" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Edit</button>';
      if ($data->status == 'C') {
        $status_button = 'disabled';
        $button_edit = '';
      } 
      return $button_edit.'
      <a href="'.url("/skb_print?param=skb_keluar&skb_id=".$data->skb_id).'" class="btn btn-primary btn-xs" target="_blank"><i class="fa fa-print"></i> Print</a>
      ';
    })
    ->make(true);
  }

  public function skb_validasi_pin(Request $request)
  {
    $r          = $request->all();
    $userid     = '2';
    $verify     = User::findOrFail($userid);

    if ($r['pin'] != $verify->pin) {
      return response()->json([
        'status' => false,
        'message' => 'Pin Salah! '
      ]);
    }

    return response()->json([
      'status' => true,
      'message' => 'Approved'
    ]);
  }


  public function skb_keluar_edit(Request $request)
  {
    $r = $request->all();
    // dd($r);
    $data = DB::table('skb')
    ->select(
      'skb.*',
      'skb_detail.*',
      'cmt.name as nama_cmt',
      'proses.name as nama_proses',
      'satuan.name as nama_satuan'
      )
      ->leftJoin('skb_detail', 'skb.id', '=', 'skb_detail.skb_id')
      ->leftJoin('cmt', 'skb_detail.cmt_id', '=', 'cmt.id')
      ->leftJoin('proses', 'skb.proses_id', '=', 'proses.id')
      ->leftJoin('satuan', 'skb_detail.satuan_id', '=', 'satuan.id')
      ->where('skb.id', '=', $r['skb_id'])
      ->where('skb_detail.so_id', '=', $r['so_id'])
      ->where('skb_detail.art_id', '=', $r['art_id'])
      ->get();

      // dd($data);
      return response()->json([
        'data'    =>  $data,
        // 'type'    =>  'M'
      ]);
    }


  public function skb_keluar_update(Request $request)
  {
    $r          = $request->all();
    $data       = SkbDetail::where('skb_id',$r['id_edit'])
                  ->where('so_id',$r['so_id_edit'])
                  ->where('art_id',$r['art_id_edit']);

    $data_update     = [
        'qty'       => $r['qty_edit'],
        'qty_sisa'  => $r['qty_edit'],
        'ket'       => $r['ket_edit'],
    ];

    $data->update($data_update);

    return response()->json([
      'status' => true,
      'message' => 'SKB Updated'
    ]);
  }

  public function skb_masuk_index()
  {
    $tanggal  = $this->datenowtoview();
    $title    = 'SKB Masuk';
    $tag      = 'skb_masuk';
    $newid    = $this->genid('Skb', 'SKM','type','M');
    return view('skb.skb_masuk', ['newid'=>$newid,'tanggal'=>$tanggal,'title'=>$title,'tag'=>$tag]);
  }

  public function get_skb_keluar(Request $request)
  {
    $r        = $request->all();
    $param    = (!isset($r['search'])) ? '': $r['search'] ;
    $data     = DB::select('select skb.id as id, skb.id as text
    from skb where isactive = \'N\' AND id like \'%'.$param.'%\'
    AND type = \'K\' order by skb.id asc ');
    return response()->json($data);
  }

  public function get_detail_skb_keluar(Request $request)
  {
    $r      = $request->all();
    $data   = DB::table('skb')
    ->select('skb.*','skb_detail.qty','skb_detail.so_id','skb_detail.art_id','skb_detail.name as nama_produk','skb_detail.status_cmt as status', 'cmt.name as nama_cmt', 'proses.name as nama_proses', 'satuan.name as nama_satuan')
    ->join('skb_detail', 'skb.id', '=', 'skb_detail.skb_id')
    ->join('cmt', 'skb_detail.cmt_id', '=', 'cmt.id')
    ->join('satuan', 'skb_detail.satuan_id', '=', 'satuan.id')
    ->join('proses', 'skb.proses_id', '=', 'proses.id')
    ->where('skb.type','K')
    ->where('skb.id',$r['id'])
    ->where('skb.isactive','N')
    ->get();
    return response()->json($data);
  }

  //gsd
  public function get_skb_detail(Request $request)
  {
    $r      = $request->all();
    $data   = DB::table('skb')
    ->select('skb.*', DB::raw("to_char(skb.tanggal,'DD/MM/YY') as tanggal_keluar"),'so.barang_jadi_id','skb_detail.qty','skb_detail.qty_sisa',
    'skb_detail.so_id','skb_detail.art_id','skb_detail.name as nama_produk','skb_detail.status_cmt as status', 'cmt.name as nama_cmt', 
    'proses.name as nama_proses', 'satuan.name as nama_satuan')
    ->leftJoin('skb_detail', 'skb.id', '=', 'skb_detail.skb_id')
    ->leftJoin('cmt', 'skb_detail.cmt_id', '=', 'cmt.id')
    ->leftJoin('satuan', 'skb_detail.satuan_id', '=', 'satuan.id')
    ->leftJoin('proses', 'skb.proses_id', '=', 'proses.id')
    ->leftJoin('so', 'skb_detail.so_id', '=', 'so.id')
    ->where('skb_detail.cmt_id',$r['cmt_id'])
    ->orderBy('skb_detail.art_id','ASC')
    ->where('skb.type','=','K')
    ->where(function($q){
      $q->where('skb_detail.status_cmt','O')
      ->orWhere('skb_detail.status_cmt','P');
    })
    // ->where('skb.isactive','N')
    ->get();
    // dd($data);
    return response()->json($data);
  }

  //s2
  public function skb_masuk_create(Request $request)
  { 
    $r    = $request->all();
    $i    = $this->genindex('Skb','type','M');

    $cmt  = Cmt::select('cmt.*','proses.name as nama_proses')
                ->leftJoin('proses', 'cmt.proses_id', '=', 'proses.id')
                ->where('cmt.id', $r['cmt_id'])
                ->get();

    $r['proses_id']   = $cmt[0]->proses_id;
    $r['proses']      = $cmt[0]->nama_proses;

    $data_create = [
      'id'              => $r['id'],
      'no_surat_jalan'  => $r['no_surat_jalan'],
      'index'           => $i,
      'tanggal'         => $this->datetodb($r['tanggal']),
      'type'            => 'M',
      'proses_id'       => $r['proses_id'],
      'cmt_id'          => $r['cmt_id'],
      'isactive'        => 'A',
    ];

    $p = substr($r['proses'],0,1);
    $p_first = $p;
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

    // Validasi SKB MASUK
    for ($i=0; $i < count(array_filter($r['so_id'])) ; $i++) {
      if($this->ribuantodb($r['qty_masuk'][$i]) < 1){
        return response()->json([
          'status'  => false,
          'message' => 'Qty harus terisi',
        ]);
      }

      $validas_sum_qty_sisa = SkbDetail::where('art_id', $r['art_id'][$i])
      ->where('so_id', $r['so_id'][$i])
      ->where('skb_id', $r['no_skb'][$i])
      ->sum('qty_sisa');

      if($this->ribuantodb($r['qty_masuk'][$i]) > $validas_sum_qty_sisa){
        return response()->json([
          'status'  => false,
          'message' => 'Qty masuk dan sisa tidak sesuai',
        ]);
      }

      if($this->ribuantodb($r['qty_masuk'][$i]) > $this->ribuantodb($r['qty_keluar'][$i])){
        return response()->json([
          'status'  => false,
          'message' => 'Qty masuk tidak boleh lebih besar dari keluar',
        ]);
      }

    }
    // dd(  count(array_filter($r['so_id']))   );
    for ($i=0; $i < count(array_filter($r['so_id'])) ; $i++) {
      $data_art = So::select('so.name','art.id', 'art.qty_in_'.$p. ' as qty_in', 'art.qty_out_'.$p. ' as qty_out', 'art.out_perbaikan_'.$p.' as out_perbaikan', 'art.in_perbaikan_'.$p.' as in_perbaikan', 'art.out_perbaikan_'.$p.' as out_perbaikan', 'art.cacat_bahan_'.$p.' as cacat_bahan', 'art.inv_cmt_'.$p.' as inv_cmt', 'art.sisa_'.$p.' as qty_sisa', 'art.qty_bj', 'art.alur_proses', 
      'art.sisa_printing as qty_sisa_printing', 'art.sisa_embro as qty_sisa_embro', 'art.sisa_sewing as qty_sisa_sewing', 'art.sisa_washing as qty_sisa_washing', 'art.sisa_lain2 as qty_sisa_lain2', 'art.sisa_finishing as qty_sisa_finishing',
      'art.stock_printing as stock_printing', 'art.stock_embro as stock_embro', 'art.stock_sewing as stock_sewing', 'art.stock_washing as stock_washing', 'art.stock_lain2 as stock_lain2', 'art.stock_finishing as stock_finishing')
      ->leftJoin('art','so.produksi_id','=','art.produksi_id')
      ->where('so.id', $r['so_id'][$i])
      ->where('art.art_id', $r['art_id'][$i])
      ->groupBy('art.id','so.name')
      ->get();
      // dd($data_art);

      $label_proses_stock= 'stock_'.$p;
      $qty_stock_awal    = (int)$data_art[0]->$label_proses_stock;
      $qty_sisa          = (int)$data_art[0]->qty_sisa;
      $qty_out_awal      = (int)$data_art[0]->qty_out;
      $qty_in_awal       = (int)$data_art[0]->qty_in;
      $qty_out_perbaikan  = (int)$data_art[0]->out_perbaikan;
      $qty_in_perbaikan  = (int)$data_art[0]->in_perbaikan;
      $qty_cacat_bahan   = (int)$data_art[0]->cacat_bahan;
      $qty_inv_cmt       = (int)$data_art[0]->inv_cmt;

      $qty_out_skb       = (int)$this->ribuantodb($r['qty_keluar'][$i]);
      $qty_in_skb        = (int)$this->ribuantodb($r['qty_masuk'][$i]);

      $validasi          = ($qty_stock_awal < 1 && ($qty_out_awal + $qty_out_perbaikan) - ($qty_in_awal + $qty_in_skb + $qty_cacat_bahan + $qty_in_perbaikan + $qty_inv_cmt) == 0) ? 'C' : 'P'; 
      // dd($validasi,$qty_stock_awal,$qty_out_awal,$qty_in_awal,$qty_sisa);   
      $data_update_art = [
        'qty_in_'.$p             => $qty_in_awal + $qty_in_skb,
        'sisa_'.$p               => $qty_sisa - $qty_in_skb,
        'catatan_'.$p            => $r['ket'][$i],
        'tgl_in_'.$p             => $this->datetodb($r['tanggal']),
        'cmt_id_'.$p             => $data_create['cmt_id'],
        'status_'.$p             => $validasi,
      ];

      $data_find = $data_art[0]->alur_proses; 
      $next = substr($data_find, strpos($data_find, $p_first) + 1,1);    

        if ($next == 'P') {
          $next = 'printing';
        } elseif ($next == 'E') {
          $next = 'embro';   
        } elseif ($next == 'S') {
          $next = 'sewing';
        } elseif ($next == 'W') {
          $next = 'washing';
        } elseif ($next == 'L') {
          $next = 'lain2';
        } elseif ($next == 'F') {
          $next = 'finishing';
        }

      $qty_bj_awal = (int)$data_art[0]->qty_bj;
      $status_name_sisa = 'stock_'.$next;
      $qty_sisa_add = (int)$data_art[0]->$status_name_sisa;
      
      if($validasi == 'C' || $validasi == 'P') {
        if($next != ''){
          $data_update_art['status_'.$next] = 'R';
          $data_update_art['stock_'.$next] =  $qty_sisa_add + $qty_in_skb;
        } else {
          $data_update_art['iscomplete'] = 'C';
          $data_update_art['qty_bj'] =  $qty_bj_awal + $qty_in_skb;
        }
      }

      $art = Art::where('art_id', $r['art_id'][$i])
      ->where('so_id', $r['so_id'][$i])
      ->update($data_update_art);

      $data_detail_art_skb = [
        'skb_id'              => $r['id'],
        'so_id'               => $r['so_id'][$i],
        'art_id'              => $r['art_id'][$i],
        'index'               => $i,
        'name'                => $data_art[0]['name'],
        'qty'                 => $qty_in_skb,
        'satuan_id'           => 'ST003',
        'cmt_id'              => $data_create['cmt_id'],
        'skk_id'              => $r['no_skb'][$i],
        'status_cmt'          => $validasi,
        'ket'                 => $r['ket'][$i],
        'isactive'            => 'A',
      ];

      $art_detail = SkbDetail::create($data_detail_art_skb);

      //Validasi SKB
      $sum_qty_keluar = SkbDetail::where('art_id', $r['art_id'][$i])
      ->where('so_id', $r['so_id'][$i])
      ->where('skb_id', $r['no_skb'][$i])
      ->sum('qty');

      $sum_qty_masuk = SkbDetail::where('art_id', $r['art_id'][$i])
      ->where('so_id', $r['so_id'][$i])
      ->where('skk_id', $r['no_skb'][$i])
      ->sum('qty');

      $sum_qty_sisa = SkbDetail::where('art_id', $r['art_id'][$i])
      ->where('so_id', $r['so_id'][$i])
      ->where('skb_id', $r['no_skb'][$i])
      ->sum('qty_sisa');

      $qty_sisa_skb_keluar = $sum_qty_sisa - $qty_in_skb;
      $validasi_cmt = ($qty_sisa_skb_keluar == 0) ? 'C' : 'P' ;     

      $update_sisa_skb = SkbDetail::where('art_id', $r['art_id'][$i])
      ->where('so_id', $r['so_id'][$i])
      ->where('skb_id', $r['no_skb'][$i])
      ->update([
        'status_cmt' => $validasi_cmt,
        'qty_sisa' => $qty_sisa_skb_keluar,
      ]);

      $update = SkbDetail::where('art_id', $r['art_id'][$i])
      ->where('so_id', $r['so_id'][$i])
      ->where('skk_id', $r['no_skb'][$i])
      ->update([
        'status_cmt' => $validasi_cmt,
      ]);
    }

    // Membuat SKB
    $create = Skb::create($data_create);
    
    // Validasi Jumlah Art total dan Art yang Complete
    $count_art = Art::where('so_id', $r['so_id'][$i])->count();
    $count_art_complete = Art::where('so_id', $r['so_id'][$i])->where('art.iscomplete','=','C')->count();

    if($count_art == $count_art_complete){
       $update = So::where('id', $r['so_id'][$i])->update([
        'iscomplete'   => 'C',
      ]);
    }

    $newid = $this->genid('Skb','SKM','type','M');

    return response()->json([
      'status'  => true,
      'message' => 'SKB Masuk created',
      'newid'   => $newid,
      'total_art' => $count_art,
      'total_art_complete' => $count_art_complete
    ]);
  }

  public function skb_masuk_api()
  {
    $data = SkbDetail::select('skb_detail.*', 'skb_detail.skk_id as skk_id', 'skb.no_surat_jalan as no_surat_jalan', 'skb_detail.status_cmt as status', 'skb_detail.qty as qty', 'cmt.name as nama_cmt', 'proses.name as nama_proses')
    ->leftJoin('skb', 'skb_detail.skb_id', '=', 'skb.id')
    ->leftJoin('cmt', 'skb_detail.cmt_id', '=', 'cmt.id')
    ->leftJoin('proses', 'skb.proses_id', '=', 'proses.id')
    ->where('type','M')
    ->get();

    return DataTables::of($data)
    ->editColumn('status', function($data){
      if ($data->status == 'O') {
        return 'Open';
      } else if ($data->status == 'C') {
        return 'Close';
      } else if ($data->status == 'CP') {
        return 'Close & Stock Terkirim Kegudang';
      } else if ($data->status == 'P') {
        return 'Proses';
      } else {
        return 'Undefined';
      }
    })
    ->editColumn('qty', function($data){
        return number_format($data->qty,0).' PCS';
    })
    ->addColumn('action', function($data){
      $post_to_stock = '';
      if ($data->nama_proses == 'Finishing' && $data->status == 'C') {
        $post_to_stock = '<a href="#" onclick="postToStock(\''.$data->so_id.'\',\''.$data->art_id.'\',\''.$data->qty.'\',\''.$data->skb_id.'\')" class="btn btn-warning btn-xs"><i class="fa fa-send"></i> Post to Stock</a>';
      }
      return '<a href="'.url("/skb_print?param=skb_masuk&skb_id=".$data->skb_id).'" class="btn btn-primary btn-xs" target="_blank"><i class="fa fa-print"></i> Print</a>&nbsp;'.$post_to_stock;
    })
    ->make(true);
  }

  public function send_skb_masukx(Request $request)
  {
    $r           = $request->all();
    $i          = Skb::orderBy('index', 'max')->where('type', 'M')->take(1)->get();

    if (!isset($i[0])) {
      $i  = 1;
    } else {
      $i  = $i[0]->index + 1;
    }

    $add            = Skb::create([
      'id'              => $r['id'],
      'index'           => $i,
      'type'            => 'M',
      'qty'             => $this->ribuantodb($r['qty']),
      'so_id'           => $r['so_id'],
      'cmt_id'          => $r['cmt_id'],
      'status_cmt'      => 'C',
    ]);

    // dd($add);
    $p = $r['proses_now'];
    if ($p == 'c') {
      $p = 'cutting';
      $s = 'cc';
    } elseif ($p == 'p') {
      $p = 'printing';
      $s = 'pc';
    } elseif ($p == 'e') {
      $p = 'embro';
      $s = 'ec';
    } elseif ($p == 's') {
      $p = 'sewing';
      $s = 'sc';
    } elseif ($p == 'w') {
      $p = 'washing';
      $s = 'wc';
    } elseif ($p == 'l') {
      $p = 'lain2';
      $s = 'lc';
    } elseif ($p == 'f') {
      $p = 'finishing';
      $s = 'fc';
    }

    // dd($p);

    for ($i=0; $i < count($r['data_art']) ; $i++) {
      $add = Art::where('art_id', $r['data_art'][$i]['art_id'])
      ->where('so_id', $r['so_id'])->
      update([
        'qty_in_'.$p             => $this->ribuantodb($r['data_art'][$i]['qty']),
        'catatan_'.$p            => $r['data_art'][$i]['ket'],
        'tgl_in_'.$p             => $r['tgl'],
        'proses_now'             => $s,
        'cmt_id_'.$p             => $r['cmt_id'],
        'status_'.$p             => 'C',
      ]);
    }

    $add = Skb::where('so_id', $r['so_id'])->
    update([
      'status_cmt'       => 'C',
    ]);

    $add = So::where('id', $r['so_id'])->
    update([
      'isactive'       => 'A',
    ]);

    if ($add) {
      $status=['1'];
    } else {
      $status=['o'];
    }

    return response()->json($status);
  }

  public function list_so()
  {
    $data = DB::table('so')->get();
    return view('so.list_so', ['data'=>$data]);
  }


  public function skb_print(Request $request)
  {
    $r      = $request->all();

    if ($r['param'] == 'skb_keluar') {
      $title = 'SKB KELUAR';
    } elseif ( $r['param'] == 'skb_masuk') {
      $title = 'SKB MASUK';
    } elseif ( $r['param'] == 'non_skb_NK') {
      $title = 'NON SKB KELUAR';
    } else {
      $title = 'NON SKB MASUK';
    }

    $skb = SkbDetail::select('skb_detail.*', 'skb_detail.skb_id as skk_id', 'skb_detail.status_cmt as status', 'cmt.name as nama_cmt', 'proses.name as nama_proses')
    ->join('skb', 'skb_detail.skb_id', '=', 'skb.id')
    ->join('cmt', 'skb_detail.cmt_id', '=', 'cmt.id')
    ->join('proses', 'skb.proses_id', '=', 'proses.id')
    ->where('skb_id',$r['skb_id'])
    ->get();

    $data_perusahaan = Param::all();
    // dd($data_perusahaan[0]['alamat']);
    $data       = [
      'title'       =>  $title,
      'data'        =>  $skb,
      'alamat'      =>  $data_perusahaan[0]['alamat'],
      'logo'        =>  $data_perusahaan[0]['logo_perusahaan'],
      'tanggal'     =>  $this->datenowtoview(),
      'nama_cmt'    =>  $skb[0]['nama_cmt'],
      'nama_proses' =>  $skb[0]['nama_proses'],
      'skb_id'      =>  $r['skb_id'],
    ];

    $pdf  = PDF::loadView('skb.print.master', $data);
    $pdf->setPaper('a4', 'potrait');
    return $pdf->stream();
  }

  public function post_to_stock(Request $request)
  {
    $r = $request->all();
    // dd($r);
    $so    = So::where('id',$r['so_id'])->get();
    $count = MasterBJ::where('id', $so[0]['barang_jadi_id'] . '-' . $r['art_id'])->count();
    // dd($count);
    if ($count == 0) {
      $index = $this->genindex('MasterBJ');
      $data = [
        'id'      => $so[0]['barang_jadi_id'].'-'.$r['art_id'],
        'index'   => $index,
        'name'    => $so[0]['name'],
        'id_so'   => $r['so_id'],
        'id_art'  => $r['art_id'],
        'stock'   => $r['qty'],
        'isactive'=> 'A',
      ];
      $insert = MasterBJ::create($data);
      $update = SkbDetail::where('art_id', $r['art_id'])
      ->where('so_id', $r['so_id'])
      ->where('skb_id', $r['skb_id'])
      ->update([
        'status_cmt' => 'CP',
      ]);
    } else {
      $stock = MasterBJ::where('id', $so[0]['barang_jadi_id'] . '-' . $r['art_id'])
      ->get();

      $data = [
        'stock'   => (int)$r['qty']+(int)$stock[0]['stock'],
      ];

      $update_stock = MasterBJ::where('id', $so[0]['barang_jadi_id'] . '-' . $r['art_id'])
      ->update($data);

      $update = SkbDetail::where('art_id', $r['art_id'])
      ->where('so_id', $r['so_id'])
      ->where('skb_id', $r['skb_id'])
      ->update([
        'status_cmt' => 'CP',
      ]);

    }
    return response()->json([
      'status'  => true,
      'message' => 'SKB Posted',
    ]);
  }


  public function get_id_skb_adjust(Request $request)
  {
    $newid    = $this->genid('Skb', 'SKN'.$request->type,'type','N'.$request->type);
    return response()->json([
      'id'  => $newid,
      ]);
  }

  public function skb_adjust_index()
  {
    $tanggal  = $this->datenowtoview();
    $title    = 'SKB Adjust';
    $tag      = 'skb_adjust';
    $newid    = $this->genid('Skb', 'SKNK','type','NK');
    return view('skb.skb_adjust', ['newid'=>$newid,'tanggal'=>$tanggal,'title'=>$title,'tag'=>$tag]);
  }

  //s3
  public function skb_adjust_create(Request $request)
  {
    $r  = $request->all();
    $i  = $this->genindex('Skb','type','N'.$r['type']);
    
    $dataSkb = [
      'id'              => $r['id'],
      'index'           => $i,
      'tanggal'         => $this->datetodb($r['tanggal']),
      'type'            => 'N'.$r['type'],
      'proses_id'       => $r['proses_id'],
      'cmt_id'          => $r['cmt_id'],
      'isactive'        => 'N',
    ];

    $p = $r['proses_now'];
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

     // Validasi SKB ADJUST
    for ($i=0; $i < count(array_filter($r['so_id'])) ; $i++) {
      if($this->ribuantodb($r['qty'][$i]) < 1){
        return response()->json([
          'status'  => false,
          'message' => 'Qty harus terisi',
        ]);
      }
      // dd($r);
      $no_skb_keluar =  $r['no_skb_keluar'][$i];
      $no_skb_adjust =  $r['no_skb_adjust'][$i];
      $validasi_sum_qty_sisa = SkbDetail::leftjoin('skb','skb_detail.skb_id','=','skb.id')
      ->where('skb_detail.so_id', $r['so_id'][$i])
      ->where('skb_detail.art_id', $r['art_id'][$i])
      // ->where('skb.type','=', 'K')
      ->when($r['status'][$i] == '1' || $r['status'][$i] == '2' || $r['status'][$i] == '3', function($q)  use($no_skb_keluar){
        return $q->where('skb.type','=', 'K')
                 ->where('skb_detail.skb_id',$no_skb_keluar);
                })
      ->when($r['status'][$i] == '4', function($q) use($no_skb_adjust){
        return $q->where('skb.type','=', 'NK')
                 ->where('skb_detail.skb_id',$no_skb_adjust);
      })
      ->where('skb.proses_id','=', $r['proses_id'])
      ->where('skb_detail.cmt_id', $r['cmt_id'])
      ->sum('skb_detail.qty_sisa');
      // dd($validasi_sum_qty_sisa);

      if($validasi_sum_qty_sisa < 1){
        return response()->json([
          'status'  => false,
          'message' => 'Sisa Tidak Ada atau ada artikel yang tidak sesuai dengan CMT',
        ]);
      }

      if($this->ribuantodb($r['qty'][$i]) > $validasi_sum_qty_sisa){
        return response()->json([
          'status'  => false,
          'message' => 'Qty dan sisa tidak sesuai',
        ]);
      }
    }

    
      for ($i=0; $i < count(array_filter($r['so_id'])) ; $i++) {
      $data_art = So::select('so.name','art.id', 'art.qty_in_'.$p. ' as qty_in', 'art.qty_out_'.$p. ' as qty_out', 'art.out_perbaikan_'.$p.' as out_perbaikan', 'art.in_perbaikan_'.$p.' as in_perbaikan', 'art.cacat_bahan_'.$p.' as cacat_bahan', 'art.inv_cmt_'.$p.' as inv_cmt', 'art.sisa_'.$p.' as qty_sisa', 'art.qty_bj', 'art.alur_proses', 
      'art.sisa_printing as qty_sisa_printing', 'art.sisa_embro as qty_sisa_embro', 'art.sisa_sewing as qty_sisa_sewing', 'art.sisa_washing as qty_sisa_washing', 'art.sisa_lain2 as qty_sisa_lain2', 'art.sisa_finishing as qty_sisa_finishing',
      'art.stock_printing as stock_printing', 'art.stock_embro as stock_embro', 'art.stock_sewing as stock_sewing', 'art.stock_washing as stock_washing', 'art.stock_lain2 as stock_lain2', 'art.stock_finishing as stock_finishing')
      ->leftJoin('art','so.produksi_id','=','art.produksi_id')
      ->where('so.id', $r['so_id'][$i])
      ->where('art.art_id', $r['art_id'][$i])
      ->groupBy('art.id','so.name')
      ->get();

      $label_proses_stock = 'stock_'.$p;
      $qty_stock_awal     = (int)$data_art[0]->$label_proses_stock;
      $qty_sisa           = (int)$data_art[0]->qty_sisa;
      $qty_out_awal       = (int)$data_art[0]->qty_out;
      $qty_in_awal        = (int)$data_art[0]->qty_in;
      $qty_out_perbaikan  = (int)$data_art[0]->out_perbaikan;
      $qty_in_perbaikan   = (int)$data_art[0]->in_perbaikan;
      $qty_cacat_bahan    = (int)$data_art[0]->cacat_bahan;
      $qty_inv_cmt        = (int)$data_art[0]->inv_cmt;
      $qty_in_non_skb     = (int)$this->ribuantodb($r['qty'][$i]);

      $validasi          = ($qty_stock_awal < 1 && $qty_out_awal - ($qty_in_awal + $qty_in_non_skb + $qty_cacat_bahan + $qty_in_perbaikan + $qty_inv_cmt) == 0) ? 'C' : 'P'; 
      if ($r['type'] == 'M') {
      $data_update_art = [
        'status_' . $p => $validasi,
      ];
      
      if ($r['status'][$i] == '1') {
        $data_update_art['cacat_bahan_' . $p] = $this->ribuantodb($r['qty'][$i]);
        $data_update_art['sisa_' . $p] = (int)$qty_sisa - (int)$this->ribuantodb($r['qty'][$i]);
        $ket = 'Cacat Bahan';
      } elseif ($r['status'][$i] == '2') {
        $data_update_art['inv_cmt_' . $p] = $this->ribuantodb($r['qty'][$i]);
        $data_update_art['sisa_' . $p] = (int)$qty_sisa - (int)$this->ribuantodb($r['qty'][$i]);
        $ket = 'INV. CMT';
      } else {
        $data_update_art['in_perbaikan_' . $p] = $this->ribuantodb($r['qty'][$i]);
        $ket = 'Masuk Perbaikan';
      }
      
      $data_find  = $data_art[0]->alur_proses; 
      $next       = substr($data_find, strpos($data_find, $r['proses_now']) + 1,1);    

        if ($next == 'P') {
          $next = 'printing';
        } elseif ($next == 'E') {
          $next = 'embro';   
        } elseif ($next == 'S') {
          $next = 'sewing';
        } elseif ($next == 'W') {
          $next = 'washing';
        } elseif ($next == 'L') {
          $next = 'lain2';
        } elseif ($next == 'F') {
          $next = 'finishing';
        }

      $qty_bj_awal = (int)$data_art[0]->qty_bj;
      $status_name_sisa = 'stock_'.$next;
      $qty_sisa_add = (int)$data_art[0]->$status_name_sisa;
      
      if($validasi == 'C' || $validasi == 'P') {
        if($next != ''){
          if($r['status'][$i] == '4'){
            $data_update_art['status_'.$next] = 'R';
            $data_update_art['stock_'.$next] =  $qty_sisa_add + $qty_in_non_skb;
          }
        } else {
          $data_update_art['iscomplete'] = 'C';
          if($r['status'][$i] == '4'){
            $data_update_art['qty_bj'] =  $qty_bj_awal + $qty_in_non_skb;
          }
        }
      }

      $art = Art::where('art_id', $r['art_id'][$i])
        ->where('so_id', $r['so_id'][$i])
        ->update($data_update_art);

      $data_detail_art_skb = [
        'skb_id' => $r['id'],
        'so_id' => $r['so_id'][$i],
        'art_id' => $r['art_id'][$i],
        'index' => $i,
        'name' => $r['nama'][$i],
        'qty' => $this->ribuantodb($r['qty'][$i]),
        'satuan_id' => $r['satuan_id'][$i],
        'cmt_id' => $r['cmt_id'],
        'status_cmt' => $validasi,
        'ket' => $ket,
        'isactive' => 'A',
      ];
      
      $art_detail = SkbDetail::create($data_detail_art_skb);

      //Validasi SKB
      $sum_qty_keluar_all = SkbDetail::leftJoin('skb','skb.id','=','skb_detail.skb_id')
      ->where('skb_detail.art_id', $r['art_id'][$i])
      ->where('skb_detail.so_id', $r['so_id'][$i])
      ->where('skb_detail.cmt_id', $r['cmt_id'])
      ->where('skb.proses_id', $r['proses_id'])
      ->where(function($q){
        return $q->where('skb.type','=','NK')
        ->orWhere('skb.type','=','K');
      })
      ->sum('skb_detail.qty');
      
      $sum_qty_masuk_all = SkbDetail::leftJoin('skb','skb.id','=','skb_detail.skb_id')
      ->where('skb_detail.art_id', $r['art_id'][$i])
      ->where('skb_detail.so_id', $r['so_id'][$i])
      ->where('skb_detail.cmt_id', $r['cmt_id'])
      ->where('skb.proses_id', $r['proses_id'])
      ->where(function($q){
        return $q->where('skb.type','=','NM')
        ->orWhere('skb.type','=','M');
      })
      ->sum('skb_detail.qty');
      
      $qty_sisa_skb_all = $sum_qty_keluar_all - ($sum_qty_masuk_all + (int)$this->ribuantodb($r['qty'][$i]));
      $validasi_cmt_all = ($qty_sisa_skb_all == 0) ? 'C' : 'P' ;
      // dd($sum_qty_masuk_all);
      // dd($sum_qty_keluar_all);
      // dd($validasi_cmt_all);
      
      if($r['status'][$i] != '4'){
        $update_sisa_skb = SkbDetail::where('art_id', $r['art_id'][$i])
        ->where('so_id', $r['so_id'][$i])
        ->where('skb_id', $r['no_skb_keluar'][$i])
        ->where('cmt_id', $r['cmt_id'])
        ->update([
          'status_cmt' => $validasi_cmt_all,
          'qty_sisa' => $qty_sisa_skb_all,
        ]);
          
        $update = SkbDetail::where('art_id', $r['art_id'][$i])
        ->where('so_id', $r['so_id'][$i])
        ->where('skk_id', $r['no_skb_keluar'][$i])
        ->update([
        'status_cmt' => $validasi_cmt_all,
        ]);

      } else {
        $sum_qty_keluar_nk = SkbDetail::leftJoin('skb','skb.id','=','skb_detail.skb_id')
        ->where('skb_detail.art_id', $r['art_id'][$i])
        ->where('skb_detail.so_id', $r['so_id'][$i])
        ->where('skb_detail.cmt_id', $r['cmt_id'])
        ->where('skb.proses_id', $r['proses_id'])
        ->where(function($q){
          return $q->where('skb.type','=','NK');
        })
        ->sum('skb_detail.qty');

        $sum_qty_masuk_nk = SkbDetail::leftJoin('skb','skb.id','=','skb_detail.skb_id')
        ->where('skb_detail.art_id', $r['art_id'][$i])
        ->where('skb_detail.so_id', $r['so_id'][$i])
        ->where('skb_detail.cmt_id', $r['cmt_id'])
        ->where('skb.proses_id', $r['proses_id'])
        ->where(function($q){
          return $q->where('skb.type','=','NM');
        })
        ->sum('skb_detail.qty');

        $qty_sisa_skb_nk = $sum_qty_keluar_nk - ($sum_qty_masuk_nk + (int)$this->ribuantodb($r['qty'][$i]));
        $validasi_cmt_nk = ($qty_sisa_skb_nk == 0) ? 'C' : 'P' ;

        $update_sisa_nk = SkbDetail::where('art_id', $r['art_id'][$i])
        ->where('so_id', $r['so_id'][$i])
        ->where('cmt_id', $r['cmt_id'])
        ->where('skb_id', $r['no_skb_adjust'][$i])
        ->update([
          'status_cmt' => $validasi_cmt_nk,
          'qty_sisa' => $qty_sisa_skb_nk,
        ]);

        // $sum_qty_keluar_skb = SkbDetail::
        // where('skb_detail.art_id', $r['art_id'][$i])
        // ->where('skb_detail.so_id', $r['so_id'][$i])
        // ->where('skb_detail.cmt_id', $r['cmt_id'])
        // ->where('skb_detail.skb_id', $r['no_skb_keluar'][$i])
        // ->sum('skb_detail.qty_sisa');

        $update_sisa_nk2 = SkbDetail::where('art_id', $r['art_id'][$i])
        ->where('so_id', $r['so_id'][$i])
        ->where('cmt_id', $r['cmt_id'])
        ->where('skb_id', $r['no_skb_keluar'][$i])
        ->update([
          'status_cmt' => $validasi_cmt_all,
          // 'qty_sisa' => $sum_qty_keluar_skb - (int)$this->ribuantodb($r['qty'][$i]),
        ]);

        $update = SkbDetail::where('art_id', $r['art_id'][$i])
        ->where('so_id', $r['so_id'][$i])
        ->where('skk_id', $r['no_skb_keluar'][$i])
        ->update([
          'status_cmt' => $validasi_cmt_all,
        ]);

      }
     } else {
        $data_update_art = [
          'out_perbaikan_' . $p => $this->ribuantodb($r['qty'][$i]),
          'sisa_' . $p          => $qty_sisa - $this->ribuantodb($r['qty'][$i]),
        ];

        $ket = 'Keluar Perbaikan';
        $r['status'][$i] = 'OP';

        $data_detail_art = [
          'skb_id'              => $r['id'],
          'so_id'               => $r['so_id'][$i],
          'art_id'              => $r['art_id'][$i],
          'index'               => $i,
          'name'                => $r['nama'][$i],
          'qty'                 => $this->ribuantodb($r['qty'][$i]),
          'satuan_id'           => $r['satuan_id'][$i],
          'cmt_id'              => $r['cmt_id'],
          'status_cmt'          => $r['status'][$i],
          'ket'                 => $ket,
          'isactive'            => 'A',
          'qty_sisa'            => $this->ribuantodb($r['qty'][$i]),
        ];

        $art_detail_skb = SkbDetail::create($data_detail_art);
        $art            = Art::where('art_id', $r['art_id'][$i])
                          ->where('so_id', $r['so_id'][$i])
                          ->update($data_update_art);

        //Validasi SKB
        $sum_qty_sisa_skb_keluar = SkbDetail::where('art_id', $r['art_id'][$i])
        ->where('so_id', $r['so_id'][$i])
        ->where('skb_id', $r['no_skb_keluar'][$i])
        ->sum('qty_sisa');

        $update_sisa_skb = SkbDetail::where('art_id', $r['art_id'][$i])
        ->where('so_id', $r['so_id'][$i])
        ->where('skb_id', $r['no_skb_keluar'][$i])
        ->update([
          'qty_sisa'  => $sum_qty_sisa_skb_keluar - $this->ribuantodb($r['qty'][$i]),
        ]);

     }
    }

   
    $create = Skb::create($dataSkb);
    $newid = $this->genid('Skb', 'SKN'.$r['type'],'type','N'.$r['type']);

    return response()->json([
      'status'  => true,
      'message' => 'SKB Adjust created',
      'newid'   => $newid
    ]);

}

  public function skb_adjust_api()
  {
    $data = SkbDetail::select('skb_detail.*', 'skb_detail.skb_id as skk_id', 'skb_detail.status_cmt as status', 'cmt.name as nama_cmt', 'proses.name as nama_proses','skb.type as type')
    ->leftJoin('skb', 'skb_detail.skb_id', '=', 'skb.id')
    ->leftJoin('cmt', 'skb_detail.cmt_id', '=', 'cmt.id')
    ->leftJoin('proses', 'skb.proses_id', '=', 'proses.id')
    ->where('skb.type','<>','M')
    ->where('skb.type','<>','K')
    ->get();

    return DataTables::of($data)
    ->editColumn('status', function($data){
      return $data->ket;
    })
    ->editColumn('qty', function($data){
      return number_format($data->qty,0).' PCS';
    })
    ->addColumn('action', function($data){
      $post_to_stock = '';
      if ($data->nama_proses == 'Finishing' && $data->status == 'C') {
        $post_to_stock = '<a href="#" onclick="postToStock(\''.$data->so_id.'\',\''.$data->art_id.'\',\''.$data->qty.'\')" class="btn btn-warning btn-xs"><i class="fa fa-send"></i> Post to Stock</a>';
      }
      return '<a href="'.url("/skb_print?param=non_skb_$data->type&skb_id=".$data->skb_id).'" class="btn btn-primary btn-xs" target="_blank"><i class="fa fa-print"></i> Print</a>&nbsp;'.$post_to_stock;
    })
    ->make(true);
  }

}

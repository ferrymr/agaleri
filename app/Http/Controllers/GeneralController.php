<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use App\BahanBaku;
use App\Warna;
use App\Role;
use App\Brand; 
use App\BarangJadi;
use App\Supplier;
use App\Costumer;
use App\Cmt;
use App\EKategori;
use App\Size;
use App\Produk;
use App\Acc;
use App\Proses;
use App\Bank;
use App\So;
use App\Art;
use App\Skb;
use App\Satuan;
use App\MasterBB;
use App\MasterBJ;
use App\MasterAcc;
use App\PermintaanBB;
use App\PemakaianBB;
use App\KeluarBB;
use App\PermintaanAcc;
use App\KeluarAcc;
use App\Akun;
use App\Hutang;
use App\CatatanProduksi;

class GeneralController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function get_produksi(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '' : $r['search'] ;
    $jenis  = (!isset($r['jenis'])) ? '' : $r['jenis'] ;
    $kategori  = (!isset($r['kategori'])) ? '' : $r['kategori'] ;
    if($jenis == 'keluar_ok'){
      if ($kategori == 'bb') {
        $data   = So::select('so.id AS id', DB::raw('CONCAT(so.produksi_id,\' - \', so.name) AS text'))
        ->leftjoin('permintaan_bb','permintaan_bb.id_so','=','so.id')
        ->leftjoin('keluar_bb_detail','keluar_bb_detail.id_permintaan','=','permintaan_bb.id')
        ->where('keluar_bb_detail.isactive','A')
        ->where('ispost','P')
        ->where('produksi_id','ilike','%'.$param.'%')
        ->groupby('so.id')
        ->get();
      } 
      if ($kategori == 'acc') {
        $data   = So::select('so.id AS id', DB::raw('CONCAT(so.produksi_id,\' - \', so.name) AS text'))
        ->leftjoin('permintaan_acc','permintaan_acc.id_so','=','so.id')
        ->leftjoin('keluar_acc_detail','keluar_acc_detail.id_permintaan','=','permintaan_acc.id')
        ->where('keluar_acc_detail.isactive','A')
        ->whereNull('pemakaian_acc_post')
        ->where('produksi_id','ilike','%'.$param.'%')
        ->groupby('so.id')
        ->get();
      } 
    } elseif ($jenis == 'pemakaian_ok') {
      $data   = So::select('so.id AS id', DB::raw('CONCAT(so.produksi_id,\' - \', name) AS text'))
      ->join('pemakaian_bb', 'so.id', '=', 'pemakaian_bb.id_so')
      ->where('so.isactive','A')
      ->where('so.produksi_id','ilike','%'.$param.'%')
      ->get();
      // if ($kategori == 'bb') {
      // } 
      // if ($kategori == 'acc') {
      // }       
    } elseif ($jenis == 'retur_ok') {
      if ($kategori == 'acc'){
      $data   = So::select('so.id AS id', DB::raw('CONCAT(so.produksi_id,\' - \', name) AS text'))
      ->join('pemakaian_acc', 'so.id', '=', 'pemakaian_acc.id_so')
      ->where('pemakaian_acc.status_retur','Y')
      ->where('so.produksi_id','ilike','%'.$param.'%')
      ->get();
      } else {
      $data   = So::select('so.id AS id', DB::raw('CONCAT(so.produksi_id,\' - \', name) AS text'))
      ->join('pemakaian_bb', 'so.id', '=', 'pemakaian_bb.id_so')
      ->where('pemakaian_bb.status_retur','Y')
      ->where('so.produksi_id','ilike','%'.$param.'%')
      ->get();
      }
      
    } elseif ($jenis == 'proses_ok') {
      if ($kategori == 'bb') {
        $data   = So::select('id AS id', DB::raw('CONCAT(produksi_id,\' - \', name) AS text'))
        ->whereNull('permintaan_bb_post')
        ->where('ispost','P')
        ->where('produksi_id','ilike','%'.$param.'%')
        ->get();
      } elseif ($kategori == 'acc') {
        $data   = So::select('id AS id', DB::raw('CONCAT(produksi_id,\' - \', name) AS text'))
        ->whereNull('permintaan_acc_post')
        ->where('permintaan_bb_post','Y')
        ->where('produksi_id','ilike','%'.$param.'%')
        ->get();
        // dd($data);
      }
      // $data   = So::select('id AS id', DB::raw('CONCAT(produksi_id,\' - \', name) AS text'))
      // ->where('ispost','P')
      // ->where('produksi_id','ilike','%'.$param.'%')
      // ->get();
    } else {
      $data   = So::select('id AS id', DB::raw('CONCAT(produksi_id,\' - \', name) AS text'))
      ->where('isactive','A')
      ->where('produksi_id','ilike','%'.$param.'%')
      ->get();
    }
    return response()->json($data);
  }
  // Select 2 SKB Keluar
  public function get_so(Request $request)
  {
    $r      = $request->all();
    // dd($r);
    $param  = (!isset($r['search'])) ? '': $r['search'] ;
    $so     = DB::select('select so.id as id, so.id as text, so.name as nama_produk from so where iscomplete is NULL AND (ispost = \'Y\' OR ispost = \'P\' )AND id like \'%'.$param.'%\'  ');
    return response()->json($so);
  }

  // Select 2 History by SO
  public function get_so_id_history(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '': $r['search'] ;
    $so     = DB::select('select so.id as id, so.id as text, so.name as nama_produk from so 
    where (ispost = \'Y\' OR ispost = \'P\' )AND id like \'%'.$param.'%\'  ');
    return response()->json($so);
  }

  public function get_art_id_history(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '': $r['search'] ;
    $data = DB::table('art')
    ->where('so_id', $r['so_id'])
    ->join('so', 'art.so_id', '=', 'so.id')
    ->select('art.art_id as id','art.art_id as text','art.art_id as nama_produk')
    ->orderBy('art.art_id','asc')
    ->get();
    return response()->json($data);
  }

  public function get_so_fob(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '': $r['search'] ;
    $so     = DB::select('select so.id as id, so.id as text, so.name as nama_produk from so where isactive = \'N\' AND id like \'%'.$param.'%\' AND status = \'F\'  ');
    return response()->json($so);
  }

  public function get_so_fob_detail(Request $request)
  {
    $r      = $request->all();
    $id     = $r['id'];
    $param  = (!isset($r['search'])) ? '': $r['search'] ;
    $so     = Art::select('art.*','so.*')
    ->leftJoin('so','so.id','=','art.so_id')
    ->where('art.so_id',$id)
    ->where('so.status','=','F')
    ->get();
    return response()->json($so);
  }

  public function get_detail_so(Request $request)
  {
    $r      = $request->all();
    $id     = $r['id'];
    $so     = CatatanProduksi::select('catatan_produksi.*','so.*','bahan_baku.name as nama_bahan_baku','warna.name as nama_warna','catatan_produksi.warna_a as id_warna')
    ->leftJoin('so','so.produksi_id','=','catatan_produksi.produksi_id')
    ->leftJoin('bahan_baku','so.bb_id','=','bahan_baku.id')
    ->leftJoin('warna','catatan_produksi.warna_a','=','warna.id')
    ->where('so.id',$id)
    ->get();
    $so2     = CatatanProduksi::select('catatan_produksi.*','so.*','bahan_baku.name as nama_bahan_baku','warna.name as nama_warna','catatan_produksi.warna_b as id_warna')
    ->leftJoin('so','so.produksi_id','=','catatan_produksi.produksi_id')
    ->leftJoin('bahan_baku','so.bb_id','=','bahan_baku.id')
    ->leftJoin('warna','catatan_produksi.warna_b','=','warna.id')
    ->where('so.id',$id)
    ->whereNotNull('catatan_produksi.warna_b')
    ->get();
    if(isset($so2)){
      for($i=0;$i<count($so2);$i++){
        $so->push($so2[$i]);
      }
    }
    // dd($so);
    return response()->json($so);
  }


  public function get_retur(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '': $r['search'] ;
    if($r['jenis']=='retur_bb'){
      $data     = DB::select('select retur_bb.id as id, retur_bb.id as text from retur_bb 
      where isactive = \'N\' AND retur_bb.id like \'%'.$param.'%\'  ');
    } elseif ($r['jenis']=='retur_acc'){
      $data     = DB::select('select retur_acc.id as id, retur_acc.id as text from retur_acc 
      where isactive = \'N\' AND retur_acc.id like \'%'.$param.'%\'  ');
      // $data     = DB::select('select so.id as id, so.id as text, so.name as nama_produk from so where isactive is NULL AND (ispost = \'Y\' OR ispost = \'P\' )AND id like \'%'.$param.'%\'  ');
    }
    return response()->json($data);
  }

  public function get_faktur_hutang(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '': $r['search'] ;
    $id_supplier = (!isset($r['id_supplier'])) ? '' : $r['id_supplier'] ;
    $id_cmt = (!isset($r['id_cmt'])) ? '' : $r['id_cmt'] ;
    if($r['kategori'] == 'S'){
      $data   = Hutang::select('hutang.id AS id', DB::raw("CONCAT(hutang.id,' - ',hutang.no_faktur) AS text"))
        ->where('id_supplier', '=', $id_supplier)
        ->where('status', '<>', '2')
        ->where('id', 'ilike', '%'.$param.'%')
        ->orderBy('id')
        ->limit(20)
        ->get();
    }
    if($r['kategori'] == 'C'){
      $data   = Hutang::select('hutang.id AS id', DB::raw("CONCAT(hutang.id,' - ',hutang.no_skb) AS text"))
        ->where('id_cmt', '=', $id_cmt)
        ->where('status', '<>', '2')
        ->where('id', 'ilike', '%'.$param.'%')
        ->orderBy('id')
        ->limit(20)
        ->get();
    }
    return response()->json($data);
  }

  public function get_skb_hutang(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '': $r['search'] ;
    $id_supplier = (!isset($r['id_supplier'])) ? '' : $r['id_supplier'] ;
    $id_cmt = (!isset($r['id_cmt'])) ? '' : $r['id_cmt'] ;
    // if($r['kategori'] == 'S'){
    //   $data   = Hutang::select('hutang.no_faktur AS id', 'hutang.no_faktur AS text')
    //     ->where('id_supplier', '=', $id_supplier)
    //     ->where('status', '<>', '2')
    //     ->where('no_faktur', 'ilike', '%'.$param.'%')
    //     ->orderBy('id')
    //     ->limit(20)
    //     ->get();
    // }
    if($r['kategori'] == 'C'){
      $data   = Skb::select('skb.id AS id', 'skb.id AS text')
        ->where('id_cmt', '=', $id_cmt)
        ->where('status', '<>', '2')
        ->where('no_faktur', 'ilike', '%'.$param.'%')
        ->orderBy('id')
        ->limit(20)
        ->get();
    }
    return response()->json($data);
  }

  public function get_data_hutang(Request $request)
  {
    $r      = $request->all();
    $id     = (!isset($r['id'])) ? '': $r['id'] ;
    $data   = Hutang::select('hutang.*')
      ->where('id', '=', $id)
      ->get();
    return response()->json($data);
  }

  public function get_so_nama(Request $request)
  {
    $r      = $request->all();
    $name   = So::findOrFail($r['id']);
    // dd($name['name']);
    return response()->json($name['name']);
  }

  public function get_so_masuk(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '': $r['search'] ;
    $so     = DB::select('select so.id as id, so.id as text, so.name as nama_produk
    from so join skb on skb.so_id = so.id where so.isactive = \'N\' AND so.ispost = \'Y\' AND skb.status_cmt = \'O\' AND so.id like \'%'.$param.'%\'  ');
    return response()->json($so);
  }

  public function get_proses(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '': $r['search'] ;
    // dd($r);
    if (isset($r['modul']) == 'skb_keluar') {
      $so     = DB::select('select proses.id as id, proses.name as text from proses where proses.isactive = \'A\' AND proses.name like \'%'.$param.'%\' AND proses.id <> \'PR001\' AND proses.id <> \'PR002\' ');
    } else {
      $so     = DB::select('select proses.id as id, proses.name as text from proses where proses.isactive = \'A\' AND proses.name like \'%'.$param.'%\' ');
    }
    return response()->json($so);
  }

  public function get_akun(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '' : $r['search'] ;
    $category = (!isset($r['category'])) ? '' : $r['category'] ;
    $level = (!isset($r['level'])) ? '' : $r['level'] ;
    $type = (!isset($r['type'])) ? '' : $r['type'] ;
    $k31 = (!isset($r['k31'])) ? '' : $r['k31'] ;
    $k32 = (!isset($r['k32'])) ? '' : $r['k32'] ;
    // dd($r);
    if ($category == 'all') {
      $data   = Akun::select('akun.id AS id', 'akun.name AS text')
      ->leftJoin('category','akun.id_kategori','=','category.id')
      ->where('akun.isactive','A')
      ->where('akun.name','ilike','%'.$param.'%')
      ->where('akun.level','=','4')
      ->orderBy('akun.id')
      ->limit(20)
      ->get();
    } elseif ($category == 'k3') {
      $data   = Akun::select('akun.id AS id', 'akun.name AS text')
      ->leftJoin('category','akun.id_kategori','=','category.id')
      ->where('akun.isactive','A')
      ->where('akun.name','ilike','%'.$param.'%')
      ->where(function($p)use ($k31,$k32){
        $p->where('akun.k3','=', $k31)
        ->orWhere('akun.k3','=', $k32);
      })
      ->orderBy('akun.id')
      ->limit(20)
      ->get();
      // dd(0);
    } else { 
      $data   = Akun::select('akun.id AS id', 'akun.name AS text')
      ->leftJoin('category','akun.id_kategori','=','category.id')
      ->where('category.type',$category)
      ->where('akun.isactive','A')
      ->where('akun.name','ilike','%'.$param.'%')
      ->where('akun.level','=','4')
      ->orderBy('akun.id')
      ->limit(20)
      ->get();
    }
    // dd($data);
    return response()->json($data);
  }

  public function get_cmt(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '': $r['search'] ;
    $proses = (!isset($r['proses'])) ? 'no_proses': strtolower($r['proses']) ;
    // dd($proses);
    if($proses == 'no_proses'){
      $data     = DB::select('select cmt.id as id, cmt.name as text from cmt join proses on cmt.proses_id = proses.id where cmt.isactive = \'A\' AND cmt.name ilike \'%'.$param.'%\'  ');
    } else {
      $data     = DB::select('select cmt.id as id, cmt.name as text from cmt join proses on cmt.proses_id = proses.id where cmt.isactive = \'A\' AND cmt.name ilike \'%'.$param.'%\' AND LOWER(proses.name) like \'%'.$proses.'%\'  ');
    }
    return response()->json($data);
  }

  // Get Art for Select2
  public function get_art(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '' : $r['search'];
    $id     = (!isset($r['id'])) ? '' : $r['id'];
    $proses = (!isset($r['proses'])) ? '' : $r['proses'];
    $adjust = (!isset($r['adjust'])) ? '' : $r['adjust'];
    $p      = $proses;

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

    $proses_acc = 'proses_'.$p;

    if ($proses != 'proses_now') {
      if ($adjust == 'y') {
        // dd($p);
        $data   = Art::select('art.art_id AS id', 'art.art_id AS text' )
        ->where('art.art_id','like','%'.$param.'%')
        ->where('art.so_id','like','%'.$id.'%')
        ->where('art.alur_proses','ilike','%'.$proses.'%')
        ->where('art.status_'.$p,'=','P')
        ->get();
      } else {
        $data   = Art::select('art.art_id AS id', 'art.art_id AS text' )
        ->join('so','art.so_id','=','so.id')
        ->where('art_id','like','%'.$param.'%')
        ->where('so.id','like','%'.$id.'%')
        ->where('art.ispost','=','Y')
        ->where('art.alur_proses','ilike','%'.$proses.'%')
        ->orderBy('art.index','ASC')
        ->where(function($q) use($p){
          $q->where('art.status_'.$p,'=','R');
          return $q->orWhere('art.status_'.$p,'=','P');
        })
        // ->when($proses == 'E', function($q){
        //   $q->where('art.status_embro','=','R');
        //   return $q->orWhere('art.status_embro','!=','C');
        //   // return $q->whereNull('art.status_embro');
        //   // $q->whereNull('art.status_embro');
        //   // $q->orWhere('art.status_embro','!=','O');
        //   // return $q->orWhere('art.status_embro','!=','C');
        // })
        // ->when($proses == 'S', function($q){
        //   return $q->whereNull('art.status_sewing');
        //   // $q->whereNull('art.status_sewing');
        //   // $q->orWhere('art.status_sewing','!=','O');
        //   // return $q->orWhere('art.status_sewing','!=','C');
        // })
        // ->when($proses == 'W', function($q){
        //   return $q->whereNull('art.status_washing');
        //   // $q->whereNull('art.status_washing');
        //   // $q->orWhere('art.status_washing','!=','O');
        //   // return $q->orWhere('art.status_washing','!=','C');
        // })
        // ->when($proses == 'L', function($q){
        //   return $q->whereNull('art.status_lain2');
        //   // $q->whereNull('art.status_lain2');
        //   // $q->orWhere('art.status_lain2','!=','O');
        //   // return $q->orWhere('art.status_lain2','!=','C');
        // })
        // ->when($proses == 'F', function($q){
        //   return $q->whereNull('art.status_finishing');
        //   // $q->whereNull('art.status_finishing');
        //   // $q->orWhere('art.status_finishing','!=','O');
        //   // return $q->orWhere('art.status_finishing','!=','C');
        // })
        ->get();
        // dd($data);
      }
    } else {
      $data = DB::select('select art.*, so.name as nama_produk from art join so on art.so_id = so.id where art.so_id = \''.$param.'\'  ');
    }
    return response()->json($data);
  }
  
  // Get Art for Penyerian
  public function get_art_penyerian(Request $request)
  {
    $r    = $request->all();
    $data = DB::table('art')
    ->where('so_id', $r['id'])
    ->join('so', 'art.so_id', '=', 'so.id')
    ->select('art.*', 'so.name as nama_produk')
    ->orderBy('index','asc')
    ->get();
    $data_total = DB::table('so')
    ->where('id', $r['id'])
    ->sum('qty');
    $data_total_cutting = PemakaianBB::leftjoin('so', 'pemakaian_bb.id_so', '=', 'so.id')
    ->leftjoin('pemakaian_bb_detail', 'pemakaian_bb.id', '=', 'pemakaian_bb_detail.no_bukti_pemakaian')
    ->where('pemakaian_bb.id_so', $r['id'])
    ->sum('hasil_cutt');
    $data_total_pakai_cutting = Art::where('so_id', $r['id'])
    ->where('ispost','=','Y')
    ->sum('qty');
    $produksi_id = $data[0]->produksi_id;
    $data_detail = DB::table('catatan_produksi')
    ->select('catatan_produksi.*', 'a.name as warna_a', 'b.name as warna_b')
    // ->select('catatan_produksi.*', 'warna.name as warna_a')
    ->where('catatan_produksi.produksi_id', $produksi_id)
    ->leftJoin('warna as a', 'catatan_produksi.warna_a', '=', 'a.id')
    ->leftJoin('warna as b', 'catatan_produksi.warna_b', '=', 'b.id')
    ->orderBy('index','asc')
    ->get();
    echo json_encode(array(
    "data"=>$data,
    "data_detail"=>$data_detail,
    "total_art"=>$data_total,
    "total_cutting"=>$data_total_cutting,
    "total_pakai_cutting"=>$data_total_pakai_cutting,
    "total_sisa"=>$data_total_cutting-$data_total_pakai_cutting
    )
  );
  }


  public function get_master_bb(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '' : $r['search'] ;
    $data   = MasterBB::select('id AS id', 'name AS text')
    ->where('isactive','A')
    ->where('name','ilike','%'.$param.'%')
    ->get();
    return response()->json($data);
  }

  public function get_master_bj(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '' : $r['search'] ;
    $data   = MasterBJ::select('master_bj.id AS id', DB::raw('CONCAT(master_bj.id,\' | \', master_bj.name,\' | \', supplier.name) AS text'))
    ->leftJoin('supplier','master_bj.id_supplier','=','supplier.id')
    ->where('master_bj.isactive','A')
    ->where('master_bj.name','ilike','%'.$param.'%')
    ->whereOr('master_bj.id','ilike','%'.$param.'%')
    ->get();
    return response()->json($data);
  }

  public function get_detail_master_bj(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '' : $r['search'] ;
    $data   = MasterBJ::select('master_bj.id AS id', DB::raw('CONCAT(master_bj.name,\' \', supplier.name) AS text'),'master_bj.harga_default')
    ->leftJoin('supplier','master_bj.id_supplier','=','supplier.id')
    ->where('master_bj.isactive','A')
    ->where('master_bj.id',$r['id'])
    ->where('master_bj.name','ilike','%'.$param.'%')
    ->whereOr('master_bj.id','ilike','%'.$param.'%')
    ->get();
    return response()->json($data);
  }

  public function get_bb(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '' : $r['search'] ;
    $data   = BahanBaku::select('id AS id', 'name AS text')
    ->where('isactive','A')
    ->where('name','ilike','%'.$param.'%')
    ->orderBy('id', 'ASC')
    ->get();
    return response()->json($data);
  }

  public function get_permintaan_bb(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '' : $r['search'] ;
    $data   = PermintaanBB::select('id AS id', 'id AS text')
    ->where('isactive','A') 
    ->where('id','ilike','%'.$param.'%')
    ->orderBy('id', 'ASC')
    ->get();
    return response()->json($data);
  }

  public function get_keluar_bb(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '' : $r['search'] ;
    $data   = KeluarBB::select('id AS id', 'id AS text')
    ->leftjoin('so','so.id','=','permintaan_bb_detail.id_so')
    ->leftjoin('permintaan_bb','permintaan_bb.id','=','keluar_bb_detail.id_permintaan')
    ->where('isactive','A')
    ->where('id','ilike','%'.$param.'%')
    ->orderBy('id', 'ASC')
    ->get();
    return response()->json($data);
  }

  public function get_permintaan_acc(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '' : $r['search'] ;
    $data   = PermintaanAcc::select('id AS id', 'id AS text')
    ->where('isactive','A')
    ->where('id','ilike','%'.$param.'%')
    ->orderBy('id', 'ASC')
    ->get();
    return response()->json($data);
  }

  public function get_acc(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '' : $r['search'] ;
    $data   = Acc::select('id AS id', 'name AS text')
    ->where('isactive','A')
    ->where('name','ilike','%'.$param.'%')
    ->orderBy('id', 'ASC')
    ->get();
    return response()->json($data);
  }

  public function get_bj(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '' : $r['search'] ;
    $data   = BarangJadi::select('id AS id', 'name AS text')
    ->where('isactive','A')
    ->where('name','ilike','%'.$param.'%')
    ->orderBy('id','ASC')
    ->get();
    return response()->json($data);
  }

  public function get_warna(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '' : $r['search'] ;
    $data   = Warna::select('id AS id', 'name AS text')
    ->where('isactive','A')
    ->where('name','ilike','%'.$param.'%')
    ->orderBy('id', 'ASC')
    ->get();
    return response()->json($data);
  }

  public function get_role(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '' : $r['search'] ;
    $data   = Role::select('id AS id', 'role_name AS text')
    ->where('role_name','ilike','%'.$param.'%')
    ->orderBy('id','asc')
    ->get();
    return response()->json($data);
  }

  public function get_e_kategori(Request $request)
  {
    $r      = $request->all();
    // dd($r);
    $param  = (!isset($r['search'])) ? '' : $r['search'] ;
    $data   = EKategori::select('id AS id', 'name AS text')
    ->where('isactive','A')
    ->where('name','ilike','%'.$param.'%')
    ->orderBy('id', 'ASC')
    ->get();
    return response()->json($data);
  }

  public function get_e_produk(Request $request)
  {
    $r      = $request->all();
    // dd($r);
    $param  = (!isset($r['search'])) ? '' : $r['search'] ;
    $data   = Produk::select('id AS id', 'name AS text')
    ->where('isactive','A')
    ->where('name','ilike','%'.$param.'%')
    ->orderBy('id', 'ASC')
    ->get();
    return response()->json($data);
  }

  public function get_size(Request $request)
  {
    $r      = $request->all();
    // dd($r);
    $param  = (!isset($r['search'])) ? '' : $r['search'] ;
    $data   = Size::select('id AS id', 'name AS text')
    ->where('isactive','A')
    ->where('name','ilike','%'.$param.'%')
    ->orderBy('id', 'ASC')
    ->get();
    return response()->json($data);
  }

  public function get_supplier(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '' : $r['search'] ;
    $data   = Supplier::select('id AS id', 'name AS text')
    ->where('isactive','A')
    ->where('name','ilike','%'.$param.'%')
    ->orderBy('id', 'ASC')
    ->get();
    return response()->json($data);
  }

  public function get_costumer(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '' : $r['search'] ;
    $data   = Costumer::select('id AS id', 'name AS text')
    ->where('isactive','A')
    ->where('name','ilike','%'.$param.'%')
    ->orderBy('id', 'ASC')
    ->get();
    return response()->json($data);
  }

  public function get_satuan(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '' : $r['search'] ;
    $data   = Satuan::select('id AS id', 'name AS text')
    ->where('isactive','A')
    ->where('name','ilike','%'.$param.'%')
    ->orderBy('id', 'ASC')
    ->get();
    return response()->json($data);
  }

  public function get_brand(Request $request)
  {
    $r      = $request->all();
    $param  = (!isset($r['search'])) ? '' : $r['search'] ;
    $data   = Brand::select('id AS id', 'name AS text')
    ->where('isactive','A')
    ->where('name','ilike','%'.$param.'%')
    ->orderBy('id', 'ASC')
    ->get();
    return response()->json($data);
  }

  public function get_harga_bb_default(Request $request)
  {
    $r      = $request->all();
    $data   = MasterBB::select('master_bb.*')
    ->where('isactive','A')
    ->where('id','=',''.$r['id'].'')
    ->get();
    return response()->json($data);
  }

  public function get_harga_acc_default(Request $request)
  {
    $r      = $request->all();
    $data   = MasterAcc::select('master_acc.*')
    ->where('isactive','A')
    ->where('id','=',''.$r['id'].'')
    ->get();
    return response()->json($data);
  }

}

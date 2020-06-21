<?php
//TOP
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Auth;
use Carbon\Carbon;
use App\BahanBaku;
use App\Warna;
use App\Brand;
use App\Satuan;
use App\BarangJadi;
use App\Supplier;
use App\Costumer;
use App\Cmt;
use App\Acc;
use App\Proses;
use App\Bank;
use App\Role;
use App\Akun;
use App\AkunCostumer;
use App\AkunCmt;
use App\AkunSupplier;
use App\Ledger;
use App\Journal;
use App\JournalTransaction;
use App\Category;

class MasterDataController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }


  // Fungsi CRUD Master Bahan Baku
  public function bahan_baku()
  {
    $kode     = 'BB';
    $index    = BahanBaku::orderBy('index','max')->take(1)->get();
    $data     = DB::table('bahan_baku')->get();
    $iduser   = Auth::user()->id;
    $msg      = '';

    if (!isset($index[0])) {
      $newid  = $kode.'001';
    } else {
      $index  = $index[0]->index + 1;
      $a      = str_pad($index, 3, "0", STR_PAD_LEFT);
      $newid  = $kode.$a;
    }
    return view('master_data.bahan_baku',['id'=>$iduser,'newid'=>$newid,'data'=>$data,'msg'=>$msg]);
  }

  public function add_bahan_baku(Request $request)
  {
    $r        = $request->all();
    $kode     = 'BB';
    $index    = BahanBaku::orderBy('index','max')->take(1)->get();
    $msg      = ['Berhasil','Gagal'];
    $iduser   = Auth::user()->id;

    if (!isset($index[0])) {
      $newid  = $kode.'001';
      $index  = 1;
    } else {
      $index  = $index[0]->index + 1;
      $a      = str_pad($index, 3, "0", STR_PAD_LEFT);
      $newid  = $kode.$a;
    }

    $add            = BahanBaku::create([
      'id'          => $newid,
      'index'       => $index,
      'name'        => $r['name'],
      'detail'      => '',
      'picture'     => '',
      'isactive'    => $r['isactive'],
      'created_at'  => Carbon::now(),
      'updated_at'  => Carbon::now(),
    ]);

    return back();
  }

  public function update_bahan_baku(Request $request)
  {
    $r        = $request->all();
    $update   = BahanBaku::where('id', $r['id_edit'])->update([
      'name'        => $r['name_edit'],
      'isactive'    => $r['isactive_edit'],
      'updated_at'  => Carbon::now()
    ]);
    return back();
  }

  public function del_bahan_baku(Request $request)
  {
    $r        = $request->all();
    $del      = BahanBaku::where('id', $r['id'])->delete();
    return back();
  }

  // Fungsi CRUD Master Warna
  public function warna()
  {
    $kode     = 'W';
    $index    = Warna::orderBy('index','max')->take(1)->get();
    $data     = DB::table('warna')->get();
    $iduser   = Auth::user()->id;
    $msg      = '';

    if (!isset($index[0])) {
      $newid  = $kode.'001';
    } else {
      $index  = $index[0]->index + 1;
      $a      = str_pad($index, 3, "0", STR_PAD_LEFT);
      $newid  = $kode.$a;
    }
    return view('master_data.warna',['id'=>$iduser,'newid'=>$newid,'data'=>$data,'msg'=>$msg]);
  }

  public function add_warna(Request $request)
  {
    $r        = $request->all();
    $kode     = 'W';
    $index    = Warna::orderBy('index','max')->take(1)->get();
    $msg      = ['Berhasil','Gagal'];
    $iduser   = Auth::user()->id;

    if (!isset($index[0])) {
      $newid  = $kode.'001';
      $index  = 1;
    } else {
      $index  = $index[0]->index + 1;
      $a      = str_pad($index, 3, "0", STR_PAD_LEFT);
      $newid  = $kode.$a;
    }

    $add            = Warna::create([
      'id'          => $newid,
      'index'       => $index,
      'name'        => $r['name'],
      'detail'      => '',
      'picture'     => '',
      'isactive'    => $r['isactive'],
      'created_at'  => Carbon::now(),
      'updated_at'  => Carbon::now(),
    ]);
    return back();
  }

  public function update_warna(Request $request)
  {
    $r        = $request->all();
    // dd($r);
    $update   = Warna::where('id', $r['id_edit'])->update([
      'name'        => $r['name_edit'],
      'isactive'    => $r['isactive_edit'],
      'updated_at'  => Carbon::now()
    ]);
    return back();
  }

  public function del_warna(Request $request)
  {
    $r        = $request->all();
    // dd($r);
    $del      = Warna::where('id', $r['id'])->delete();
    return back();
  }

  // Fungsi CRUD Master Brand
  public function brand()
  {
    $kode     = 'B';
    $index    = Brand::orderBy('index','max')->take(1)->get();
    $data     = DB::table('brand')->get();
    $iduser   = Auth::user()->id;
    $msg      = '';

    if (!isset($index[0])) {
      $newid  = $kode.'001';
    } else {
      $index  = $index[0]->index + 1;
      $a      = str_pad($index, 3, "0", STR_PAD_LEFT);
      $newid  = $kode.$a;
    }
    return view('master_data.brand',['id'=>$iduser,'newid'=>$newid,'data'=>$data,'msg'=>$msg]);
  }

  public function add_brand(Request $request)
  {
    $r        = $request->all();
    $kode     = 'B';
    $index    = Brand::orderBy('index','max')->take(1)->get();
    $msg      = ['Berhasil','Gagal'];
    $iduser   = Auth::user()->id;

    if (!isset($index[0])) {
      $newid  = $kode.'001';
      $index  = 1;
    } else {
      $index  = $index[0]->index + 1;
      $a      = str_pad($index, 3, "0", STR_PAD_LEFT);
      $newid  = $kode.$a;
    }

    $add            = Brand::create([
      'id'          => $newid,
      'index'       => $index,
      'name'        => $r['name'],
      'detail'      => '',
      'picture'     => '',
      'isactive'    => $r['isactive'],
      'created_at'  => Carbon::now(),
      'updated_at'  => Carbon::now(),
    ]);
    return back();
  }

  public function update_brand(Request $request)
  {
    $r        = $request->all();
    $update   = Brand::where('id', $r['id_edit'])->update([
      'name'        => $r['name_edit'],
      'isactive'    => $r['isactive_edit'],
      'updated_at'  => Carbon::now()
    ]);
    return back();
  }

  public function del_brand(Request $request)
  {
    $r        = $request->all();
    $del      = Brand::where('id', $r['id'])->delete();
    return back();
  }

  // Fungsi CRUD Master Satuan
  public function satuan()
  {
    $kode     = 'ST';
    $index    = Satuan::orderBy('index','max')->take(1)->get();
    $data     = DB::table('satuan')->get();
    $iduser   = Auth::user()->id;
    $msg      = '';

    if (!isset($index[0])) {
      $newid  = $kode.'001';
    } else {
      $index  = $index[0]->index + 1;
      $a      = str_pad($index, 3, "0", STR_PAD_LEFT);
      $newid  = $kode.$a;
    }
    return view('master_data.satuan',['id'=>$iduser,'newid'=>$newid,'data'=>$data,'msg'=>$msg]);
  }

  public function add_satuan(Request $request)
  {
    $r        = $request->all();
    $kode     = 'ST';
    $index    = Satuan::orderBy('index','max')->take(1)->get();
    $msg      = ['Berhasil','Gagal'];
    $iduser   = Auth::user()->id;

    if (!isset($index[0])) {
      $newid  = $kode.'001';
      $index  = 1;
    } else {
      $index  = $index[0]->index + 1;
      $a      = str_pad($index, 3, "0", STR_PAD_LEFT);
      $newid  = $kode.$a;
    }

    $add            = Satuan::create([
      'id'          => $newid,
      'index'       => $index,
      'name'        => $r['name'],
      'detail'      => '',
      'picture'     => '',
      'isactive'    => $r['isactive'],
      'created_at'  => Carbon::now(),
      'updated_at'  => Carbon::now(),
    ]);
    return back();
  }

  public function update_satuan(Request $request)
  {
    $r        = $request->all();
    $update   = Satuan::where('id', $r['id_edit'])->update([
      'name'        => $r['name_edit'],
      'isactive'    => $r['isactive_edit'],
      'updated_at'  => Carbon::now()
    ]);
    return back();
  }

  public function del_satuan(Request $request)
  {
    $r        = $request->all();
    $del      = Satuan::where('id', $r['id'])->delete();
    return back();
  }

  // Fungsi CRUD Master Barang Jadi
  public function barang_jadi()
  {
    $kode     = 'BJ';
    $index    = BarangJadi::orderBy('index','max')->take(1)->get();
    $data     = DB::table('barang_jadi')->get();
    $iduser   = Auth::user()->id;
    $msg      = '';

    if (!isset($index[0])) {
      $newid  = $kode.'001';
    } else {
      $index  = $index[0]->index + 1;
      $a      = str_pad($index, 3, "0", STR_PAD_LEFT);
      $newid  = $kode.$a;
    }
    return view('master_data.barang_jadi',['id'=>$iduser,'newid'=>$newid,'data'=>$data,'msg'=>$msg]);
  }

  public function add_barang_jadi(Request $request)
  {
    $r        = $request->all();
    $kode     = 'BJ';
    $index    = BarangJadi::orderBy('index','max')->take(1)->get();
    $msg      = ['Berhasil','Gagal'];
    $iduser   = Auth::user()->id;

    if (!isset($index[0])) {
      $newid  = $kode.'001';
      $index  = 1;
    } else {
      $index  = $index[0]->index + 1;
      $a      = str_pad($index, 3, "0", STR_PAD_LEFT);
      $newid  = $kode.$a;
    }

    $add            = BarangJadi::create([
      'id'          => $newid,
      'index'       => $index,
      'name'        => $r['name'],
      'detail'      => '',
      'picture'     => '',
      'isactive'    => $r['isactive'],
      'created_at'  => Carbon::now(),
      'updated_at'  => Carbon::now(),
    ]);
    return back();
  }

  public function update_barang_jadi(Request $request)
  {
    $r        = $request->all();
    $update   = BarangJadi::where('id', $r['id_edit'])->update([
      'name'        => $r['name_edit'],
      'isactive'    => $r['isactive_edit'],
      'updated_at'  => Carbon::now()
    ]);
    return back();
  }

  public function del_barang_jadi(Request $request)
  {
    $r        = $request->all();
    $del      = BarangJadi::where('id', $r['id'])->delete();
    return back();
  }

  // Fungsi CRUD Master Supplier
  public function supplier()
  {
    $idIndexAkun = $this->genIdIndexAkun('Supplier');
    $data = [
      'newid'   =>  $this->genid3('Supplier','SP'),
      'id_akun' =>  $idIndexAkun['id_akun'],
      'banks'   =>  DB::table('bank')->orderBy('index', 'asc')->get(),
      'msg'     =>  '',
      'title'   =>  'Supplier',
      'tag'     =>  'supplier'
    ];

    return view('master_data.supplier',$data);
  }

  public function supplier_create(Request $request)
  {
    $r        = $request->all();
    $index    = $this->genindex('Supplier');
    $newid    = $this->genid3('Supplier','SP');
    $table    = 'supplier';
    $title    = 'Supplier';

    $add            = Supplier::create([
      'id'          => $newid,
      'index'       => $index,
      'name'        => $r['name'],
      'alamat'      => $r['alamat'],
      'email'       => $r['email'],
      'kota'        => $r['kota'],
      'kode_pos'    => $r['kode_pos'],
      'no_telepon'  => $r['no_telepon'],
      'no_hp'       => $r['no_hp'],
      'no_fax'      => $r['no_fax'],
      'bank_id'     => $r['bank_id'],
      'no_rek'      => $r['no_rek'],
      'detail'      => '',
      'picture'     => '',
      'isactive'    => $r['isactive'],
      'created_at'  => Carbon::now(),
      'updated_at'  => Carbon::now(),
    ]);

    $i = Akun::select('akun.*')->orderBy('index', 'desc')
    ->where('level','4')
    ->where('id_kategori','21')
    ->where('k3','210101')
    ->take(1)
    ->get();

    $dataAkun = [
      'id'          => $r['id_akun'],
      'name'        => $r['name'],
      'deskripsi'   => 'Akun dari : '.$r['name'],
      'index'       => (isset($i[0]->index)) ? $i[0]->index + 1 : 1,
      'id_kategori' => '21',
      'k3'          => '210101',
      'level'       => '4',
      'saldo'       => $this->ribuantodb($r['saldo']),
      'isactive'    => $r['isactive']
    ];

    $proses_akun = $this->addAkun($dataAkun,$newid,$table);

    if ($proses_akun == 1) {
      return back();
    } else {
      Supplier::where('id', $newid)->delete();
      Akun::where('id', $r['id_akun'])->delete();
      AkunSupplier::where('id', $r['id_akun'])->delete();

      $newid    = $this->genid3('Supplier','SP');
      $bank     = DB::table('bank')->orderBy('index', 'asc')->get();
      $msg      = 'Maaf Periksa Kembali Kode Akun!';

      return view('master_data.supplier',['newid'=>$newid,'banks'=>$bank, 'title'=>$title, 'msg'=>$msg]);
    }
  }

  public function supplier_edit($id)
  {
    $data = Supplier::findOrFail($id);
    return $data;
  }

  public function supplier_update(Request $request)
  {
    $r        = $request->all();
    $update   = Supplier::where('id', $r['id_edit'])->update([
      'name'        => $r['name_edit'],
      'alamat'      => $r['alamat_edit'],
      'email'       => $r['email_edit'],
      'kota'        => $r['kota_edit'],
      'kode_pos'    => $r['kode_pos_edit'],
      'no_telepon'  => $r['no_telepon_edit'],
      'no_hp'       => $r['no_hp_edit'],
      'no_fax'      => $r['no_fax_edit'],
      'bank_id'     => $r['bank_id_edit'],
      'no_rek'      => $r['no_rek_edit'],
      'isactive'    => $r['isactive_edit'],
      'updated_at'  => Carbon::now()
    ]);

    return back();
  }

  public function supplier_api()
  {
    $data = Supplier::select('supplier.*')->orderBy('id', 'DESC');
    return DataTables::of($data)
    ->addColumn('status', function($data){
      $status = ($data->isactive == 'A') ? 'Aktif' : 'Tidak Aktif';
      return $status;
    })
    ->addColumn('action', function($data){
      return
      '<a onclick="editData(\''.$data->id.'\')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> &nbsp;'.
      '<a onclick="deleteData(\''.$data->id.'\')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
    })->make(true);
  }

  public function supplier_delete(Request $request)
  {
    $r        = $request->all();
    Supplier::where('id', $r['id'])->delete();
    Akun::leftJoin('akun_supplier','akun.id','=','akun_supplier.id_akun')->where('akun_supplier.id_supplier', $r['id'])->delete();
    AkunSupplier::where('id_supplier', $r['id'])->delete();
    return back();
  }


  // Fungsi CRUD Master Costumer
  public function costumer()
  {
    $idIndexAkun = $this->genIdIndexAkun('Costumer');
    $data = [
      'newid'   =>  $this->genid3('Costumer','CS'),
      'id_akun' =>  $idIndexAkun['id_akun'],
      'banks'   =>  DB::table('bank')->orderBy('index', 'asc')->get(),
      'msg'     =>  '',
      'title'   =>  'Costumer',
      'tag'     =>  'costumer'
    ];

    return view('master_data.costumer',$data);
  }

  public function costumer_create(Request $request)
  {
    $r        = $request->all();
    $index    = $this->genindex('Costumer');
    $newid    = $this->genid3('Costumer','CS');
    $table    = 'costumer';
    $title    = 'Costumer';

    $add            = Costumer::create([
      'id'          => $newid,
      'index'       => $index,
      'name'        => $r['name'],
      'alamat'      => $r['alamat'],
      'email'       => $r['email'],
      'kota'        => $r['kota'],
      'kode_pos'    => $r['kode_pos'],
      'no_telepon'  => $r['no_telepon'],
      'no_hp'       => $r['no_hp'],
      'no_fax'      => $r['no_fax'],
      'bank_id'     => $r['bank_id'],
      'no_rek'      => $r['no_rek'],
      'detail'      => '',
      'picture'     => '',
      'isactive'    => $r['isactive'],
      'akun_id'     => $r['id_akun'],
      'created_at'  => Carbon::now(),
      'updated_at'  => Carbon::now(),
    ]);

    $i = Akun::select('akun.*')->orderBy('index', 'desc')
    ->where('level','4')
    ->where('id_kategori','11')
    ->where('k3','110106')
    ->take(1)
    ->get();

    $dataAkun = [
      'id'          => $r['id_akun'],
      'name'        => $r['name'],
      'deskripsi'   => 'Akun dari : '.$r['name'],
      'index'       => (isset($i[0]->index)) ? $i[0]->index + 1 : 1,
      'id_kategori' => '11',
      'k3'          => '110106',
      'level'       => '4',
      'saldo'       => $this->ribuantodb($r['saldo']),
      'isactive'    => $r['isactive']
    ];

    $proses_akun = $this->addAkun($dataAkun,$newid,$table);

    if ($proses_akun == 1) {
      return back();
    } else {
      Costumer::where('id', $newid)->delete();
      Akun::where('id', $r['id_akun'])->delete();
      AkunCostumer::where('id', $r['id_akun'])->delete();

      $newid    = $this->genid3('Costumer','CS');
      $bank     = DB::table('bank')->orderBy('index', 'asc')->get();
      $msg      = 'Maaf Periksa Kembali Kode Akun!';

      return view('master_data.costumer',['newid'=>$newid,'banks'=>$bank, 'title'=>$title, 'msg'=>$msg]);
    }
  }

  public function costumer_edit($id)
  {
    $data = Costumer::findOrFail($id);
    return $data;
  }

  public function costumer_update(Request $request)
  {
    $r        = $request->all();
    $update   = Costumer::where('id', $r['id_edit'])->update([
      'name'        => $r['name_edit'],
      'alamat'      => $r['alamat_edit'],
      'email'       => $r['email_edit'],
      'kota'        => $r['kota_edit'],
      'kode_pos'    => $r['kode_pos_edit'],
      'no_telepon'  => $r['no_telepon_edit'],
      'no_hp'       => $r['no_hp_edit'],
      'no_fax'      => $r['no_fax_edit'],
      'bank_id'     => $r['bank_id_edit'],
      'no_rek'      => $r['no_rek_edit'],
      'isactive'    => $r['isactive_edit'],
      'updated_at'  => Carbon::now()
    ]);

    return back();
  }

  public function costumer_api()
  {
    $data = Costumer::select('costumer.*')->orderBy('id', 'DESC');
    return DataTables::of($data)
    ->addColumn('status', function($data){
      $status = ($data->isactive == 'A') ? 'Aktif' : 'Tidak Aktif';
      return $status;
    })
    ->addColumn('action', function($data){
      return
      '<a onclick="editData(\''.$data->id.'\')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> &nbsp;'.
      '<a onclick="deleteData(\''.$data->id.'\')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
    })->make(true);
  }

  public function costumer_delete(Request $request)
  {
    $r        = $request->all();
    Costumer::where('id', $r['id'])->delete();
    Akun::leftJoin('akun_costumer','akun.id','=','akun_costumer.id_akun')->where('akun_costumer.id_costumer', $r['id'])->delete();
    AkunCostumer::where('id_costumer', $r['id'])->delete();
    return back();
  }

  // Fungsi CRUD Master CMT
  public function cmt()
  {
    $idIndexAkun = $this->genIdIndexAkun('Cmt');
    $data = [
      'newid'   =>  $this->genid3('Cmt','CMT'),
      'id_akun' =>  $idIndexAkun['id_akun'],
      'banks'   =>  DB::table('bank')->orderBy('index', 'asc')->get(),
      'proses'  =>  DB::table('proses')->orderBy('index', 'asc')->get(),
      'msg'     =>  '',
      'title'   =>  'Cmt',
      'tag'     =>  'cmt'
    ];

    return view('master_data.cmt',$data);
  }

  public function cmt_create(Request $request)
  {
    $r        = $request->all();
    $index    = $this->genindex('Cmt');
    $newid    = $this->genid3('Cmt','CMT');
    $table    = 'cmt';
    $title    = 'Cmt';

    $add            = Cmt::create([
      'id'          => $newid,
      'proses_id'   => $r['proses_id'],
      'index'       => $index,
      'name'        => $r['name'],
      'alamat'      => $r['alamat'],
      'email'       => $r['email'],
      'kota'        => $r['kota'],
      'kode_pos'    => $r['kode_pos'],
      'no_telepon'  => $r['no_telepon'],
      'no_hp'       => $r['no_hp'],
      'no_fax'      => $r['no_fax'],
      'bank_id'     => $r['bank_id'],
      'no_rek'      => $r['no_rek'],
      'detail'      => '',
      'picture'     => '',
      'isactive'    => $r['isactive'],
      'created_at'  => Carbon::now(),
      'updated_at'  => Carbon::now(),
    ]);

    $i = Akun::select('akun.*')->orderBy('index', 'desc')
    ->where('level','4')
    ->where('id_kategori','21')
    ->where('k3','210101')
    ->take(1)
    ->get();

    $dataAkun = [
      'id'          => $r['id_akun'],
      'name'        => $r['name'],
      'deskripsi'   => 'Akun dari : '.$r['name'],
      'index'       => (isset($i[0]->index)) ? $i[0]->index + 1 : 1,
      'id_kategori' => '21',
      'k3'          => '210101',
      'level'       => '4',
      'saldo'       => $this->ribuantodb($r['saldo']),
      'isactive'    => $r['isactive']
    ];

    $proses_akun = $this->addAkun($dataAkun,$newid,$table);

    if ($proses_akun == 1) {
      return back();
    } else {
      Cmt::where('id', $newid)->delete();
      Akun::where('id', $r['id_akun'])->delete();
      AkunCmt::where('id', $r['id_akun'])->delete();

      $newid    = $this->genid('Cmt','CS');
      $bank     = DB::table('bank')->orderBy('index', 'asc')->get();
      $msg      = 'Maaf Periksa Kembali Kode Akun!';

      return view('master_data.cmt',['newid'=>$newid,'banks'=>$bank, 'title'=>$title, 'msg'=>$msg]);
    }
  }

  public function cmt_edit($id)
  {
    $data = Cmt::findOrFail($id);
    return $data;
  }

  public function cmt_update(Request $request)
  {
    $r        = $request->all();
    $update   = Cmt::where('id', $r['id_edit'])->update([
      'name'        => $r['name_edit'],
      'alamat'      => $r['alamat_edit'],
      'email'       => $r['email_edit'],
      'kota'        => $r['kota_edit'],
      'kode_pos'    => $r['kode_pos_edit'],
      'no_telepon'  => $r['no_telepon_edit'],
      'no_hp'       => $r['no_hp_edit'],
      'no_fax'      => $r['no_fax_edit'],
      'bank_id'     => $r['bank_id_edit'],
      'no_rek'      => $r['no_rek_edit'],
      'proses_id'    => $r['proses_id_edit'],
      'isactive'    => $r['isactive_edit'],
      'updated_at'  => Carbon::now()
    ]);

    return back();
  }

  public function cmt_api()
  {
    $data = Cmt::select('cmt.*')->orderBy('id', 'DESC');
    return DataTables::of($data)
    ->addColumn('status', function($data){
      $status = ($data->isactive == 'A') ? 'Aktif' : 'Tidak Aktif';
      return $status;
    })
    ->addColumn('action', function($data){
      return
      '<a onclick="editData(\''.$data->id.'\')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> &nbsp;'.
      '<a onclick="deleteData(\''.$data->id.'\')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
    })->make(true);
  }

  public function cmt_delete(Request $request)
  {
    $r        = $request->all();
    Cmt::where('id', $r['id'])->delete();
    Akun::leftJoin('akun_cmt','akun.id','=','akun_cmt.id_akun')->where('akun_cmt.id_cmt', $r['id'])->delete();
    AkunCmt::where('id_cmt', $r['id'])->delete();
    return back();
  }


  // Fungsi CRUD Master Accessories
  public function acc()
  {
    $kode     = 'AC';
    $index    = Acc::orderBy('index','max')->take(1)->get();
    $data     = Acc::all();
    $data     = DB::table('acc')->get();
    $iduser   = Auth::user()->id;
    $msg      = '';

    if (!isset($index[0])) {
      $newid  = $kode.'001';
    } else {
      $index  = $index[0]->index + 1;
      $a      = str_pad($index, 3, "0", STR_PAD_LEFT);
      $newid  = $kode.$a;
    }
    return view('master_data.acc',['id'=>$iduser,'newid'=>$newid,'data'=>$data,'msg'=>$msg]);
  }

  public function add_acc(Request $request)
  {
    $r        = $request->all();
    $kode     = 'AC';
    $index    = Acc::orderBy('index','max')->take(1)->get();
    $msg      = ['Berhasil','Gagal'];
    $data     = Acc::all();
    $iduser   = Auth::user()->id;

    if (!isset($index[0])) {
      $newid  = $kode.'001';
      $index  = 1;
    } else {
      $index  = $index[0]->index + 1;
      $a      = str_pad($index, 3, "0", STR_PAD_LEFT);
      $newid  = $kode.$a;
    }

    $add            = Acc::create([
      'id'          => $newid,
      'index'       => $index,
      'name'        => $r['name'],
      'detail'      => '',
      'picture'     => '',
      'isactive'    => $r['isactive'],
      'created_at'  => Carbon::now(),
      'updated_at'  => Carbon::now(),
    ]);
    return back();
  }

  public function update_acc(Request $request)
  {
    $r        = $request->all();
    $update   = Acc::where('id', $r['id_edit'])->update([
      'name'        => $r['name_edit'],
      'isactive'    => $r['isactive_edit'],
      'updated_at'  => Carbon::now()
    ]);
    return back();
  }

  public function del_acc(Request $request)
  {
    $r        = $request->all();
    $del      = Acc::where('id', $r['id'])->delete();
    return back();
  }

  // Fungsi CRUD Master Proses
  public function proses()
  {
    $kode     = 'PR';
    $index    = Proses::orderBy('index','max')->take(1)->get();
    $data     = Proses::all();
    $data     = DB::table('proses')->get();
    $iduser   = Auth::user()->id;
    $msg      = '';

    if (!isset($index[0])) {
      $newid  = $kode.'001';
    } else {
      $index  = $index[0]->index + 1;
      $a      = str_pad($index, 3, "0", STR_PAD_LEFT);
      $newid  = $kode.$a;
    }
    return view('master_data.proses',['id'=>$iduser,'newid'=>$newid,'data'=>$data,'msg'=>$msg]);
  }

  public function add_proses(Request $request)
  {
    $r        = $request->all();
    $kode     = 'PR';
    $index    = Proses::orderBy('index','max')->take(1)->get();
    $msg      = ['Berhasil','Gagal'];
    $iduser   = Auth::user()->id;

    if (!isset($index[0])) {
      $newid  = $kode.'001';
      $index  = 1;
    } else {
      $index  = $index[0]->index + 1;
      $a      = str_pad($index, 3, "0", STR_PAD_LEFT);
      $newid  = $kode.$a;
    }

    $add            = Proses::create([
      'id'          => $newid,
      'index'       => $index,
      'name'        => $r['name'],
      'detail'      => '',
      'picture'     => '',
      'isactive'    => $r['isactive'],
      'created_at'  => Carbon::now(),
      'updated_at'  => Carbon::now(),
    ]);
    return back();
  }

  public function update_proses(Request $request)
  {
    $r        = $request->all();
    $update   = Proses::where('id', $r['id_edit'])->update([
      'name'        => $r['name_edit'],
      'isactive'    => $r['isactive_edit'],
      'updated_at'  => Carbon::now()
    ]);
    return back();
  }

  public function del_proses(Request $request)
  {
    $r        = $request->all();
    $del      = Proses::where('id', $r['id'])->delete();
    return back();
  }

  // Fungsi CRUD Master Bank
  public function bank()
  {
    $kode     = 'BK';
    $index    = Bank::orderBy('index','max')->take(1)->get();
    $data     = Bank::all();
    $data     = DB::table('bank')->get();
    $iduser   = Auth::user()->id;
    $msg      = '';

    if (!isset($index[0])) {
      $newid  = $kode.'001';
    } else {
      $index  = $index[0]->index + 1;
      $a      = str_pad($index, 3, "0", STR_PAD_LEFT);
      $newid  = $kode.$a;
    }
    return view('master_data.bank',['id'=>$iduser,'newid'=>$newid,'data'=>$data,'msg'=>$msg]);
  }

  public function add_bank(Request $request)
  {
    $r        = $request->all();
    $kode     = 'BK';
    $index    = Bank::orderBy('index','max')->take(1)->get();
    $msg      = ['Berhasil','Gagal'];
    $data     = Bank::all();
    $iduser   = Auth::user()->id;

    if (!isset($index[0])) {
      $newid  = $kode.'001';
      $index  = 1;
    } else {
      $index  = $index[0]->index + 1;
      $a      = str_pad($index, 3, "0", STR_PAD_LEFT);
      $newid  = $kode.$a;
    }

    $add            = Bank::create([
      'id'          => $newid,
      'index'       => $index,
      'name'        => $r['name'],
      'detail'      => '',
      'picture'     => '',
      'isactive'    => $r['isactive'],
      'created_at'  => Carbon::now(),
      'updated_at'  => Carbon::now(),
    ]);
    return back();
  }

  public function update_bank(Request $request)
  {
    $r        = $request->all();
    $update   = Bank::where('id', $r['id_edit'])->update([
      'name'        => $r['name_edit'],
      'isactive'    => $r['isactive_edit'],
      'updated_at'  => Carbon::now()
    ]);
    return back();
  }

  public function del_bank(Request $request)
  {
    $r        = $request->all();
    $del      = Bank::where('id', $r['id'])->delete();
    return back();
  }

  // CRUD ROLE
  public function role_index()
  {
    $title  = 'Role';
    $tag    = 'role';

    return view('master_data.role',['title'=>$title,'tag'=>$tag]);
  }

  public function role_create(Request $request)
  {
    $data   = [
      'role_name'      => $request['name'],
    ];

    $role = Role::where('role_name',$request['name'])->count();

    if ($role > 0) {
      return response()->json([
        'status' => false,
        'message' => 'Role already exists!',
      ]);
    }

    Role::create($data);

    return response()->json([
      'status'  => true,
      'message' => 'Role created',
    ]);
  }

  public function role_edit($id)
  {
    $role = Role::findOrFail($id);
    return $role;
  }

  public function role_update(Request $request, $id)
  {
    $role  = Role::findOrFail($request['id_edit']);
    $data     = [
      'role_name' => $request['name_edit'],
    ];
    $role->update($data);
    return response()->json([
      'status' => true,
      'message' => 'Role Updated'
    ]);
  }

  public function role_delete($id)
  {
    $role = Role::findOrFail($id);
    Role::destroy($id);
    return response()->json([
      'status'  => true,
      'message' => 'Role Deleted',
    ]);
  }

  public function role_api()
  {
    $role = Role::select('role.id','role.role_name')->orderBy('id', 'ASC');;
    return DataTables::of($role)
    ->addColumn('action', function($role){
      return
      '<a onclick="editData(\''.$role->id.'\')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> &nbsp;'.
      '<a onclick="deleteData(\''.$role->id.'\')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
    })->make(true);
  }


  public function master_neraca_saldo_index()
  {
    $data  = [
      'title'   =>  'Neraca Saldo',
      'tag'     =>  'neraca_saldo',
      'year'    =>  $this->gettahun(),
      'tanggal' =>  $this->datenowtoview(),
    ];
    return view('master_data.master_neraca_saldo', $data);
  }

  public function master_neraca_saldo_api(Request $request)
  {
    $r = $request->all();
    $query  = '(select name from category where id = akun.id_kategori) as category,';
    for ($i=1; $i < 12; $i++) {
      $sparator = ($i > 1) ? ',':'';
      $query = $query.$sparator.
      "(select SUM(debit) from accounting_journal_transactions where accounting_journal_transactions.akun_id = akun.id and extract(year from created_at) ='".$r['year']."' and extract(month from created_at) ='".$i."') as debit".$i.",(select SUM(credit) from accounting_journal_transactions where accounting_journal_transactions.akun_id = akun.id and extract(year from created_at) ='".$r['year']."' and extract(month from created_at) ='".$i."') as credit".$i;
    }
    $all_query = 'akun.id as id, akun.name as name, akun.id_kategori as cat,'.$query;
    $akun = Akun::select(DB::raw($all_query))
    ->where('level','4')
    ->get();
    // ->toSql();
    // dd($akun);
    // $akun = Akun::select('akun.id as id','akun.name as name', DB::raw('SUM(accounting_journal_transactions.debit) as debit'),DB::raw('SUM(accounting_journal_transactions.credit) as credit'))
    // ->leftJoin('accounting_journal_transactions','accounting_journal_transactions.akun_id','=','akun.id')
    // ->whereYear('accounting_journal_transactions.created_at', '=', '20'.$r['tahun'])
    // ->groupBy('akun.id','akun.name')
    // dd($akun);
    return DataTables::of($akun)
    ->editColumn('id', function($akun){
      return $akun->id;
    })
    ->editColumn('name', function($akun){
      return $akun->name;
    })
    ->editColumn('category', function($akun){
      return $akun->category;
    })
    ->editColumn('debit1', function($akun){return number_format($akun->debit1,0);})
    ->editColumn('credit1', function($akun){return number_format($akun->credit1,0);})
    ->editColumn('debit2', function($akun){return number_format($akun->debit2,0);})
    ->editColumn('credit2', function($akun){return number_format($akun->credit2,0);})
    ->editColumn('debit3', function($akun){return number_format($akun->debit3,0);})
    ->editColumn('credit3', function($akun){return number_format($akun->credit3,0);})
    ->editColumn('debit4', function($akun){return number_format($akun->debit4,0);})
    ->editColumn('credit4', function($akun){return number_format($akun->credit4,0);})
    ->editColumn('debit5', function($akun){return number_format($akun->debit5,0);})
    ->editColumn('credit5', function($akun){return number_format($akun->credit5,0);})
    ->editColumn('debit6', function($akun){return number_format($akun->debit6,0);})
    ->editColumn('credit6', function($akun){return number_format($akun->credit6,0);})
    ->editColumn('debit7', function($akun){return number_format($akun->debit7,0);})
    ->editColumn('credit7', function($akun){return number_format($akun->credit7,0);})
    ->editColumn('debit8', function($akun){return number_format($akun->debit8,0);})
    ->editColumn('credit8', function($akun){return number_format($akun->credit8,0);})
    ->editColumn('debit9', function($akun){return number_format($akun->debit9,0);})
    ->editColumn('credit9', function($akun){return number_format($akun->credit9,0);})
    ->editColumn('debit10', function($akun){return number_format($akun->debit10,0);})
    ->editColumn('credit10', function($akun){return number_format($akun->credit10,0);})
    ->editColumn('debit11', function($akun){return number_format($akun->debit11,0);})
    ->editColumn('credit11', function($akun){return number_format($akun->credit11,0);})
    ->editColumn('debit12', function($akun){return number_format($akun->debit12,0);})
    ->editColumn('credit12', function($akun){return number_format($akun->credit12,0);})
    ->make(true);
  }

  public function master_export_neraca_saldo(Request $request)
  {
    global $title,$tag;
    $title  = 'Neraca Saldo';
    $tag    = 'neraca_saldo';
    $r      = $request->all();
    $file   = $r['bulan'].'/'.$r['tahun'];
    $data   = JournalTransaction::select('accounting_journal_transactions.akun_id as akun','akun.name as nama_akun', DB::raw('SUM(accounting_journal_transactions.debit) as debit'),DB::raw('SUM(accounting_journal_transactions.credit) as credit'))
    ->leftJoin('akun','accounting_journal_transactions.akun_id','=','akun.id')
    ->whereMonth('accounting_journal_transactions.created_at', '=', $r['bulan'])
    ->whereYear('accounting_journal_transactions.created_at', '=', '20'.$r['tahun'])
    ->groupBy('akun','akun.name')
    ->get();

    $myFile= Excel::create($tag, function($excel) use($data) {
      global $title,$tag;
      $excel->setTitle($title);
      $excel->sheet($tag, function($sheet) use($data) {
        $sheet->fromArray($data, null, 'A1', true, true);
      });
    });

    $myFile = $myFile->string('xlsx');
    $response =  array(
      'name' => "export_".$tag.'/'.$file.".xlsx",
      'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile)
    );

    return response()->json($response);

  }

  public function insert_neraca_saldo(Request $request)
  {
    $r = $request->all();
    $currency = 'IDR';
    $date = Carbon::createFromFormat('d/m/Y','1/'.$r['month'].'/20'.$r['year'])->format('Y-m-d');
    $data = Akun::where('id',$r['id'])->get();
    if (isset($data[0]['id_kategori'])) {
      $kategori = Category::where('id',$data[0]['id_kategori'])->get();
      $type = $kategori[0]['type'];
    } else {
      $type = '';
    }
    $data_ledger = [
      'name'         => $data[0]['name'],
      'type'         => $type,
      'created_at'   => $date,
    ];
    $create_ledger = Ledger::create($data_ledger);

    $data_jurnal = [
      'ledger_id'     => $create_ledger->id,
      'balance'       => floatval($this->ribuantodb($r['saldo'])),
      'currency'      => $currency,
      'akun_id'       => $r['id'],
      'tanggal'       => $date,
      'created_at'    => $date,
    ];
    $create_jurnal = Journal::create($data_jurnal);

    $debit = floatval($this->ribuantodb($r['debit']));
    $kredit = floatval($this->ribuantodb($r['credit']));
    $value = floatval($this->ribuantodb($r['saldo']));

    if ($type == 'asset') {
      // $debit = $value;
      $jenis = 'd';
    } elseif ($type == 'liability') {
      // $kredit = $value;
      $jenis = 'k';
    } elseif ($type == 'equity') {
      // $kredit = $value;
      $jenis = 'k';
    } elseif ($type == 'income') {
      // $kredit = $value;
      $jenis = 'k';
    } elseif ($type == 'expense') {
      // $debit = $value;
      $jenis = 'd';
    }

    $newid = $this->genidtrans('JournalTransaction');
    $index = $this->genindex('JournalTransaction');
    $dataJournalTransaction   = [
      'id'                  => $newid,
      'index'               => $index,
      'transaction_group'   => $type,
      'journal_id'          => $create_jurnal->id,
      'debit'               => $debit,
      'credit'              => $kredit,
      'currency'            => $currency,
      'memo'                => $data[0]['name'],
      'type'                => $jenis,
      'akun_id'             => $r['id'],
      'post_date'           => $date,
      'created_at'    => $date,
    ];
    $journaltransaction = JournalTransaction::create($dataJournalTransaction);

    return response()->json([
      'status'  => true,
      'message' => 'Insert Success',
    ]);

  }




}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Excel;

use App\User;
use App\Akun;
use App\Pages;
use App\UserRole;
use App\Param;
use App\Promo;


class SettingController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function general_index()
  {
    $title  = 'General';
    $tag    = 'general';
    $param = Param::all();
    return view('setting.general', ['title' => $title, 'tag' => $tag, 'param' => $param]);
  }

  public function import_index()
  {
    $data = [
      'title' => 'Import Data',
      'tag'   => 'import',
    ];

    return view('setting.import', $data);
  }

  public function import_proses(Request $request)
  {
    $m = 'App\\' . $request->model;
    if ($request->hasFile('file')) {
      $path = $request->file('file')->getRealPath();
      $model = $request->model;
      $code = $request->code;
      $data = Excel::load($path, function ($render) { })->get();
      // dd($request->code);
      if (!empty($data) && $data->count()) {
        if ($code == 'stock') {
          // dd($data);
          foreach ($data as $key => $value) {
            $index = $this->genindex($model);
            $import = new $m;
            // dd($m);
            // dd($value->id_bb);
            $import->id = $value->id_bb . '-' . $value->id_warna . '-' . $value->id_supplier;
            $import->index = $index;
            $import->name = $value->name;
            $import->id_bb = $value->id_bb;
            $import->id_warna = $value->id_warna;
            $import->id_supplier = $value->id_supplier;
            $import->stock = $value->stock;
            $import->id_satuan = $value->id_satuan;
            $import->harga_default = $value->harga_default;
            $import->isactive = $value->isactive;
            $import->save();
          } // End For
        } elseif ($code == 'akun') {
          foreach ($data as $key => $value) {
            if ($model != 'General') {
              $type = strtolower($model);
              if ($model == 'Costumer') {
                $type = 'customer';
              }
              $id_master = 'id' . '_' . $type;
              $index_master = 'index' . '_' . $type;
              $name_master = 'name' . '_' . $type;
              $isactive_master = 'isactive' . '_' . $type;
              $import = new $m;
              $import->id = $value->$id_master;
              $import->index = $value->$index_master;
              $import->name = $value->$name_master;
              $import->isactive = $value->$isactive_master;
              if ($model == 'Cmt') $import->proses_id = $value->proses_id;
              $import->akun_id = $value->id;
              // dd($import->id);
              $import->save();
            }
            $dataAkun = [
              'id'          => $value->id,
              'name'        => $value->name,
              'deskripsi'   => $value->name,
              'index'       => $value->index,
              'id_kategori' => $value->id_kategori,
              'saldo_awal'  => $value->saldo,
              'level'       => $value->level,
              'k1'          => (isset($value->k1)) ? $value->k1 : '',
              'k2'          => (isset($value->k2)) ? $value->k2 : '',
              'k3'          => (isset($value->k3)) ? $value->k3 : '',
              'isactive'    => $value->isactive,
            ];
            $proses_akun = Akun::create($dataAkun);
            // tambah buat jurnal jika saldo > 0
            if ((int) $value->saldo > 0) {
              //Fungsi Akuntansi  
              $id = [$value->id];
              $id_kategori = $value->id_kategori;
              if ($id_kategori == '11' || $id_kategori == '55' || $id_kategori == '66') {
                $debit = [(int) $value->saldo];
                $credit = [0];
              } else {
                $debit = [0];
                $credit = [(int) $value->saldo];
              }
              $ref_type = ['saldo_awal'];
              $ref_id = ['0'];
              $memo = ['Saldo Awal Akun ' . $value->name];
              $date = [$this->datenowtodb()];
              $currency = ['IDR'];

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
            }

            // if ($proses_akun <> 1) {
            //   $m::where('id', $value->id.'_'.$type)->delete();
            //   Akun::where('id', $value->id)->delete();
            // }
          } // End For
        } else {
          foreach ($data as $key => $value) {
            $id = $this->genid3($model, $code);
            $index = $this->genindex($model);;
            $import = new $m;
            $import->id = $id;
            $import->index = $index;
            $import->name = $value->name;
            $import->isactive = $value->isactive;
            $import->save();
          } // End For
        } // End If
      }
    }
    return back();
  }

  public function clear_data_index()
  {
    $data = [
      'title' => 'Clear Data',
      'tag'   => 'clear',
    ];

    return view('setting.clear_data', $data);
  }

  public function clear_data_proses(Request $request)
  {
    $master   = $request->master;
    $so       = $request->so;
    $gudang   = $request->gudang;
    $produksi = $request->produksi;
    $skb      = $request->skb;
    $invoice  = $request->invoice;
    $finance  = $request->finance;
    $accounting = $request->accounting;
    $ecommerce = $request->ecommerce;
    // dd($request->all());

    if (count($master)) {
      foreach ($master as $key => $value) {
        $m = 'App\\' . $value;
        $p = $m::truncate();
      }
    }

    if (count($so)) {
      foreach ($so as $key => $value) {
        $m = 'App\\' . $value;
        $p = $m::truncate();
      }
    }

    if (count($gudang)) {
      foreach ($gudang as $key => $value) {
        $m  = 'App\\' . $value;
        $p  = $m::truncate();
        if ($value == 'KeluarBB' || $value == 'ReturBB' || $value == 'KeluarAcc' || $value == 'ReturAcc') {
          $md = 'App\\' . $value . 'Detail';
          $pd = $md::truncate();
        }
      }
    }

    if (count($produksi)) {
      // dd($produksi);
      foreach ($produksi as $key => $value) {
        $m  = 'App\\' . $value;
        $p  = $m::truncate();
        $md = 'App\\' . $value . 'Detail';
        $pd = $md::truncate();
      }
    }

    if (count($skb)) {
      foreach ($skb as $key => $value) {
        $m  = 'App\\' . $value;
        $p  = $m::truncate();
        $md = 'App\\' . $value . 'Detail';
        $pd = $md::truncate();
      }
    }

    if (isset($invoice)) {
      $m  = 'App\\' . $invoice;
      $p  = $m::truncate();
      $md = 'App\\' . $invoice . 'Detail';
      $pd = $md::truncate();
    }

    if (count($finance)) {
      // dd($finance);
      foreach ($finance as $key => $value) {
        if ($value == 'PembayaranPiutang') {
          $m = 'App\\' . $value;
          $p = $m::truncate();
          $md = 'App\\PembayaranDetailPiutang';
          $pd = $md::truncate();
        } else {
          $m = 'App\\' . $value;
          $p = $m::truncate();
          $md = 'App\\' . $value . 'Detail';
          $pd = $md::truncate();
        }
      }
    }

    if (count($accounting)) {
      foreach ($accounting as $key => $value) {
        if ($value == 'Trans') {
          $p  = 'App\Journal'::truncate();
          $p  = 'App\JournalTransaction'::truncate();
          $p  = 'App\Ledger'::truncate();
        } elseif ($value == 'Akun') {
          $p  = 'App\Akun'::truncate();
          $p  = 'App\AkunCmt'::truncate();
          $p  = 'App\AkunCostumer'::truncate();
          $p  = 'App\AkunSupplier'::truncate();
        } else {
          $m = 'App\\' . $value;
          $p = $m::truncate();
          $md = 'App\\' . $value . 'Detail';
          $pd = $md::truncate();
        }
      }
    }

    return back();
  }


  public function general_update(Request $request)
  {
    $param     = Param::where('index', '1');

    $data     = [
      'name_perusahaan'   => $request['name_perusahaan'],
      'name_aplikasi'     => $request['name_aplikasi'],
      'versi'             => $request['versi'],
      'email'             => $request['email'],
      'alamat'            => $request['alamat'],
      'telepon'           => $request['telepon'],
      'no_wa'             => $request['no_wa'],
      'copyright_year'    => $request['copyright_year'],
      'updated_at'        => Carbon::now()
    ];

    $param->update($data);
    return response()->json([
      'status' => true,
      'message' => 'Param updated'
    ]);
  }



  public function user_index()
  {
    $kode   = 'U';
    $title  = 'User';
    $tag    = 'user';

    return view('setting.user', ['title' => $title, 'tag' => $tag]);
  }

  public function user_create(Request $request)
  {
    $data = [
      'name'              => $request['name'],
      'email'             => $request['email'],
      'no_ktp'            => $request['no_ktp'],
      'telepon'           => $request['telepon'],
      'alamat'            => $request['alamat'],
      'password'          => bcrypt($request['password']),
      'pin'               => $request['pin'],
      'isactive'          => $request['isactive']
    ];

    // Validasi Cek Email Apakah sudah terdaftar?
    $user = User::where('email', $request['email'])->count();

    if ($user > 0) {
      return response()->json([
        'status' => false,
        'message' => 'Email already exists!'
      ]);
    }

    $create_user = User::create($data);
    $data_role = [
      'user_id'           => $create_user['id'],
      'role_id'           => (int) $request['id_role'],
    ];

    // dd($data_role);
    $create_role = UserRole::create($data_role);


    return response()->json([
      'status'  => true,
      'message' => 'User created',
    ]);
  }

  public function user_edit($id)
  {
    $user = User::findOrFail($id);

    return $user;
  }

  public function user_update(Request $request, $id)
  {
    $user  = User::findOrFail($request['id_edit']);

    $data     = [
      'index'             => $request['id_edit'],
      'name'              => $request['name_edit'],
      'email'             => $request['email_edit'],
      'no_ktp'            => $request['ktp_edit'],
      'telepon'           => $request['telp_edit'],
      'alamat'            => $request['alamat_edit'],
      'updated_at'        => Carbon::now(),
      'isactive'          => $request['isactive_edit']
    ];

    $user->update($data);
    return response()->json([
      'status' => true,
      'message' => 'User updated'
    ]);
  }

  public function user_delete($id)
  {
    $user = User::findOrFail($id);
    User::destroy($id);
    return response()->json([
      'status' => true,
      'message' => 'User Deleted'
    ]);
  }

  public function user_api()
  {
    $user = DB::table('users')
      ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
      ->leftJoin('role', 'role.id', '=', 'role_user.role_id')
      ->select('users.id', 'users.name', 'users.email', 'users.isactive', 'role.role_name as role_name')
      ->orderBy('users.id', 'asc')
      ->get();
    // dd($user);
    return DataTables::of($user)
      ->editColumn('role', function ($user) {
        return $user->role_name;
      })
      ->editColumn('isactive', function ($user) {
        return ($user->isactive == 'A') ? 'Active' : 'Non Active';
      })
      ->addColumn('action', function ($user) {
        return
          '<a onclick="editData(\'' . $user->id . '\')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> &nbsp;' .
          '<a onclick="deleteData(\'' . $user->id . '\')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
      })->make(true);
  }


  public function profile_index()
  {
    $kode   = 'P';
    $title  = 'Profil';
    $tag    = 'profile';
    $user   = Auth::user();
    return view('setting.profile', ['title' => $title, 'tag' => $tag, 'user' => $user]);
  }

  public function profile_update(Request $request)
  {
    $id     = Auth::user()->id;
    $user   = User::findOrFail($id);

    $data     = [
      'name'      => $request['name'],
      'email'     => $request['email'],
      'alamat'    => $request['alamat'],
      'telepon'    => $request['telepon'],
      'no_ktp'    => $request['no_ktp'],
    ];

    $user->update($data);
    return response()->json([
      'status'    => true,
      'message'   => 'Profile user updated',
      'name'      => $request['name'],
      'email'     => $request['email'],
      'alamat'    => $request['alamat'],
      'telepon'    => $request['telepon'],
      'no_ktp'    => $request['no_ktp'],
    ]);
  }

  public function profile_update_security(Request $request)
  {
    $id     = Auth::user()->id;
    $user   = User::findOrFail($id);

    if ($request['password'] != $request['confirm_password']) {
      return response()->json([
        'status'    => false,
        'message'   => 'Password dan Confirm Password tidak sama!',
      ]);
    } elseif ($request['pin'] != $request['confirm_pin']) {
      return response()->json([
        'status'    => false,
        'message'   => 'Password dan Confirm Password tidak sama!',
      ]);
    } elseif ($request['pin'] == '' || $request['password'] == '') {
      return response()->json([
        'status'    => false,
        'message'   => 'Password dan Pin tidak boleh kosong!',
      ]);
    }

    $data     = [
      'password'  => bcrypt($request['password']),
      'pin'       => $request['pin'],
    ];

    $user->update($data);
    return response()->json([
      'status'    => true,
      'message'   => 'Password dan Pin updated',
    ]);
  }

  // CRUD PAGES
  public function pages_index()
  {
    $title  = 'Pages';
    $tag    = 'pages';
    
    // dd($newid);

    return view('setting.pages', ['title' => $title, 'tag' => $tag]);
  }

  public function pages_create(Request $request)
  {
    $newid  = $this->genidstd('Pages', '');
    $r = $request->all();
    $data   = [
      'id'        => $newid,
      'name'      => $r['name'],
      'title'     => $r['title'],
      'content'   => $r['content'],
      'status'    => $r['status']
    ];

    $count = Pages::where('name', $r['name'])->count();

    if ($count > 0) {
      return response()->json([
        'status' => false,
        'message' => 'Pages already exists!',
      ]);
    }

    if ($request->hasFile('featured_image')) {
      $r['featured_image'] = '/image/pages/' . $newid . '/' . str_slug($r['name'], '-') . '.' . $request->featured_image->getClientOriginalExtension();
      $request->featured_image->move(public_path('/image/pages/' . $newid . '/'), $r['featured_image']);
      $data['featured_image']  = $r['featured_image'];
    }

    Pages::create($data);

    return response()->json([
      'status'  => true,
      'message' => 'Pages created',
    ]);
  }

  public function pages_edit($id)
  {
    $pages = Pages::findOrFail($id);
    return $pages;
  }

  public function pages_update(Request $request, $id)
  {
    $pages  = Pages::findOrFail($request['id_edit']);
    $r = $request->all();
    $data   = [
      'name'      => $r['name_edit'],
      'title'     => $r['title_edit'],
      'content'   => $r['content_edit'],
      'status'    => $r['status_edit']
    ];

    $count = Pages::where('name', $r['name_edit'])->count();

    if ($count > 1) {
      return response()->json([
        'status' => false,
        'message' => 'Pages already exists!',
      ]);
    }

    if ($request->hasFile('featured_image_edit')) {
      $r['featured_image_edit'] = '/image/pages/' . $newid . '/' . str_slug($r['name'], '-') . '.' . $request->featured_image->getClientOriginalExtension();
      $request->featured_image->move(public_path('/image/pages/' . $newid . '/'), $r['featured_image_edit']);
      $data['featured_image_edit']  = $r['featured_image_edit'];
    }
    // dd($data);
    $pages->update($data);
    return response()->json([
      'status' => true,
      'message' => 'Pages Updated'
    ]);
  }

  public function pages_delete($id)
  {
    $pages = Pages::findOrFail($id);
    Pages::destroy($id);
    return response()->json([
      'status'  => true,
      'message' => 'Pages Deleted',
    ]);
  }

  public function pages_api()
  {
    $pages = Pages::all();
    return DataTables::of($pages)
      ->editColumn('status', function ($pages) {
        return ($pages->status == 'A') ? 'Active' : 'Non Active';
      })
      ->addColumn('action', function ($pages) {
        return
          '<a onclick="editData(\'' . $pages->id . '\')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> &nbsp;' .
          '<a onclick="deleteData(\'' . $pages->id . '\')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
      })->make(true);
  }

  // CRUD PAGES
  public function promo_index()
  {
    $title  = 'Promo';
    $tag    = 'promo';

    return view('setting.promo', ['title' => $title, 'tag' => $tag]);
  }

  public function promo_create(Request $request)
  {
    $newid  = $this->genidstd('Promo', '');
    $r = $request->all();
    $data   = [
      'id'        => $newid,
      'name'      => $r['name'],
      'id_barang'=> $r['id_produk'],
      'price'   => $r['price'],
      'keterangan'=> $r['keterangan'],
      'start_date'=> $this->dateviewtodb($r['from']),
      'end_date'=> $this->dateviewtodb($r['to']),
      'status'    => $r['status']
    ];

    $count = Promo::where('id_barang', $r['id_produk'])
    ->where('status', 'A')
    ->count();

    if ($count > 0) {
      return response()->json([
        'status' => false,
        'message' => 'Promo produk already exists!',
      ]);
    }

    Promo::create($data);

    return response()->json([
      'status'  => true,
      'message' => 'Promo created',
    ]);
  }

  public function promo_edit($id)
  {
    $promo = Promo::select('promo.*','produk.name as nama_produk')
    ->leftJoin('produk','produk.id','promo.id_barang')
    ->where('promo.id',$id)
    ->get();

    if(isset($promo[0]->start_date)){
      $promo[0]->start_date = $this->datedbtoview($promo[0]->start_date);
      $promo[0]->end_date = $this->datedbtoview($promo[0]->end_date);
    }

    return $promo;
  }

  public function promo_update(Request $request, $id)
  {
    $promo  = Promo::findOrFail($request['id_edit']);
    $r = $request->all();
    $data   = [
      'name'      => $r['name_edit'],
      // 'id_barang' => $r['id_produk_edit'],  
      'price'   => $r['price_edit'],
      'keterangan' => $r['keterangan_edit'],
      'start_date' => $this->dateviewtodb($r['from_edit']),
      'end_date' => $this->dateviewtodb($r['to_edit']),
      'status'    => $r['status_edit']
    ];

    $count = Promo::where('id_barang', $r['id_produk_edit'])
      ->where('status', 'A')
      ->count();

    if ($count > 1) {
      return response()->json([
        'status' => false,
        'message' => 'Promo already exists!',
      ]);
    }

    // dd($data);
    $promo->update($data);
    return response()->json([
      'status' => true,
      'message' => 'Promo Updated'
    ]);
  }

  public function promo_delete($id)
  {
    $promo = Promo::findOrFail($id);
    Promo::destroy($id);
    return response()->json([
      'status'  => true,
      'message' => 'Promo Deleted',
    ]);
  }

  public function promo_api()
  {
    $promo = Promo::select('promo.*','produk.name as nama_barang')
    ->leftJoin('produk','produk.id','=','promo.id_barang')
    ->get();
    return DataTables::of($promo)
      ->editColumn('status', function ($promo) {
        return ($promo->status == 'A') ? 'Active' : 'Non Active';
      })
      ->editColumn('price', function ($promo) {
        return number_format($promo->price);
      })
      ->addColumn('action', function ($promo) {
        return
          '<a onclick="editData(\'' . $promo->id . '\')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> &nbsp;' .
          '<a onclick="deleteData(\'' . $promo->id . '\')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
      })->make(true);
  }


}

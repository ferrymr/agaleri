<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Costumer;
use App\Pages;
use App\Produk;
use App\ProdukStok;
use App\EKategori;
use App\Cart;
use App\CartDetail;
use App\User;
use App\UserRole;
use App\Size;
use App\Order;
use App\Promo;
use App\OrderDetail;
use Auth;

class EcommerceController extends Controller
{

  //  public function __construct()
  //  {
  //    $this->middleware('auth');
  //  }


  //CRUD PRODUK
  public function produk_index()
  {
    $title  = 'Produk';
    $tag    = 'produk';
    // $newid  = $this->genid('Produk','');

    return view('ecommerce.produk', ['title' => $title, 'tag' => $tag]);
  }

  public function produk_create(Request $request)
  {
    $r = $request->all();
    $r['thumb'] = null;
    $r['photo'] = null;

    if ($request->hasFile('thumb')) {
      $r['thumb'] = '/image/produk/' . $r['id'] . '/thumb_' . str_slug($r['name'], '-') . '.' . $request->photo->getClientOriginalExtension();
      $request->thumb->move(public_path('/image/produk/' . $r['id'] . '/'), $r['thumb']);
    }

    if ($request->hasFile('photo')) {
      $r['photo'] = '/image/produk/' . $r['id'] . '/' . str_slug($r['name'], '-') . '.' . $request->photo->getClientOriginalExtension();
      $request->photo->move(public_path('/image/produk/' . $r['id'] . '/'), $r['photo']);
    }

    $index  = $this->genindex('Produk');
    $data   = [
      'id'              => $r['id'],
      'index'           => $r['index'],
      'name'            => $r['name'],
      'id_category'     => $r['kategori_id'],
      // 'qty'             => $this->ribuantodb($r['qty']),
      'harga'           => $this->ribuantodb($r['harga']),
      'thumb'           => $r['thumb'],
      'photo'           => $r['photo'],
      'berat'           => $this->ribuantodb($r['berat']),
      'spesifikasi'     => $r['spesifikasi'],
      'deskripsi'       => $r['deskripsi'],
      'status'          => 'A',
      'isactive'        => $r['isactive']
    ];

    $produk = Produk::where('name', $r['name'])->count();
    $newid = $this->genid('Produk', '');

    if ($produk > 0) {
      return response()->json([
        'status' => false,
        'message' => 'Produk already exists!',
        'newid'   => $newid
      ]);
    }

    $produk = Produk::create($data);
    $newid = $this->genid('Produk', '');

    return response()->json([
      'status'  => true,
      'message' => 'Produk created',
      'newid'   => $newid
    ]);
  }

  public function produk_edit($id)
  {
    $produk = Produk::findOrFail($id);
    return $produk;
  }

  public function produk_update(Request $request, $id)
  {
    $r = $request->all();
    $produk  = Produk::findOrFail($r['id_edit']);
    $r['photo'] = null;

    $data   = [
      'name'            => $r['name_edit'],
      'harga'           => $this->ribuantodb($r['harga_edit']),
      'berat'           => $this->ribuantodb($r['berat_edit']),
      'spesifikasi'     => $r['spesifikasi_edit'],
      'deskripsi'       => $r['deskripsi_edit'],
      'isactive'        => $r['isactive_edit']
    ];

    if ($request->hasFile('thumb_edit')) {
      $r['thumb_edit'] = '/image/produk/' . $r['id_edit'] . '/thumb_' . str_slug($r['name_edit'], '-') . '.' . $request->thumb_edit->getClientOriginalExtension();
      $request->thumb_edit->move(public_path('/image/produk/' . $r['id_edit'] . '/'), $r['thumb_edit']);
      $data['thumb']     = $r['thumb_edit'];
    }

    if ($request->hasFile('photo_edit')) {
      $r['photo_edit'] = '/image/produk/' . $r['id_edit'] . '/' . str_slug($r['name_edit'], '-') . '.' . $request->photo_edit->getClientOriginalExtension();
      $request->photo_edit->move(public_path('/image/produk/' . $r['id_edit'] . '/'), $r['photo_edit']);
      $data['photo']     = $r['photo_edit'];
    }

    $produk->update($data);
    return response()->json([
      'status' => true,
      'message' => 'Produk Updated'
    ]);
  }

  public function produk_delete($id)
  {
    $produk = Produk::findOrFail($id);
    Produk::destroy($id);
    $newid    = $this->genid('Produk', '');
    return response()->json([
      'status'  => true,
      'message' => 'Produk Deleted',
      'newid'   => $newid
    ]);
  }

  public function produk_api()
  {
    $produk = Produk::all();
    return DataTables::of($produk)
      ->editColumn('isactive', function ($produk) {
        return ($produk->isactive == 'A') ? 'Active' : 'Non Active';
      })
      ->addColumn('action', function ($produk) {
        return
          '<a onclick="editData(\'' . $produk->id . '\')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> &nbsp;' .
          '<a onclick="deleteData(\'' . $produk->id . '\')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
      })->make(true);
  }

  public function gallery_index()
  {
    $title  = 'Gallery';
    $tag    = 'gallery';
    $data   = Produk::all();

    return view('ecommerce.gallery', ['title' => $title, 'tag' => $tag, 'data' => $data]);
  }

  // CRUD ECOMMERCE KATEGORI
  public function e_kategori_index()
  {
    $title  = 'Brands';
    $tag    = 'e_brand';
    // $newid  = $this->genid('EKategori','');

    return view('ecommerce.kategori', ['title' => $title, 'tag' => $tag]);
  }

  public function e_kategori_create(Request $request)
  {
    $index  = $this->genindex('EKategori');
    $data   = [
      'id'        => $request['id'],
      'index'     => $index,
      'name'      => $request['name'],
      'isactive'  => $request['isactive']
    ];

    $e_kategori = EKategori::where('name', $request['name'])->count();
    $newid = $this->genid('EKategori', '');

    if ($e_kategori > 0) {
      return response()->json([
        'status' => false,
        'message' => 'Kategori already exists!',
        'newid'   => $newid
      ]);
    }

    EKategori::create($data);
    $newid = $this->genid('EKategori', '');

    return response()->json([
      'status'  => true,
      'message' => 'Kategori created',
      'newid'   => $newid
    ]);
  }

  public function e_kategori_edit($id)
  {
    $e_kategori = EKategori::findOrFail($id);
    return $e_kategori;
  }

  public function e_kategori_update(Request $request, $id)
  {
    $e_kategori  = EKategori::findOrFail($request['id_edit']);
    $data     = [
      'name' => $request['name_edit'],
      'isactive' => $request['isactive_edit']
    ];
    $e_kategori->update($data);
    return response()->json([
      'status' => true,
      'message' => 'Kategori Updated'
    ]);
  }

  public function e_kategori_delete($id)
  {
    $e_kategori = EKategori::findOrFail($id);
    EKategori::destroy($id);
    $newid    = $this->genid('EKategori', '');
    return response()->json([
      'status'  => true,
      'message' => 'Kategori Deleted',
      'newid'   => $newid
    ]);
  }

  public function e_kategori_api()
  {
    $e_kategori = EKategori::all();
    return DataTables::of($e_kategori)
      ->editColumn('isactive', function ($e_kategori) {
        return ($e_kategori->isactive == 'A') ? 'Active' : 'Non Active';
      })
      ->addColumn('action', function ($e_kategori) {
        return
          '<a onclick="editData(\'' . $e_kategori->id . '\')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> &nbsp;' .
          '<a onclick="deleteData(\'' . $e_kategori->id . '\')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
      })->make(true);
  }

  // ecommerce
  public function daftar_akun_index()
  {
    return view('ecommerce.daftar-akun');
  }

  public function daftar_akun_create(Request $request)
  {
    $r = $request->all();

    $data   = [
      'name'           => $r['txtNamaDepan'] . ' ' . $r['txtNamaBelakang'],
      'email'          => $r['txtEmail'],
      'no_ktp'         => '',
      'telepon'        => '',
      'alamat'         => '',
      'password'       => bcrypt($r['txtKataKunci']),
      'pin'            => '123456',
      'isactive'       => 'A',
      'remember_token' => '',
      'created_at'     => Carbon::now(),
      'updated_at'     => Carbon::now()
    ];

    $user = User::where('email', $r['txtEmail'])->count();

    if ($user > 0) {
      return redirect()->route('daftar-akun');
    } else {
      $user = User::create($data);

      $dataRoleUser   = [
        'user_id'           => $user->id,
        'role_id'           => 6
      ];
      $userRole = UserRole::create($dataRoleUser);

      return redirect()->route('login');
    }
  }

  public function services_index()
  {
    $data = Produk::all();

    return view('ecommerce.services', ['produk' => $data]);
  }



  function get_produk_id($id)
  {
    // dd($id);
    $data = Produk::get();
    $index  = $this->genindex('Produk', 'id_category', $id);
    $newid = $this->genid3('Produk', $id, 'id_category', $id);
    return $data = [
      'id' => $newid,
      'index' => $index,
    ];
  }

  // public function order_list_ecommerce_index()
  // {
  //   $title  = 'Order List';
  //   $tag    = 'order_list';
  //   // $newid  = $this->genid('EKategori','');

  //   return view('so.list_so', ['title' => $title, 'tag' => $tag]);
  // }


  // CRUD ECOMMERCE SIZE
  public function size_index()
  {
    $title  = 'Size';
    $tag    = 'size';
    // $newid  = $this->genid('Size','');

    return view('ecommerce.size', ['title' => $title, 'tag' => $tag]);
  }

  public function size_create(Request $request)
  {
    $index  = $this->genindex('Size');
    $data   = [
      'id'        => $request['id'],
      'index'     => $index,
      'name'      => $request['name'],
      'isactive'  => $request['isactive']
    ];

    $size = Size::where('name', $request['name'])->count();
    $newid = $this->genid('Size', '');

    if ($size > 0) {
      return response()->json([
        'status' => false,
        'message' => 'Size already exists!',
        'newid'   => $newid
      ]);
    }

    Size::create($data);
    $newid = $this->genid('Size', '');

    return response()->json([
      'status'  => true,
      'message' => 'Size created',
      'newid'   => $newid
    ]);
  }

  public function size_edit($id)
  {
    $size = Size::findOrFail($id);
    return $size;
  }

  public function size_update(Request $request, $id)
  {
    $size  = Size::findOrFail($request['id_edit']);
    $data     = [
      'name' => $request['name_edit'],
      'isactive' => $request['isactive_edit']
    ];
    $size->update($data);
    return response()->json([
      'status' => true,
      'message' => 'Size Updated'
    ]);
  }

  public function size_delete($id)
  {
    $size = Size::findOrFail($id);
    Size::destroy($id);
    $newid    = $this->genid('Size', '');
    return response()->json([
      'status'  => true,
      'message' => 'Size Deleted',
      'newid'   => $newid
    ]);
  }

  public function size_api()
  {
    $size = Size::all();
    return DataTables::of($size)
      ->editColumn('isactive', function ($size) {
        return ($size->isactive == 'A') ? 'Active' : 'Non Active';
      })
      ->addColumn('action', function ($size) {
        return
          '<a onclick="editData(\'' . $size->id . '\')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> &nbsp;' .
          '<a onclick="deleteData(\'' . $size->id . '\')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
      })->make(true);
  }


  public function cart_index()
  {
    if (Auth::check() == false) {
      return view('ecommerce.pages_login');
    }
    $user_id = Auth::user()->id;
    $cart = CartDetail::select('cart.id', 
    'cart_detail.qty',
    'cart_detail.potongan',
    'cart_detail.harga as harga_total',
    'cart_detail.size_id', 
    'cart_detail.barang_id', 
    'produk.name',
    'produk.harga',
    'produk.photo'
    )
      ->where('user_id', $user_id)
      ->leftJoin('cart', 'cart.id', '=', 'cart_detail.cart_id')
      ->leftJoin('produk', 'produk.id', '=', 'cart_detail.barang_id')
      ->get();
    $subtotal = CartDetail::select(
      DB::raw('sum(cart_detail.harga) as subtotal')
    )
      ->where('user_id', $user_id)
      ->leftJoin('cart', 'cart.id', '=', 'cart_detail.cart_id')
      ->leftJoin('produk', 'produk.id', '=', 'cart_detail.barang_id')
      ->get();
    // dd();
    $data = [
      'cart' => $cart,
      'sub_total' => $subtotal[0]->subtotal,
    ];
    return view('ecommerce.cart', $data);
  }


  public function cart_remove(Request $request, $id, $produk_id, $size_id){
    $r = $request->all();
    CartDetail::where('barang_id', $produk_id)
    ->where('size_id', $size_id)
    ->where('cart_id', $id)
    ->delete();
    return redirect()->back();
  }


  public function cart_process(Request $request){
    $r = $request->all();
    // dd($r);
    $user_id = Auth::user()->id;
    if($r['btn_submit_cart'] == 'update'){
      // dd('a');
      for($i=0;$i<count($r['id']);$i++){
      CartDetail::where('barang_id', $r['barang_id'][$i])
        ->where('size_id', $r['size_id'][$i])
        ->where('cart_id', $r['id'][$i])
        ->delete();
        $index  = $this->genindex('CartDetail', 'cart_id', $r['id'][$i]);
        $datenow = Carbon::now()->format('Y-m-d');
        $promo = Promo::where('id_barang', '=', $r['barang_id'][$i])
          ->where('status', '=', 'A')
          ->whereDate('start_date', '<=', $datenow)
          ->whereDate('end_date', '>=', $datenow)
          ->get();
        // dd($promo);
        $data_create = [
          'cart_id'   => $r['id'][$i],
          'barang_id' => $r['barang_id'][$i],
          'size_id'   => $r['size_id'][$i],
          'index'     => $index,
          'qty'       => $r['qty'][$i],
        ];
        if(isset($promo[0])){
          $data_create['harga'] = (int) $promo[0]->price * (int) $r['qty'][$i];
          $data_create['potongan'] = ((int) $r['harga'][$i] - (int) $promo[0]->price) * (int) $r['qty'][$i];
        }else{
          $data_create['harga'] = (int) $r['harga'][$i] * (int) $r['qty'][$i];
        }
      CartDetail::create($data_create);
      }
      return redirect()->back();
    } else {
      $user_id = Auth::user()->id;
      $data_customer = Costumer::select(
        'costumer.name',
        'costumer.email',
        'costumer.no_hp',
        'costumer.alamat',
        'costumer.kota',
        'costumer.kode_pos'
      )
        ->where('users.id', $user_id)
        ->leftJoin('users', 'users.id', 'costumer.id')
        ->get();

      $cart = CartDetail::select(
        'cart.id',
        'cart_detail.qty',
        'cart_detail.harga as harga_total',
        'cart_detail.size_id',
        'cart_detail.barang_id',
        'produk.name',
        'produk.harga',
        'produk.photo'
      )
        ->where('user_id', $user_id)
        ->leftJoin('cart', 'cart.id', '=', 'cart_detail.cart_id')
        ->leftJoin('produk', 'produk.id', '=', 'cart_detail.barang_id')
        ->get();
      $subtotal = CartDetail::select(
        DB::raw('sum(cart_detail.harga) as subtotal')
      )
        ->where('user_id', $user_id)
        ->leftJoin('cart', 'cart.id', '=', 'cart_detail.cart_id')
        ->leftJoin('produk', 'produk.id', '=', 'cart_detail.barang_id')
        ->get();
      $potongan = CartDetail::select(
        DB::raw('sum(cart_detail.potongan) as potongan')
      )
        ->where('user_id', $user_id)
        ->leftJoin('cart', 'cart.id', '=', 'cart_detail.cart_id')
        ->leftJoin('produk', 'produk.id', '=', 'cart_detail.barang_id')
        ->get();

      $count_order = count($cart);
      $data = [
        'data' =>  $data_customer,
        'cart' => $cart,
        'potongan' => $potongan[0]->potongan,
        'sub_total' => $subtotal[0]->subtotal,
        'count_order' => $count_order,
      ];
      return view('ecommerce.shipping', $data);
    }
  }

  public function shipping_index()
  {
    $user_id = Auth::user()->id;
    $data_customer = Costumer::select(
      'costumer.name',
      'costumer.email',
      'costumer.no_hp',
      'costumer.alamat',
      'costumer.kota',
      'costumer.kode_pos'
    )
      ->where('users.id', $user_id)
      ->leftJoin('users', 'users.id', 'costumer.id')
      ->get();

    $cart = CartDetail::select(
      'cart.id',
      'cart_detail.qty',
      'cart_detail.harga as harga_total',
      'cart_detail.size_id',
      'cart_detail.barang_id',
      'produk.name',
      'produk.harga',
      'produk.photo'
    )
      ->where('user_id', $user_id)
      ->leftJoin('cart', 'cart.id', '=', 'cart_detail.cart_id')
      ->leftJoin('produk', 'produk.id', '=', 'cart_detail.barang_id')
      ->get();
    $subtotal = CartDetail::select(
      DB::raw('sum(cart_detail.harga) as subtotal')
    )
      ->where('user_id', $user_id)
      ->leftJoin('cart', 'cart.id', '=', 'cart_detail.cart_id')
      ->leftJoin('produk', 'produk.id', '=', 'cart_detail.barang_id')
      ->get();


    $count_order = count($cart);
    $data = [
      'data' =>  $data_customer,
      'cart' => $cart,
      'sub_total' => $subtotal[0]->subtotal,
      'count_order' => $count_order,
    ];
    return view('ecommerce.shipping',$data);
  }

  public function shipping_create(Request $request)
  {
    $r = $request->all();
    // dd($r);
    $user_id = Auth::user()->id;
    $data_order = [
      'user_id' => $user_id,
      'nama_penerima' => $r['name'],
      'alamat_tujuan' => $r['alamat'],
      'kota' => $r['kota'],
      'kode_pos' => $r['kode_pos'],
      'email' => $r['email'],
      'catatan_order' => $r['catatan'],
      'telepon' => $r['no_hp'],
      'total_transaksi' => (int)$r['subtotal'],
      'potongan' => (int)$r['potongan'],
      'status_order' => 'n',
      'tanggal_order' => $this->datenowtodb(),
    ];
    // dd($data_order);
    $order_id = Order::create($data_order);

    $data_cart = Cart::where('cart.user_id',$user_id)
    ->leftJoin('cart_detail','cart_detail.cart_id','=','cart.id')
    ->get();
    // dd($data_cart[0]->id);
    $cart_id = $data_cart[0]->id;
    for ($i = 0; $i < count($data_cart); $i++) {
      $data_order_detail = [
        'order_id' => $order_id->id,
        'barang_id' => $data_cart[$i]->barang_id,
        'size_id' => $data_cart[$i]->size_id,
        'index' => $i + 1,
        'qty' => (int)$data_cart[$i]->qty,
        'harga' => (int)$data_cart[$i]->harga,
        'total' => (int) $data_cart[$i]->qty * (int) $data_cart[$i]->harga,
      ];
      OrderDetail::create($data_order_detail);
    }
    Cart::where('id', $cart_id)->delete();
    CartDetail::where('cart_id', $cart_id)->delete();
    return view('ecommerce.payment');
  }

  public function payment_index()
  {
    return view('ecommerce.payment');
  }

  public function order_index()
  {
    $user_id = Auth::user()->id;
    $order = Order::where('user_id', $user_id)->orderBy('id','desc')->get();
    $data = [
      'data' => $order,
    ];
    // dd($order->get());
    return view('ecommerce.order', $data);
  }


  public function account_index()
  {
    $user_id = Auth::user()->id;
    $data_customer = Costumer::select('costumer.name', 
    'costumer.name',
    'costumer.email',
    'costumer.birth_date', 
    'costumer.no_hp', 
    'costumer.alamat',
    'costumer.kota', 
    'costumer.kode_pos')
    ->where('users.id', $user_id)
    ->leftJoin('users','users.id','costumer.id')
    ->get();
    $data = [
      'data' =>  $data_customer,
    ];
    return view('ecommerce.account', $data);
  }

  public function account_update(Request $request)
  {
    $r = $request->all();
    // dd($r);
    $data     = [
      'name' => $r['name'],
      'email' => $r['email'],
    ];
    User::where('id', Auth::user()->id)
      ->update($data);

    $data_detail     = [
      'name' => $r['name'],
      'email' => $r['email'],
      'birth_date' => $r['birth_date'],
      'no_hp' => $r['no_hp'],
      'alamat' => $r['alamat'],
      'kota' => $r['kota'],
      'kode_pos' => $r['kode_pos'],
    ];
    Costumer::where('id', Auth::user()->id)
      ->update($data_detail);

    $user_id = Auth::user()->id;
    $data_customer = Costumer::select(
      'costumer.name',
      'costumer.name',
      'costumer.email',
      'costumer.birth_date',
      'costumer.no_hp',
      'costumer.alamat',
      'costumer.kota',
      'costumer.kode_pos'
    )
      ->where('users.id', $user_id)
      ->leftJoin('users', 'users.id', 'costumer.id')
      ->get();
    $data = [
      'data' =>  $data_customer,
    ];
    return view('ecommerce.account', $data);
  }

  public function admin_order_index()
  {
    return view('ecommerce.admin_order');
  }

  public function password_recovery_index()
  {
    return view('ecommerce.password_recovery');
  }

  public function password_update(Request $request)
  {
    $r = $request->all();
    // dd($r);
    $data     = [
      'password' => bcrypt($r['password']),
    ];
    User::where('id', Auth::user()->id)
      ->update($data);

    $data = [
      'data' =>  Auth::user(),
    ];
    return redirect('password_recovery');
  }


  public function pages_show($name)
  {
    $pages = Pages::where('name', $name)->get();
    return view('ecommerce.pages_show', ['data' => $pages]);
  }


  public function shop_index()
  {
    $produk = Produk::all();
    $kategori = DB::table('e_kategori')
      ->select('e_kategori.id as id','e_kategori.name as name_e_kategori', 'produk.qty')
      ->leftjoin('produk', 'e_kategori.id', '=', 'produk.id_category')
      ->get();

    return view('ecommerce.shop', ['produk' => $produk, 'kategori' => $kategori]);
  }


  public function single_produk_index($id)
  {
    $produk = Produk::all()->where('id', '=', $id);
    $datenow = Carbon::now()->format('Y-m-d');
    $promo = Promo::where('id_barang', '=', $id)
    ->where('status', '=', 'A')
    ->whereDate('start_date', '<=' , $datenow)
    ->whereDate('end_date', '>=' , $datenow)
    ->get();
    $produk_stok = ProdukStok::where('id_barang', '=', $id)->orderBy('id_size', 'asc')->get();

    return view('ecommerce.single-produk', ['produk' => $produk, 'produk_stok' => $produk_stok, 'promo' => $promo]);
  }

  public function single_produk_create(Request $request, $id)
  {
    $r = $request->all();
    if(Auth::check() == false){
      return view('ecommerce.pages_login');
    }
    // dd($r);
    $user_id = Auth::user()->id;
    $count = Cart::where('user_id', $user_id)->count();

    if ($count > 0) {
      $get_cart = Cart::where('user_id', $user_id)->get();
      $cart_id = $get_cart[0]->id;
    } else {
      $data_cart   = [
        'user_id'         => $user_id,
        'status'          => 'A',
      ];
      $create_cart = Cart::create($data_cart);
      $cart_id = $create_cart->id;
    }

    $count_detail = CartDetail::where('cart_id', $cart_id)
      ->where('barang_id', $r['id_produk'])
      ->where('size_id', $r['id_size'])
      ->count();

    $datenow = Carbon::now()->format('Y-m-d');
    $promo = Promo::where('id_barang', '=', $id)
      ->where('status', '=', 'A')
      ->whereDate('start_date', '<=', $datenow)
      ->whereDate('end_date', '>=', $datenow)
      ->get();

    if ($count_detail > 0) {
      $get_cart_detail = CartDetail::where('cart_id', $cart_id)
        ->where('barang_id', $r['id_produk'])
        ->where('size_id', $r['id_size'])
        ->get();

      $index  = $this->genindex('CartDetail', 'cart_id', $cart_id);
      
        if(isset($promo[0])){
        $data_cart_detail   = [
          'qty'             => (int) $get_cart_detail[0]->qty + (int) $r['qty'],
          'harga'           => (int) $get_cart_detail[0]->harga + ((int) $promo[0]->price * (int) $r['qty']),
          'potongan'        => (int) $get_cart_detail[0]->potongan + ((int) $r['harga'] - (int) $promo[0]->price) * (int) $r['qty'],
        ];
        } else {
          $data_cart_detail   = [
            'qty'             => (int) $get_cart_detail[0]->qty + (int) $r['qty'],
            'harga'           => (int) $get_cart_detail[0]->harga + ((int) $r['harga'] * (int) $r['qty']),
          ];
        }
      CartDetail::where('cart_id', $cart_id)
        ->where('barang_id', $r['id_produk'])
        ->where('size_id', $r['id_size'])
        ->update($data_cart_detail);
    } else {
      $index  = $this->genindex('CartDetail', 'cart_id', $cart_id);
      $data_cart_detail   = [
        'cart_id'         => $cart_id,
        'barang_id'       => $r['id_produk'],
        'size_id'         => $r['id_size'],
        'index'           => $index,
        'qty'             => $r['qty'],
      ];
      if (isset($promo[0])) {
        $data_cart_detail['harga'] = (int) $promo[0]->price * (int) $r['qty'];
        $data_cart_detail['potongan'] = ((int) $r['harga'] - (int) $promo[0]->price) * (int) $r['qty'];
      } else {
        $data_cart_detail['harga'] = (int) $r['harga'] * (int) $r['qty'];
      }
      CartDetail::create($data_cart_detail);
    }
    return redirect()->back();
  }


  public function pages_login_index()
  {
    return view('ecommerce.pages_login');
  }

  public function pages_signup_index()
  {
    return view('ecommerce.pages_signup');
  }

  public function pages_signup_create(Request $request)
  {
    $r = $request->all();
    // dd($r);

    $user = User::where('email', $r['email'])->count();
    if ($user > 0) {
      return view('ecommerce.pages_login');
    }
    $data   = [
      'name'           => $r['name'],
      'email'          => $r['email'],
      'password'       => bcrypt($r['password']),
      'isactive'       => 'A',
      'role'           => '3',
    ];

    $user = User::create($data);

    $data_customer = [
      'id'          => $user->id,
      'index'       => $this->genindex('Costumer'),
      'name'        => $r['name'],
      'email'       => $r['email'],
      'birth_date'  => $r['year'] . '-' . $r['month'] . '-' . $r['day'],
      'favorite_food' => $r['favorite_food'],
      'hoby'        => $r['hoby'],
      'status'    => 'A',
    ];

    Costumer::create($data_customer);

    $dataRoleUser   = [
      'user_id'           => $user->id,
      'role_id'           => 3
    ];
    UserRole::create($dataRoleUser);

    return redirect()->route('pages_login');
  }


}

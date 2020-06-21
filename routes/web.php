<?php
use Illuminate\Support\Facades\DB;

// Route untuk user yang baru register
Route::group(['prefix' => 'home', 'middleware' => ['auth']], function(){
  Route::get('/', function(){
    $data['role'] = DB::table('users')
    ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
    ->leftJoin('role', 'role.id', '=', 'role_user.role_id')
    ->select('users.*','role.role_name as role_name')
    ->where('users.id',Auth::id())
    ->get();

    $data_session = [
      'role' => $data['role'][0]->role_name,
      'user_id' => $data['role'][0]->id,
    ];
    session($data_session);
    $session_role = session()->get('role');
    // dd($session_role);
    if ($session_role == 'customer') {
      return redirect()->route('order');
    } else if ($session_role != 'customer') {
      return redirect()->route('dashboard');
    } 
  });
});

Route::get('/', function () {
  $products = DB::table('produk')->limit(9)->get();
  return view('home_ecommerce',['products' => $products]);
});

Route::group(['middleware' => "role:super_admin,admin"], function () {
  Route::get('/dashboard', 'HomeController@index')->name('dashboard');
  Route::get('/about', 'HomeController@about')->name('about');
  Route::post('validasi_pin_super_admin', 'Controller@validasi_pin_super_admin')->name('validasi_pin_super_admin');
  Route::get('/changelog', 'HomeController@changelog')->name('changelog');
  Route::get('order_list_ecommerce', 'OrderController@order_list_ecommerce_index')->name('order_list_ecommerce.index');
  Route::get('order_list_ecommerce_api', 'OrderController@order_list_ecommerce_api')->name('order_list_ecommerce.api');
  Route::get('order_ecommerce/{id}/view_print', 'OrderController@order_ecommerce_view_print')->name('order_ecommerce_view_print');
  Route::post('batal_order', 'OrderController@batal_order')->name('batal_order');
  Route::post('selesai_order', 'OrderController@selesai_order')->name('selesai_order');
  Route::post('approve_order', 'OrderController@approve_order')->name('approve_order');
  Route::post('input_no_resi', 'OrderController@input_no_resi')->name('input_no_resi');
  include_once 'routes_part/master_data.php';
  include_once 'routes_part/so.php';
  include_once 'routes_part/history.php';
  include_once 'routes_part/skb.php';
  include_once 'routes_part/accounting.php';
  include_once 'routes_part/finance.php';
  include_once 'routes_part/produksi.php';
  include_once 'routes_part/gudang.php';
  include_once 'routes_part/report.php';
  include_once 'routes_part/general.php';
  include_once 'routes_part/setting.php';
});

include_once 'routes_part/ecommerce.php';
include_once 'routes_part/guest.php';
Auth::routes();
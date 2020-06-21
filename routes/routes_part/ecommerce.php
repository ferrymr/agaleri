<?php
use Illuminate\Support\Facades\DB;
 
Route::get('produk','EcommerceController@produk_index')->name('produk.index');
Route::get('produk/api','EcommerceController@produk_api')->name('produk.api');
Route::post('produk','EcommerceController@produk_create')->name('produk.create');
Route::get('produk/{id}/edit','EcommerceController@produk_edit')->name('produk.edit');
Route::patch('produk/{id}','EcommerceController@produk_update')->name('produk.update');
Route::delete('produk/{id}','EcommerceController@produk_delete')->name('produk.delete');
Route::post('produk_id/{id}','EcommerceController@get_produk_id')->name('get_produk_id');
Route::get('gallery','EcommerceController@gallery_index')->name('gallery.index');

// Route Kategori
Route::get('e_kategori','EcommerceController@e_kategori_index')->name('e_kategori.index');
Route::get('e_kategori/api','EcommerceController@e_kategori_api')->name('e_kategori.api');
Route::post('e_kategori','EcommerceController@e_kategori_create')->name('e_kategori.create');
Route::get('e_kategori/{id}/edit','EcommerceController@e_kategori_edit')->name('e_kategori.edit');
Route::patch('e_kategori/{id}','EcommerceController@e_kategori_update')->name('e_kategori.update');
Route::delete('e_kategori/{id}','EcommerceController@e_kategori_delete')->name('e_kategori.delete');

// Route Size
Route::get('size','EcommerceController@size_index')->name('size.index');
Route::get('size/api','EcommerceController@size_api')->name('size.api');
Route::post('size','EcommerceController@size_create')->name('size.create');
Route::get('size/{id}/edit','EcommerceController@size_edit')->name('size.edit');
Route::patch('size/{id}','EcommerceController@size_update')->name('size.update');
Route::delete('size/{id}','EcommerceController@size_delete')->name('size.delete');

// Route Kategori Member
Route::get('order', 'EcommerceController@order_index')->name('order');
Route::get('account', 'EcommerceController@account_index')->name('account.index');
Route::get('password_recovery', 'EcommerceController@password_recovery_index')->name('password_recovery');
Route::get('cart', 'EcommerceController@cart_index')->name('cart');
Route::post('cart/remove/{id}/{produk_id}/{size_id}', 'EcommerceController@cart_remove')->name('cart_remove');
Route::post('cart/process', 'EcommerceController@cart_process')->name('cart_process');
Route::get('shipping', 'EcommerceController@shipping_index')->name('shipping');
Route::post('shipping', 'EcommerceController@shipping_create')->name('shipping_create');
Route::get('payment', 'EcommerceController@payment_index')->name('payment.index');
Route::get('masuk_barang', 'EcommerceController@masuk_barang_index')->name('masuk_barang.index');
Route::post('account/update', 'EcommerceController@account_update')->name('account.update');
Route::post('password/update', 'EcommerceController@password_update')->name('password.update');


//Order
Route::get('shop', 'EcommerceController@shop_index')->name('shop');
Route::get('single-produk/{id}', 'EcommerceController@single_produk_index')->name('single_produk_index.index');
Route::post('single-produk/add-cart/{id}', 'EcommerceController@single_produk_create')->name('single_produk.create');
Route::get('pages_signup', 'EcommerceController@pages_signup_index')->name('pages.signup.index');
Route::post('pages_signup/add', 'EcommerceController@pages_signup_create')->name('pages.signup.create');
// Route::get('daftar-akun', 'EcommerceController@daftar_akun_index')->name('daftar_akun.index');
// Route::post('daftar-akun/add', 'EcommerceController@daftar_akun_create')->name('daftar_akun.create');
Route::get('pages_login', 'EcommerceController@pages_login_index')->name('pages_login');
Route::post('pages_login/masuk', 'EcommerceController@pages_login_berhasil')->name('pages_login_berhasil');


//Pages Show
Route::get('pages/{name}/show', 'EcommerceController@pages_show')->name('pages_show.index');
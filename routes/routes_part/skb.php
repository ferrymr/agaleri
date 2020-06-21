<?php

//SKB
Route::get('skb_keluar', 'SkbController@skb_keluar_index')->name('skb_keluar.index');
Route::post('skb_keluar_create', 'SkbController@skb_keluar_create')->name('skb_keluar.create');
Route::post('skb_keluar_update', 'SkbController@skb_keluar_update')->name('skb_keluar.update');
Route::post('get_detail_skb_keluar', 'SkbController@get_detail_skb_keluar')->name('skb_keluar.get_detail');
Route::get('skb_keluar_api','SkbController@skb_keluar_api')->name('skb_keluar.api');
Route::get('skb_keluar_edit','SkbController@skb_keluar_edit')->name('skb_keluar_edit');

Route::get('skb_masuk', 'SkbController@skb_masuk_index')->name('skb_masuk.index');
Route::get('get_skb_keluar', 'SkbController@get_skb_keluar')->name('skb_keluar.get');
Route::post('skb_masuk_create', 'SkbController@skb_masuk_create')->name('skb_masuk.create');
Route::get('skb_masuk_api','SkbController@skb_masuk_api')->name('skb_masuk.api');
Route::post('get_skb_detail','SkbController@get_skb_detail')->name('get_skb_detail.get');


Route::get('skb_adjust', 'SkbController@skb_adjust_index')->name('skb_adjust.index');
Route::post('skb_adjust_create', 'SkbController@skb_adjust_create')->name('skb_adjust.create');
Route::get('skb_adjust_api','SkbController@skb_adjust_api')->name('skb_adjust.api');
// Print SKB
Route::get('skb_print','SkbController@skb_print')->name('skb_print');

//Port to Stock
Route::post('post_to_stock','SkbController@post_to_stock')->name('post_to_stock');


Route::post('get_id_skb_adjust','SkbController@get_id_skb_adjust')->name('get_id_skb_adjust');


//Validasi Pin Edit
Route::post('skb_validasi_pin','SkbController@skb_validasi_pin')->name('skb_validasi_pin');

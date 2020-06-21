<?php
 
//SO
Route::get('add_so', 'SoController@add_so');
Route::post('send_so', 'SoController@send_so');
Route::get('list_so', 'SoController@list_so');
Route::get('api_so', 'SoController@api_so')->name('so.api');

Route::post('posting_proses', 'SoController@posting_proses');
Route::get('so/{id}/print','SoController@so_print')->name('so.print');

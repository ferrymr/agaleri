<?php

//History
Route::get('/history_spk', 'HistoryController@history_spk');
Route::get('/history_art', 'HistoryController@history_art');
Route::get('/history_so', 'HistoryController@history_so');

Route::get('/history_so_api', 'HistoryController@history_so_api')->name('history_so.api');
Route::get('/history_art_api', 'HistoryController@history_art_api')->name('history_art.api');

Route::post('/history_detail', 'HistoryController@history_detail')->name('history_detail.get');
<?php

Route::get('general','SettingController@general_index')->name('general.index');
Route::patch('general','SettingController@general_update')->name('general.update');

// User Route
Route::get('user','SettingController@user_index')->name('user.index');
Route::get('user/api','SettingController@user_api')->name('user.api');
Route::post('user','SettingController@user_create')->name('user.create');
Route::get('user/{id}/edit','SettingController@user_edit')->name('user.edit');
Route::patch('user/{id}','SettingController@user_update')->name('user.update');
Route::delete('user/{id}','SettingController@user_delete')->name('user.delete');

// Profil Route
Route::get('profile','SettingController@profile_index')->name('profile.index');
Route::post('profile','SettingController@profile_update')->name('profile.update');
Route::post('profile/security','SettingController@profile_update_security')->name('profile.update_security');

// Import
Route::get('import','SettingController@import_index')->name('import.index');
Route::get('import_stock','SettingController@import_index')->name('import.index');
Route::get('import_akun','SettingController@import_index')->name('import.index');

Route::post('import_proses','SettingController@import_proses')->name('import.general');


// Clear Data
Route::get('clear_data', 'SettingController@clear_data_index')->name('clear_data.index');
Route::post('clear_data_proses', 'SettingController@clear_data_proses')->name('clear_data.proses');


// Pages Master
Route::get('pages', 'SettingController@pages_index')->name('pages.index');
Route::get('pages/api', 'SettingController@pages_api')->name('pages.api');
Route::post('pages_c', 'SettingController@pages_create')->name('pages.create'); 
Route::get('pages/{id}/edit', 'SettingController@pages_edit')->name('pages.edit');
Route::patch('pages/{id}', 'SettingController@pages_update')->name('pages.update');
Route::delete('pages/{id}', 'SettingController@pages_delete')->name('pages.delete');

// Pages Master
Route::get('promo', 'SettingController@promo_index')->name('promo.index');
Route::get('promo/api', 'SettingController@promo_api')->name('promo.api');
Route::post('promo', 'SettingController@promo_create')->name('promo.create'); 
Route::get('promo/{id}/edit', 'SettingController@promo_edit')->name('promo.edit');
Route::patch('promo/{id}', 'SettingController@promo_update')->name('promo.update');
Route::delete('promo/{id}', 'SettingController@promo_delete')->name('promo.delete');

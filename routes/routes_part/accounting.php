<?php

Route::get('pembelian', 'AccountingController@pembelian_index')->name('pembelian.index');
Route::get('pembelian_bb', 'AccountingController@pembelian_bb_index');
Route::post('pembelian_bb', 'AccountingController@pembelian_bb_create')->name('pembelian_bb.create');
Route::get('pembelian_bb/api', 'AccountingController@pembelian_bb_api')->name('pembelian_bb.api');

Route::get('pembelian_acc', 'AccountingController@pembelian_acc_index');
Route::post('pembelian_acc', 'AccountingController@pembelian_acc_create')->name('pembelian_acc.create');
Route::get('pembelian_acc/api', 'AccountingController@pembelian_acc_api')->name('pembelian_acc.api');

Route::get('pembelian_bj', 'AccountingController@pembelian_bj_index');
Route::post('pembelian_bj', 'AccountingController@pembelian_bj_create')->name('pembelian_bj.create');
Route::get('pembelian_bj/api', 'AccountingController@pembelian_bj_api')->name('pembelian_bj.api');

Route::get('payment_expense', 'AccountingController@payment_expense_index')->name('payment_expense.index');
Route::post('payment_expense', 'AccountingController@payment_expense_create')->name('payment_expense.create');
// Route::get('list_expense','AccountingController@list_expense')->name('list_expense');

// Payment Route
Route::get('payment', 'AccountingController@payment_index')->name('payment.index');
Route::get('payment/api', 'AccountingController@payment_api')->name('payment.api');
Route::post('payment', 'AccountingController@payment_create')->name('payment.create');
Route::get('payment/{id}/edit', 'AccountingController@payment_edit')->name('payment.edit');
Route::patch('payment/{id}', 'AccountingController@payment_update')->name('payment.update');
Route::delete('payment/{id}', 'AccountingController@payment_delete')->name('payment.delete');

// Cateogry Route
Route::get('category', 'AccountingController@category_index')->name('category.index');
Route::get('category/api', 'AccountingController@category_api')->name('category.api');
Route::post('category', 'AccountingController@category_create')->name('category.create');
Route::get('category/{id}/edit', 'AccountingController@category_edit')->name('category.edit');
Route::patch('category/{id}', 'AccountingController@category_update')->name('category.update');
Route::delete('category/{id}', 'AccountingController@category_delete')->name('category.delete');

// Get Select 2
Route::get('/get_costumer', 'AccountingController@get_costumer')->name('costumer.get');
Route::get('/get_payment', 'AccountingController@get_payment')->name('payment.get');
Route::get('/get_category', 'AccountingController@get_category')->name('category.get');
Route::get('/get_k', 'AccountingController@get_k')->name('k.get');


Route::post('/get_id_akun', 'AccountingController@get_id_akun')->name('get_id_akun.get');

// Report
Route::get('/income', 'AccountingController@income_index')->name('income.index');
Route::get('/expense', 'AccountingController@expense_index')->name('expense.index');
Route::get('/incomeexpense', 'AccountingController@incomeexpense_index')->name('incomeexpense.index');
Route::get('/buku_besar', 'AccountingController@buku_besar_index')->name('buku_besar.index');
Route::get('/buku_besar/api', 'AccountingController@buku_besar_api')->name('buku_besar.api');
Route::post('/export_buku_besar', 'AccountingController@export_buku_besar')->name('export.buku_besar');
Route::get('/view_buku_besar/{from}/{to}/{id}', 'AccountingController@view_buku_besar')->name('view.buku_besar'); 

Route::get('/jurnalreport', 'AccountingController@jurnalreport_index')->name('jurnalreport.index'); 
Route::post('/get_jurnal', 'AccountingController@get_jurnal')->name('get_jurnal'); 
Route::post('/update_saldo', 'AccountingController@update_saldo')->name('update_saldo'); 
Route::post('/jurnal_update', 'AccountingController@jurnal_update')->name('jurnal.update'); 
Route::get('/jurnalreport/api', 'AccountingController@jurnalreport_api')->name('jurnalreport.api');
Route::post('/export_jurnalreport', 'AccountingController@export_jurnalreport')->name('export.jurnalreport');
Route::get('/view_jurnal/{from}/{to}', 'AccountingController@view_jurnal')->name('view.jurnal'); 

Route::get('/neraca_saldo', 'AccountingController@neraca_saldo_index')->name('neraca_saldo.index');
Route::get('/neraca_saldo/api', 'AccountingController@neraca_saldo_api')->name('neraca_saldo.api');
Route::post('/export_neraca_saldo', 'AccountingController@export_neraca_saldo')->name('export.neraca_saldo');

/**
 * Work Sheet Report Routes
 */

Route::get('work_sheet', 'AccountingController@work_sheet_index')
->name('work_sheet.index');

Route::get('work_sheet/api', 'AccountingController@work_sheet_api')
->name('work_sheet.api');

Route::post('export_work_sheet', 'AccountingController@export_work_sheet')
->name('export.work_sheet');

/* End Work Sheet */




Route::get('/neraca', 'AccountingController@neraca_index')->name('neraca.index');
Route::get('/neraca_aktiva/api', 'AccountingController@neraca_aktiva_api')->name('neraca_aktiva.api');
Route::post('/export_neraca', 'AccountingController@export_neraca')->name('export.neraca');
Route::get('/laba_rugi', 'AccountingController@laba_rugi_index')->name('laba_rugi.index');
Route::get('/laba_rugi_income/api', 'AccountingController@laba_rugi_income_api')->name('laba_rugi_income.api');
Route::get('/laba_rugi_expense/api', 'AccountingController@laba_rugi_expense_api')->name('laba_rugi_expense.api');
Route::post('/get_laba', 'AccountingController@get_laba')->name('get_laba');
Route::post('/export_income_laba_rugi', 'AccountingController@export_income_laba_rugi')->name('export_income.laba_rugi');
Route::post('/saldo_akun', 'AccountingController@saldo_akun')->name('saldo.akun');

// Akun Route
Route::get('akun', 'AccountingController@akun_index')->name('akun.index');
Route::post('akun/api', 'AccountingController@akun_api')->name('akun.api');
Route::post('akun', 'AccountingController@akun_create')->name('akun.create');
Route::get('akun/{id}/edit', 'AccountingController@akun_edit')->name('akun.edit');
Route::patch('akun/{id}', 'AccountingController@akun_update')->name('akun.update');
Route::delete('akun/{id}', 'AccountingController@akun_delete')->name('akun.delete');

// Jurnal Route
Route::get('jurnal', 'AccountingController@jurnal_index')->name('jurnal.index');
Route::get('jurnal_penyesuaian', 'AccountingController@jurnal_index')->name('jurnal.index');
Route::post('jurnal', 'AccountingController@jurnal_create')->name('jurnal.create'); 
Route::get('jurnal/{id}/view', 'AccountingController@jurnal_view')->name('jurnal.view');
Route::get('jurnal/{id}/print', 'AccountingController@jurnal_print')->name('jurnal.print');
Route::post('jurnal/acc', 'AccountingController@jurnal_acc')->name('jurnal.acc');
Route::post('jurnal/cancel', 'AccountingController@jurnal_cancel')->name('jurnal.cancel');
Route::get('jurnal/api', 'AccountingController@jurnal_api')->name('jurnal.api'); 


Route::get('pembelian/view/{type}/{id}','AccountingController@pembelian_view')->name('pembelian_view');

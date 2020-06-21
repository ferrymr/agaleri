<?php

// Hutang Penambahan
Route::get('hutang_tambah', 'FinanceController@hutang_tambah_index')->name('hutang_tambah.index');
Route::get('hutang_tambah_bayar', 'FinanceController@hutang_tambah_bayar')->name('hutang_tambah.pembayaran');
Route::post('hutang_tambah', 'FinanceController@hutang_tambah_create')->name('hutang_tambah.create');
Route::get('hutang_tambah/{id}/view', 'FinanceController@hutang_tambah_view')->name('hutang_tambah.view');
Route::get('hutang_tambah/{id}/print', 'FinanceController@hutang_tambah_print')->name('hutang_tambah.print');
Route::post('hutang_tambah/acc', 'FinanceController@hutang_tambah_acc')->name('hutang_tambah.acc');
Route::post('hutang_tambah/cancel', 'FinanceController@hutang_tambah_cancel')->name('hutang_tambah.cancel');
Route::get('hutang_tambah/api', 'FinanceController@hutang_tambah_api')->name('hutang_tambah.api');
Route::get('hutang_tambah/delete', 'FinanceController@hutang_tambah_delete')->name('hutang_tambah.delete');

// Hutang Pembayaran
Route::get('hutang', 'FinanceController@hutang_index')->name('hutang.index');
Route::get('hutang_bayar', 'FinanceController@hutang_bayar')->name('hutang.pembayaran');
Route::post('hutang', 'FinanceController@hutang_create')->name('hutang.create');
Route::get('hutang/{id}/view', 'FinanceController@hutang_view')->name('hutang.view');
Route::get('hutang/{id}/print', 'FinanceController@hutang_print')->name('hutang.print');
Route::post('hutang/acc', 'FinanceController@hutang_acc')->name('hutang.acc');
Route::post('hutang/cancel', 'FinanceController@hutang_cancel')->name('hutang.cancel');
Route::get('hutang/api', 'FinanceController@hutang_api')->name('hutang.api');
Route::get('hutang_cmt/api', 'FinanceController@hutang_cmt_api')->name('hutang_cmt.api');
Route::get('hutang/delete', 'FinanceController@hutang_delete')->name('hutang.delete');


// Invoice & Penerimaan
Route::get('invoice', 'FinanceController@invoice_index')->name('invoice.index');
// Route::get('invoice_list', 'FinanceController@invoice_list')->name('invoice.list');
Route::post('invoice', 'FinanceController@invoice_create')->name('invoice.create');
Route::get('invoice/{id}/view', 'FinanceController@invoice_view')->name('invoice.view');
Route::get('invoice/{id}/print', 'FinanceController@invoice_print')->name('invoice.print');
Route::post('invoice/acc', 'FinanceController@invoice_acc')->name('invoice.acc');
Route::post('invoice/cancel', 'FinanceController@invoice_cancel')->name('invoice.cancel');
// Route::get('invoice/api', 'FinanceController@invoice_api')->name('invoice.api');
Route::get('invoice/delete', 'FinanceController@invoice_delete')->name('invoice.delete');
Route::get('bayar_invoice/{id}', 'FinanceController@bayar_invoice')->name('bayar_invoice'); 
Route::post('bayar_invoice', 'FinanceController@bayar_invoice_create')->name('bayar_invoice.create'); 

// Piutang
Route::get('piutang', 'FinanceController@piutang_index')->name('piutang.index');
Route::get('piutang/api', 'FinanceController@piutang_api')->name('piutang.api');

// Report
Route::get('/laporan_hutang/{kategori}', 'FinanceController@laporan_hutang_index')->name('laporan_hutang.index');
Route::get('/laporan_hutang/view/{from}/{to}/{type}/{kategori}/{id}', 'FinanceController@laporan_hutang_view')->name('laporan_hutang.view');
Route::get('/laporan_pembelian_bahan_baku/{kategori}', 'FinanceController@laporan_pembelian_bahan_baku_index')->name('laporan_pembelian_bahan_baku.index');
Route::get('/laporan_pembelian_bahan_baku/view/{kategori}/{from}/{to}/{id}', 'FinanceController@view_laporan_pembelian_bahan_baku')->name('view.laporan_pembelian_bahan_baku');
Route::get('/laporan_giro', 'FinanceController@laporan_giro_index')->name('laporan_giro.index');
Route::get('/laporan_giro/view/{from}/{to}/{kategori}/{status}', 'FinanceController@laporan_giro_view')->name('laporan_giro.view');
Route::get('/laporan_piutang', 'FinanceController@laporan_piutang_index')->name('laporan_piutang.index');
Route::get('/laporan_piutang/view/{from}/{to}/{status}', 'FinanceController@laporan_piutang_view')->name('laporan_piutang.view');
Route::get('/laporan_pengeluaran', 'FinanceController@laporan_pengeluaran_index')->name('laporan_pengeluaran.index');
Route::get('/laporan_pengeluaran/view/{from}/{to}/{id}', 'FinanceController@laporan_pengeluaran_view')->name('laporan_pengeluaran.view');


// Bayar Hutang CMT
Route::get('skb_keluar_finance', 'FinanceController@skb_keluar_finance_index')->name('skb_keluar_finance.index');
Route::get('get_skb_keluar_finance', 'FinanceController@get_skb_keluar_finance')->name('skb_keluar_finance.get');
Route::get('get_skb_masuk_finance', 'FinanceController@get_skb_masuk_finance')->name('skb_masuk_finance.get');
Route::get('get_skb_adjust_finance', 'FinanceController@get_skb_adjust_finance')->name('skb_adjust_finance.get');
Route::post('get_detail_skb_keluar_finance', 'FinanceController@get_detail_skb_keluar_finance')->name('detail_skb_keluar_finance.get');
Route::post('get_detail_skb_masuk_finance', 'FinanceController@get_detail_skb_masuk_finance')->name('detail_skb_masuk_finance.get');
Route::post('get_detail_skb_adjust_finance', 'FinanceController@get_detail_skb_adjust_finance')->name('detail_skb_adjust_finance.get');
Route::get('skb_masuk_finance', 'FinanceController@skb_masuk_finance_index')->name('skb_masuk_finance.index');
Route::post('skb_masuk_finance', 'FinanceController@skb_masuk_finance_create')->name('skb_masuk_finance.create');
Route::get('skb_adjust_finance', 'FinanceController@skb_adjust_finance_index')->name('skb_adjust_finance.index');
Route::post('skb_adjust_finance', 'FinanceController@skb_adjust_finance_create')->name('skb_adjust_finance.create');



// Giro
Route::get('giro_keluar', 'FinanceController@giro_keluar_index')->name('giro_keluar.index');
Route::post('giro_keluar', 'FinanceController@giro_keluar_create')->name('giro_keluar.create');
Route::post('giro_keluar_aprove', 'FinanceController@giro_keluar_aprove')->name('giro_keluar.aprove');
Route::get('giro_keluar_api', 'FinanceController@giro_keluar_api')->name('giro_keluar.api');

Route::get('giro_masuk', 'FinanceController@giro_masuk_index')->name('giro_masuk.index');
Route::post('giro_masuk', 'FinanceController@giro_masuk_create')->name('giro_masuk.create');
Route::post('giro_masuk_aprove', 'FinanceController@giro_masuk_aprove')->name('giro_masuk.aprove');
Route::get('giro_masuk_api', 'FinanceController@giro_masuk_api')->name('giro_masuk.api');


// Penjualan List

Route::get('penjualan', 'FinanceController@penjualan_index')->name('penjualan.index'); 
Route::get('penjualan/api', 'FinanceController@penjualan_api')->name('penjualan.api'); 
Route::get('penjualan/view/{id}', 'FinanceController@penjualan_view')->name('penjualan_view');


// Invoice
Route::get('invoice','FinanceController@invoice_index')->name('invoice.index');
Route::get('invoice_list','FinanceController@invoice_list')->name('invoice.list');
Route::post('invoice','FinanceController@invoice_create')->name('invoice.create');
Route::get('invoice/{id}/view','FinanceController@invoice_view')->name('invoice.view');
Route::get('invoice/{id}/print','FinanceController@invoice_print')->name('invoice.print');
Route::post('invoice/acc','FinanceController@invoice_acc')->name('invoice.acc');
Route::post('invoice/cancel','FinanceController@invoice_cancel')->name('invoice.cancel');
Route::get('invoice/api','FinanceController@invoice_api')->name('invoice.api');
Route::get('invoice/delete','FinanceController@invoice_delete')->name('invoice.delete');
  
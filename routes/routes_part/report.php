<?php

Route::get('report_transaksi', 'ReportController@report_transaksi_index');
// Route::get('v/{param}', 'ReportController@view_print_report_transaksi');
Route::get('view_print_report_transaksi/{param}/{from}/{to}', 'ReportController@view_print_report_transaksi');
Route::get('export_report_transaksi/{param}/{from}/{to}', 'ReportController@export_report_transaksi');

Route::get('report_stok', 'ReportController@report_stok_index'); 
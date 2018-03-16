<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('invoice', 'InvoiceController');
Route::get('invoice-send/{sendId}', 'InvoiceController@email');
Route::get('invoice-download/{downloadId}', 'InvoiceController@pdfDownload');

Route::get('i/{hash}', 'PublicController@view');
Route::get('p/{pHash}', 'PublicController@paid');

Route::resource('customers', 'CustomerController');

Route::get('my-data', 'MyDataController@show');
Route::put('my-data', 'MyDataController@save');

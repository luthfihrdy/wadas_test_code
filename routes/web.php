<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/barang', [App\Http\Controllers\BarangController::class, 'barang'])->name('barang');
Route::post('/barang/tambah', [App\Http\Controllers\BarangController::class, 'barangSubmit'])->name('barang_submit');
Route::put('/barang/update', [App\Http\Controllers\BarangController::class, 'barangUpdate'])->name('barang_update');
Route::delete('/barang/delete', [App\Http\Controllers\BarangController::class, 'barangDelete'])->name('barang_delete');

Route::get('/perusahaan', [App\Http\Controllers\PerusahaanController::class, 'perusahaan'])->name('perusahaan');
Route::post('/perusahaan/tambah', [App\Http\Controllers\PerusahaanController::class, 'perusahaanSubmit'])->name('perusahaan_submit');
Route::put('/perusahaan/update', [App\Http\Controllers\PerusahaanController::class, 'perusahaanUpdate'])->name('perusahaan_update');
Route::delete('/perusahaan/delete', [App\Http\Controllers\PerusahaanController::class, 'perusahaanDelete'])->name('perusahaan_delete');

Route::get('/transaksi', [App\Http\Controllers\TransaksiController::class, 'transaksi'])->name('transaksi');
Route::post('/transaksi/tambah', [App\Http\Controllers\TransaksiController::class, 'transaksiSubmit'])->name('transaksi_submit');
Route::get('/transaksi/cetak', [App\Http\Controllers\TransaksiController::class, 'transaksi_cetak'])->name('transaksi_cetak');


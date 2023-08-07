<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\PaketLaundryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/satuan', [SatuanController::class, 'index'])->name('satuan.index');
Route::post('/satuan/store', [SatuanController::class, 'store'])->name('satuan.store');
Route::put('/satuan/{id}/edit', [SatuanController::class, 'update'])->name('satuan.update');
Route::delete('/satuan/{satuan}', [SatuanController::class, 'destroy'])->name('satuan.destroy');
Route::get('/satuan/{id}/nonaktif', [SatuanController::class, 'nonaktif'])->name('satuan.nonaktif');
Route::get('/satuan/{id}/aktif', [SatuanController::class, 'aktif'])->name('satuan.aktif');

Route::get('/paket', [PaketController::class, 'index'])->name('paket.index');
Route::get('/paket/create', [PaketController::class, 'create'])->name('paket.create');
Route::post('/paket', [PaketController::class, 'store'])->name('paket.store');
Route::get('/paket/{id}/edit', [PaketController::class, 'edit'])->name('paket.edit');
Route::put('/paket/{id}', [PaketController::class, 'update'])->name('paket.update');
Route::delete('/paket/{id}', [PaketController::class, 'destroy'])->name('paket.destroy');
Route::get('/paket/{id}/nonaktif', [PaketController::class, 'nonaktif'])->name('paket.nonaktif');
Route::get('/paket/{id}/aktif', [PaketController::class, 'aktif'])->name('paket.aktif');
Route::get('/paket/filter ', [PaketController::class, 'filter']);

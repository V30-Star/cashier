<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LihatBarangController;
use App\Http\Controllers\authController;
use App\Http\Controllers\buatBarangController;
use App\Http\Controllers\keranjangController;
use App\Http\Controllers\historyController;
use App\Http\Controllers\CheckoutController;

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
    return view('main/home');
})->middleware('auth')->name('home');

Route::get('/auth/registration', [authController::class, 'register'])->name('register');
Route::post('/auth/registration', [authController::class, 'register_action'])->name('register.action');

Route::get('/auth/login', [authController::class, 'login'])->name('login');
Route::post('/auth/login', [authController::class, 'login_action'])->name('login.action');

Route::get('/main/home', [LihatBarangController::class, 'home'])->name('home');

Route::get('/main/lihatBarang', [LihatBarangController::class, 'lihatBarang'])->name('lihatBarang');
Route::delete('/main/lihatBarang/{kode_barang}', [LihatBarangController::class, 'delete'])->name('deleteBarang');
Route::get('/main/editBarang/{kode_barang}', [LihatBarangController::class, 'edit'])->name('editBarang');
Route::put('/main/updateBarang/{kode_barang}', [LihatBarangController::class, 'update'])->name('updateBarang');


Route::get('/main/buatBarang', [buatBarangController::class, 'buatBarang'])->name('buatBarang');
Route::post('/main/buatBarang', [buatBarangController::class, 'buatBarang_action'])->name('buatBarang.action');

Route::get('/main/keranjang', [keranjangController::class, 'keranjang'])->name('keranjang');
Route::post('/main/keranjang', [KeranjangController::class, 'addToKeranjang'])->name('addToKeranjang');
Route::post('main/keranjang/checkout', [KeranjangController::class, 'checkout'])->name('checkout');
Route::delete('/main/keranjang/{kode_barang}', [KeranjangController::class, 'removeFromKeranjang'])->name('removeFromKeranjang');
Route::delete('/main/hapusSemuaBarang', [keranjangController::class, 'hapusSemuaBarang'])->name('hapusSemuaBarang');
Route::get('/main/editKeranjang/{kode_barang}', [keranjangController::class, 'edit'])->name('editBarang');
Route::put('/main/updateKeranjang/{kode_barang}', [keranjangController::class, 'update'])->name('updateKeranjang');

Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout');
Route::get('/history', [historyController::class, 'index'])->name('history');
Route::get('/history/{id}', [historyController::class, 'show'])->name('history.show');
Route::delete('/history/{id}', [CheckoutController::class, 'delete'])->name('history.delete');




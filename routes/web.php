<?php

use App\Http\Controllers\AcaraController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndoRegionController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiDetailController;
use App\Models\Keranjang;
use App\Models\User;

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

// Route::get('/',[KeranjangController::class, 'CartCount']);

Route::get('/', function () {
    return view('konsumen.beranda');
});

Route::get('/virtualaccount', function () {
    return view('konsumen.virtualAccount');
});

Route::get('/chat', function () {
    return view('konsumen.chat');
});


Route::get('/listKeranjang', [AcaraController::class, 'index'])->middleware('auth');

Route::get('/profilekonsumen', function(){
    return view('konsumen.profile');
})->middleware("auth");

Route::get('/editProfile', function(){
    return view('konsumen.editprofile');
});

Route::get('/konsumen/keranjang', [KeranjangController::class, 'index']);
Route::get('/konsumen/keranjang/{IdAcara}', [KeranjangController::class, 'detailKeranjang']);

Route::get('/umkm', [UserController::class, 'umkmHome']);

Route::get('/konsumen/cari', [ProdukController::class,'konsumenIndex']);
Route::get('/konsumen/filter-produk',[ProdukController::class, 'filterProduk']);

Route::get('/pesananKonsumen', function(){
    return view('konsumen.pesanan');
});

Route::get('/detailPesanan', function(){
    return view('konsumen.detailPesanan');
});

Route::get('/tarikSaldo', function(){
    return view('konsumen.saldo');
});

Route::get('/tarikDebit', function(){
    return view('konsumen.debit');
});

Route::get('/tarikEmoney', function(){
    return view('konsumen.emoney');
});

Route::get('/tarikSaldoUMKM', function(){
    return view('umkm.saldo');
});

Route::get('/tarikDebitUMKM', function(){
    return view('umkm.debit');
});

Route::get('/tarikEmoneyUMKM', function(){
    return view('umkm.emoney');
});

Route::get('/pembayaran', function(){
    return view('konsumen.pembayaran');
});

Route::get('/pesananMasuk', function(){
    return view('umkm.pesananMasuk');
});

Route::get('/pesananUmkm', function(){
    return view('umkm.pesanan');
});

Route::get('/dashboard',[ProdukController::class,'index']);

Route::get('/tambahProduk', function(){
    return view('umkm.tambahProduk');
});

Route::get('/profileToko', function(){
    return view('umkm.profileToko');
});


Route::get('/editProduk/{IdProduk}', [ProdukController::class,'edit']);
Route::put('/umkm/updateProduk',[ProdukController::class,'update']);

Route::get('/editProfileToko',[LoginController::class,'editToko']);

Route::put('/umkm/update',[LoginController::class,'updateToko']);







Route::get('/konsumen/detailproduk/{IdProduk}',[ProdukController::class, 'show']);
Route::post('/konsumen/tambahAcara',[AcaraController::class,'store']);
Route::get('/konsumen/toko/{IdToko}',[UserController::class, 'detailToko']);
Route::post('/konsumen/addtocart',[KeranjangController::class, 'store']);
Route::post('/konsumen/deleteCart',[KeranjangController::class, 'destroy']);
Route::post('/konsumen/updateCart',[KeranjangController::class, 'update']);
Route::post('/konsumen/checkout', [KeranjangController::class, 'checkout']);
Route::post('/konsumen/bayar', [TransaksiController::class, 'store']);
Route::get('/konsumen/pembayaran/{IdTransaksi}', [TransaksiController::class, 'virtualaccount']);
Route::get('/konsumen/pesanan', [TransaksiController::class, 'index']);
Route::get('/konsumen/detailTransaksi/{IdTransaksi}', [TransaksiController::class, 'show']);
Route::post('/konsumen/bayar',[TransaksiController::class, 'pembayaranselesai']);

Route::get('/konsumen/disiapkan', [TransaksiController::class, 'disiapkan']);
Route::get('/konsumen/filter-pesanan',[TransaksiController::class, 'filterpesanan']);


Route::get('/loadCartCount', [KeranjangController::class, 'CartCount']);


Route::get('/umkm/pesanan', [TransaksiController::class, 'umkmindex']);















Route::post('/tambahProduk',[ProdukController::class,'store']);


Route::get('/editprofile',[LoginController::class,'edit']);
Route::put('/konsumen/update',[LoginController::class,'update']);

Route::group(['prefix'=>'register'], function(){
    // Route::get('/',[RegisterController::class,'index']);
    Route::get('/{roleId}',[RegisterController::class,'index']);
    Route::post('/',[RegisterController::class,'store']);

    Route::get('/', function(){
        return view('PilihRole');
    });
})->middleware('guest');

Route::post('api/fetch-kota', [RegisterController::class, 'fetchKota']);

Route::get('/login',[LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class,'store']);
Route::post('/logout',[LoginController::class,'logout']);

Route::get('/form',[IndoRegionController::class,'form'])->name('form');
Route::post('api/fetch-kota', [IndoRegionController::class, 'fetchState']);

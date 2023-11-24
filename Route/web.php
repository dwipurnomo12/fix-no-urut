<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DataAnggotaController;
use App\Http\Controllers\DataBarangMasukController;
use App\Http\Controllers\DataBukuController;
use App\Http\Controllers\DataKategoriController;
use App\Http\Controllers\WorkshopController;

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NoAksesController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PengembalianController1;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Pengembalian;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\PerbaikanController;
use App\Models\Perbaikan;
use App\Http\Controllers\DataMesinController;
use App\Http\Controllers\MesinImportEksportController;
use App\Http\Controllers\PopupDataMesinController;
use App\Models\KlasMesin;
use App\Http\Controllers\NoRegistrasiController;
use App\Models\KategoriMesin;
use App\Models\NoRegistrasi;
use App\Http\Controllers\KategoriMesinController;
use App\Http\Controllers\KlasMesinController;

use App\Http\Controllers\SearchController;
use App\Models\DataMesin;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Search;
use App\Http\Controllers\DropDownController;
use App\Models\Workshop;

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
/*Data Export */

Route::post('api/getklasmesin', [DataMesinController::class, 'getklasmesin']);

Route::resource('/data-mesin', DropDownController::class);
Route::get('/getKlasifikasi', [DropDownController::class, 'getKlasifikasi']);
Route::get('/data-mesin/{id}/edit', 'DataMesinController@edit');
Route::post('/data-mesin-update/{id}', [DataMesinController::class, 'update']);

Route::get('/get-latest-id', [DataMesinController::class, 'getLatestID']);
Route::get('/get-latest-mesin/{kategoriID}/{klasifikasiID}/{tahun}', [DataMesinController::class, 'getLatestmESIN']);
Route::get('/get-latest-mesin-by-id/{kategoriID}/{klasifikasiID}/{id}', [DataMesinController::class, 'getLatestbyId']);
Route::get('/get-latest-id/{kategoriID}/{klasifikasiID}', [DataMesinController::class, 'getLatestID']);
Route::get('/get-kategori-data', [DataMesinController::class, 'getKategoriData']);
Route::get('/get-klasifikasi-data/{kategori}', [DataMesinController::class, 'getKlasifikasiData']);


Route::get('/search', [SearchController::class, 'search']);
Route::get('/search', [SearchController::class, 'search'])->name('search');


Route::get('file-import-export', [MesinImportEksportController::class, 'ImportExport']);
Route::post('file-import', [MesinImportEksportController::class, 'DataMesinImport'])->name('file-import');
Route::get('file-export', [MesinImportEksportController::class, 'DataMesinExport'])->name('file-export');
/*DATA MESIN */

Route::get('qrcode-generate/{id}',[QRCodeController::class,'qrcodeView'])->name('qrcode-generate');
Route::resource('/data-mesin', DataMesinController::class)->middleware('auth', 'isAdmin');
// Add a route group for admin-only routes
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('data-mesin', DataMesinController::class)
        ->only(['edit', 'destroy']);
});

/*WORKSHOP*/
Route::resource('/lokasi-workshop-mesin', WorkshopController::class);
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('/lokasi-workshop-mesin', WorkshopController::class)
        ->only(['edit', 'destroy']);
});

/*KLASIFIKASI*/
Route::resource('/klasifikasi-mesin', KlasMesinController::class)->middleware('auth', 'isAdmin');
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('/klasifikasi-mesin', KlasMesinController::class)
        ->only(['edit', 'destroy']);
});

Route::resource('/registrasi-mesin', NoRegistrasiController::class);

/*KATEGORI*/
Route::resource('/kategori-mesin', KategoriMesinController::class);
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('/kategori-mesin', KategoriMesinController::class)
        ->only(['edit', 'destroy']);
});

/*TIDAK BISA DIAKSES*/
Route::get('/tidak-memilki-akses', [NoAksesController::class, 'index']);


Route::get('/qrcode/{id}', [QRCodeController::class, 'index']);

Route::get('/status', [StatusController::class, 'index']);
Route::get('/perbaikan', [PerbaikanController::class, 'index']);
Route::resource('/perbaikan', PerbaikanController::class);


Route::get('/', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/pegawai/pdf', [DataAnggotaController::class, 'cetak_pdf'])->middleware(['auth', 'isAdmin']);
Route::resource('/pegawai', DataAnggotaController::class)->middleware('auth', 'isAdmin');
Route::resource('/datapetugas', UserController::class)->middleware(['auth', 'isAdmin']);
Route::get('/petugas/pdf', [UserController::class, 'cetak_pdf']);
Route::resource('/datamesin', DataBukuController::class);
Route::get('/mesin/printpdf', [DataBukuController::class, 'cetak_pdf']);
Route::get('/mesin/printqrcodepdf', [DataBukuController::class, 'cetakQRCodePDF'])->name('mesin.printqrcodepdf');
Route::resource('/datakategori', DataKategoriController::class);
Route::get('/kategori/printpdf', [DataKategoriController::class, 'cetak_pdf']);
Route::resource('/pinjam', PeminjamanController::class);
Route::get('/datapinjam/printpdf', [PeminjamanController::class, 'cetak_pdf']);
Route::get('/transaksipengembalian/{id}', [TransaksiController::class, 'pengembalian']);
Route::resource('/pengembalian', PengembalianController::class);
Route::get('/datapengembalian/printpdf', [PengembalianController::class, 'cetak_pdf']);
Route::resource('/laporan', LaporanController::class);


/*DATA BARANG */
Route::resource('/data-masuk', DataBarangMasukController::class);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

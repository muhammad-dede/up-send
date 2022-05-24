<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', [App\Http\Controllers\Apps\BerandaController::class, 'index'])->name('home');
    Route::resource('/user', App\Http\Controllers\Apps\UserController::class)->middleware(['role:admin']);
    Route::resource('/matakuliah', App\Http\Controllers\Apps\MatakuliahController::class);
    Route::resource('/mahasiswa', App\Http\Controllers\Apps\MahasiswaController::class)->middleware(['role:admin']);
    // Scan QR Menu
    Route::get('/scan-qr', [App\Http\Controllers\Apps\ScanController::class, 'index'])->name('scan.index');
    Route::post('/scan-qr/search', [App\Http\Controllers\Apps\ScanController::class, 'search'])->name('scan.search');
    // Absensi Menu
    Route::get('/kelas', [App\Http\Controllers\Apps\KelasController::class, 'index'])->name('kelas.index');
    Route::get('/kelas/create', [App\Http\Controllers\Apps\KelasController::class, 'create'])->name('kelas.create');
    Route::post('/kelas/store', [App\Http\Controllers\Apps\KelasController::class, 'store'])->name('kelas.store');
    Route::get('/kelas/{id}/edit', [App\Http\Controllers\Apps\KelasController::class, 'edit'])->name('kelas.edit');
    Route::put('/kelas/update/{id}', [App\Http\Controllers\Apps\KelasController::class, 'update'])->name('kelas.update');
    Route::get('/kelas/show/{id}', [App\Http\Controllers\Apps\KelasController::class, 'show'])->name('kelas.show');
    Route::get('/kelas/cetak/{qr_code}', [App\Http\Controllers\Apps\KelasController::class, 'cetak'])->name('kelas.cetak');

    Route::get('/absensi', [App\Http\Controllers\Apps\AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/absensi/create', [App\Http\Controllers\Apps\AbsensiController::class, 'create'])->name('absensi.create');
    Route::post('/absensi/store', [App\Http\Controllers\Apps\AbsensiController::class, 'store'])->name('absensi.store');
    Route::get('/absensi/{id}/edit', [App\Http\Controllers\Apps\AbsensiController::class, 'edit'])->name('absensi.edit');
    Route::put('/absensi/update/{id}', [App\Http\Controllers\Apps\AbsensiController::class, 'update'])->name('absensi.update');
    Route::get('/absensi/show/{id}', [App\Http\Controllers\Apps\AbsensiController::class, 'show'])->name('absensi.show');
    Route::get('/absensi/show/absensi-detail/{id_absensi}', [App\Http\Controllers\Apps\AbsensiController::class, 'getAbsensiDetail'])->name('absensi.getAbsensiDetail');
    Route::post('/absensi/scanning', [App\Http\Controllers\Apps\AbsensiController::class, 'scanning'])->name('absensi.scanning');
    Route::delete('/absensi/destroy/detail/{id}', [App\Http\Controllers\Apps\AbsensiController::class, 'destroyDetail'])->name('absensi.destroy.detail');

    Route::get('/export/excel/absensi/{id_absensi}', [App\Http\Controllers\Apps\ExportController::class, 'exportExcelAbsensi'])->name('export.excel.absensi');
    // Pengaturan
    Route::get('/pengaturan/akun', [App\Http\Controllers\Apps\PengaturanController::class, 'akun'])->name('pengaturan.akun');
    Route::post('/pengaturan/akun/update', [App\Http\Controllers\Apps\PengaturanController::class, 'akunUpdate'])->name('pengaturan.akun.update');
});

Auth::routes(['register' => false, 'verify' => false]);

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Prodi;
use App\Http\Controllers\Author\DashboardController as AuthorDashboard;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['as'=>'admin.', 'prefix'=>'admin', 'middleware'=>['auth', 'admin']], function() {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('prodi', [Prodi::class, 'index'])->name('prodi');
    //Route::get('prodi', 'App\Http\Controllers\Admin\Prodi@index');
});

Route::group(['as'=>'author.', 'prefix'=>'author', 'middleware'=>['auth', 'author']], function() {
    Route::get('dashboard', [AuthorDashboard::class, 'index'])->name('dashboard');
});

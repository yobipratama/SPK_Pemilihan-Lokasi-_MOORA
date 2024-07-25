<?php

use App\Http\Controllers\User\AlternatifController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\PenilaianController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Support\Facades\Route;

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


Route::middleware('guest')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/','index')->name('login.index');
        Route::post('login','login')->name('login.process');
        Route::get('/logout', 'logout')->name('logout')->withoutMiddleware('guest');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('/profile')->group(function(){
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/edit', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('change.password');
        Route::post('/change-password', [ProfileController::class, 'updatePassword'])->name('change.password');
    });
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('/dashboard/admin')->group(function(){
        Route::get('/', function(){
            $alternatif = Alternatif::count();
            $kriteria = Kriteria::count();
            $penilaian = Penilaian::count();

            return view('admin.index', [
                'alternatif' => $alternatif,
                'kriteria' => $kriteria,
                'penilaian' => $penilaian,
            ]);
        })->name('admin.dashboard');
        Route::prefix('/owner')->group(function(){
            Route::get('/', [UserController::class, 'index'])->name('admin.owner.index');
            Route::get('/add', [UserController::class, 'create'])->name('admin.owner.add');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.owner.edit');
            Route::post('/store', [UserController::class, 'store'])->name('admin.owner.store');
            Route::post('/update', [UserController::class, 'update'])->name('admin.owner.update');
            Route::get('/{id}', [UserController::class, 'destroy'])->name('admin.owner.destroy');
        });
        Route::prefix('/kriteria')->group(function(){
            Route::get('/', [KriteriaController::class, 'index'])->name('admin.kriteria.index');
            Route::get('/add', [KriteriaController::class, 'add'])->name('admin.kriteria.add');
            Route::get('/edit/{id}', [KriteriaController::class, 'edit'])->name('admin.kriteria.edit');
            Route::post('/store', [KriteriaController::class, 'store'])->name('admin.kriteria.store');
            Route::post('/storesubkriteria', [KriteriaController::class, 'storesubkriteria'])->name('admin.kriteria.store_sub');
            Route::post('/update', [KriteriaController::class, 'update'])->name('admin.kriteria.update');
            Route::get('/{id}', [KriteriaController::class, 'destroy'])->name('admin.kriteria.destroy');
        });
        Route::get('/detail-kriteria', [KriteriaController::class, 'detail'])->name('admin.kriteria.detail');

    });
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::prefix('/dashboard/user')->group(function(){
        Route::get('/', function(){
            $alternatif = Alternatif::count();
            $kriteria = Kriteria::count();
            $penilaian = Penilaian::count();

            return view('user.index', [
                'alternatif' => $alternatif,
                'kriteria' => $kriteria,
                'penilaian' => $penilaian,
            ]);
        })->name('user.dashboard');
        Route::prefix('/penilaian')->group(function(){
            Route::get('/', [PenilaianController::class, 'index'])->name('user.penilaian.index');
            Route::get('/history', [PenilaianController::class, 'history'])->name('user.penilaian.history');
            Route::get('/history/{id}', [PenilaianController::class, 'detail_history'])->name('user.penilaian.detail_history');
            Route::post('/', [PenilaianController::class, 'store'])->name('user.penilaian.store');
            Route::get('/generate-pdf/{id}', [PenilaianController::class, 'generatePdf'])->name('user.penilaian.pdf');
        });
        Route::prefix('/alternatif')->group(function(){
            Route::get('/', [AlternatifController::class, 'index'])->name('user.alternatif.index');
            Route::get('/add', [AlternatifController::class, 'add'])->name('user.alternatif.add');
            Route::get('/edit/{id}', [AlternatifController::class, 'edit'])->name('user.alternatif.edit');
            Route::post('/store', [AlternatifController::class, 'store'])->name('user.alternatif.store');
            Route::post('/update', [AlternatifController::class, 'update'])->name('user.alternatif.update');
            Route::get('/{id}', [AlternatifController::class, 'destroy'])->name('user.alternatif.destroy');
        });
    });
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\admin;

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

Route::prefix('/admin')->group(function () {

    // XEM CHI TIẾT
    Route::prefix('xemchitiet')->group(function () {
        Route::get('/trienlam/{id}', function () {
            return view('admin.Xemchitiet.Trienlam');
        });

        Route::get('danhmuc/{id}', function () {
            return view('admin.Xemchitiet.Danhmuc');
        });
        Route::get('anhtrienlam/{id}', function () {
            return view('admin.Xemchitiet.Anhtrienlam');
        });
        Route::get('dangkytrienlam/{id}', function () {
            return view('admin.Xemchitiet.Dangkytrienlam');
        });

        Route::post('{name}/{id}', [admin::class, 'show']);
        
    });

    // SỬA
    Route::post('concat', [admin::class, 'edit2']);
    Route::prefix('sua')->group(function () {
        Route::get('trienlam/{id}', function () {
            return view('admin.Sua.Trienlam');
        });
        Route::get('danhmuc/{id}', function () {
            return view('admin.Sua.Danhmuc');
        });
        Route::get('anhtrienlam/{id}', function () {
            return view('admin.Sua.Anhtrienlam');
        });
        
        Route::post('sua/{name}/{id}', [admin::class, 'edit2']);
        Route::post('{name}/{id}', [admin::class, 'edit']);
        
    });

    // XÓA
    Route::prefix('xoa')->group(function () {
        Route::post('{name}/{id}', [admin::class, 'destroy']);
    });

    // CHẤP NHẬN

    Route::prefix('chapnhan')->group(function () {
        Route::post('{name}/{id}', [admin::class, 'accept']);
    });

    // 
    Route::get('/', function () {
        return view('admin.Trangchu.Trangchu');
    })->name('trangchu');

    Route::get('/quanlytrienlam', function () {
        return view('admin.Quanly.Trienlam');
    })->name('quanlytrienlam');


    Route::get('/quanlydanhmuc', function () {
        return view('admin.Quanly.Danhmuc');
    })->name('quanlydanhmuc');

    Route::get('/quanlynguoidung', function () {
        return view('admin.Quanly.Nguoidung');
    })->name('quanlynguoidung');

    Route::get('/quanlybinhluan', function () {
        return view('admin.Quanly.Binhluan');
    })->name('quanlybinhluan');

    Route::get('/quanlyanhtrienlam', function () {
        return view('admin.Quanly.Anhtrienlam');
    })->name('quanlyanhtrienlam');

    Route::get('/quanlydangkytrienlam', function () {
        return view('admin.Quanly.Dangkytrienlam');
    })->name('quanlydangkytrienlam');

    Route::get('/themtrienlam', function () {
        return view('admin.Them.Trienlam');
    })->name('themtrienlam');

    Route::get('/themdanhmuc', function () {
        return view('admin.Them.Danhmuc');
    })->name('themdanhmuc');

    Route::get('/themanhtrienlam', function () {
        return view('admin.Them.Anhtrienlam');
    })->name('themanhtrienlam');

    Route::post('/{name}', [admin::class, 'index']);
});
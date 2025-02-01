<?php

use App\Http\Controllers\PrinterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
// Route::get('/dang-nhap', [HomeController::class, 'dangNhap'])->name('dang-nhap')->middleware('guest');
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('index'); // Nếu đã đăng nhập, chuyển hướng đến trang chủ
    }
    return redirect()->route('dang_nhap'); // Nếu chưa đăng nhập, chuyển hướng đến đăng nhập
});
Route::get('/', [PrinterController::class, 'dang_nhap'])->name('dang_nhap')->middleware('guest');
Route::post('/xu_ly_dang_nhap', [PrinterController::class, 'xu_ly_dang_nhap'])->name('xu_ly_dang_nhap')->middleware('guest');

Route::middleware(['auth'])->group(
    function () {
        Route::get('/export', [PrinterController::class, 'export'])->name('export')->middleware('auth');
        Route::get('/xoa_du_lieu', [PrinterController::class, 'xoa_du_lieu'])->name('xoa_du_lieu')->middleware('auth');
        Route::get('/trang_chu', [PrinterController::class, 'index'])->name('index')->middleware('auth');
        Route::get('/bao_cao', [PrinterController::class, 'bao_cao'])->name('bao_cao')->middleware('auth');
        Route::get('/dang_xuat', [PrinterController::class, 'dang_xuat'])->name('dang_xuat')->middleware('auth');

        Route::get('/quan_ly_muc_in', [PrinterController::class, 'quan_ly_muc_in'])->name('quan_ly_muc_in')->middleware('auth');
        Route::post('/them_muc_in', [PrinterController::class, 'them_muc_in'])->name('them_muc_in')->middleware('auth');
        Route::get('/chi_tiet_muc_in/{id}', [PrinterController::class, 'chi_tiet_muc_in'])->name('chi_tiet_muc_in')->middleware('auth');
        Route::get('/xoa_muc_in/{id}/{kho}', [PrinterController::class, 'xoa_muc_in'])->name('xoa_muc_in')->middleware('auth');
        Route::post('/them_muc_bom/{id}', [PrinterController::class, 'them_muc_bom'])->name('them_muc_bom')->middleware('auth');
        Route::post('/con_muc/{id_muc_in_sua}', [PrinterController::class, 'con_muc'])->name('con_muc')->middleware('auth');
        Route::get('/xoa_muc_in_bao_bom/{id_muc_in_sua}/{kho}', [PrinterController::class, 'xoa_muc_in_bao_bom'])->name('xoa_muc_in_bao_bom')->middleware('auth');
        Route::get('/lich_su_chi_tiet_muc_in/{id}/{kho}', [PrinterController::class, 'lich_su_chi_tiet_muc_in'])->name('lich_su_chi_tiet_muc_in')->middleware('auth');
        Route::post('/trang_thai_muc_in/{id}', [PrinterController::class, 'trang_thai_muc_in'])->name('trang_thai_muc_in')->middleware('auth');
        Route::post('/bao_hong_thay_linh_kien_muc_in/{id}', [PrinterController::class, 'bao_hong_thay_linh_kien_muc_in'])->name('bao_hong_thay_linh_kien_muc_in')->middleware('auth');




        Route::get('/quan_ly_may_in', [PrinterController::class, 'quan_ly_may_in'])->name('quan_ly_may_in')->middleware('auth');
        Route::get('/xoa_may_in/{id}/{kho}', [PrinterController::class, 'xoa_may_in'])->name('xoa_may_in')->middleware('auth');
        Route::get('/lich_su_chi_tiet_may_in/{id}/{kho}', [PrinterController::class, 'lich_su_chi_tiet_may_in'])->name('lich_su_chi_tiet_may_in')->middleware('auth');
        Route::post('/them_may_in', [PrinterController::class, 'them_may_in'])->name('them_may_in')->middleware('auth');
        Route::post('/trang_thai_may_in/{id}', [PrinterController::class, 'trang_thai_may_in'])->name('trang_thai_may_in')->middleware('auth');
        Route::post('/bao_hong_thay_linh_kien_may_in/{id}', [PrinterController::class, 'bao_hong_thay_linh_kien_may_in'])->name('bao_hong_thay_linh_kien_may_in')->middleware('auth');
        Route::get('/xoa_may_in_bao_sua/{id}/{kho}', [PrinterController::class, 'xoa_may_in_bao_sua'])->name('xoa_may_in_bao_sua')->middleware('auth');
        Route::post('/them_may_in_sua/{id}', [PrinterController::class, 'them_may_in_sua'])->name('them_may_in_sua')->middleware('auth');


        Route::post('/them_so_luong_binh_muc', [PrinterController::class, 'them_so_luong_binh_muc'])->name('them_so_luong_binh_muc')->middleware('auth');
        Route::post('/cap_nhat_so_luong_muc', [PrinterController::class, 'cap_nhat_so_luong_muc'])->name('cap_nhat_so_luong_muc')->middleware('auth');
        Route::get('/xem_bao_cao', [PrinterController::class, 'xem_bao_cao'])->name('xem_bao_cao')->middleware('auth');
    });





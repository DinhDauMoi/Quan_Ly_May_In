<?php

namespace App\Http\Controllers;

use App\Models\bao_cao;
use App\Models\kho;
use App\Models\may_in;
use App\Models\muc_in;
use App\Models\sua_may_in;
use App\Models\sua_muc_in;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\alert;
use App\Exports\BaoCao;
use Maatwebsite\Excel\Facades\Excel;

class PrinterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function xoa_du_lieu(Request $request){
        if($request->mat_khau == 220102171102){
            sua_may_in::truncate();
            sua_muc_in::truncate();
            bao_cao::truncate();
            return back()->with('success', "Đã xóa tất cả dữ liệu");
        }else{
            return back()->with('error', 'Mật khẩu không đúng');
        }
    }
    //sua_may_in::onlyTrashed()->restore();

    public function export()
    {
        return Excel::download(new BaoCao, 'bao_cao.xlsx');
    }

    public function dang_nhap(){
        return view('dang_nhap');
    }
    public function xu_ly_dang_nhap(Request $request){
        if(Auth::attempt(['ten_dang_nhap'=> $request->ten_dang_nhap, 'password'=> $request->mat_khau])){
            return redirect()->route('index');
        }else{
            return back()->with('error', 'Đăng nhập thất bại');
        }
    }
    public function index()
    {

        $get_date = Carbon::now()->format('Y-m-d');;

        $sua_may_in = sua_may_in::whereDate("ngay_bao_hong", $get_date)->get();
        $kho_groups = $sua_may_in->groupBy('kho');
        $sua_muc_in = sua_muc_in::whereDate("ngay_bom_muc", $get_date)->get();
        $kho_groups_muc = $sua_muc_in->groupBy('kho');
        $so_luong_muc_in = sua_muc_in::whereDate("ngay_bom_muc", $get_date)->count();
        $so_luong_may_in = sua_may_in::whereDate("ngay_bao_hong", $get_date)->count();
        return view("trang_chu", ['kho_groups' => $kho_groups, 'kho_groups_muc' => $kho_groups_muc, "sua_may_in" => $sua_may_in, "sua_muc_in" => $sua_muc_in, 'so_luong_muc_in' => $so_luong_muc_in, 'so_luong_may_in' => $so_luong_may_in]);
    }
    public function dang_xuat()
    {

        Auth::logout();
        // session()->flush();
        return redirect()->route('dang_nhap');
    }
    // public function bao_cao(){
    //     return view("bao_cao");
    // }
    public function quan_ly_muc_in()
    {
        $muc_in = muc_in::where('trang_thai', 0)->orderBy('id_muc_in', 'asc')->get();
        $kho_groups = $muc_in->groupBy('kho');
        $muc_in_hong = muc_in::where('trang_thai', 1)->orderBy('id_muc_in', 'asc')->get();
        $kho_groups_hong = $muc_in_hong->groupBy('kho');
        $kho = kho::all();
        return view("muc_in.quan_ly_muc_in", ["kho_groups" => $kho_groups, "muc_in" => $muc_in, "kho_groups_hong" => $kho_groups_hong, "muc_in_hong" => $muc_in_hong, "kho" => $kho]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function quan_ly_may_in()
    {
        $may_in = may_in::where('trang_thai', 0)->orderBy('id_may_in', 'asc')->get();
        $may_in_hu = may_in::where('trang_thai', 1)->orderBy('id_may_in', 'asc')->get();
        $kho_groups = $may_in->groupBy('kho');
        $kho_groups_hu = $may_in_hu->groupBy('kho');
        $kho = kho::all();
        return view("may_in.quan_ly_may_in", ["may_in" => $may_in, "may_in_hu" => $may_in_hu, "kho" => $kho, "kho_groups" => $kho_groups, "kho_groups_hu" => $kho_groups_hu]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function them_muc_in(Request $request)
    {
        if ($request->id_muc_in == "" || $request->kho == "") {
            return back()->with('error', 'Vui lòng điền đầy đủ thông tin');
        }
        $muc_in = muc_in::where('id_muc_in', $request->id_muc_in)->where('kho', $request->kho)->first();
        if (!$muc_in) {
            muc_in::create([
                'id_muc_in' => $request->id_muc_in,
                'kho' => $request->kho,
                'trang_thai' => "0",
                'ghi_chu' => $request->ghi_chu,
            ]);
            return back()->with('success', "");
        } else {
            return back()->with('error', 'ĐÃ TỒN TẠI MỰC IN NÀY');
        }
    }
    public function bao_hong_thay_linh_kien_muc_in($id, Request $request)
    {
        $get_date = Carbon::now()->format('Y-m-d');
        sua_muc_in::where('id_muc_in_sua', $id)->where('kho', $request->kho)->where('ngay_bom_muc', $get_date)->update([
            'thay_drum' => $request->has('thay_drum') ? $get_date : null,
            'ghi_chu' => $request->ghi_chu
        ]);
        return back()->with('success', "");
    }
    public function bao_hong_thay_linh_kien_may_in($id, Request $request)
    {
        $get_date = Carbon::now()->format('Y-m-d');
        sua_may_in::where('id_may_in_sua', $id)->where('kho', $request->kho)->where('ngay_bao_hong', $get_date)->update([
            'thay_bao_lua' => $request->has('thay_bao_lua') ? $get_date : null,
            'thay_rulo' => $request->has('thay_rulo') ? $get_date : null,
            'bao_tri' => $request->has('bao_tri') ? $get_date : null,
            'ghi_chu' => $request->ghi_chu
        ]);
        return back()->with('success', "");
    }
    /**
     * Display the specified resource.
     */
    public function them_may_in(Request $request)
    {
        if($request->id_may_in =="" || $request->kho==""){
            return back()->with('error','Vui lòng điền đầy đủ thông tin');
        }
        $may_in = may_in::where('id_may_in', $request->id_may_in)->where('kho', $request->kho)->first();
        if (!$may_in) {
            may_in::create([
                'id_may_in' => $request->id_may_in,
                'kho' => $request->kho,
                'trang_thai' => 0,
                'ghi_chu' => $request->ghi_chu,
            ]);
            return back()->with('success', "");
        } else {
            return back()->with('error', 'ĐÃ TỒN TẠI MÁY IN NÀY');
        }
    }
    public function trang_thai_may_in($id, Request $request)
    {
        if ($request->trang_thai == 0) {
            may_in::where('id_may_in', $id)->where('kho',$request->kho)->update([
                'trang_thai' => 1,
            ]);
            return back()->with('success', "");
        } else {
            may_in::where('id_may_in', $id)->where('kho', $request->kho)->update([
                'trang_thai' => 0,
            ]);
            return back()->with('success', "");
        }
    }
    public function trang_thai_muc_in($id, Request $request)
    {
        if ($request->trang_thai == 0) {
            muc_in::where('id_muc_in', $id)->where('kho', $request->kho)->update([
                'trang_thai' => 1,
            ]);
            return back()->with('success', "");
        } else {
            muc_in::where('id_muc_in', $id)->where('kho', $request->kho)->update([
                'trang_thai' => 0,
            ]);
            return back()->with('success', "");
        }
    }
    public function xoa_may_in($id, $kho)
    {
        may_in::where('id_may_in', $id)->where('kho', $kho)->delete();
        return back()->with('success', "");
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function lich_su_chi_tiet_muc_in($id, $kho)
    {
        $lich_su_bom_muc = sua_muc_in::where('id_muc_in_sua', $id)->where('kho', $kho)->orderBy('ngay_bom_muc', 'desc')->get();
        return view('muc_in.lich_su_sua_chua_muc_in', ['lich_su_bom_muc' => $lich_su_bom_muc]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function lich_su_chi_tiet_may_in($id, $kho)
    {
        $lich_sua_sua_may = sua_may_in::where('id_may_in_sua', $id)->where('kho', $kho)->orderBy('ngay_bao_hong', 'desc')->get();
        return view('may_in.lich_su_sua_chua_may_in', ['lich_sua_sua_may' => $lich_sua_sua_may]);
    }
    public function them_may_in_sua(Request $request, $id)
    {
        $ngay_hien_tai = Carbon::now()->format('Y-m-d');
        $sua_may_in = sua_may_in::where('id_may_in_sua', $id)->where('kho',$request->kho)->where('ngay_bao_hong', $ngay_hien_tai)->first();
        if (!$sua_may_in) {
            sua_may_in::create([
                'id_may_in_sua' => $request->id_may_in_sua,
                'kho' => $request->kho,
                'ngay_bao_hong' => $ngay_hien_tai,
            ]);
            return back()->with('success', "");
        } else {
            return back()->with('error', 'MÁY IN NÀY ĐÃ ĐƯỢC BÁO');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function xoa_muc_in($id, $kho)
    {
        muc_in::where('id_muc_in', $id)->where('kho', $kho)->delete();
        return back()->with('success', "");
    }
    public function them_muc_bom(Request $request, $id)
    {
        $ngay_hien_tai = Carbon::now()->format('Y-m-d');
        $them_muc_in = sua_muc_in::where('id_muc_in_sua', $id)->where('kho',$request->kho)->where('ngay_bom_muc', $ngay_hien_tai)->first();
        if (!$them_muc_in) {
            sua_muc_in::create([
                'id_muc_in_sua' => $request->id_may,
                'kho' => $request->kho,
                'ngay_bom_muc' => $ngay_hien_tai,
                'tinh_trang_muc' => 0,
            ]);
            return back()->with('success', "");
        } else {
            return back()->with('error', 'MỰC IN NÀY ĐÃ ĐƯỢC BÁO');
        }
    }
    public function con_muc(Request $request, $id)
    {
        $get_date = Carbon::now()->format('Y-m-d');
        if ($request->tinh_trang_muc == 0) {
            sua_muc_in::where('id_muc_in_sua', $id)->where('ngay_bom_muc', $get_date)->update([
                'tinh_trang_muc' => 1,
            ]);
            return back()->with('success', "");
        } else {
            sua_muc_in::where('id_muc_in_sua', $id)->where('ngay_bom_muc', $get_date)->update([
                'tinh_trang_muc' => 0,
            ]);
            return back()->with('success', "");
        }
    }
    public function xoa_muc_in_bao_bom($id, $kho)
    {
        $get_date = Carbon::now()->format('Y-m-d');;
        sua_muc_in::where('id_muc_in_sua', $id)->where('kho', $kho)->where('ngay_bom_muc', $get_date)->delete();
        return back()->with('success', "");
    }
    public function xoa_may_in_bao_sua($id, $kho)
    {
        $get_date = Carbon::now()->format('Y-m-d');
        sua_may_in::where('id_may_in_sua', $id)->where('kho', $kho)->where('ngay_bao_hong', $get_date)->delete();
        return back()->with('success', "");
    }
    public function them_so_luong_binh_muc(Request $request)
    {
        $get_date = Carbon::now()->format('Y-m-d');
        $tim = bao_cao::where('ngay', $get_date)->first();
        if (!$tim) {
            bao_cao::create([
                'ngay' => $get_date,
                'so_luong' => $request->so_luong
            ]);
            return back()->with('success', "");
        } else {
            return back()->with('error', 'ĐÃ THÊM SỐ LƯỢNG MỰC');
        }
    }
    public function cap_nhat_so_luong_muc(Request $request)
    {
        $get_date = Carbon::now()->format('Y-m-d');

        $sl = bao_cao::where('ngay',$get_date)->first();
        if($request->so_luong == $sl->so_luong){
            return back()->with('error','Số lượng không thay đổi');
        }
        bao_cao::where('ngay', $get_date)->update([
            'so_luong' => $request->so_luong
        ]);
        return back()->with('success', "");
    }
    public function bao_cao()
    {
        $get_date = Carbon::now()->format('Y-m-d');
        $bao_cao = bao_cao::where('ngay', $get_date)->first();
        $sua_may_in = sua_may_in::where('ngay_bao_hong', $get_date)->orderBy('kho', 'asc')->get();
        $sua_muc_in_het = sua_muc_in::where('ngay_bom_muc', $get_date)->where('tinh_trang_muc', 0)->orderBy('kho', 'asc')->get();
        $sua_muc_in_con = sua_muc_in::where('ngay_bom_muc', $get_date)->where('tinh_trang_muc', 1)->orderBy('kho', 'asc')->get();
        $sua_muc_in_het_count = sua_muc_in::where('ngay_bom_muc', $get_date)->where('tinh_trang_muc', 0)->count();
        $sua_muc_in_con_count = sua_muc_in::where('ngay_bom_muc', $get_date)->where('tinh_trang_muc', 1)->count();

        return view('bao_cao', [
            'bao_cao' => $bao_cao,
            'sua_may_in' => $sua_may_in,
            'sua_muc_in_het' => $sua_muc_in_het,
            'sua_muc_in_con' => $sua_muc_in_con,
            'get_day' => $get_date,
            'sua_muc_in_het_count' => $sua_muc_in_het_count,
            'sua_muc_in_con_count' => $sua_muc_in_con_count
        ]);
    }
    public function xem_bao_cao(Request $request)
    {
        $get_date = Carbon::now()->format('Y-m-d');
        $ngay_bao_cao = $request->ngay_bao_cao;
        if($ngay_bao_cao == ""){
            return back()->with('error', 'CHƯA CHỌN NGÀY XEM BÁO CÁO');
        }
        $ngay_duoc_chon = $request->ngay_bao_cao;
        $xem_bao_cao = bao_cao::where('ngay', $ngay_bao_cao)->first();
        if ($xem_bao_cao) {
            $xem_muc_in = sua_muc_in::where('ngay_bom_muc', $ngay_bao_cao)->where('tinh_trang_muc',0)->orderBy('kho', 'asc')->get();
            $xem_muc_in_con = sua_muc_in::where('ngay_bom_muc', $ngay_bao_cao)->where('tinh_trang_muc', 1)->orderBy('kho', 'asc')->get();
            $xem_may_in = sua_may_in::where('ngay_bao_hong', $ngay_bao_cao)->orderBy('kho', 'asc')->get();
            return view('xem_bao_cao', [
                'xem_bao_cao' => $xem_bao_cao,
                'xem_muc_in' => $xem_muc_in,
                'xem_may_in' => $xem_may_in,
                'ngay_duoc_chon'=> $ngay_duoc_chon,
                'xem_muc_in_con'=> $xem_muc_in_con
            ]);
        } else {
            return back()->with('error', 'KHÔNG CÓ DỮ LIỆU NGÀY ' . $ngay_bao_cao);
        }
    }

}

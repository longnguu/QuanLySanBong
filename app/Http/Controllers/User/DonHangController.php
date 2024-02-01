<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ChiTietThueSan;
use App\Models\DonHang;
use App\Models\LichSuNap;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use MongoDB\Driver\Session;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $donhang=\Illuminate\Support\Facades\DB::table('donhang')
//            ->leftJoin('chitietthuesan','donhang.id','=','chitietthuesan.maDonHang')
            ->where('maNguoiDung','=',\Illuminate\Support\Facades\Auth::user()->maNguoiDung)
            ->where('loaiDonHang','=',1)
            ->orderBy('id','desc')
            ->paginate(10)->withQueryString();

//        dd($donhang);
        $donhang1=\Illuminate\Support\Facades\DB::table('donhang')
            ->where('maNguoiDung','=',\Illuminate\Support\Facades\Auth::user()->maNguoiDung)
            ->where('loaiDonHang','=',2)
            ->orderBy('id','desc')
            ->paginate(10)->withQueryString();
        return view('User.pages.donhang.index',['donhang'=>$donhang,'donhang1'=>$donhang1]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function chitiet(Request $request){
        if ($request->maDon==null){
            return redirect()->route('user.donhang');
        }
        if (Auth::user()->maNguoiDung!=DB::table('donhang')
                ->where('id','=',$request->maDon)
                ->first()->maNguoiDung){
            \Illuminate\Support\Facades\Session::flash('message', 'Bạn không có quyền truy cập!');
            \Illuminate\Support\Facades\Session::flash('message_type', 'error');
            return redirect()->route('HomePage');
        }
        return view('User.pages.donhang.chitiet',['maDon'=>$request->maDon]);
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function checkout(Request $request){
//        dd(Carbon::now()->addHour(7));
        $spmua=DB::table('giohang')
            ->where('maNguoiDung','=',Auth::user()->maNguoiDung)
            ->where('trangThai','=',1)
            ->where('maSan','=',null)
            ->where('maVatPham','!=',null)
            ->first();
        $spthue=DB::table('giohang')
            ->where('maNguoiDung','=',Auth::user()->maNguoiDung)
            ->where('trangThai','=',1)
            ->where('maSan','!=',null)
            ->where('maVatPham','=',null)
            ->first();
        if ($spmua && $spthue){
            \Illuminate\Support\Facades\Session::flash('message', 'Hãy đặt đơn thuê sân và đơn mua vật phẩm riêng biệt!');
            \Illuminate\Support\Facades\Session::flash('message_type', 'error');
            return redirect()->route('cart');
        }
        $sanpham = DB::table('giohang')
            ->join('sanbong','sanbong.maSan','=','giohang.maSan')
            ->leftjoin('vatpham','giohang.maVatPham','=','vatpham.maVatPham')
            ->where('maNguoiDung','=',Auth::user()->maNguoiDung)
            ->where('giohang.trangThai','=',1)
            ->orderBy('giohang.maSan','asc')
            ->orderBy('giohang.thoiGianBatDau')
            ->orderBy('giohang.thoiGianKetThuc')
            ->orderBy('giohang.id','asc')
            ->select('giohang.*','sanbong.*','vatpham.*','giohang.trangThai as tt')
            ->get();
        if( !DB::table('giohang')->where('trangThai','=',1)->first()){
            \Illuminate\Support\Facades\Session::flash('message', 'Cần chọn ít nhất 1 sản phẩm');
            \Illuminate\Support\Facades\Session::flash('message_type', 'error');
            return redirect()->route('cart');
        }
        $test = DB::table('giohang')
            ->where('trangThai', '=', 1)
            ->where('maNguoiDung','=', Auth::user()->maNguoiDung)
            ->groupBy('maSan', 'maVatPham', 'thoiGianBatDau', 'thoiGianKetThuc')
            ->havingRaw('count(*) > 1')
            ->select('maSan', 'maVatPham', 'thoiGianBatDau', 'thoiGianKetThuc', DB::raw('count(*) as count'))
            ->first();
        if($test){
            \Illuminate\Support\Facades\Session::flash('message', 'Bạn chọn nhiều vật phẩm giống nhau cho 1 đơn hàng!');
            \Illuminate\Support\Facades\Session::flash('message_type', 'error');
            return redirect()->route('cart');
        }
        $tong=0;
        $tong += DB::table('giohang')
            ->join('vatpham', 'vatpham.maVatPham', '=', 'giohang.maVatPham')
            ->where('maNguoiDung', '=', Auth::user()->maNguoiDung)
            ->where('giohang.trangThai', '=', 1)
            ->where('giohang.maSan', '=', null)
            ->sum(DB::raw('donGiaBan * soLuong'));
        $ktrasangh=1;
        $ktraSanTT=1;
        foreach ($sanpham as $sp)
        {
            $tongDat = $sp->thu!=null?count(explode(';', $sp->thu))*($sp->ngay/7):1;
            if ($sp->maVatPham==null) {
                if (Carbon::parse($sp->thoiGianBatDau)<Carbon::now()->addHour(7) || $sp->thoiGianKetThuc < $sp->thoiGianBatDau){
                    \Illuminate\Support\Facades\Session::flash('message', 'Bạn chọn sân với thời gian bắt đầu nhỏ hơn thời gian hiện tại!('.$sp->maSan .': '. $sp->thoiGianBatDau . ' - ' . $sp->thoiGianKetThuc .')');
                    \Illuminate\Support\Facades\Session::flash('message_type', 'error');
                    return redirect()->route('cart');
                }
                if($sp->thu!=null && $sp->ngay!=null){
                    for ($i = 0; $i < $sp->ngay; $i++) {
                        $currentDate = Carbon::parse($sp->thoiGianBatDau)->copy()->addDays($i);
                        $currentDateKT = Carbon::parse($sp->thoiGianKetThuc)->copy()->addDays($i);
                        $dayOfWeek = $currentDate->dayOfWeek;
                        if (in_array($dayOfWeek, explode(';', $sp->thu))) {
                            $check = DB::table('giohang')
                                ->where('id', '!=', $sp->id)
                                ->where('maSan', '=', $sp->maSan)
                                ->where('maVatPham', '=', null)
                                ->where('trangThai', '=', 1)
                                ->where('maNguoiDung', '=', Auth::user()->maNguoiDung)
                                ->where(function ($query) use ($currentDate, $currentDateKT) {
                                    $query->whereRaw('? <= thoiGianBatDau AND ? >= thoiGianBatDau', [$currentDate, $currentDateKT])
                                        ->orWhereRaw('? <= thoiGianKetThuc AND ? >= thoiGianKetThuc', [$currentDate, $currentDateKT]);
                                })
                                ->first();
                            $check1 = DB::table('chitietthuesan')
                                ->where('maSan', '=', $sp->maSan)
                                ->where('maVatPham', '=', null)
                                ->where(function ($query) use ($currentDate, $currentDateKT) {
                                    $query->whereRaw('? <= thoiGianBatDau AND ? >= thoiGianBatDau', [$currentDate, $currentDateKT])
                                        ->orWhereRaw('? <= thoiGianKetThuc AND ? >= thoiGianKetThuc', [$currentDate, $currentDateKT]);
                                })
                                ->first();

                        }
                    }
                    if ($check) {
                        \Illuminate\Support\Facades\Session::flash('message', 'Sân bạn chọn '.$check->maSan.' bị trùng lịch ('.$currentDate .' đến '.$currentDateKT.')!');
                        \Illuminate\Support\Facades\Session::flash('message_type', 'error');
                        return redirect()->route('cart');
//                        $ktrasangh=2;
                    }
                    if ($check1) {
                        \Illuminate\Support\Facades\Session::flash('message', 'Sân bạn chọn '.$check->maSan.' bận ('.$currentDate .' đến '.$currentDateKT.')!');
                        \Illuminate\Support\Facades\Session::flash('message_type', 'error');
                        return redirect()->route('cart');
//                        $ktraSanTT=2;
                    }
                }else{
                    $check = DB::table('giohang')
                        ->where('id', '!=', $sp->id)
                        ->where('maSan', '=', $sp->maSan)
                        ->where('maVatPham', '=', null)
                        ->where('trangThai', '=', 1)
                        ->where('maNguoiDung', '=', Auth::user()->maNguoiDung)
                        ->where(function ($query) use ($sp) {
                            $query->whereRaw('? < thoiGianBatDau AND ? > thoiGianBatDau', [$sp->thoiGianBatDau, $sp->thoiGianKetThuc])
                                ->orWhereRaw('? < thoiGianKetThuc AND ? > thoiGianKetThuc', [$sp->thoiGianBatDau, $sp->thoiGianKetThuc]);
                        })
                        ->first();
                    $check1=DB::table('chitietthuesan')
                        ->where('maSan','=',$sp->maSan)
                        ->where('maVatPham','=',null)
                        ->where(function ($query) use ($sp) {
                            $query->whereRaw('? < thoiGianBatDau AND ? > thoiGianBatDau', [$sp->thoiGianBatDau, $sp->thoiGianKetThuc])
                                ->orWhereRaw('? < thoiGianKetThuc AND ? > thoiGianKetThuc', [$sp->thoiGianBatDau, $sp->thoiGianKetThuc]);
                        })
                        ->first();
                    if ($check) {
                        $ktrasangh=2;
                    }
                    if ($check1) {
                        $ktraSanTT=2;
                    }

                }
            }
            if($sp->maVatPham!=null){
                if($sp->thu!=null && $sp->ngay!=null){
                    for ($i = 0; $i < $sp->ngay; $i++) {
                        $currentDate = Carbon::parse($sp->thoiGianBatDau)->copy()->addDays($i);
                        $currentDateKT = Carbon::parse($sp->thoiGianKetThuc)->copy()->addDays($i);
                        $dayOfWeek = $currentDate->dayOfWeek;
                        if (in_array($dayOfWeek, explode(';', $sp->thu))) {
                            $test1 = DB::table('giohang')
                                ->where('giohang.trangThai', '=', 1)
                                ->where('maNguoiDung', '=', Auth::user()->maNguoiDung)
                                ->where('giohang.maVatPham', '=', $sp->maVatPham)
                                ->where(function ($query) use ($currentDate, $currentDateKT) {
                                    $query->whereRaw('? <= thoiGianBatDau AND ? >= thoiGianBatDau', [$currentDate, $currentDateKT])
                                        ->orWhereRaw('? <= thoiGianKetThuc AND ? >= thoiGianKetThuc', [$currentDate, $currentDateKT]);
                                })
                                ->groupBy( 'giohang.maVatPham', 'giohang.thoiGianBatDau', 'giohang.thoiGianKetThuc')
                                ->select('giohang.maVatPham', DB::raw('sum(soLuong) as countSL'))
                                ->first();
                            $check2=null;
                            $checkSLGioHang=null;
                            if ($test1){
                                $checkSLGioHang = DB::table('vatpham')
                                    ->where('maVatPham', '=', $sp->maVatPham)
                                    ->groupBy('maVatPham', 'soLuongChoThue','tenVatPham')
                                    ->havingRaw('? < ?', [$sp->soLuongChoThue, $test1->countSL])
                                    ->select('maVatPham','soLuongChoThue', DB::raw($test1->countSL.' as countSL'),'tenVatPham')
                                    ->first();
                                $check2 = DB::table('chitietthuesan')
                                    ->leftJoin('vatpham','vatpham.maVatPham','=','chitietthuesan.maVatPham')
                                    ->where('chitietthuesan.maVatPham', '=', $sp->maVatPham)
                                    ->where(function ($query) use ($currentDate, $currentDateKT) {
                                        $query->whereRaw('? <= thoiGianBatDau AND ? >= thoiGianBatDau', [$currentDate, $currentDateKT])
                                            ->orWhereRaw('? <= thoiGianKetThuc AND ? >= thoiGianKetThuc', [$currentDate, $currentDateKT]);
                                    })
                                    ->groupBy('chitietthuesan.maVatPham','tenVatPham')
                                    ->havingRaw('sum(soLuong) + ? > ?', [$sp->soLuongChoThue, $test1->countSL])
                                    ->select(DB::raw('sum(soLuong) as soLuong'), 'chitietthuesan.maVatPham','tenVatPham')
                                    ->first();
                            }
                            if ($check2){
                                \Illuminate\Support\Facades\Session::flash('message', 'Số lượng vật phẩm '.$check2->tenVatPham.' cho thuê trong khung giờ: '.$currentDate.' đến '.$currentDateKT.' không đủ!');
                                \Illuminate\Support\Facades\Session::flash('message_type', 'error');
                                return redirect()->route('cart');
                                $ktraspgh=2;
                            }
                            if ($checkSLGioHang){
                                \Illuminate\Support\Facades\Session::flash('message', 'Số lượng vật phẩm '.$checkSLGioHang->tenVatPham.' cho thuê trong khung giờ: '.$currentDate.' đến '.$currentDateKT.' không đủ!');
                                \Illuminate\Support\Facades\Session::flash('message_type', 'error');
                                return redirect()->route('cart');
                                $ktraspgh=2;
                            }
                        }
                    }
                }else{
                    $test1 = DB::table('giohang')
                        ->where('trangThai', '=', 1)
                        ->where('maNguoiDung', '=', Auth::user()->maNguoiDung)
                        ->where('maVatPham', '=', $sp->maVatPham)
                        ->where(function ($query) use ($sp) {
                            $query->whereRaw('? <= thoiGianBatDau AND ? >= thoiGianBatDau', [$sp->thoiGianBatDau, $sp->thoiGianKetThuc])
                                ->orWhereRaw('? <= thoiGianKetThuc AND ? >= thoiGianKetThuc', [$sp->thoiGianBatDau, $sp->thoiGianKetThuc]);
                        })
                        ->groupBy( 'maVatPham', 'thoiGianBatDau', 'thoiGianKetThuc')
                        ->select('maVatPham', DB::raw('sum(soLuong) as countSL'))
                        ->first();
                    $check2=null;
                    $checkSLGioHang=null;
                    if ($test1){
                        $checkSLGioHang = DB::table('vatpham')
                            ->where('maVatPham', '=', $sp->maVatPham)
                            ->groupBy('maVatPham', 'soLuongChoThue','tenVatPham')
                            ->havingRaw('? < ?', [$sp->soLuongChoThue, $test1->countSL])
                            ->select('maVatPham','soLuongChoThue', DB::raw($test1->countSL.' as countSL'),'tenVatPham')
                            ->first();
                        $check2 = DB::table('chitietthuesan')
                            ->leftJoin('vatpham','vatpham.maVatPham','=','chitietthuesan.maVatPham')
                            ->where('chitietthuesan.maVatPham', '=', $sp->maVatPham)
                            ->where(function ($query) use ($sp) {
                                $query->whereRaw('? <= thoiGianBatDau AND ? >= thoiGianBatDau', [$sp->thoiGianBatDau, $sp->thoiGianKetThuc])
                                    ->orWhereRaw('? <= thoiGianKetThuc AND ? >= thoiGianKetThuc', [$sp->thoiGianBatDau, $sp->thoiGianKetThuc]);
                            })
                            ->groupBy('chitietthuesan.maVatPham','tenVatPham')
                            ->havingRaw('sum(soLuong) + ? > ?', [$sp->soLuongChoThue, $test1->countSL])
                            ->select(DB::raw('sum(soLuong) as soLuong'), 'chitietthuesan.maVatPham','tenVatPham')
                            ->first();
                    }
                    if ($check2){
                        \Illuminate\Support\Facades\Session::flash('message', 'Số lượng vật phẩm '.$check2->tenVatPham.' cho thuê trong khung giờ: '.$sp->thoiGianBatDau.' đến '.$sp->thoiGianKetThuc.' không đủ!('.$sp->soLuongChoThue-$check2->soLuong.'/'.$test1->countSL.')');
                        \Illuminate\Support\Facades\Session::flash('message_type', 'error');
                        return redirect()->route('cart');
                        $ktraspgh=2;
                    }
                    if ($checkSLGioHang){
                        \Illuminate\Support\Facades\Session::flash('message', 'Số lượng vật phẩm '.$checkSLGioHang->tenVatPham.' cho thuê trong khung giờ: '.$sp->thoiGianBatDau.' đến '.$sp->thoiGianKetThuc.' không đủ! ('.$sp->soLuongChoThue.'/'.$test1->countSL.')');
                        \Illuminate\Support\Facades\Session::flash('message_type', 'error');
                        return redirect()->route('cart');
                        $ktraspgh=2;
                    }
                }
            }
            if ($ktrasangh==2)
            {
                \Illuminate\Support\Facades\Session::flash('message', 'Sân bạn chọn bị trùng lịch!');
                \Illuminate\Support\Facades\Session::flash('message_type', 'error');
                return redirect()->route('cart');
            }
            if ($ktraSanTT==2)
            {
                \Illuminate\Support\Facades\Session::flash('message', 'Sân bạn chọn bận!');
                \Illuminate\Support\Facades\Session::flash('message_type', 'error');
                return redirect()->route('cart');
            }
            if ($sp->tt==1){
                if ($sp->maVatPham!=null){
                    if($sp->thoiGianKetThuc && $sp->thoiGianBatDau){
                        if($sp->hinhThucDat==2){
                            $tong+=(\Carbon\Carbon::parse($sp->thoiGianKetThuc)->diffInHours(\Carbon\Carbon::parse($sp->thoiGianBatDau)))*$sp->donGiaThue*0.4*$sp->soLuong*$tongDat;
                        }elseif($sp->hinhThucDat==3){
                            $tong+=(\Carbon\Carbon::parse($sp->thoiGianKetThuc)->diffInHours(\Carbon\Carbon::parse($sp->thoiGianBatDau)))*$sp->donGiaThue*0.3*$sp->soLuong*$tongDat;
                        }else{
                            $tong+=(\Carbon\Carbon::parse($sp->thoiGianKetThuc)->diffInHours(\Carbon\Carbon::parse($sp->thoiGianBatDau)))*$sp->donGiaThue*$sp->soLuong*$tongDat;
                        }
                    }
                }else{
                    if($sp->thoiGianKetThuc && $sp->thoiGianBatDau){
                        if($sp->hinhThucDat==2){
                            $tong+=(\Carbon\Carbon::parse($sp->thoiGianKetThuc)->diffInHours(\Carbon\Carbon::parse($sp->thoiGianBatDau)))*$sp->giaDichVu*0.4*$tongDat;
                        }elseif($sp->hinhThucDat==3){
                            $tong+=(\Carbon\Carbon::parse($sp->thoiGianKetThuc)->diffInHours(\Carbon\Carbon::parse($sp->thoiGianBatDau)))*$sp->giaDichVu*0.3*$tongDat;
                        }else{
                            $tong+=(\Carbon\Carbon::parse($sp->thoiGianKetThuc)->diffInHours(\Carbon\Carbon::parse($sp->thoiGianBatDau)))*$sp->giaDichVu*$tongDat;
                        }
                    }
                }
            }
        }
        $donmua = DB::table('giohang')
            ->join('vatpham', 'vatpham.maVatPham', '=', 'giohang.maVatPham')
            ->where('maNguoiDung', '=', Auth::user()->maNguoiDung)
            ->where('giohang.trangThai', '=', 1)
            ->where('giohang.maSan', '=', null)
            ->select('giohang.*','vatpham.*','giohang.trangThai as tt')
            ->get();
        return view('User.pages.checkout.checkout',[
            'sanpham'=>$sanpham,
            'donmua'=>$donmua,
            'tong'=>$tong,
        ]);
    }
    public function checkoutPost(Request $request){
        $request->validate([
            'SDT' => 'required|required|regex:/(0)[0-9]{9}/',
            'sonha' => 'required',
        ], [
            'sonha.required' => 'Vui lòng nhập địa chỉ.',
            'SDT.required' => 'Vui lòng nhập số điện thoại.',
            'SDT.regex' => 'Số điện thoại không hợp lệ. Vui lòng kiểm tra lại.',
        ]);

        $spmua=DB::table('giohang')
            ->where('maNguoiDung','=',Auth::user()->maNguoiDung)
            ->where('trangThai','=',1)
            ->where('maSan','=',null)
            ->where('maVatPham','!=',null)
            ->first();
        $spthue=DB::table('giohang')
            ->where('maNguoiDung','=',Auth::user()->maNguoiDung)
            ->where('trangThai','=',1)
            ->where('maSan','!=',null)
            ->where('maVatPham','=',null)
            ->first();
        if ($spmua && $spthue){
            \Illuminate\Support\Facades\Session::flash('message', 'Hãy đặt đơn thuê sân và đơn mua vật phẩm riêng biệt!');
            \Illuminate\Support\Facades\Session::flash('message_type', 'error');
            return redirect()->route('cart');
        }
        $sanpham = DB::table('giohang')
            ->join('sanbong','sanbong.maSan','=','giohang.maSan')
            ->leftjoin('vatpham','giohang.maVatPham','=','vatpham.maVatPham')
            ->where('maNguoiDung','=',Auth::user()->maNguoiDung)
            ->where('giohang.trangThai','=',1)
            ->orderBy('giohang.maSan','asc')
            ->orderBy('giohang.id','asc')
            ->select('giohang.*','sanbong.*','vatpham.*','giohang.trangThai as tt')
            ->get();
        $test = DB::table('giohang')
            ->where('trangThai', '=', 1)
            ->groupBy('maSan', 'maVatPham', 'thoiGianBatDau', 'thoiGianKetThuc')
            ->where('maNguoiDung','=', Auth::user()->maNguoiDung)
            ->havingRaw('count(*) > 1')
            ->select('maSan', 'maVatPham', 'thoiGianBatDau', 'thoiGianKetThuc', DB::raw('count(*) as count'))
            ->first();
        if($test){
            \Illuminate\Support\Facades\Session::flash('message', 'Bạn chọn nhiều vật phẩm giống nhau cho 1 đơn hàng!');
            \Illuminate\Support\Facades\Session::flash('message_type', 'error');
            return redirect()->route('cart');
        }
        $tong=0;
        $tong += DB::table('giohang')
            ->join('vatpham', 'vatpham.maVatPham', '=', 'giohang.maVatPham')
            ->where('maNguoiDung', '=', Auth::user()->maNguoiDung)
            ->where('giohang.trangThai', '=', 1)
            ->where('giohang.maSan', '=', null)
            ->sum(DB::raw('donGiaBan * soLuong'));
        $ktrasangh=1;
        $ktraSanTT=1;
        foreach ($sanpham as $sp)
        {
            $tongDat = $sp->thu!=null?count(explode(';', $sp->thu))*($sp->ngay/7):1;
            if ($sp->maVatPham==null) {
                if ($sp->thoiGianBatDau<Carbon::now()->addHour(7)){
                    \Illuminate\Support\Facades\Session::flash('message', 'Bạn chọn sân với thời gian không hợp lệ!('.$sp->maSan .': '. $sp->thoiGianBatDau . ' - ' . $sp->thoiGianKetThuc .')');
                    \Illuminate\Support\Facades\Session::flash('message_type', 'error');
                    return redirect()->route('cart');
                }
                if($sp->thu!=null && $sp->ngay!=null){
                    for ($i = 0; $i < $sp->ngay; $i++) {
                        $currentDate = Carbon::parse($sp->thoiGianBatDau)->copy()->addDays($i);
                        $currentDateKT = Carbon::parse($sp->thoiGianKetThuc)->copy()->addDays($i);
                        $dayOfWeek = $currentDate->dayOfWeek;
                        if (in_array($dayOfWeek, explode(';', $sp->thu))) {
                            $check = DB::table('giohang')
                                ->where('id', '!=', $sp->id)
                                ->where('maSan', '=', $sp->maSan)
                                ->where('maVatPham', '=', null)
                                ->where('maNguoiDung','=',Auth::user()->maNguoiDung)
                                ->where(function ($query) use ($currentDate, $currentDateKT) {
                                    $query->whereRaw('? <= thoiGianBatDau AND ? >= thoiGianBatDau', [$currentDate, $currentDateKT])
                                        ->orWhereRaw('? <= thoiGianKetThuc AND ? >= thoiGianKetThuc', [$currentDate, $currentDateKT]);
                                })
                                ->first();
                            $check1 = DB::table('chitietthuesan')
                                ->where('maSan', '=', $sp->maSan)
                                ->where('maVatPham', '=', null)
                                ->where(function ($query) use ($currentDate, $currentDateKT) {
                                    $query->whereRaw('? <= thoiGianBatDau AND ? >= thoiGianBatDau', [$currentDate, $currentDateKT])
                                        ->orWhereRaw('? <= thoiGianKetThuc AND ? >= thoiGianKetThuc', [$currentDate, $currentDateKT]);
                                })
                                ->first();
                            if ($check) {
                                $ktrasangh=2;
                            }
                            if ($check1) {
                                $ktraSanTT=2;
                            }
                        }
                    }
                }else{
                    $check = DB::table('giohang')
                        ->where('id', '!=', $sp->id)
                        ->where('maSan', '=', $sp->maSan)
                        ->where('maVatPham', '=', null)
                        ->where('trangThai', '=', 1)
                        ->where('maNguoiDung', '=', Auth::user()->maNguoiDung)
                        ->where(function ($query) use ($sp) {
                            $query->whereRaw('? < thoiGianBatDau AND ? > thoiGianBatDau', [$sp->thoiGianBatDau, $sp->thoiGianKetThuc])
                                ->orWhereRaw('? < thoiGianKetThuc AND ? > thoiGianKetThuc', [$sp->thoiGianBatDau, $sp->thoiGianKetThuc]);
                        })
                        ->first();
                    $check1=DB::table('chitietthuesan')
                        ->where('maSan','=',$sp->maSan)
                        ->where('maVatPham','=',null)
                        ->where(function ($query) use ($sp) {
                            $query->whereRaw('? < thoiGianBatDau AND ? > thoiGianBatDau', [$sp->thoiGianBatDau, $sp->thoiGianKetThuc])
                                ->orWhereRaw('? < thoiGianKetThuc AND ? > thoiGianKetThuc', [$sp->thoiGianBatDau, $sp->thoiGianKetThuc]);
                        })
                        ->first();
                    if ($check) {
                        $ktrasangh=2;
                    }
                    if ($check1) {
                        $ktraSanTT=2;
                    }
                }
                if ($ktrasangh==2)
                {
                    \Illuminate\Support\Facades\Session::flash('message', 'Sân bạn chọn bị trùng lịch!');
                    \Illuminate\Support\Facades\Session::flash('message_type', 'error');
                    return redirect()->route('cart');
                }
            }
            if($sp->maVatPham!=null){
                $test1 = DB::table('giohang')
                    ->where('trangThai', '=', 1)
                    ->where('maVatPham', '=', $sp->maVatPham)
                    ->where(function ($query) use ($sp) {
                        $query->whereRaw('? < thoiGianBatDau AND ? > thoiGianBatDau', [$sp->thoiGianBatDau, $sp->thoiGianKetThuc])
                            ->orWhereRaw('? < thoiGianKetThuc AND ? > thoiGianKetThuc', [$sp->thoiGianBatDau, $sp->thoiGianKetThuc]);
                    })
                    ->groupBy( 'maVatPham', 'thoiGianBatDau', 'thoiGianKetThuc')
                    ->select('maVatPham', DB::raw('sum(soLuong) as count'))
                    ->first();
                $check2=null;
                if ($test1){
                    $check2 = DB::table('chitietthuesan')
                        ->where('maVatPham', '=', $sp->maVatPham)
                        ->where(function ($query) use ($sp) {
                            $query->whereRaw('? < thoiGianBatDau AND ? > thoiGianBatDau', [$sp->thoiGianBatDau, $sp->thoiGianKetThuc])
                                ->orWhereRaw('? < thoiGianKetThuc AND ? > thoiGianKetThuc', [$sp->thoiGianBatDau, $sp->thoiGianKetThuc]);
                        })
                        ->groupBy('maVatPham')
                        ->havingRaw('sum(soLuong) > ? - ?', [$sp->soLuongChoThue, $test1->count])
                        ->select(DB::raw('sum(soLuong) as soLuong'), 'maVatPham')
                        ->first();
                }
                if ($check2){
                    \Illuminate\Support\Facades\Session::flash('message', 'Không thể đặt sân do vật phẩm '.$sp->tenVatPham.' có số lượng cho thuê ít hơn( Còn '.$sp->soLuongChoThue-$check2->soLuong.'/'.$test1->count.' vật phẩm trong thời gian từ: '. $sp->thoiGianBatDau .' đến ' .$sp->thoiGianKetThuc.')!');
                    \Illuminate\Support\Facades\Session::flash('message_type', 'error');
                    return redirect()->route('cart');
                }
            }
//            if ($check){
//                \Illuminate\Support\Facades\Session::flash('message', 'Sân bạn chọn bị trùng lịch!');
//                \Illuminate\Support\Facades\Session::flash('message_type', 'error');
//                return redirect()->route('checkout');
//            }
            if ($ktraSanTT==2){
                \Illuminate\Support\Facades\Session::flash('message', 'Không thể đặt sân do sân'.$sp->maSan.' bận!');
                \Illuminate\Support\Facades\Session::flash('message_type', 'error');
                return redirect()->route('cart');
            }

            if ($sp->tt==1){
                if ($sp->maVatPham!=null){
                    if($sp->thoiGianKetThuc && $sp->thoiGianBatDau){
                        if($sp->hinhThucDat==2){
                            $tong+=(\Carbon\Carbon::parse($sp->thoiGianKetThuc)->diffInHours(\Carbon\Carbon::parse($sp->thoiGianBatDau)))*$sp->donGiaThue*0.4*$sp->soLuong*$tongDat;
                        }elseif($sp->hinhThucDat==3){
                            $tong+=(\Carbon\Carbon::parse($sp->thoiGianKetThuc)->diffInHours(\Carbon\Carbon::parse($sp->thoiGianBatDau)))*$sp->donGiaThue*0.3*$sp->soLuong*$tongDat;
                        }else{
                            $tong+=(\Carbon\Carbon::parse($sp->thoiGianKetThuc)->diffInHours(\Carbon\Carbon::parse($sp->thoiGianBatDau)))*$sp->donGiaThue*$sp->soLuong*$tongDat;
                        }
                    }
                }else{
                    if($sp->thoiGianKetThuc && $sp->thoiGianBatDau){
                        if($sp->hinhThucDat==2){
                            $tong+=(\Carbon\Carbon::parse($sp->thoiGianKetThuc)->diffInHours(\Carbon\Carbon::parse($sp->thoiGianBatDau)))*$sp->giaDichVu*0.4*$tongDat;
                        }elseif($sp->hinhThucDat==3){
                            $tong+=(\Carbon\Carbon::parse($sp->thoiGianKetThuc)->diffInHours(\Carbon\Carbon::parse($sp->thoiGianBatDau)))*$sp->giaDichVu*0.3*$tongDat;
                        }else{
                            $tong+=(\Carbon\Carbon::parse($sp->thoiGianKetThuc)->diffInHours(\Carbon\Carbon::parse($sp->thoiGianBatDau)))*$sp->giaDichVu*$tongDat;
                        }
                    }
                }
            }
        }
        $mgg = $request->mgg;
        $data=null;
        if($mgg!=null){
            $data=DB::table('magiamgia')
                ->where('magiamgia','=',$mgg)
                ->where('trangthai','>',0)
                ->where('soluongcon','>',0)
                ->first();
        }
        $magiam=null;
        if ($data){
            $giam=0;
            if($data->loai==1){
                $giam = min($data->giatri*$tong,$data->giamtoida);
            }else{
                $giam= $data->giatri;
            }
            if ($data->toithieu<=$tong){
                $magiam= $data->magiamgia;
                $tong=$tong-$giam;
            }
        }
        $pttt=0;
//        $donHang=null;
        if ($request->PTTT!=null){
            if(Auth::user( )->soDuTaiKhoan < $tong){
                \Illuminate\Support\Facades\Session::flash('message', 'Bạn không đủ tiền trong tài khoản!');
                \Illuminate\Support\Facades\Session::flash('message_type', 'error');
                return redirect()->route('checkout');
            }else{
                $donHang = DonHang::create([
                    'maNguoiDung'=>Auth::user()->maNguoiDung,
                    'hoTen'=>$request->ho.' '.$request->ten,
                    'maXa'=>$request->xaphuong,
                    'diaChi'=>$request->sonha,
                    'SDT'=>$request->SDT,
                    'Email'=>$request->email,
                    'daThanhToan'=>1,
                    'ghiChu'=>$request->ghiChu,
                    'maGiamGia'=>$magiam,
                    'tongTien'=>$tong,
                    'loaiDonHang'=>$spthue?1:2,
                ]);
                DB::table('nguoidung')
                    ->where('maNguoiDung','=',Auth::user()->maNguoiDung)
                    ->update([
                        'soDuTaiKhoan'=>Auth::user()->soDuTaiKhoan-$tong,
                    ]);
                LichSuNap::create([
                    'maNguoiDung'=>Auth::user()->maNguoiDung,
                    'soTien'=>$tong,
                    'ndck'=>"Thanh toán cho đơn hàng ".$donHang->id."",
                    'trangThai'=>1,
                    'loaiGD'=>2,
                    'thoiGian' => date('Y-m-d H:i:s'),
                    'transID'=>null,
                ]);
                $request->PTTT!=null?$pttt=1:$pttt=0;
            }
        }else{
            $donHang = DonHang::create([
                'maNguoiDung'=>Auth::user()->maNguoiDung,
                'hoTen'=>$request->ho.' '.$request->ten,
                'maXa'=>$request->xaphuong,
                'diaChi'=>$request->sonha,
                'SDT'=>$request->SDT,
                'Email'=>$request->email,
                'daThanhToan'=>$pttt,
                'ghiChu'=>$request->ghiChu,
                'maGiamGia'=>$magiam,
                'tongTien'=>$tong,
                'loaiDonHang'=>$spthue?1:2,
            ]);
        }
        $customer=DB::table('nguoidung')->where('maNguoiDung','=',Auth::user()->maNguoiDung)->first();
        $order_detail =
            DB::table('chitietthuesan')
                ->leftJoin('sanbong', 'chitietthuesan.maSan', 'sanbong.maSan')
                ->leftJoin('vatpham', 'chitietthuesan.maVatPham', 'vatpham.maVatPham')
                ->where('maDonHang', Auth::user()->maNguoiDung)
                ->orderBy('chitietthuesan.maSan', 'asc')
                ->orderBy('chitietthuesan.thoiGianBatDau', 'asc')
                ->orderBy('chitietthuesan.thoiGianKetThuc', 'asc')
                ->select('chitietthuesan.*','sanbong.*', 'vatpham.tenVatPham','vatpham.donGiaBan','vatpham.donGiaThue')->get();
        $order = DB::table('donhang')
            ->where('id', $donHang->id)
            ->first();
        Mail::send('MailTo.thanhtoanthanhcong', compact('customer','order_detail','order'), function ($email) use ($customer) {
            $email->subject('Email thông báo đn hàng thành công');
            $email->to($customer->taiKhoan, $customer->ten);
        });

        $donmua = DB::table('giohang')
            ->join('vatpham', 'vatpham.maVatPham', '=', 'giohang.maVatPham')
            ->where('maNguoiDung', '=', Auth::user()->maNguoiDung)
            ->where('giohang.trangThai', '=', 1)
            ->where('giohang.maSan', '=', null)
            ->select('giohang.*','vatpham.*','giohang.trangThai as tt')
            ->get();
       foreach ($sanpham as $sp){
           if($sp->thu==null && $sp->ngay==null){
               if($sp->maVatPham==null){
                   $CTT = ChiTietThueSan::create([
                       'maDonHang' => $donHang->id,
                       'maSan' => $sp->maSan,
                       'maHinhThuc' => $sp->hinhThucDat,
                       'thoiGianBatDau' => $sp->thoiGianBatDau,
                       'thoiGianKetThuc' => $sp->thoiGianKetThuc,
                   ]);
               }else{
                   $CTT = ChiTietThueSan::create([
                       'maDonHang' => $donHang->id,
                       'maSan' => $sp->maSan,
                       'maVatPham' => $sp->maVatPham,
                       'soLuong' => $sp->soLuong,
                       'maHinhThuc' => $sp->hinhThucDat,
                       'thoiGianBatDau' => $sp->thoiGianBatDau,
                       'thoiGianKetThuc' => $sp->thoiGianKetThuc,
//                     'ghiChu'=>$sp->ghiChu,
                   ]);
               }
           }else{
               for ($i = 0; $i < $sp->ngay; $i++) {
                   $currentDate = Carbon::parse($sp->thoiGianBatDau)->copy()->addDays($i);
                   $currentDateKT = Carbon::parse($sp->thoiGianKetThuc)->copy()->addDays($i);
                   $dayOfWeek = $currentDate->dayOfWeek;
                   if (in_array($dayOfWeek, explode(';', $sp->thu))) {
                       if($sp->maVatPham==null){
                           $CTT = ChiTietThueSan::create([
                               'maDonHang' => $donHang->id,
                               'maSan' => $sp->maSan,
                               'maHinhThuc' => $sp->hinhThucDat,
                               'thoiGianBatDau' => $currentDate,
                               'thoiGianKetThuc' => $currentDateKT,
                           ]);
                       }else{
                           $CTT = ChiTietThueSan::create([
                               'maDonHang' => $donHang->id,
                               'maSan' => $sp->maSan,
                               'maVatPham' => $sp->maVatPham,
                               'soLuong' => $sp->soLuong,
                               'maHinhThuc' => $sp->hinhThucDat,
                               'thoiGianBatDau' => $currentDate,
                               'thoiGianKetThuc' => $currentDateKT,
                           ]);
                       }
                   }
               }
           }
        }
       foreach($donmua as $dm){
           DB::table('chitietthuesan')
               ->insert([
                     'maDonHang'=>$donHang->id,
                     'maVatPham'=>$dm->maVatPham,
                     'soLuong'=>$dm->soLuong,
                     'gia'=>$dm->donGiaBan,
                ]);
           DB::table('VatPham')
               ->where('maVatPham', '=', $dm->maVatPham)
               ->update([
                   'soLuongCon' => $dm->soLuongCon - $dm->soLuong,
               ]);
       }
       DB::table('giohang')
           ->where('maNguoiDung','=',Auth::user()->maNguoiDung)
           ->where('trangThai','=',1)
           ->delete();
        \Illuminate\Support\Facades\Session::flash('message', 'Đặt hàng thành công!');
        \Illuminate\Support\Facades\Session::flash('message_type', 'success');
        return redirect()->route('user.donhang');
    }
    public function huydon(Request $request){
        $request->only('maDon','maCT');
        if ($request->maDon){
            $donhang=DB::table('donhang')
                ->where('id','=',$request->maDon)
                ->first();
            if ($donhang->maNguoiDung!=Auth::user()->maNguoiDung){
                \Illuminate\Support\Facades\Session::flash('message', 'Bạn không thể hủy đơn hàng này!');
                \Illuminate\Support\Facades\Session::flash('message_type', 'error');
                return redirect()->route('user.donhang');
            }
            $c1=\Illuminate\Support\Facades\DB::table('chitietthuesan')
                ->where('maVatPham','=',null)
                ->where('thoiGianBatDau','>',Carbon::now()->addHour(8))
                ->where('maDonHang','=',$request->maDon)
                ->groupBy('maDonHang')->count();
//            dd($c1);
            $c2=\Illuminate\Support\Facades\DB::table('chitietthuesan')
                ->where('maVatPham','=',null)
                ->where('maDonHang','=',$request->maDon)
                ->groupBy('maDonHang')->count();
            if ($c1!=$c2){
                \Illuminate\Support\Facades\Session::flash('message', 'Không thể hủy sân trước thời gian đặt 1 giờ!');
                \Illuminate\Support\Facades\Session::flash('message_type', 'error');
                return redirect()->route('user.donhang');
            }else{
                $tonghoantra=0;
                $donNay=DB::table('chitietthuesan')
                    ->orderBy('chitietthuesan.thoiGianBatDau','asc')
                    ->first();
                $phihoantra=$donNay->thoiGianBatDau>Carbon::now()->addHour(12)?0.05*$donhang->tongTien:0.1*$donhang->tongTien;
                if($donhang->daThanhToan==1){
                    $hoantra=$donhang->tongTien-$donhang->tongTien;
                    $tonghoantra=$hoantra-$phihoantra;
                }else{
                    $tonghoantra=0-$phihoantra;
                }
                if (Auth::user()->soDuTaiKhoan + $tonghoantra < 0) {
                    \Illuminate\Support\Facades\Session::flash('message', 'Không thể hủy sân do cần ít nhất ' . number_format(-$tonghoantra) . ' VNĐ để hoàn trả!');
                    \Illuminate\Support\Facades\Session::flash('message_type', 'error');
                    return redirect()->route('user.donhang');
                }else{
                    DB::table('donhang')
                        ->where('id','=',$request->maDon)
                        ->delete();
                    DB::table('nguoiDung')
                        ->where('maNguoiDung','=',Auth::user()->maNguoiDung)
                        ->update([
                            'soDuTaiKhoan'=>Auth::user()->soDuTaiKhoan+$tonghoantra,
                        ]);
                    LichSuNap::create([
                        'maNguoiDung'=>Auth::user()->maNguoiDung,
                        'soTien'=>$tonghoantra,
                        'ndck'=>"Phí dịch vụ cho việc hủy sân ở đơn hàng ".$donhang->id."",
                        'trangThai'=>1,
                        'loaiGD'=>2,
                        'thoiGian' => date('Y-m-d H:i:s'),
                        'transID'=>null,
                    ]);
                }
                \Illuminate\Support\Facades\Session::flash('message', 'Hủy đơn hàng thành công!');
                \Illuminate\Support\Facades\Session::flash('message_type', 'success');
                return redirect()->route('user.donhang');
            }
        }
        if ($request->maCT){
            $donhang=DB::table('donhang')
                ->join('chitietthuesan','chitietthuesan.maDonHang','=','donhang.id')
                ->where('chitietthuesan.maCTT','=',$request->maCT)
                ->first();
            if ($donhang->maNguoiDung!=Auth::user()->maNguoiDung){
                \Illuminate\Support\Facades\Session::flash('message', 'Bạn không thể hủy đơn hàng này!');
                \Illuminate\Support\Facades\Session::flash('message_type', 'error');
                return redirect()->route('user.donhang');
            }
            $c1=\Illuminate\Support\Facades\DB::table('chitietthuesan')
                ->where('maCTT','=',$request->maCT)
                ->where('thoiGianBatDau','>',Carbon::now()->addHour(8))
                ->first();
//            dd($donhang);
//            dd($c1,Carbon::now()->addHour(8));
            if (!$c1){
                \Illuminate\Support\Facades\Session::flash('message', 'Không thể hủy sân trước thời gian đặt 1 giờ!');
                \Illuminate\Support\Facades\Session::flash('message_type', 'error');
                return redirect()->route('user.donhang');
            }else{
                $ct = DB::table('chitietthuesan')
                    ->leftJoin('vatpham','vatpham.maVatPham','=','chitietthuesan.maVatPham')
                    ->leftJoin('sanbong','sanbong.maSan','=','chitietthuesan.maSan')
                    ->where('maDonHang', '=', $donhang->id)
                    ->select('chitietthuesan.*','vatpham.donGiaThue','sanbong.giaDichVu')
                    ->get();
                $tong=0;
                foreach ($ct as $sp)
                {
                    if(!($sp->maSan==$c1->maSan && $sp->thoiGianBatDau ==$c1->thoiGianBatDau && $sp->thoiGianKetThuc == $c1->thoiGianKetThuc)){
                        if ($sp->maVatPham!=null){
                            if($sp->thoiGianKetThuc && $sp->thoiGianBatDau){
//                              dd($sp->giaDichVu);
                                $tong+=(\Carbon\Carbon::parse($sp->thoiGianKetThuc)->diffInHours(\Carbon\Carbon::parse($sp->thoiGianBatDau)))*$sp->donGiaThue*$sp->soLuong;
                            }
                        }else{
                            if($sp->thoiGianKetThuc && $sp->thoiGianBatDau){
//                                dd($sp->giaDichVu);
                                $tong+=(\Carbon\Carbon::parse($sp->thoiGianKetThuc)->diffInHours(\Carbon\Carbon::parse($sp->thoiGianBatDau)))*$sp->giaDichVu;
                            }
                        }
                    }
                }
                $mgg = $donhang->maGiamGia;
//                dd($tong,$mgg);
                $data=null;
                if($mgg!=null){
                    $data=DB::table('magiamgia')
                        ->where('magiamgia','=',$mgg)
                        ->where('trangthai','>',0)
                        ->where('soluongcon','>',0)
                        ->first();
                }
                $magiam=null;
                if ($data){
                    $giam=0;
                    if($data->loai==1){
                        $giam = min($data->giatri*$tong,$data->giamtoida);
                    }else{
                        $giam= $data->giatri;
                    }
                    if ($data->toithieu<=$tong){
                        $magiam= $data->magiamgia;
                        $tong=$tong-$giam;
                    }
                }
//                dd($tong,$magiam);
                $tonghoantra=0;
                $phihoantra=$c1->thoiGianBatDau>Carbon::now()->addHour(12)?0.05*$donhang->tongTien:0.1*$donhang->tongTien;
                if($donhang->daThanhToan==1){
                    $hoantra=$donhang->tongTien-$tong;
                    $tonghoantra=$hoantra-$phihoantra;
                }else{
                    $tonghoantra=0-$phihoantra;
                }
//                dd($tonghoantra,$phihoantra);
                if (Auth::user()->soDuTaiKhoan + $tonghoantra < 0) {
                    \Illuminate\Support\Facades\Session::flash('message', 'Không thể hủy sân do cần ít nhất ' . number_format(-$tonghoantra) . ' VNĐ để hoàn trả!');
                    \Illuminate\Support\Facades\Session::flash('message_type', 'error');
                    return redirect()->route('user.donhang');
                }else{
                    DB::table('chitietthuesan')
                        ->where('thoiGianBatDau','=',$c1->thoiGianBatDau)
                        ->where('thoiGianKetThuc','=',$c1->thoiGianKetThuc)
                        ->where('maSan','=',$c1->maSan)
                        ->where('maDonHang','=',$donhang->id)
                        ->delete();
                    DB::table('donhang')
                        ->where('id','=',$donhang->id)
                        ->update([
                            'tongTien'=>$tong,
                            'maGiamGia'=>$magiam,
                        ]);
                    DB::table('nguoiDung')
                        ->where('maNguoiDung','=',Auth::user()->maNguoiDung)
                        ->update([
                            'soDuTaiKhoan'=>Auth::user()->soDuTaiKhoan+$tonghoantra,
                        ]);
                    LichSuNap::create([
                        'maNguoiDung'=>Auth::user()->maNguoiDung,
                        'soTien'=>$tonghoantra,
                        'ndck'=>"Phí dịch vụ cho việc hủy sân ở đơn hàng ".$donhang->id."",
                        'trangThai'=>1,
                        'loaiGD'=>2,
                        'thoiGian' => date('Y-m-d H:i:s'),
                        'transID'=>null,
                    ]);
                }
                \Illuminate\Support\Facades\Session::flash('message', 'Hủy đơn hàng thành công!');
                \Illuminate\Support\Facades\Session::flash('message_type', 'success');
                return redirect()->route('user.donhang');
            }

        }

    }
}

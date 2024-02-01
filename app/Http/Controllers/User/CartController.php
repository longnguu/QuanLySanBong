<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GioHang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $danhmuc = DB::table('loaiVP')
            ->get();
        $vatpham = DB::table('vatpham')
            ->where('trangthai','=','1')
            ->get();
        if (Auth::check()){
            $sanpham = DB::table('giohang')
                ->join('vatpham','vatpham.maVatPham','=','giohang.maVatPham')
                ->where('maSan','=',null)
                ->where('maNguoiDung','=',Auth::user()->maNguoiDung)
                ->select('giohang.*','vatpham.*','giohang.trangThai as tt')
                ->get();
            $sanpham1 = DB::table('giohang')
                ->join('sanbong','sanbong.maSan','=','giohang.maSan')
                ->leftjoin('vatpham','giohang.maVatPham','=','vatpham.maVatPham')
                ->where('maNguoiDung','=',Auth::user()->maNguoiDung)
                ->where('giohang.maSan','!=',null)
                ->orderBy('giohang.maSan','asc')
                ->orderBy('giohang.thoiGianBatDau','asc')
                ->orderBy('giohang.thoiGianKetThuc','asc')
                ->orderBy('giohang.id','asc')
                ->select('giohang.*','sanbong.*','vatpham.*','giohang.trangThai as tt')
                ->get();
//            dd($sanpham1->count());
//            dd($sanpham,$sanpham1);
            $tong=0;
            $tong += DB::table('giohang')
                ->join('vatpham', 'vatpham.maVatPham', '=', 'giohang.maVatPham')
                ->where('maNguoiDung', '=', Auth::user()->maNguoiDung)
                ->where('giohang.trangThai', '=', 1)
                ->where('giohang.maSan', '=', null)
                ->sum(DB::raw('donGiaBan * soLuong'));
            foreach ($sanpham1 as $sp)
            {
                $tongDat = $sp->thu!=null?count(explode(';', $sp->thu))*($sp->ngay/7):1;
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
            return view('User.pages.cart',[
                'cart'=> $sanpham,
                'cart1'=> $sanpham1,
                'danhmuc' => $danhmuc,
                'vatpham' => $vatpham,
                'tong'=>$tong,
            ]);
        }else{
            Session::flash('error','Bạn cần đăng nhập trước');
            \Illuminate\Support\Facades\Session::flash('message', 'Bạn cần đăng nhập trước!');
            \Illuminate\Support\Facades\Session::flash('message_type', 'error');
            return redirect('login');
        }
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $idsp = $request->maSan;
        $idND = Auth::user()->maNguoiDung;
        $sl=$request->soluong;
        $cart = DB::table('giohang')
            ->where('maSan','=',null)
            ->where('maVatPham','=',$idsp)
            ->where('maNguoiDung','=',$idND)
            ->first();
        if ($cart!=null){
            DB::table('giohang')
                ->where('maSan','=',null)
                ->where('maVatPham','=',$idsp)
                ->where('manguoiDung','=',$idND)
                ->update([
                    'soLuong'=>$cart->soLuong+($sl==null?1:$sl)
                ]);
        }else{
            DB::table('giohang')
                ->insert([
                    'maNguoiDung' => $idND,
                    'maVatPham' => $idsp,
                    'soLuong'=>($sl==null?1:$sl),
                    'hinhThucDat'=>1,
                ]);
        }

        \Illuminate\Support\Facades\Session::flash('success','Thêm thành công');
        return response()->json([
            'thongbao'=>'Thêm thành công',
        ]);
    }
    public function storet(Request $request)
    {
        //
        $idsp = $request->maSan;
        $time = $request->time;
        $lh = $request->loaihinh;
        $thoiGianBatDau = $request->time;
        $carbonThoiGianBatDau = \Carbon\Carbon::parse($thoiGianBatDau);
        if ($request->loaihinh==1){
            $carbonThoiGianKetThuc = Carbon::parse($thoiGianBatDau)->addHour($request->slthue);
        }else{
            $carbonThoiGianKetThuc = Carbon::parse($thoiGianBatDau)->addDays($request->slthue*$request->loaihinh);
        }
//        dd($request);
        $cs = DB::table('sanBong')
            ->join('coso', 'sanBong.maCoSo', '=', 'coso.maCoSo')
            ->where('sanBong.maSan', '=', $idsp)
            ->select('coso.*')
            ->first();
        if (($carbonThoiGianBatDau->day != $carbonThoiGianKetThuc->day) &&  !($cs->thoiGianMoCua!=0 &&  $cs->thoiGianDongCua!=23)){
            return response()->json([
                'thongbao'=>$cs->tenCoSo.' chỉ hoạt động từ '. $cs->thoiGianMoCua .'h đến '.$cs->thoiGianDongCua.'h',
            ]);
        }
        if (!($carbonThoiGianBatDau->hour >= $cs->thoiGianMoCua && $carbonThoiGianKetThuc->hour <= $cs->thoiGianDongCua)) {
            return response()->json([
                'thongbao'=>$cs->tenCoSo.' chỉ hoạt động từ '. $cs->thoiGianMoCua .'h đến '.$cs->thoiGianDongCua.'h',
            ]);
        }
        $htd= $lh==1?'1':($lh==7?2:3);
        $idND = Auth::user()->maNguoiDung;
        $check = DB::table('giohang')
            ->where('maNguoiDung','=',$idND)
            ->where('maSan','=',$idsp)
            ->where('thoiGianBatDau','=',$carbonThoiGianBatDau)
            ->where('thoiGianKetThuc','=',$carbonThoiGianKetThuc)
            ->first();
        if ($check){
//            \Illuminate\Support\Facades\Session::flash('error','Đã tồn tại sân');
            return response()->json([
                'thongbao'=>'Đã tồn tại sân tương tự trong giỏ hàng',
            ]);
        }else{
            $cart = GioHang::create([
                'maNguoiDung' => $idND,
                'maSan' => $idsp,
                'thoiGianBatDau'=>$carbonThoiGianBatDau,
                'thoiGianKetThuc'=>$carbonThoiGianKetThuc,
                'hinhThucDat'=>$htd,
            ]);
            \Illuminate\Support\Facades\Session::flash('success','Thêm thành công');
        }

//        dd($cart);
//        DB::table('giohang')
//            ->insert([
//                'maNguoiDung' => $idND,
//                'maSan' => $idsp,
//                'thoiGianBatDau'=>$carbonThoiGianBatDau,
//                'thoiGianKetThuc'=>$carbonThoiGianKetThuc,
//                'hinhThucDat'=>2,
//            ]);

        return response()->json([
            'thongbao'=>'Thêm thành công',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $vp=DB::table('vatpham')
            ->where('trangthai','=',1)
            ->first();
//        $maVatPham = $request->maVatPham;
        $maSan = $request->maSan;
        $idND = Auth::user()->maNguoiDung;
        $tgbd= $request->thoiGianBatDau;
        $tgkt= $request->thoiGianKetThuc;
        $htd= DB::table('giohang')
            ->where('maSan','=',$maSan)
            ->where('thoiGianBatDau','=',$tgbd)
            ->where('thoiGianKetThuc','=',$tgkt)
            ->first();
        $cart = GioHang::insert([
            'maNguoiDung' => $idND,
            'maSan' => $maSan,
            'maVatPham'=>$vp->maVatPham,
            'thoiGianBatDau'=>$tgbd,
            'thoiGianKetThuc'=>$tgkt,
            'hinhThucDat'=>$htd->hinhThucDat,
            'trangThai'=>$htd->trangThai,
            'thu'=>$htd->thu,
            'ngay'=>$htd->ngay,
            'created_at'=>$request->created_at,
            'updated_at'=>$request->created_at,
        ]);
//        DB::table('giohang')
//            ->insert([
//                'maNguoiDung' => $idND,
//                'maSan' => $maSan,
//                'maVatPham'=>$vp->maVatPham,
//                'thoiGianBatDau'=>$tgbd,
//                'thoiGianKetThuc'=>$tgkt,
//                'hinhThucDat'=>1,
//            ]);
//        for ($i = 0; $i < count($idSPs); $i++) {
//            $idsp = $idSPs[$i];
//            $sl = explode("/", $sls[$i])[0];
//            $tt= $tts[$i];
//            if ($sl>0){
//                DB::table('giohang')
//                    ->where('id_sp','=',$idsp)
//                    ->where('id_nd','=',$idND)
//                    ->update(['so_luong'=>$sl,'trangthai'=>$tt]);
//            }else{
//                DB::table('giohang')
//                    ->where('id_sp','=',$idsp)
//                    ->where('id_nd','=',$idND)
//                    ->delete();
//            }
//
//        }
//        \Illuminate\Support\Facades\Session::flash('success','Chỉnh sửa thành công');
//        return redirect('cart');
        $danhmuc = DB::table('loaiVP')
            ->get();
        $vatpham = DB::table('vatpham')
            ->where('trangthai','=','1')
            ->get();
        if (Auth::check()){
            $sanpham = DB::table('giohang')
                ->join('vatpham','vatpham.maVatPham','=','giohang.maVatPham')
                ->where('maNguoiDung','=',Auth::user()->maNguoiDung)
                ->get();
            $sanpham1 = DB::table('giohang')
                ->join('sanbong','sanbong.maSan','=','giohang.maSan')
                ->leftjoin('vatpham','giohang.maVatPham','=','vatpham.maVatPham')
                ->where('maNguoiDung','=',Auth::user()->maNguoiDung)
                ->orderBy('giohang.maSan','asc')
                ->orderBy('giohang.thoiGianBatDau','asc')
                ->orderBy('giohang.thoiGianKetThuc','asc')
                ->orderBy('giohang.id','asc')
                ->select('giohang.*','sanbong.*','vatpham.*','giohang.trangThai as tt')
                ->get();

//            dd($sanpham1->count());
//            dd($sanpham,$sanpham1);
            $tong=0;
            $tong += DB::table('giohang')
                ->join('vatpham', 'vatpham.maVatPham', '=', 'giohang.maVatPham')
                ->where('maNguoiDung', '=', Auth::user()->maNguoiDung)
                ->where('giohang.trangThai', '=', 1)
                ->where('giohang.maSan', '=', null)
                ->sum(DB::raw('donGiaBan * soLuong'));
            foreach ($sanpham1 as $sp)
            {
                $tongDat = $sp->thu!=null?count(explode(';', $sp->thu))*($sp->ngay/7):1;
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
            return[
                'html'=>
                view('User.pages.cart.ajaxcarttr',[
                'cart'=> $sanpham,
                'cart1'=> $sanpham1,
                'danhmuc' => $danhmuc,
                'vatpham' => $vatpham,
                'tong'=>$tong,
            ])->render(),'tong'=>$tong];
        }else{
            \Illuminate\Support\Facades\Session::flash('message', 'Bạn cần đăng nhập trước!');
            \Illuminate\Support\Facades\Session::flash('message_type', 'error');
            return redirect('login');
        }
        //

    }
    public function update1(Request $request)
    {
//        dd($request);
        if ($request->type == 'change'){
            DB::table('giohang')
                ->where('id','=',$request->id)
                ->update(['maVatPham'=>$request->item]);
        }else if($request->type == 'SL'){
            DB::table('giohang')
                ->where('id','=',$request->id)
                ->update(['soLuong'=>$request->item]);
        }else if($request->type == 'tt'){
            $cr = DB::table('giohang')
                ->where('id','=',$request->id)
                ->first();
//            if ($cr){
//            dd($request);
                DB::table('giohang')
                    ->where('maSan','=',$cr->maSan)
                    ->where('thoiGianBatDau','=',$cr->thoiGianBatDau)
                    ->where('thoiGianKetThuc','=',$cr->thoiGianKetThuc)
                    ->update(['trangThai'=>$request->item]);
//            }
        }else if($request->type == 'del'){
            DB::table('giohang')
                ->where('id','=',$request->id)
                ->delete();
        }else if($request->type == 'delAll'){
            $tableDel = DB::table('giohang')
                ->where('id','=',$request->id)
                ->first();
//            dd($tableDel);
            DB::table('giohang')
                ->where('maSan','=',$tableDel->maSan)
                ->where('thoiGianBatDau','=',$tableDel->thoiGianBatDau)
                ->where('thoiGianKetThuc','=',$tableDel->thoiGianKetThuc)
                ->delete();
        }else if($request->type == 'delvp'){
            DB::table('giohang')
                ->where('id','=',$request->id)
                ->delete();
        }
        else if($request->type == 'ttVP'){
            $cr = DB::table('giohang')
                ->where('id','=',$request->id)
                ->update(['trangThai'=>$request->item]);
        }
        $danhmuc = DB::table('loaiVP')
            ->get();
        $vatpham = DB::table('vatpham')
            ->where('trangthai','=','1')
            ->get();
        if (Auth::check()){
            $sanpham = DB::table('giohang')
                ->join('vatpham','vatpham.maVatPham','=','giohang.maVatPham')
                ->where('maNguoiDung','=',Auth::user()->maNguoiDung)
                ->get();
            $sanpham1 = DB::table('giohang')
                ->join('sanbong','sanbong.maSan','=','giohang.maSan')
                ->leftjoin('vatpham','giohang.maVatPham','=','vatpham.maVatPham')
                ->where('maNguoiDung','=',Auth::user()->maNguoiDung)
                ->orderBy('giohang.maSan','asc')
                ->orderBy('giohang.thoiGianBatDau','asc')
                ->orderBy('giohang.thoiGianKetThuc','asc')
                ->orderBy('giohang.id','asc')
                ->select('giohang.*','sanbong.*','vatpham.*','giohang.trangThai as tt')
                ->get();
            $tong=0;
            $tong += DB::table('giohang')
                ->join('vatpham', 'vatpham.maVatPham', '=', 'giohang.maVatPham')
                ->where('maNguoiDung', '=', Auth::user()->maNguoiDung)
                ->where('giohang.trangThai', '=', 1)
                ->where('giohang.maSan', '=', null)
                ->sum(DB::raw('donGiaBan * soLuong'));
            foreach ($sanpham1 as $sp)
            {
                $tongDat = $sp->thu!=null?count(explode(';', $sp->thu))*($sp->ngay/7):1;
                if ($sp->tt==1){
                    if ($sp->maSan==null){
                        $tong+=$sp->donGiaBan*$sp->soLuong;
                        dd($sp->donGiaBan*$sp->soLuong);
                    }else{
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
            }
//            dd($sanpham1->count());
//            dd($sanpham,$sanpham1);
            return [
                'html'=>
                view('User.pages.cart.ajaxcarttr',[
                'cart'=> $sanpham,
                'cart1'=> $sanpham1,
                'danhmuc' => $danhmuc,
                'vatpham' => $vatpham,
                'tong'=>$tong,
            ])->render(),'tong'=>$tong];
        }else{
            Session::flash('error','Bạn cần đăng nhập trước');
            return redirect('login');
        }
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function updatecart(Request $request)
    {
        $idsp = $request->id;
        $sl = $request->soluong;
        $idND = Auth::user()->id;
        $tt= $request->trangthai;
        if ($sl>0){
            DB::table('giohang')
                ->where('id_sp','=',$idsp)
                ->where('id_nd','=',$idND)
                ->update(['so_luong'=>$sl,'trangthai'=>$tt]);
        }else{
            DB::table('giohang')
                ->where('id_sp','=',$idsp)
                ->where('id_nd','=',$idND)
                ->delete();
        }
        $updatedCart = DB::table('giohang')
            ->join('sanpham','sanpham.id','=','id_sp')
            ->where('id_nd','=',Auth::user()->id)
            ->where('giohang.trangthai','=',1)
            ->get();

        $totalValue = $updatedCart->sum(function ($item) {
            return $item->giatrithuc * $item->so_luong;
        });

        $SubtotalValue = $updatedCart->sum(function ($item) {
            return $item->DonGia * $item->so_luong;
        });

        \Illuminate\Support\Facades\Session::flash('success','Chỉnh sửa thành công');

        return response()->json(['totalValue' => $totalValue, 'SubtotalValue' => $SubtotalValue]);
        //

    }
    public function checkout(Request $request){
        $sanpham = DB::table('giohang')
            ->join('sanbong','sanbong.maSan','=','giohang.maSan')
            ->leftjoin('vatpham','giohang.maVatPham','=','vatpham.maVatPham')
            ->where('maNguoiDung','=',Auth::user()->maNguoiDung)
            ->where('giohang.trangThai','=',1)
            ->orderBy('giohang.maSan','asc')
            ->orderBy('giohang.thoiGianBatDau','asc')
            ->orderBy('giohang.thoiGianKetThuc','asc')
            ->orderBy('giohang.id','asc')
            ->select('giohang.*','sanbong.*','vatpham.*','giohang.trangThai as tt')
            ->get();
        $tong=0;
        $tong += DB::table('giohang')
            ->join('vatpham', 'vatpham.maVatPham', '=', 'giohang.maVatPham')
            ->where('maNguoiDung', '=', Auth::user()->maNguoiDung)
            ->where('giohang.trangThai', '=', 1)
            ->where('giohang.maSan', '=', null)
            ->sum(DB::raw('donGiaBan * soLuong'));
        $donmua = DB::table('giohang')
            ->join('vatpham', 'vatpham.maVatPham', '=', 'giohang.maVatPham')
            ->where('maNguoiDung', '=', Auth::user()->maNguoiDung)
            ->where('giohang.trangThai', '=', 1)
            ->where('giohang.maSan', '=', null)
            ->select('giohang.*','sanbong.*','vatpham.*','giohang.trangThai as tt')
            ->get();
        foreach ($sanpham as $sp)
        {
            $tongDat = $sp->thu!=null?count(explode(';', $sp->thu))*($sp->ngay/7):1;
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
        return view('User.pages.checkout.checkout',[
            'sanpham'=>$sanpham,
            'donmua'=>$donmua,
            'tong'=>$tong,
        ]);
    }
    public function storetNC(Request $request)
    {
        //
//        if ($request->thu==null && $request->ngay!=null) {
//            \Illuminate\Support\Facades\Session::flash('message', 'Bạn cần chọn ít nhất 1 ngày để thực hiện chu kì đặt sân!');
//            Session::flash('message_type', 'error');
//            return redirect()->back();
//        }
//        dd($request->all());
        $idsp = $request->maSan;
        $time = $request->time;
        $lh = $request->loaihinh;
        $thoiGianBatDau = $request->time;
        $songay = $request->ngay?$request->ngay:7;
        $songay<7?$songay=7:$songay=$songay;
        $carbonThoiGianBatDau = \Carbon\Carbon::parse($thoiGianBatDau);
        $carbonThoiGianKetThuc = Carbon::parse($thoiGianBatDau)->addHour($request->slthue);
        $foundDates = [];
        $foundDates1 = [];
        $foundDay = [];
        $checks = [];
        if ($request->thu!=null){
            $idND = Auth::user()->maNguoiDung;
            for ($i = 0; $i < $songay; $i++) {
                    $thuArray = $request->thu;
                    $thuString = implode(';', $thuArray);
                    $currentDate = $carbonThoiGianBatDau->copy()->addDays($i);
                    $currentDateKT = Carbon::parse($currentDate)->addHour($request->slthue);
                    $dayOfWeek = $currentDate->dayOfWeek;
                    if (in_array($dayOfWeek, explode(';', $thuString))) {
                        $check = DB::table('giohang')
                            ->where('maNguoiDung', '=', $idND)
                            ->where('maSan', '=', $idsp)
                            ->where('maVatPham','=',null)
                            ->where('thoiGianBatDau', '=', $currentDate)
                            ->where('thoiGianKetThuc', '=', $currentDateKT)
                            ->first();
                        if ($check) {
                            return response()->json([
                                'thongbao'=>'Sân '.$idsp.', thời gian: '.$currentDate .' đến '.$currentDateKT.' đã tồn tại trong giỏ hàng!',
                            ]);
                        }
                }
            }
            $thuArray = $request->thu;
            $thuString = implode(';', $thuArray);
            $check = DB::table('giohang')
                ->where('maNguoiDung','=',$idND)
                ->where('maSan','=',$idsp)
                ->where('thoiGianBatDau','=',$carbonThoiGianBatDau)
                ->where('thoiGianKetThuc','=',$carbonThoiGianKetThuc)
                ->first();
            if ($check){
//            \Illuminate\Support\Facades\Session::flash('error','Đã tồn tại sân');
                return response()->json([
                    'thongbao'=>'Đã tồn tại sân tương tự trong giỏ hàng',
                ]);
            }
            $cart = GioHang::create([
                    'maNguoiDung' => $idND,
                    'maSan' => $idsp,
                    'thoiGianBatDau'=>$carbonThoiGianBatDau,
                    'thoiGianKetThuc'=>$carbonThoiGianKetThuc,
                    'hinhThucDat'=>1,
                    'thu'=>$thuString,
                    'ngay'=>$request->ngay,
                ]);
            \Illuminate\Support\Facades\Session::flash('success','Thêm thành công');
            return response()->json([
                'thongbao'=>'Thêm thành công',
            ]);

        }
        for ($i = 0; $i < $songay; $i++) {
            $currentDate = $carbonThoiGianBatDau->copy()->addDays($i);
            $currentDateKT = Carbon::parse($currentDate)->addHour($request->slthue);
            $dayOfWeek = $currentDate->dayOfWeek;
            $check = DB::table('chitietthuesan')
                ->where(function ($query) use ($currentDate, $currentDateKT,$idsp) {
                    $query->where('thoiGianBatDau', '<=', $currentDate)
                        ->where('thoiGianBatDau', '>=', $currentDateKT)
                        ->where('maSan', '=', $idsp)
                        ->where('maVatPham', '=', null);
                })
                ->orWhere(function ($query) use ($currentDate, $currentDateKT,$idsp) {
                    $query->where('thoiGianBatDau', '<=', $currentDateKT)
                        ->where('thoiGianKetThuc', '>=', $currentDateKT)
                        ->where('maSan', '=', $idsp)
                        ->where('maVatPham', '=', null);
                })
                ->first();
            if($check){
                if ($request->thu!=null){
                    Session::flash('message', 'Ngày bạn chọn bị trùng lịch!');
                    Session::flash('message_type', 'error');
                    return redirect()->route('cart');
                }
                $foundDates[] = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $currentDate->format('d/m/Y H:i:s'));
                $foundDates1[] = $currentDateKT->format('d/m/Y H:i:s');
                $foundDay[]=$dayOfWeek;
            }
        }

        return view('User.ajax.sanbongnangcao',[
            'maSan'=>$idsp,
            'thoiGianBatDau'=>$carbonThoiGianBatDau,
            'thoiGianKetThuc'=>$carbonThoiGianKetThuc,
            'songay'=>$songay,
            'checks'=>$checks,
            'foundDates'=>$foundDates,
            'foundDates1'=>$foundDates1,
            'foundDay'=>$foundDay,
        ]);
    }
}

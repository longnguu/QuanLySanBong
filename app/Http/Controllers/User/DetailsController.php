<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $product=DB::table('sanbong')->get();
        return view('User.Pages.Details.sanbong',[
            'product'=>$product,
        ]);
    }
    public function index1()
    {
        //
        $product=DB::table('vatpham')->get();
        return view('User.Pages.Details.sanpham',[
            'product'=>$product,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
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
    public function filter(Request $request){
//        $thoiGianBatDau = $request->time;
//        $carbonThoiGianBatDau = \Carbon\Carbon::parse($thoiGianBatDau);
//
//        $product = DB::table('chitietthuesan')
//            ->join('sanbong', 'chitietthuesan.maSan', '=', 'sanbong.maSan')
//            ->whereBetween('chitietthuesan.thoiGianBatDau', [$carbonThoiGianBatDau, $carbonThoiGianBatDau->copy()->addDays('chitietthuesan.maHinhThuc')]) // Thời gian bắt đầu trong khoảng 7 ngày
//            ->whereTime('chitietthuesan.thoiGianBatDau', '=', $carbonThoiGianBatDau->toTimeString()) // Chỉ lấy trong khoảng giờ từ 8h-9h
//            ->select('sanbong.*')
//            ->get();
//
//        $product = DB::table('chitietthuesan')
//            ->rightJoin('sanbong', 'chitietthuesan.maSan', '=', 'sanbong.maSan')
//            ->select('sanbong.*')
//            ->selectRaw('CASE
//                    WHEN
//                        ? BETWEEN chitietthuesan.thoiGianBatDau AND chitietthuesan.thoiGianKetThuc
//                        and ? BETWEEN chitietthuesan.thoiGianBatDau AND chitietthuesan.thoiGianKetThuc
//                    THEN 1
//                    ELSE 0
//                 END AS stt', [
//                $carbonThoiGianBatDau,
//                $carbonThoiGianKetThuc
//            ])
//            ->get();

        $thoiGianBatDau = $request->time;
        $sort=$request->sort;
//        dd($request);
        $carbonThoiGianBatDau = \Carbon\Carbon::parse($thoiGianBatDau);
        if ($request->loaihinh==1){
            $carbonThoiGianKetThuc = Carbon::parse($thoiGianBatDau)->addHour($request->slthue);
        }else{
            $carbonThoiGianKetThuc = Carbon::parse($thoiGianBatDau)->addDays($request->slthue*$request->loaihinh);
        }


        $product = DB::table('chitietthuesan')
            ->rightJoin('sanbong', 'chitietthuesan.maSan', '=', 'sanbong.maSan')
            ->select('sanbong.*')
            ->selectRaw('CASE
                    WHEN
                        ? < chitietthuesan.thoiGianKetThuc
                        and
                        ? > chitietthuesan.thoiGianBatDau
                    THEN 1
                    ELSE 0
                 END AS stt', [
                $carbonThoiGianBatDau,
                $carbonThoiGianKetThuc
            ])
            ->orderByRaw('
        CASE
            WHEN ? = 1 THEN sanbong.tenSan END ASC,
        CASE
            WHEN ? = 2 THEN sanbong.tenSan END DESC,
        CASE
            WHEN ? = 3 THEN sanbong.giaDichVu END ASC,
        CASE
            WHEN ? = 4 THEN sanbong.giaDichVu END DESC', [
                $sort,
                $sort,
                $sort,
                $sort
            ])
            ->get();
        return view('User.Ajax.sanbong',['product'=>$product]);
    }
    public function filter1(Request $request){
        $thoiGianBatDau = $request->time;
        $carbonThoiGianBatDau = \Carbon\Carbon::parse($thoiGianBatDau);
        if ($request->loaihinh==1){
            $carbonThoiGianKetThuc = Carbon::parse($thoiGianBatDau)->addHour($request->loaihinh);
        }else{
            $carbonThoiGianKetThuc = Carbon::parse($thoiGianBatDau)->addDays($request->loaihinh);
        }


        $product = DB::table('chitietthuesan')
            ->rightJoin('sanbong', 'chitietthuesan.maSan', '=', 'sanbong.maSan')
            ->select('sanbong.*')
            ->selectRaw('CASE
                    WHEN
                        ? < chitietthuesan.thoiGianKetThuc
                        and
                        ? > chitietthuesan.thoiGianBatDau
                    THEN 1
                    ELSE 0
                 END AS stt', [
                $carbonThoiGianBatDau,
                $carbonThoiGianKetThuc
            ])
            ->get();
        $product=DB::table('vatpham')->get();
        return view('User.Ajax.sanpham',['product'=>$product]);
    }
}

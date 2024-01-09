<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function dashboard()
    {
        $topSellingProduct = DB::table('vatpham')
            ->select('vatpham.maVatPham','vatpham.tenVatPham','vatpham.donGiaBan', 'trangthai as tong_soluong_ban')
            ->groupBy('vatpham.maVatPham','vatpham.tenVatPham','vatpham.donGiaBan','trangthai')
            ->orderByDesc('tong_soluong_ban')
            ->take(5)->get();
        $noibat = DB::table('loaiVP')->take(5)->get();
        $data['banchay'] = $topSellingProduct;
        $data['noibat'] = $noibat;
        return view('admin.pages.dashboard', $data);
    }
}

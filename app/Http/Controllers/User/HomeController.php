<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\VatPham;
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
        $product=DB::table('vatpham')
            ->where('trangThai','=','1')
            ->get();
        $sb=DB::table('sanbong')
            ->get();
//        dd($product);
        return view('User.Pages.index',['product'=>$product,'sanbong'=>$sb]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('User.Pages.cart');
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
}

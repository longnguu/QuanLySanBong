<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Discount::get();
        return view('admin.pages.discount.index', ['list_discount' => $list]);
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

    public function addDiscount()
    {
        return view('admin.pages.discount.add');
    }

    public function addDiscountPost(Request $request)
    {
        $data = $request->all();
        $new = new Discount();
        $new->TenKM = $request->TenKM;
        $new->LoaiKM = $request->LoaiKM;
        $new->GiaTriKM = $request->GiaTriKM;
        $new->NgayBD = $request->NgayBD;
        $new->NgayKT = $request->NgayKT;
        $new->TrangThai = $request->TrangThai;
        $new->save();
        return redirect()->route("admin.discount.index")->with('add', 'Data inserted thành công');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoSo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoSoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cate = DB::table('coso')->get();
        return view('admin.pages.coso.index', ['list_cate' => $cate]);
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
        $product = CoSo::find($id);
        return view('admin.pages.coso.edit',['cate'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $new = CoSo::find($id);
        $new->tenCoSo = $request->TenDM;
        $new->moTa = $request->moTa;
        $new->diaChi = $request->diaChi;
        $new->thoiGianMoCua = $request->gmc;
        $new->thoiGianDongCua = $request->gdc;
        $new->save();
        return redirect()->route("admin.coso.index")->with('updated', 'Chỉnh sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function addCoSo()
    {
        return view('admin.pages.coso.add');
    }
    public function addCoSoPost(Request $request)
    {
        $data = $request->all();
        $new = new CoSo();
        $new->tenCoSo = $request->TenDM;
        $new->moTa = $request->moTa;
        $new->diaChi = $request->diaChi;
        $new->thoiGianMoCua = $request->gmc;
        $new->thoiGianDongCua = $request->gdc;
        $new->save();
        return redirect()->route("admin.coso.index")->with('add', 'Thêm thành công');
    }
}

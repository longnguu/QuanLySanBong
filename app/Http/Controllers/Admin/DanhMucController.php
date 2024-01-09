<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DanhMucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cate = DB::table('loaivp')->get();
        return view('admin.pages.category.index', ['list_cate' => $cate]);
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
        $cate = Category::find($id);
        $data['cate'] = $cate;
        return view('admin.pages.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $new = Category::find($id);
        $new->tenLoaiVP = $request->TenDM;
        $new->moTa = $request->moTa;
        $new->save();
        return redirect()->route("admin.category.index")->with('updated', 'Data updted thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function addCate()
    {
        return view('admin.pages.category.add');
    }

    public function addCatePost(Request $request)
    {
        $data = $request->all();
        $new = new Category();
        $new->tenLoaiVP = $request->TenDM;
        $new->moTa = $request->moTa;
        $new->save();
        return redirect()->route("admin.category.index")->with('add', 'Data inserted thành công');
    }
}

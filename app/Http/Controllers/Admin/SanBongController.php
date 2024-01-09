<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SanBong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SanBongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cate = DB::table('sanbong')->get();
        return view('admin.pages.sanbong.index', ['list_cate' => $cate]);
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
        $product = SanBong::find($id);
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
    public function addCoSo()
    {
        return view('admin.pages.sanbong.add');
    }
    public function addCoSoPost(Request $request)
    {
        $data = $request->all();
        $new = new SanBong();
        $new->tenCoSo = $request->TenDM;
        $new->moTa = $request->moTa;
        $new->save();
        return redirect()->route("admin.category.index")->with('add', 'Data inserted thành công');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ThongBaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.pages.thongbao.index');
    }
    public function send(Request $request)
    {
        //
//        dd($request);

        Session::flash('updated', 'Gửi thông báo thành công');
//        Session::flash('message_type', 'success');
        $thongBao=\App\Models\ThongBao::create([
            'maNguoiDung' => $request->maNguoiDung,
            'noiDung' => $request->noiDung,
            'loaiTB' => $request->loaiTB,
            'tieuDe' => $request->tieuDe,
        ]);
        if ($request->loaiTB==1){
            broadcast(new \App\Events\ThongBao(3,$request->noiDung,2));
            return redirect()->route('admin.thongbao.index');
        }elseif($request->loaiTB==2){
            broadcast(new \App\Events\ThongBao(1,$request->noiDung,2));
            return redirect()->route('admin.thongbao.index');
        }else{
            broadcast(new \App\Events\ThongBao($request->maNguoiDung,$request->noiDung,1));
            return redirect()->route('admin.thongbao.index');
        }
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
}

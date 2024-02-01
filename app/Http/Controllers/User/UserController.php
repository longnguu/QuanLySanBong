<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
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
    public function user_inf()
    {
        if(Auth::check()== false)
//            dd(Session());
            return redirect()->intended('/login');
        else {
            $result = DB::table('nguoidung')->where('maNguoiDung', Auth::user()->maNguoiDung)->first();
            return view('user.pages.profile', ['user'=>$result]);
        }
    }
    public function update_user_inf(Request $request)
    {
//        dd($request);
        $request->validate([
            'hinhAnh' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'anhBia' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ], [
            'hinhAnh.image' => 'Hình ảnh phải là một tệp hình ảnh.',
            'hinhAnh.mimes' => 'Hình ảnh phải có định dạng là jpeg, png, jpg, gif, svg, hoặc webp.',
            'hinhAnh.max' => 'Kích thước tệp hình ảnh không được vượt quá 2048 KB.',
            'anhBia.image' => 'Hình ảnh phải là một tệp hình ảnh.',
            'anhBia.mimes' => 'Hình ảnh phải có định dạng là jpeg, png, jpg, gif, svg, hoặc webp.',
            'anhBia.max' => 'Kích thước tệp hình ảnh không được vượt quá 2048 KB.',
        ]);
        $hinhAnh=null;
        $anhBia=null;
        if ($request->hasFile('hinhAnh')) {
            $fileName1 = $request->file('hinhAnh')->getClientOriginalName();
            $fileName1 = time() . $fileName1;
            $request->file('hinhAnh')->storeAs('public/img/products', $fileName1);
            $hinhAnh = 'img/products/'.$fileName1;
        }
        if ($request->hasFile('anhBia')) {
            $fileName1 = $request->file('anhBia')->getClientOriginalName();
            $fileName1 = time() .'b'. $fileName1;
            $request->file('anhBia')->storeAs('public/img/products', $fileName1);
            $anhBia = 'img/products/'.$fileName1;
        }
        DB::table('nguoidung')
            ->where('maNguoiDung', Auth::user()->maNguoiDung)
            ->update([
                'ho'=>$request->ho,
                'ten'=>$request->ten,
                'gioiTinh'=>$request->id_gender,
                'SDT'=>$request->sdt,
                'diaChi'=>$request->diachi,
                'cccd'=>$request->cccd,
                'hinhAnh' => $hinhAnh !== null ? $hinhAnh : DB::raw('hinhAnh'),
                'anhBia' => $anhBia !== null ? $anhBia : DB::raw('anhBia'),
                'maPhuong'=>$request->xaphuong,
                'ngaySinh'=>$request->birthday,
            ]);
        Session::flash('message', 'Cập nhật thông tin thành công!');
        Session::flash('message_type', 'success');
        return redirect()->intended('/profile');
    }
    public function chat(Request $request,$uid)
    {
        return view('User.chat.chat',['usid'=>$uid]);
    }
}

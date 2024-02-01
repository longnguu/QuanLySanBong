<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
//        $list = DB::table('nguoidung')
//            ->join('quyen', 'nguoidung.maQuyen', '=', 'quyen.maQuyen')
//            ->select('*')
//            ->orderBy('nguoidung.maQuyen')
//            ->get();
//        dd($request->user);
        $list = DB::table('nguoidung')
            ->join('quyen', 'nguoidung.maQuyen', '=', 'quyen.maQuyen')
            ->join('devvn_xaphuongthitran', 'nguoidung.maPhuong', '=', 'devvn_xaphuongthitran.xaid')
            ->join('devvn_quanhuyen', 'devvn_xaphuongthitran.maqh', '=', 'devvn_quanhuyen.maqh')
            ->join('devvn_tinhthanhpho', 'devvn_quanhuyen.matp', '=', 'devvn_tinhthanhpho.matp')
            ->select('nguoidung.*', 'quyen.*', 'devvn_xaphuongthitran.name AS xaphuong_name', 'devvn_quanhuyen.name AS quanhuyen_name', 'devvn_tinhthanhpho.name AS tinhthanh_name')
            ->orderBy('nguoidung.maQuyen')
            ->paginate(10)->withQueryString();
        if ($request->user!=null) {
            $list = DB::table('nguoidung')
                ->join('quyen', 'nguoidung.maQuyen', '=', 'quyen.maQuyen')
                ->join('devvn_xaphuongthitran', 'nguoidung.maPhuong', '=', 'devvn_xaphuongthitran.xaid')
                ->join('devvn_quanhuyen', 'devvn_xaphuongthitran.maqh', '=', 'devvn_quanhuyen.maqh')
                ->join('devvn_tinhthanhpho', 'devvn_quanhuyen.matp', '=', 'devvn_tinhthanhpho.matp')
                ->select('nguoidung.*', 'quyen.*', 'devvn_xaphuongthitran.name AS xaphuong_name', 'devvn_quanhuyen.name AS quanhuyen_name', 'devvn_tinhthanhpho.name AS tinhthanh_name')
                ->where('nguoidung.ten', 'like', '%' . $request->user . '%')
                ->orderBy('nguoidung.maQuyen')
                ->paginate(10)->withQueryString();
        }
//        dd($list);
        return view('admin.pages.user.index', ['list' => $list]);
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
        $role=DB::table('quyen')->get();
        $user=DB::table('nguoidung')->where('maNguoiDung','=',$id)->first();
        return view('admin.pages.user.edit', ['user'=>$user,'role'=>$role]);
    }

    public function addUser()
    {
        //
        $role=DB::table('quyen')->get();
//        $user=DB::table('nguoidung')->where('maNguoiDung','=',$id)->first();
        return view('admin.pages.user.add', ['quyen'=>$role]);
    }

    public function addUserPost(string $id)
    {
        //
        $role=DB::table('quyen')->get();
        $user=DB::table('nguoidung')->where('maNguoiDung','=',$id)->first();
        return view('admin.pages.user.edit', ['user'=>$user,'role'=>$role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
//        dd($request->all());
        DB::table('nguoidung')
            ->where('maNguoiDung', '=', $id)
            ->update([
                'ho' => $request->Ho,
                'ten' => $request->Ten,
                'gioiTinh' => $request->GioiTinh,
                'sdt' => $request->SDT==null?null:$request->SDT,
                'diaChi' => $request->DiaChi,
                'maQuyen' => $request->Quyen_id,
                'trangThai' => $request->TrangThai,
            ]);
        $role=DB::table('quyen')->get();
        $user=DB::table('nguoidung')->where('maNguoiDung','=',$id)->first();
        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

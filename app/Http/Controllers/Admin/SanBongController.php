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
    public function addSanBong()
    {
        //
//        $cate = DB::table('sanbong')->where('maSan','=',$request->id)->first();
        return view('admin.pages.sanbong.add');
    }
    public function addSanBongPost(Request $request)
    {
        //
        $sanbong = SanBong::insert([
            'maCoSo' => $request->maCoSo,
            'tenSan' => $request->tenSan,
            'moTa' => $request->moTa,
            'trangThai' => 1,
            'loaiSan' => $request->loaiSan,
            'giaDichVu' => $request->giaDichVu,
            ]);

        return redirect()->route("admin.sanbong.index")->with('add', 'Data inserted thành công');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
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
        return view('admin.pages.sanbong.edit',['product'=>$product]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $sanbong = DB::table('sanbong')
            ->where('maSan','=',$id)
            ->update([
                'maCoSo' => $request->maCoSo,
                'tenSan' => $request->tenSan,
                'moTa' => $request->moTa,
                'trangThai' => 1,
                'loaiSan' => $request->loaiSan,
                'giaDichVu' => $request->giaDichVu,
            ]);
        return redirect()->route("admin.sanbong.index")->with('updated', 'Data updated thành công');
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
    public function active($id)
    {
        $pr = SanBong::find($id);
        if ($pr->trangThai == 1) {
            $pr->trangThai = 0;
        } else {
            $pr->trangThai = 1;
        }
        $pr->save();
        return redirect()->back()->with('active', 'Đã cập nhật trạng thái sân' . $id);
    }

}

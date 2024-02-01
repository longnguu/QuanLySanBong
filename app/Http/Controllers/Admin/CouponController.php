<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list = DB::table('magiamgia')->get();
        return view('admin.pages.coupon.index', ['list_discount' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discount = Coupon::find($id);
        $data['discount'] = $discount;
        return view('admin.pages.coupon.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'magiamgia'=>'required',
            'trangthai'=> 'required',
            'loai' => 'required',
            'giatri' => 'required',
            'toithieu'=>'required',
            'giamtoida'=>'required',
            'soluongcon' => 'required',
        ]);
        $new = Coupon::find($id);
        $new->magiamgia = $request->magiamgia;
        $new->trangthai = $request->trangthai;
        $new->loai = $request->loai;
        $new->giatri = $request->giatri;
        $new->toithieu = $request->toithieu;
        $new->giamtoida = $request->giamtoida;
        $new->soluongcon = $request->soluongcon;
        if ($request->loai == 0 ){
            $mota = "Mã giảm ".$request->giatri." cho đơn hàng từ ".$request->toithieu;
        }else{
            $mota = "Mã giảm ".$request->giatri."% tối đa ".$request->giamtoida." cho đơn hàng từ ".$request->toithieu;
        }
        $new->mota= $mota;
        $new->save();
        return redirect()->route("admin.coupon.index")->with('updated', 'Data updted thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find = Coupon::find($id);
        $find->delete();
        return redirect()->route("admin.coupon.index")->with('del', 'Data deleted thành công');
    }
    public function addCoupon()
    {
        return view('admin.pages.coupon.add');
    }
    public function addCouponPost(Request $request)
    {
//        dd($request);
        $request->validate([
            'magiamgia'=>'required',
            'trangthai'=> 'required',
            'loai' => 'required',
            'giatri' => 'required',
            'toithieu'=>'required',
            'giamtoida'=>'required',
            'soluongcon' => 'required',
        ]);
        $data = $request->all();

        $new = new Coupon();
        $new->magiamgia = $request->magiamgia;
        $new->trangthai = $request->trangthai;
        $new->loai = $request->loai;
        $new->giatri = $request->giatri;
        $new->toithieu = $request->toithieu;
        $new->giamtoida = $request->giamtoida;
        $new->soluongcon = $request->soluongcon;
        if ($request->loai == 0 ){
            $mota = "Mã giảm ".$request->giatri." cho đơn hàng từ ".$request->toithieu;
        }else{
            $mota = "Mã giảm ".$request->giatri."% tối đa ".$request->giamtoida." cho đơn hàng từ ".$request->toithieu;
        }
        $new->mota= $mota;
        $new->save();
        return redirect()->route("admin.coupon.index")->with('add', 'Thêm thành công');
    }
}

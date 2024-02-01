<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->key){
            $list = DB::table('donhang')
                ->where('loaiDonHang','=',1)
                ->where('id','=',$request->key  )
                ->orderBy('donhang.id','desc')
                ->paginate(10)->withQueryString();
            return view('admin.pages.order.index', ['list_order' => $list]);
        }
        $list = DB::table('donhang')->where('loaiDonHang','=',1)->orderBy('donhang.id','desc')->paginate(10)->withQueryString();
        return view('admin.pages.order.index', ['list_order' => $list]);
    }
    public function adminfil(Request $request)
    {
        //
        if ($request->luachon==1){
            $list = DB::table('donhang')
                ->leftJoin('chitietthuesan','donhang.id','=','chitietthuesan.maDonHang')
                ->orderBy('donhang.id', 'desc')
                ->select('donhang.*')
                ->distinct()
                ->paginate(10)->withQueryString();
            return view('admin.pages.ajax.donthue', ['list_order' => $list]);
        }else{
            $list = DB::table('donhang')
                ->leftJoin('chitietthuesan','donhang.id','=','chitietthuesan.maDonHang')
                ->where('chitietthuesan.thoiGianBatDau', '=', $request->input('time'))
                ->select('donhang.*')
                ->distinct()
                ->orderBy('donhang.id', 'desc')
                ->paginate(10)->withQueryString();
            return view('admin.pages.ajax.donthue', ['list_order' => $list]);
        }

        return view('admin.pages.ajax.donthue', ['list_order' => $list]);
    }
    public function index1()
    {
        //
        $list = DB::table('donhang')
            ->where('loaiDonHang','=',2)
            ->orderBy('donhang.id','desc')
            ->paginate(10)
            ->withQueryString();
        return view('admin.pages.order.index1', ['list_order' => $list]);
    }
    public function detail($id)
    {

        $or = DB::table('donhang')
            ->where('id', $id)
            ->first();
        $data['order'] = $or;
        $order_detail =
            DB::table('chitietthuesan')
            ->leftJoin('sanbong', 'chitietthuesan.maSan', 'sanbong.maSan')
            ->leftJoin('vatpham', 'chitietthuesan.maVatPham', 'vatpham.maVatPham')
            ->where('maDonHang', $id)
                ->orderBy('chitietthuesan.maSan', 'asc')
                ->orderBy('chitietthuesan.thoiGianBatDau', 'asc')
                ->orderBy('chitietthuesan.thoiGianKetThuc', 'asc')
            ->select('chitietthuesan.*','sanbong.*', 'vatpham.tenVatPham','vatpham.donGiaBan','vatpham.donGiaThue')->get();
        $data['order_detail'] = $order_detail;
//        dd($data);
        return view('admin.pages.order.detail', $data);
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

    public function action($id)
    {
        $order = DB::table('donhang')->where('id','=',$id)->first();
        if ($order->trangThai == 0) {
            DB::table('donhang')
                ->where('id','=',$id)
                ->update([
                    'trangThai' => 1,
                ]);
        } elseif ($order->trangThai == 1) {//Đưa đơn hàng sang trang thái đang giao
            DB::table('donhang')
                ->where('id','=',$id)
                ->update([
                    'trangThai' => 2,
                ]);
        } elseif ($order->trangThai  == 2) {//Đưa đơn hàng sang trang thái đã giao
            DB::table('donhang')
                ->where('id','=',$id)
                ->update([
                    'trangThai' => 3,
                ]);
        }
        Session::flash('message', 'Đã chuyển trạng thái!');
        Session::flash('message_type', 'success');
        return redirect()->back();
    }

    public function cancel($id)
    {
        $order = Order::find($id);
        $detailOrder = DB::table('chitiethoadon')->where('MaHD', $id)->get();
        if ($detailOrder) {
            foreach ($detailOrder as $value) {
                $product = Product::find($value->MaSP);
                $product->SoLuong = $product->SoLuong + $value->SoLuong;
                $product->save();
            }
        }
        if($order->pttt!=null){
            DB::table('nguoidung')
                ->where('id','=',$order->MaND)
                ->update([
                    'sodu' => DB::raw('sodu + ' . $order->tongTien),
                ]);
        }
        $order->TrangThai = 4;
        $order->save();
        return redirect()->back()/*->with('cancel', 'Đã hủy ĐH'. $id)*/
            ;

    }
    public function danhantien($id)
    {
        $order = DB::table('donhang')->where('id','=',$id)->first();
        if ($order->daThanhToan == 0) {
            DB::table('donhang')
                ->where('id','=',$id)
                ->update([
                    'daThanhToan' => 1,
                ]);
        }
        Session::flash('message', 'Đã chuyển trạng thái!');
        Session::flash('message_type', 'success');
        return redirect()->back();
    }
}

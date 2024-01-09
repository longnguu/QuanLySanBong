<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SanBong;
use App\Models\VatPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $list = DB::table('vatpham')
            ->join('loaivp', 'vatpham.maLoaiVP', '=', 'loaivp.maLoaiVP')
            ->join('khuyenmai', 'vatpham.maKhuyenMai', '=', 'khuyenmai.maKM')
            ->select('vatpham.*', 'loaiVP.tenLoaiVP', 'khuyenmai.TenKM')
            ->orderBy('vatpham.maVatPham')
            ->get();
        if ($id = request()->product) {
            $list = DB::table('vatpham')
                ->join('loaivp', 'vatpham.maLoaiVP', '=', 'loaivp.maLoaiVP')
                ->join('khuyenmai', 'vatpham.maKhuyenMai', '=', 'khuyenmai.maKM')
                ->select('vatpham.*', 'loaiVP.tenLoaiVP', 'khuyenmai.TenKM')
                ->where('vatpham.tenVatPham', 'like', '%' . $id . '%')
                ->orderBy('vatpham.maVatPham')
                ->get();
        }
        $list_brand = DB::table('loaiVP')
            ->get();
        $data['list_brand'] = $list_brand;
        $data['list_product'] = $list;
        return view('admin.pages.product.index', $data);
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
        $product = VatPham::find($id);
//        dd($product);
        $br = DB::table('loaiVP')->get();
        $km = DB::table('khuyenmai')->get();
        $data['product'] = $product;
        $data['br'] = $br;
        $data['km'] = $km;
//        dd($data);
        return view('admin.pages.product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->all();
        $new = VatPham::find($id);
        $new->maKhuyenMai = $request->maKM;
        $new->tenVatPham = $request->TenSP;
        $new->maLoaiVP = $request->TH_id;
        $new->moTa = $request->MoTa;
        $new->donGiaBan = $request->DonGiaBan;
        $new->donGiaThue = $request->DonGiaThue;
        $new->soLuongCon = $request->SoLuong;

        $request->validate([
            'HinhAnh1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'HinhAnh2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'HinhAnh3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $request->validate([
            'HinhAnh1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'HinhAnh2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'HinhAnh3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('HinhAnh1')) {
            $fileName1 = $request->file('HinhAnh1')->getClientOriginalName();
            $fileName1 = time() . '_1' . $fileName1;
            $request->file('HinhAnh1')->storeAs('public/img/products', $fileName1);
            $new->hinhAnh1 = 'img/products/'.$fileName1;
        }
        if ($request->hasFile('HinhAnh2')) {
            $fileName2 = $request->file('HinhAnh2')->getClientOriginalName();
            $fileName2 = time() . '_2' . $fileName2;
            $request->file('HinhAnh2')->storeAs('public/img/products', $fileName2);
            $new->hinhAnh2 = 'img/products/'.$fileName2;
        }
        if ($request->hasFile('HinhAnh3')) {
            $fileName3 = $request->file('HinhAnh3')->getClientOriginalName();
            $fileName3 = time() . '_3' . $fileName3;
            $request->file('HinhAnh3')->storeAs('public/img/products', $fileName3);
            $new->hinhAnh3 = 'img/products/'.$fileName3;
        }

        $new->maKhuyenMai = $request->KM_id;
        $new->trangThai = $request->TrangThai;
        $new->save();

        return redirect()->route("admin.product.index")->with('add', 'Thêm thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('vatpham')->where('maVatPham', $id)->delete();
        return redirect()->route("admin.product.index")->with('del', 'Data deleted thành công');
    }

    public function addProduct()
    {
        $br = DB::table('loaiVP')->get();
        $km = DB::table('khuyenmai')->get();
        $data['title'] = "Thêm sản phẩm";
        $data['br'] = $br;
        $data['km'] = $km;
        return view('admin.pages.product.add', $data);
    }

    public function addProductPost(Request $request)
    {
        $data = $request->all();
        $new = new VatPham();
        $new->maLoaiVP = $request->maLoaiVP;
        $new->maKhuyenMai = $request->maKM;
        $new->tenVatPham = $request->TenSP;
        $new->moTa = $request->MoTa;
        $new->donGiaBan = $request->DonGiaBan;
        $new->donGiaThue = $request->DonGiaThue;
        $new->soLuongCon = $request->SoLuong;
        dd($request);
        $request->validate([
            'HinhAnh1' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'HinhAnh2' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'HinhAnh3' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $request->validate([
            'HinhAnh1' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'HinhAnh2' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'HinhAnh3' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('HinhAnh1')) {
            $fileName1 = $request->file('HinhAnh1')->getClientOriginalName();
            $fileName1 = time() . '_1' . $fileName1;
            $request->file('HinhAnh1')->storeAs('public/img/products', $fileName1);
            $new->hinhAnh1 = 'img/products/'.$fileName1;
        }
        if ($request->hasFile('HinhAnh2')) {
            $fileName2 = $request->file('HinhAnh2')->getClientOriginalName();
            $fileName2 = time() . '_2' . $fileName2;
            $request->file('HinhAnh2')->storeAs('public/img/products', $fileName2);
            $new->hinhAnh2 = 'img/products/'.$fileName2;
        }
        if ($request->hasFile('HinhAnh3')) {
            $fileName3 = $request->file('HinhAnh3')->getClientOriginalName();
            $fileName3 = time() . '_3' . $fileName3;
            $request->file('HinhAnh3')->storeAs('public/img/products', $fileName3);
            $new->hinhAnh3 = 'img/products/'.$fileName3;
        }

        $new->maKhuyenMai = $request->KM_id;
        $new->trangThai = $request->TrangThai;
        $new->save();
        dd($new);

        return redirect()->route("admin.product.index")->with('add', 'Thêm thành công');
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

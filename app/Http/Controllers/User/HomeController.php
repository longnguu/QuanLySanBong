<?php

namespace App\Http\Controllers\User;

use App\Events\BankCallBack;
use App\Events\callBackBank;
use App\Http\Controllers\Controller;
use App\Models\LichSuNap;
use App\Models\VatPham;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
//        dd($request->ip());
        $product=DB::table('vatpham')
            ->where('trangThai','=','1')
            ->where('soLuongCon','>',0)
            ->get();
        $sb=DB::table('sanbong')
            ->get();
//        dd($product);
        return view('User.Pages.index',['product'=>$product,'sanbong'=>$sb]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('User.Pages.cart');
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
    public function filSPbyDM(Request $request)
    {
        //
        if ($request->category==null) {
            $product = DB::table('vatpham')
                ->where('trangThai', '=', '1')
                ->get();
            return view('User.Pages.cart.ajaxcbb', ['vatpham' => $product]);
        }
        else
            $product=DB::table('vatpham')
                ->where('trangThai','=','1')
                ->where('maLoaiVP','=',$request->category)
                ->get();
            return view('User.Pages.cart.ajaxcbb',['vatpham'=>$product]);

    }
    public function updateCart(Request $request){
        $id=$request->id;
        $qty=$request->qty;
        $product=VatPham::find($id);
        $product->soLuong=$qty;
        $product->save();
        return response()->json(['success'=>'Cập nhật thành công']);

    }
    public function get_data_location(Request $request)
    {
        $idt = $request->id_tinh;
        $idh = $request->id_huyen;
//        dd(1);
        if ($request->stt==null){
        }else{
            if($request->stt==0){
                $data=DB::table('devvn_quanhuyen')
                    ->select("devvn_quanhuyen.*")
                    ->join('devvn_tinhthanhpho','devvn_quanhuyen.matp','=','devvn_tinhthanhpho.matp')
                    ->where('devvn_quanhuyen.matp', '=', $idt)
                    ->get();
                $data1= DB::table('devvn_xaphuongthitran')
                    ->select('devvn_xaphuongthitran.*')
                    ->join('devvn_quanhuyen','devvn_quanhuyen.maqh','=','devvn_xaphuongthitran.maqh')
                    ->join('devvn_tinhthanhpho','devvn_quanhuyen.matp','=','devvn_tinhthanhpho.matp')
                    ->where('devvn_quanhuyen.matp', '=', $idt)
                    ->get();
//                dd(view('User.Ajax.cbbquanhuyen',['data'=>$data])->render());
                return [
                    'cbbqh'=>view('User.Ajax.cbbquanhuyen',['data'=>$data])->render(),
                    'cbbxp'=>view('User.Ajax.cbbxaphuong',['data'=>$data1])->render(),
                ];
            }
            if($request->stt==1){
                $data= DB::table('devvn_xaphuongthitran')
                    ->select('devvn_xaphuongthitran.*')
                    ->join('devvn_quanhuyen','devvn_quanhuyen.maqh','=','devvn_xaphuongthitran.maqh')
                    ->where('devvn_xaphuongthitran.maqh', '=', $idh)
                    ->get();
                return [
                    'cbbxp'=>view('User.Ajax.cbbxaphuong',['data'=>$data])->render(),
                ];
            }
        }
        \Illuminate\Support\Facades\Session::flash('success', 'Chỉnh sửa thành công');


    }
    public function addcoupon(Request $request)
    {
        $mgg = $request->magiamgia;
        $data=null;
        if($mgg!=null){
            $data=DB::table('magiamgia')
                ->where('magiamgia','=',$mgg)
                ->where('trangthai','>',0)
                ->where('soluongcon','>',0)
                ->first();
        }

        \Illuminate\Support\Facades\Session::flash('success', 'Thêm mã giảm giá thành công');
        return response()->json(['data' => $data]);
    }
    public function naptien(Request $request)
    {
//        $apiUrl = 'https://api.web2m.com/historyapimb/Sonicmaster54/0300183159999/2F19BC57-21A6-E839-81C0-1C0FDF8B8274';
//        $client = new Client();
//        try {
//            $response = $client->get($apiUrl);
//            $jsonResponse = $response->getBody()->getContents();
//            $data = json_decode($jsonResponse, true);
//            $data= array_slice($data, 0, 100);
//            if (isset($data['success']) && $data['success'] === true) {
//                $transactionHistory = $data['data'];
//                dd($transactionHistory);
//                foreach ($transactionHistory as $trans) {
//                    $startPos = strpos($trans['addDescription'], "naptien ") + strlen("naptien ");
//                    $endPos = strpos($trans['addDescription'], "- Ma GD");
//                    if ($startPos !== false && $endPos !== false) {
//                        $ndck = substr($trans['addDescription'], $startPos, $endPos - $startPos);
//                    }
//                    DB::table('lichsunap')
//                        ->where('ndck','like','naptien '.$ndck)
//                        ->where('trangThai','=',0)
//                        ->update(['soTien'=>$trans['creditAmount'],'trangThai'=>1]);
////                    LichSuNap::update([
////                        'maNguoiDung'=>Auth::user()->maNguoiDung,
////                        'soTien'=>$trans['creditAmount'],
////                        'ndck'=>$ndck,
////                        'trangThai'=>1,
////                        'thoiGian'=>date('Y-m-d H:i:s'),
////                    ]);
//                    DB::table('lichsunap')
//                        ->where('ndck','like','naptien '.$ndck)
//                        ->where('trangThai','=',0)
//                        ->update(['soTien'=>$trans['creditAmount'],'trangThai'=>1]);
//                }
//            } else {
//                // Handle the case when $data['success'] is not true
//            }
//        } catch (\Exception $e) {
////            dd($e);
//        }
        return view('User.Pages.naptien.naptien',['giatri'=>$request->giatri]);
    }
    public function xacnhannap(Request $request)
    {
        $apiUrl = 'https://api.web2m.com/historyapimb/Sonicmaster54/0300183159999/2F19BC57-21A6-E839-81C0-1C0FDF8B8274';
        $client = new Client();
        LichSuNap::create([
            'maNguoiDung'=>Auth::user()->maNguoiDung,
            'soTien'=>0,
            'ndck'=>$request->ndck,
            'trangThai'=>0,
            'thoiGian'=>date('Y-m-d H:i:s'),
        ]);
        try {
            $response = $client->get($apiUrl);
            $jsonResponse = $response->getBody()->getContents();
            $data = json_decode($jsonResponse, true);
            $data= array_slice($data, 0, 100);
            if (isset($data['success']) && $data['success'] === true) {
                $transactionHistory = $data['data'];
//                dd($transactionHistory);
                foreach ($transactionHistory as $trans) {
                    if (isset($trans['addDescription']) && stripos($trans['addDescription'], $request->ndck) !== false) {
                        DB::table('líchsunap')
                            ->where('ndck','=',$request->ndck)
                            ->where('trangThai','=',0)
                            ->update(['soTien',$trans['creditAmount'],'trangThai'=>1]);
                    } else {
                    }
                }
            } else {
                // Handle the case when $data['success'] is not true
            }
        } catch (\Exception $e) {
            // Xử lý lỗi nếu có
        }
        \Illuminate\Support\Facades\Session::flash('message', 'Thành công. Nếu sau 30p chưa nhận được tiền vui lòng liên hệ admin');
        \Illuminate\Support\Facades\Session::flash('message_type', 'success');
        return redirect()->back();
    }
    public function callBackBank(Request $request){
//        $accessToken = '2F19BC57-21A6-E839-81C0-1C0FDF8B8274'; // Thay YOUR_ACCESS_TOKEN bằng Access Token thực tế
        $accessToken = 'f800e99e53cf0792de52e6dc7c1728e01f0d4c9b11c7daa0f9289be1c678a42d';
        $receivedData = $request->getContent(); // Nhận dữ liệu từ webhook

        // Kiểm tra xem tiêu đề Authorization có tồn tại trong yêu cầu
        if ($request->header('Authorization') && strpos($request->header('Authorization'), 'Bearer ') === 0) {
            $bearerToken = substr($request->header('Authorization'), 7); // Lấy chuỗi token sau 'Bearer '

            // Kiểm tra xem chữ ký HMAC-SHA256 của bearerToken và imei có khớp với accessToken
            if ($accessToken === $bearerToken) {
                // Dữ liệu hợp lệ, tiếp tục xử lý
                $data = json_decode($receivedData, true);

                // Xử lý dữ liệu tại đây
                // ...
//                Log::info($data);
                $transactionHistory = $data['data'];
                foreach ($transactionHistory as $trans) {
                    $transactionID = $trans['transactionID'];
                    $amount = $trans['amount'];
                    $description = $trans['description'];
                    $description = str_replace("  ", " ", $description);
//                    $mang_tu = explode(" ", $description);
                    $position = strpos($description, 'ND');
                    if ($position !== false) {
                        // Nếu "ND" được tìm thấy, lấy chuỗi bắt đầu từ vị trí của "ND"
                        $idND = substr($description, $position,9);
                        // In ra kết quả
                    }
                    Log::info("idND: " . $idND);
                    $check= DB::table('lichsunap')
                        ->where('transID','=',$transactionID)
                        ->first();
                    $check1= DB::table('nguoidung')
                        ->where('maNguoiDung','=',$idND)
                        ->first();
                    if (!$check && $check1){
                        LichSuNap::create([
                                'maNguoiDung'=>$idND,
                                'soTien'=>$amount,
                                'ndck'=>$description,
                                'trangThai'=>1,
                                'thoiGian'=>date('Y-m-d H:i:s'),
                                'transID'=>$transactionID
                            ]);
                        DB::table('nguoidung')
                            ->where('maNguoiDung', '=', $idND)
                            ->update([
                                'soDuTaiKhoan' => DB::raw('soDuTaiKhoan + ' . $amount)
                            ]);
                        if ($check1) {
                            $message = "Bạn đã nạp thành công " . $amount . " vào tài khoản";
                            $thongBao=\App\Models\ThongBao::create([
                                'maNguoiDung' => $idND,
                                'noiDung' => $message,
                                'loaiTB' => 0,
                                'tieuDe' => 'Nạp tiền thành công',
                            ]);
                            event(new BankCallBack($idND, $message));
                            broadcast(new \App\Events\ThongBao($idND,$message,1));
                        }


                    }
                }
                $response = [
                    "status" => true,
                    "msg" => "OK"
                ];

                return response()->json($response);
            } else {
                // Chữ ký không khớp, từ chối yêu cầu
                Log::warning('Chữ ký không hợp lệ.');
                return response()->json(['error' => 'Chữ ký không hợp lệ.'], 401);
            }
        } else {
            // Tiêu đề Authorization không tồn tại hoặc không hợp lệ
            Log::warning('Access Token không được cung cấp hoặc không hợp lệ.');
            return response()->json(['error' => 'Access Token không được cung cấp hoặc không hợp lệ.'], 401);
        }

    }
    public function baoloi(){

    }
    public function timkiem(Request $request){
        $product = DB::table('vatpham')
            ->where('tenVatPham','like','%'.$request->key.'%')
            ->get();
        $user = DB::table('nguoidung')
            ->where(DB::raw("CONCAT(ho, ' ', ten)"), 'like', '%' . $request->key . '%')
            ->get();
        return view('User.pages.timkiem.index',['product'=>$product,'user'=>$user]);

    }
    public function huydon(){

    }
    public function locdonmua(Request $request)
    {
        if(Auth::check() == false)
            return redirect()->intended('/login');
        else {
            if($request->trangThai==9){
                $result = DB::table('donhang')
                    ->where('maNguoiDung', Auth::user()->maNguoiDung)
                    ->where('loaiDonHang','=',2)
                    ->orderBy('id', 'desc')
                    ->get();
                return view('user.ajax.don_mua_fil', ['donhang1'=>$result]);
            }
            $result = DB::table('donhang')
                ->where('maNguoiDung', Auth::user()->maNguoiDung)
                ->where('trangThai','=',$request->trangthai)
                ->where('loaiDonHang','=',2)
                ->orderBy('id', 'desc')
                ->get();
            return view('user.ajax.don_mua_fil', ['donhang1'=>$result]);
        }
    }
    public function xemthongbao(Request $request){
        $result = DB::table('thongbao')
            ->where(function ($query) use ($request) {
                $query->where('id', $request->id)
                    ->where('maNguoiDung', Auth::user()->maNguoiDung);
            })
            ->orWhere(function ($query) use ($request) {
                $query->where('id', $request->id)
                    ->where('loaiTB', 1);
            })
            ->first();
        if($result->daXem==1){
            return view('user.ajax.thongbao', ['thongbao'=>$result]);
        }
        DB::table('thongbao')
            ->where('id', $request->id)
            ->update(['daXem' => 1]);
//        dd($result);
        return view('user.ajax.thongbao', ['thongbao'=>$result]);
    }
}

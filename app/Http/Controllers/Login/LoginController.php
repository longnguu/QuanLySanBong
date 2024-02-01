<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Auth::check()){
            return redirect()->route('HomePage');
        }
        return  view('User.pages.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $request->validate([
            'Ho'=>'required',
            'Ten'=> 'required',
            'email' => 'required|email|unique:nguoidung,taiKhoan',
            'password' => 'required|min:8',
            'confirmpassword'=>'required_with:password'
        ], [
            'required'=>'Vui lòng nhập :attribute',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        ]);
        $token = strtoupper(\Illuminate\Support\Str::random(15));
        $data=$request->only('Ho','Ten','email','password');
        $data['token']=$token;

        $checkmail = DB::table('nguoidung')
            ->where('taiKhoan','=',$request->input('email'))
            ->get();
        if ($checkmail->isEmpty()){
            DB::table('nguoidung')->insert(
                [
                    'ho' => $request->input('Ho'),
                    'ten'=>$request->input('Ten'),
                    'taiKhoan'=>$request->input('email'),
                    'password'=> bcrypt($request->input('password')),
                    'maQuyen'=>1,
                ]);
        }
        Session::flash('success','Bạn đã đăng ký thành công. Vui lòng kiểm tra Email để kích hoạt tài khoản');
        return redirect()->route('login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'taiKhoan' => 'required',
            'matKhau' => 'required',
        ]);

        $credentials['password'] = $request->matKhau;
        $credentials['taiKhoan'] = $request->taiKhoan;

        if (Auth::attempt($credentials)) {
            Session::flash('message', 'Đăng nhập thành công');
            Session::flash('message_type', 'success');
//            dd(Auth::user());
            return back();
        }else {
            Session::flash('message', 'Sai thông tin');
            Session::flash('message_type', 'error');
            return back();
        }
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
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function quenMK()
    {
        return view('User.pages.quen_mk');
    }
    public function kt_email(Request $request)
    {
        $request->only('email');
        $email=$request->email;
        $result = DB::table('nguoidung')->where('taikhoan', '=',$email)->first();
        if(!$result) {
            echo 'Email vừa nhập sai';
        } else {
            $rand = 'ABCDEFGHJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789';
            $maXN = substr(str_shuffle($rand), 0, 6);
            DB::table('nguoidung')
                ->where('taiKhoan', '=',$email)
                ->update([
                    'maXN'=>$maXN,
                ]);
            $customer=$result;
            Mail::send('MailTo.forget', compact('customer','maXN'), function ($email) use ($customer) {
                $email->subject('Email lấy lại mật khẩu');
                $email->to($customer->taiKhoan, $customer->ten);
            });
            echo 'Chúng tôi vừa gửi cho bạn 1 email. Vui lòng kiểm tra email và làm theo hướng dẫn để lấy lại mật khẩu.';
        }
    }

    public function kt_ma_xn($ma_xn, $email)
    {
        if($ma_xn != Session()->get('ma_xn')) {
            echo 'sai';
        } else {
            return view('user.ajax.doi_mk', ['email'=>$email]);
        }
    }
    public function forget(Request $request){
        if ($request->token!=null){
            $customer = DB::table('nguoidung')
                ->where('maNguoiDung' ,'=', $request->customer)
                ->where('maXN','=',$request->token)
                ->first();
            if($customer == null){
                Session::flash('message','Xác thực thất bại');
                Session::flash('message_type','error');
                return redirect()->route('login');
            }else{
                DB::table('nguoidung')
                    ->where('maNguoiDung', '=', $request->customer)
                    ->where('maXN', '=', $request->token)
                    ->update([
                        'password' => bcrypt($request->token),
                        'maXN'=>null,
                    ]);
                Session::flash('success','Kích hoạt mật khẩu mới thành công.');
                Session::flash('message','Xác thực thành công');
                Session::flash('message_type','success');
                return redirect()->route('login');
            }
        }
    }
    public function doimk(Request $request){
//        dd($request);
        $request->validate([
            'mkcu' => 'required',
            'mkmoi' => 'required|min:8',
            'xnmkmoi' => 'required_with:mkmoi|same:mkmoi',
        ], [
            'mkcu.required' => 'Vui lòng nhập mật khẩu cũ.',
            'mkmoi.required' => 'Vui lòng nhập mật khẩu mới.',
            'xnmkmoi.required_with' => 'Vui lòng xác nhận mật khẩu mới.',
            'xnmkmoi.same' => 'Mật khẩu xác nhận không khớp với mật khẩu mới.',
            'mkmoi.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        ]);

        $customer = DB::table('nguoidung')
            ->where('taiKhoan', '=', Auth::user()->taiKhoan)
            ->first();

        if ($customer && Hash::check($request->mkcu, $customer->password)) {
            DB::table('nguoidung')
                ->where('taiKhoan', '=', Auth::user()->taiKhoan)
                ->update([
                    'password' => bcrypt($request->mkmoi),
                ]);
            Session::flash('message','Đổi mật khẩu thành công');
            Session::flash('message_type','success');
            Auth::logout();
            return redirect()->route('login');
        }
        Session::flash('message','Mật khẩu cũ không đúng');
        Session::flash('message_type','error');
        return redirect()->back()->with('error','Mật khẩu cũ không đúng');



    }
}

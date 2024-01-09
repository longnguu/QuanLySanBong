<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'email' => 'required',
            'password' => 'required',
            'confirmpassword'=>'required_with:password'
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
//            dd(Auth::user());
            return back()->with('succes','Đăng nhập thành công');
        }else{
            return back()->with('error','Sai thông tin');
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
}

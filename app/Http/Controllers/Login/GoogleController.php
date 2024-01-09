<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
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
    public function getGoogleSignInUrl()
    {
        return Socialite::driver('google')
            ->redirect();
    }

    public function loginCallback(Request $request)
    {
        try {
            $state = $request->input('state');
            parse_str($state, $result);
            $googleUser = Socialite::driver('google')->user();
            $user = DB::table('nguoidung')
                ->where('email', $googleUser->email)
                ->first();

            if ($user) {
                \Illuminate\Support\Facades\Auth::loginUsingId($user->id);
                \Illuminate\Support\Facades\Session::flash('success','Đăng nhập thành công');
                return redirect()->route('login');
            }
            else{
                $token = strtoupper(\Illuminate\Support\Str::random(15));
                $password = "123456@";
                DB::table('nguoidung')->insert(
                    [
                        'email' => $googleUser->email,
                        'username' => $googleUser->email,
                        'Ho' =>  $googleUser->user['family_name'],
                        'Ten' =>  $googleUser->user['given_name'],
                        'google_id'=> $googleUser->id,
                        'password'=> bcrypt($password),
                        'Quyen_id'=>'1',
                        'google_token'=>$token,
                    ]);
                $email= $googleUser->email;
                $customer = DB::table('nguoidung')
                    ->where('email','=',$email)
                    ->first();
                Mail::send('MailTo.xacthucgg', compact('customer'), function ($email) use ($customer) {
                    $email->subject('Email kích hoạt tài khoản');
                    $email->to($customer->email, $customer->Ten);
                });
                \Illuminate\Support\Facades\Session::flash('success','Đăng nhập ký thành công. Vui lòng vào Email để kích hoạt tài khoản');
                return redirect()->route('login');
            }
        } catch (\Exception $exception) {
            return response()->json([
                'status' => __('google sign in failed'),
                'error' => $exception,
                'message' => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}

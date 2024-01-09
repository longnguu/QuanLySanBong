<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
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
    public function getFBSignInUrl()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function loginFBCallback(){
        try {

            $user = Socialite::driver('facebook')->user();
            $finduser = DB::table('nguoidung')
                ->where('facebook_id', $user->id)->first();

            if($finduser){
                Auth::loginUsingId($finduser->id);
                return redirect()->route('HomePage');
            }else{
                $newUser = User::create([
                    'Ten' => $user->name,
                    'facebook_id'=> $user->id,
                    'TrangThai'=>1,
                ]);
                Auth::loginUsingId($newUser->id);
                return redirect()->intended('HomePage');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,...$roles)
    {
        if (!Auth::check()) {
            \Illuminate\Support\Facades\Session::flash('message', 'Bạn cần đăng nhập trước!');
            \Illuminate\Support\Facades\Session::flash('message_type', 'error');
            return redirect()->route('login');
        }
//        if(Auth::user()->password==null){
//            Session::flash("error",'Bạn phải đăng nhập mới có thể vào trang này.');
//            return redirect()->route('login');
//        }
//        if(Auth::user()->password==null){
//            Session::flash("error",'Bạn phải đăng nhập mới có thể vào trang này.');
//            return redirect()->route('login');
//        }
        $userRole = Auth::user()->maQuyen;
        foreach ($roles as $role) {
            if ($userRole == $role) {
                return $next($request);
            }
        }
        if (Auth::check()){
//            return $next($request);
            Session::flash("error",'Bạn không có quyền truy cập vào trang này.');
            \Illuminate\Support\Facades\Session::flash('message', 'Bạn không có quyền truy cập vào trang này!');
            \Illuminate\Support\Facades\Session::flash('message_type', 'error');
            return redirect()->back()->withErrors([
                'error' => 'Bạn không có quyền truy cập vào trang này.'
            ]);
        }
        else{
            Session::flash("error",'Bạn phải đăng nhập mới có thể vào trang này.');
            \Illuminate\Support\Facades\Session::flash('message', 'Bạn phải đăng nhập mới có thể vào trang này!');
            \Illuminate\Support\Facades\Session::flash('message_type', 'error');
            return redirect()->back()->withErrors([
                'error' => 'Bạn phải đăng nhập mới có thể vào trang này.'
            ]);
        }
        return $next($request);
    }
}

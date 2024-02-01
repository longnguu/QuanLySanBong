<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckRoomMembership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Retrieve the uid from the route parameters
        $uid = $request->route('uid');

        $check = DB::table('phongnhantin')
            ->where('id', '=', $uid)
            ->where(function ($query) {
                $query->where('nd1', '=', Auth::user()->maNguoiDung)
                    ->orWhere('nd2', '=', Auth::user()->maNguoiDung);
            })
            ->first();
//        $check = DB::table('phongnhantin')
//            ->join('chitietphongnt','phongnhantin.id','=','chitietphongnt.idPhongNT')
//            ->where('phongnhantin.id', '=', $uid)
//            ->where('maNguoiDung','=',Auth::user()->maNguoiDung)
//            ->first();
        // Check if the authenticated user is associated with the specified uid
        if (Auth::check() && $check) {
            return $next($request);
        }

        // Redirect or respond with an error if the user is not authorized
        Session::flash('message','Bạn không có quyền truy cập vào cuộc trò chuyện này');
        Session::flash('message_type','error');
        return redirect()->route('HomePage');
//        return abort(403, 'Unauthorized to access this room.');
    }
}

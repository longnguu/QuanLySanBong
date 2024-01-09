<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $list = DB::table('nguoidung')
            ->join('quyen', 'nguoidung.maQuyen', '=', 'quyen.maQuyen')
            ->select('*')
            ->orderBy('nguoidung.maQuyen')
            ->get();
        return view('admin.pages.user.index', ['list' => $list]);
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
        $role=DB::table('quyen')->get();
        $user=DB::table('nguoidung')->where('maNguoiDung','=',$id)->first();
        return view('admin.pages.user.edit', ['user'=>$user,'role'=>$role]);
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
}

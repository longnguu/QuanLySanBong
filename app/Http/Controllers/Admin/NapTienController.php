<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NapTienController extends Controller
{
    public function index()
    {
        //
        $list = DB::table('lichsunap')
            ->get();

        return view('admin.pages.naptien.index', ['list_order' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function activate(Request $request)
    {
        $order = DB::table('lichsunap')
            ->where('id','=',$request->id)
            ->first();
        DB::table('lichsunap')
            ->where('id','=',$request->id)
            ->update([
                'trangthai'=>1,
                'soTien'=>$request->sotien,
            ]);
        return redirect()->back();
    }

    public function cancel($id)
    {
        $order = DB::table('lichsunap')
            ->where('id','=',$id)
            ->first();
        DB::table('lichsunap')
            ->where('id','=',$id)
            ->update([
                'trangthai'=>2
            ]);
        if ($order->trangthai==1){
            DB::table('nguoidung')
                ->where('id','=',$order->idnd)
                ->update([
                    'sodu'=> DB::raw('sodu - ' . $order->giatri),
                ]);
        }
        return redirect()->back();

    }
}

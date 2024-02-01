<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KtraDonLoi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:ktra-don-loi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
//        $this->info('Đang kiểm tra đơn lỗi...');
        $dh=DB::table('donhang')->where('trangThai','=',0)->get();
        foreach ($dh as $d){
            if(\Illuminate\Support\Facades\DB::table('chitietthuesan')
                ->where('maVatPham', '=', null)
                ->where('maDonHang', '=', $d->id)
                ->where('thoiGianKetThuc', '>', Carbon::now()->addHour(7))
                ->groupBy('maDonHang')
                ->count()==0){
                DB::table('donhang')->where('id',$d->id)->update(['trangThai'=>1]);
            }
        }
        $dh1=DB::table('donhang')->where('trangThai','=',0)->where('daThanhToan','=',0)->get();
        foreach ($dh as $d){
            if(\Illuminate\Support\Facades\DB::table('chitietthuesan')
                    ->where('maVatPham', '=', null)
                    ->where('maDonHang', '=', $d->id)
                    ->where('thoiGianKetThuc', '>', Carbon::now()->addHour(7))
                    ->groupBy('maDonHang')
                    ->count()>0){
                DB::table('donhang')->where('id',$d->id)->update(['trangThai'=>1]);
            }
        }
    }
}

<?php

namespace App\Console\Commands;

use App\Events\BankCallBack;
use App\Models\LichSuNap;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class FetchTransactionData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
//    protected $signature = 'app:fetch-transaction-data';
    protected $signature = 'fetch:transactions';
    protected $description = 'Fetch transaction data from the API every 5 minutes';


    /**
     * The console command description.
     *
     * @var string
     */
//    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $apiUrl = 'https://api.web2m.com/historyapimb/Sonicmaster54/0300183159999/2F19BC57-21A6-E839-81C0-1C0FDF8B8274'; // Thay thế bằng đường link API của bạn
//        $apiUrl='https://api.sieuthicode.net/historyapimbbank/AiUskOqYdNae-UVmYyk-gGNz-ECIj-UmBk';
        $client = new Client();
        try {
            $response = $client->get($apiUrl);
            $jsonResponse = $response->getBody()->getContents();
            $data = json_decode($jsonResponse, true);
            $data= array_slice($data, 0, 100);
            if (isset($data['success']) && $data['success'] === true) {
                $transactionHistory = $data['data'];
                foreach ($transactionHistory as $trans) {
                    $transactionID = $trans['refNo'];
                    $amount = $trans['creditAmount'];
                    $transactionID = substr($transactionID, 0,16);
                    $description = $trans['description'];
                    $description = str_replace("  ", " ", $description);
//                    $mang_tu = explode(" ", $description);
                    $position = strpos($description, 'ND');
                    $idND=null;
                    if ($position !== false) {
                        $idND = substr($description, $position,9);
                    }
//                    Log::info("idND: " . $idND);
                    $check= DB::table('lichsunap')
                        ->where('transID','=',$transactionID)
                        ->first();
                    $check1=null;
                    if ($idND){
                        $check1= DB::table('nguoidung')
                            ->where('maNguoiDung','=',$idND)
                            ->first();
                    }
                    if (!$check && $check1) {
                        LichSuNap::create([
                            'maNguoiDung' => $idND,
                            'soTien' => $amount,
                            'ndck' => $description,
                            'trangThai' => 1,
                            'thoiGian' => date('Y-m-d H:i:s'),
                            'transID' => $transactionID
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
            } else {
                // Handle the case when $data['success'] is not true
            }
        } catch (\Exception $e) {
            $this->error('Error connecting to the API: ' . $e->getMessage());
        }
    }
}

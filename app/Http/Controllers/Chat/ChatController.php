<?php

namespace App\Http\Controllers\Chat;

use App\Events\MessageSent;
use App\Events\MessageSent1;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\MessageRoom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function sendMessage(Request $request,$uid)
    {
        $user = Auth::user();

//        // Use Eloquent relationships if available
//        $room = DB::table('phongnhantin')
//            ->where(function ($query) use ($user, $request) {
//                $query->where('nd1', $user->maNguoiDung)
//                    ->where('nd2', $request->input('usid'));
//            })
//            ->orWhere(function ($query) use ($user, $request) {
//                $query->where('nd2', $user->maNguoiDung)
//                    ->where('nd1', $request->input('usid'));
//            })
//            ->first();
//
//        // If the conversation does not exist, create a new record
//        if (!$room) {
//            $room = MessageRoom::create([
//                'nd1' => $user->maNguoiDung,
//                'nd2' => $request->input('usid'),
//            ]);
//        }
        $room = MessageRoom::find($uid);

        $message=Message::create([
            'idPhongNT'=> $uid,
            'noiDung'=> $request->input('message'),
            'maNguoiGui'=> $user->maNguoiDung,
        ]);
//        broadcast(new MessageSent($room, $message))->toOthers();
        $us1=User::find($room->nd1);
        $us2=User::find($room->nd2);

        if ($room->nd1==Auth::user()->maNguoiDung){
            broadcast(new MessageSent($us2->maNguoiDung, $message));
//            broadcast(new MessageSent($us1, "Bạn đã chào {$us2->maNguoiDung}"));
        }else{
            broadcast(new MessageSent($us1->maNguoiDung, $message));
//            broadcast(new MessageSent($us2, "Bạn đã chào {$us1->maNguoiDung}"));
        }

        return response()->json(['status' => 'Message Sent!']);
    }
    public function index()
    {
        //
    }
    public function chatprivate(Request $request,User $receiver)
    {
        //
        broadcast(new MessageSent($receiver, "{$request->user()->name} đã chào bạn"));
        broadcast(new MessageSent($request->user(), "Bạn đã chào {$receiver->name}"));

        return "Lời chào từ {$request->user()->name} đến {$receiver->name}";
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
}

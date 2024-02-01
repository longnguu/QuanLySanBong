<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('private-chat.{userId}', function ($user, $userId) {
    return (int) $user->maNguoiDung === (int) $userId;
});
Broadcast::channel('message', function($user) {
    if($user != null){
        return ['id' => $user->maNguoiDung, 'name' => $user->ho. " " . $user->ten];
    }
    return false;
});
Broadcast::channel('chat.private.{id}', function ($user, $id) {
    return $user->maNguoiDung ===  $id;
});
Broadcast::channel('callbackBank.private.{id}', function ($user, $id) {
    return $user->maNguoiDung ===  $id;
});
Broadcast::channel('thongbao1.private.{id}', function ($user, $id) {
    return $user->maNguoiDung ===  $id;
});
Broadcast::channel('thongbao2.private.{id}', function ($user, $id) {
    return $user->maQuyen ==  $id;
});


<?php

namespace App\Http\Messages;

class MemShowMessage
{
    public static function showMem($mem, $chat_id){
        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => 'test', 'callback_data' => 'test'],
                    ['text' => 'Watch', 'callback_data' => 'watch_mems']
                ],
            ]
        ];
        $encodedKeyboard = json_encode($keyboard);
        $data = array(
            'chat_id' => (int)trim($chat_id),
            'photo' => $mem->photo_id,
            'reply_markup' => $encodedKeyboard
        );
        Messenger::send('sendphoto', $data);
    }
}
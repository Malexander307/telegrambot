<?php

namespace App\Http\Messages;

class MemShowMessage
{
    public static function showMem($mem, $chat_id, $query_id){
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
            'photo' => $mem->image_id
        );
        Messenger::send('sendPhoto', $data);
        Messenger::send('answerCallbackQuery',array(
            'callback_query_id' => $query_id
        ));
    }
}
<?php

namespace App\Http\Messages;

class MemShowMessage
{
    public static function showMem($mem, $chat_id, $query_id){
        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => 'Like', 'callback_data' => 'like'],
                    ['text' => 'Continue to watch', 'callback_data' => 'watch_mems']
                ],
            ]
        ];
        $encodedKeyboard = json_encode($keyboard);
        $data = array(
            'chat_id' => (int)trim($chat_id),
            'photo' => $mem->image_id,
            'reply_markup' => $encodedKeyboard
        );
        Messenger::send('sendPhoto', $data);
        Messenger::send('answerCallbackQuery',array(
            'callback_query_id' => $query_id
        ));
    }
}
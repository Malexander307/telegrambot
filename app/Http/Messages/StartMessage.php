<?php

namespace App\Http\Messages;

class StartMessage
{
    public static function firstMessage($request){
        $text = "Hello " . $request["message"]["from"]["first_name"] . " i am mems bot";
        $keyboard = [
                'inline_keyboard' => [
                    [
                        ['text' => 'Add mem', 'callback_data' => 'add_mem'],
                        ['text' => 'Watch mems', 'callback_data' => 'watch_mems']
                    ],
                ]
            ];
        $encodedKeyboard = json_encode($keyboard);
        $data = array(
                    'chat_id' => (int)trim($request["message"]["chat"]["id"]),
                    'text' => $text,
                    'reply_markup' => $encodedKeyboard
                );
        Messenger::send('sendmessage', $data);
    }
}
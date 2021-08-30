<?php

namespace App\Http\Messages;

class StartMessage
{
    public static function firstMessage($request){
        $text = "Hello " . $request["message"]["from"]["first_name"] . " i am mems bot";
        $data = array(
                    'chat_id' => (int)trim($request["message"]["chat"]["id"]),
                    'text' => $text
                );
        Messenger::send('sendmessage', $data);
    }
}
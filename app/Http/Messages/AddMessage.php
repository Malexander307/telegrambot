<?php

namespace App\Http\Messages;

class AddMessage
{
    public static function addMemsMessage($request){
        $text = "Send a mem as picture";
        $data = array(
                    'chat_id' => (int)trim($request["message"]["chat"]["id"]),
                    'text' => $text
                );
        Messenger::send('sendmessage', $data);
    }
}
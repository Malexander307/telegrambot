<?php

namespace App\Http\Messages;

class AddMessage
{
    public static function addMemsMessage($request){
        $text = "Send a mem as picture";
        $data = array(
                    'chat_id' => (int)trim($request['callback_query']['from']['id']),
                    'text' => $text
                );
        Messenger::send('sendmessage', $data);
        Http::post($path . "/answerCallbackQuery?callback_query_id=". $request['callback_query']['id']);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public static function sendPhoto($request)
    {
        $chatId = (int)trim($request["message"]["chat"]["id"]);
        $name = $request["message"]["from"]["first_name"];
        $text = "Hello " . $name;
        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => 'test', 'callback_data' => 'test'],
                    ['text' => 'Watch', 'callback_data' => 'watch_mems']
                ],
            ]
        ];
        $encodedKeyboard = json_encode($keyboard);
        return array(
            'chat_id' => $chatId,
            'caption' => $text,
            'photo' => 'AgACAgIAAxkBAAPvYSs3izihG47TYZl40WqGh3W5cjQAAnezMRs1SFlJ3Tt_N8y6MFUBAAMCAANzAAMgBA',
            'reply_markup' => $encodedKeyboard
        );
    }

}

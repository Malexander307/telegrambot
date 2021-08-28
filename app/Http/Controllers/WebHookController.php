<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebHookController extends Controller
{
    public function index(Request $request)
    {
        $path = "https://api.telegram.org/bot1955140014:AAE0KkWUJzKP6fnCmX2UsJ0iQocFz8FYG10";
        $request = $request->toArray();
        if (!isset($request["callback_query"])) {
            $chatId = (int)trim($request["message"]["chat"]["id"]);
            $name = $request["message"]["from"]["first_name"];
        }
        Http::post($path . "/sendmessage?chat_id=" . $chatId . "&text=" . (string)json_encode($request));
        $chatId = (int)preg_replace('/\^ /', "", $chatId);
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
        $parameters =
            array(
                'chat_id' => $chatId,
                'text' => $text,
                'reply_markup' => $encodedKeyboard
            );

        switch ($request["message"]["text"]) {
            case 'f':
                $this->send('sendMessage', $parameters);
                break;
        }
        if (isset($request["callback_query"])) {
            switch ($request["callback_query"]['data']) {
                case 'test':
                    $chat_id = $request['callback_query']['from']['id'];
                    Http::post($path . "/sendmessage?chat_id=" . $chatId . "&text=" . "test");
                    break;
            }
        }

    }

    private function send($method, $data)
    {
        $url = "https://api.telegram.org/bot1955140014:AAE0KkWUJzKP6fnCmX2UsJ0iQocFz8FYG10" . "/" . $method;

        if (!$curld = curl_init()) {
            exit;
        }
        curl_setopt($curld, CURLOPT_POST, true);
        curl_setopt($curld, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curld, CURLOPT_URL, $url);
        curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($curld);
        curl_close($curld);
        return $output;
    }
}



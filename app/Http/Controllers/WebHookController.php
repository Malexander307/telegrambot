<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebHookController extends Controller
{
    public function index(Request $request){
        $path = "https://api.telegram.org/bot1955140014:AAE0KkWUJzKP6fnCmX2UsJ0iQocFz8FYG10";
        $request = $request->toArray();
        $chatId = (int)trim($request["message"]["chat"]["id"]);
        $name = $request["message"]["from"]["first_name"];
        $chatId = (int)preg_replace('/\^ /', "", $chatId);
        $text = "Hello ".$name;
        $text = "keyboardButton#a2fa4880 text:string = KeyboardButton;";
        Http::post($path."/sendmessage?chat_id=".$chatId."&text=".$text);
    }
}

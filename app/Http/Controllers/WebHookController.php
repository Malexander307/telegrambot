<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebHookController extends Controller
{
    public function index(Request $request){
        $path = "https://api.telegram.org/bot1955140014:AAE0KkWUJzKP6fnCmX2UsJ0iQocFz8FYG10";
//        dd($request);
        $chatId = (int)$request["message"]["chat"]["id"];
        dd($chatId);
        file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=Here's the weather in");
//        Http::post($path."/sendmessage?chat_id=".$chatId."&text=Here's the weather in ");
    }
}

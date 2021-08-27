<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebHookController extends Controller
{
    public function index(Request $request){
        $path = "https://api.telegram.org/bot1955140014:AAE0KkWUJzKP6fnCmX2UsJ0iQocFz8FYG10";
        $request = $request->toArray();
        $update = json_decode(file_get_contents("php://input"), TRUE);

        $chatId = $update["message"]["chat"]["id"];
        Http::get($path."/sendmessage?chat_id=".$chatId."&text=Here's the weather in ");
    }
}

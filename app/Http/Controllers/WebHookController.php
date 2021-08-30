<?php

namespace App\Http\Controllers;

use App\Http\Messages\AddMessage;
use App\Http\Messages\StartMessage;
use App\Services\MemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebHookController extends Controller
{
    public function index(Request $request)
    {
        $request = $request->toArray();
//        if (isset($request["message"]["photo"])){
//            MemService::addMem($request["message"]["photo"][0]["file_id"], $request["message"]["from"]["id"]);
//        }
        if (isset($request["callback_query"])) {
            switch ($request["callback_query"]["data"]) {
                case 'add_mem':
                    AddMessage::addMemsMessage($request);
                    break;
            }
        }
        if (isset($request["message"]["text"])) {
            switch ($request["message"]["text"]) {
                case '/start':
                    StartMessage::firstMessage($request);
                    break;
            }
        }
    }
}



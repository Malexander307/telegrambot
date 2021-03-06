<?php

namespace App\Http\Controllers;

use App\Http\Messages\AddMessage;
use App\Http\Messages\MemShowMessage;
use App\Http\Messages\StartMessage;
use App\Repositories\MemsRepository;
use App\Services\MemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebHookController extends Controller
{
    public function index(Request $request)
    {
        $request = $request->toArray();
        if (isset($request["message"]["photo"])){
            MemService::addMem($request["message"]["photo"][0]["file_unique_id"], $request["message"]["from"]["id"]);
        }
        if (isset($request["callback_query"])) {
            switch ($request["callback_query"]["data"]) {
                case 'add_mem':
                    AddMessage::addMemsMessage($request);
                    break;
                case 'watch_mems':
                    $path = "https://api.telegram.org/bot1955140014:AAE0KkWUJzKP6fnCmX2UsJ0iQocFz8FYG10";
                    $chatId = (int)trim($request['callback_query']['from']['id']);
                    Http::post($path . "/sendmessage?chat_id=" . $chatId . "&text=" . (string)json_encode($request));
                    MemShowMessage::showMem(MemsRepository::getMems(), $request['callback_query']['from']['id'], $request['callback_query']['id']);
                    break;
                case 'like':
                    MemService::addLike($request['callback_query']["photo"][0]["file_id"]);
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



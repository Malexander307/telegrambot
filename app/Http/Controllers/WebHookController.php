<?php

namespace App\Http\Controllers;

use App\Http\Messages\StartMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebHookController extends Controller
{
    public function index(Request $request)
    {
        $request = $request->toArray();
        if (isset($request["message"]["text"])){
          switch ($request["message"]["text"]){
              case '\/start':
                  StartMessage::firstMessage($request);
                  break;
          }
        }
    }
}



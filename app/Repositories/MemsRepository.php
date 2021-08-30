<?php

namespace App\Repositories;

use App\Models\Mems;

class MemsRepository
{
    public static function getMems(){
        return Mems::where('id', 3)->first();
    }
}
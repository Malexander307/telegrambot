<?php

namespace App\Services;

use App\Models\Mems;

class MemService
{
    public static function addMem($photo_id, $user_id){
        Mems::create([
            'image_id' => $photo_id,
            'user_id' => $user_id,
            'count_likes' => 0
                     ]);
    }
}
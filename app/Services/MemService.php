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

    public static function addLike($photo_id){
        $mem = Mems::where('image_id', $photo_id);
        $mem->count_likes = $mem->count_likes + 1;
        $mem->save();

    }
}
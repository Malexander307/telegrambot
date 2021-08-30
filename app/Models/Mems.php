<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mems extends Model
{
    use HasFactory;

    protected $fillable = ["image_id", "user_id", "count_likes"];
}

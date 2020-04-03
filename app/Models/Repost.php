<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repost extends Model
{
    protected $fillable = [
        "user_id",
        "gift_id",
    ];

}

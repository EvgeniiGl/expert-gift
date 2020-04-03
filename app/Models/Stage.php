<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{

    protected $fillable = [
        "id",
        "name",
        "score",
    ];

    public $timestamps = false;


}

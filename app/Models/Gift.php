<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    protected $fillable = [
        "url",
        "title",
        "img",
        "group",
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
    
}

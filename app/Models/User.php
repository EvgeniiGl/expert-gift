<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        "id",
        "score",
        "stage",
    ];

    public $incrementing = false;

    public $timestamps = false;

    public function gifts()
    {
        return $this->belongsToMany('App\Models\Gift');
    }

    public function getTotalGiftsAttribute()
    {
        return $this->belongsToMany('App\Models\Gift')->count();
    }

    public function reposts()
    {
        return $this->belongsToMany('App\Models\Gift', "reposts", "user_id", "id")->withPivot('created_at');

    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = ['title', 'extras', 'image', 'user_ID', 'status'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

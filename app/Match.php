<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    public function match()
    {
        return $this->belongsTo(User::class);
    }
}

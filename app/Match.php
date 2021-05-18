<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    public function user()
    {
        return $this->hasOne(User::class);
    }
}

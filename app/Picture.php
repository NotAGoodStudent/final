<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }
}

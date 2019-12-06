<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAuth extends Model
{
    // relacionamento
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

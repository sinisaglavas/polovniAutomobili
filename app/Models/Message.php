<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function ad() {
        return $this->belongsTo('App\Models\Ad','ad_id');
    }

    public function sender() {
        return $this->belongsTo('App\Models\User', 'sender_id');
    }


}

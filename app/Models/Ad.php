<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    protected $guarded = [];// dozvoljavamo da se unese bilo sta u bazu

    public function adOwner()
    {
        return $this->belongsTo('\App\Models\AdOwner','ad_owner_id');
    }

    public function adCreator()
    {
        return $this->belongsTo('\App\Models\User','user_id');
    }


}

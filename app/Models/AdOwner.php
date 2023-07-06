<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdOwner extends Model
{
    use HasFactory;
    protected $guarded = [];//ovo znaci da dozvoljavamo da se unese bilo sta u bazu

    public function myAds()
    {
        return $this->hasMany(Ad::class, 'ad_owner_id');
    }




}

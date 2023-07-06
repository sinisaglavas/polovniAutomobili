<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdOwner;
use Illuminate\Http\Request;

class AdOwnerController extends Controller
{
    public function completeOffer($ad_owner_id)
    {
        $complete_offers = AdOwner::find($ad_owner_id)->myAds;
        $ad_owner = AdOwner::find($ad_owner_id);

        return view('completeOffer', compact('complete_offers', 'ad_owner'));

    }
}

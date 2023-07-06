@extends('layouts.master')

@section('main')

<style>
#logo, #ad-owner, #ad, #about-us, #contact {
    width: 150px;
}
#about-us, #contact {
    padding: 20px;
}
#left {
    border: 1px black solid;
    border-top-left-radius: 15px;
    box-shadow: rgba(0, 0, 0, 0.5) -1px -1px 5px;
}
#right {
    border: 1px black solid;
    border-top-right-radius: 15px;
    box-shadow: rgba(0, 0, 0, 0.5) 1px -1px 5px;
}
#background {
    background-color: #bcbebf;
}
a {
    text-decoration: none;
    color: #1e2125;
}
a:hover {
    color: black;
}


</style>


<div class="container">
    <div class="row  mt-5">
        <div class="col">
            <div id="logo" class="mx-auto">
                Logo
            </div>
        </div>
        <div class="col">
            <div id="ad-owner" class="mx-auto">
                <h4>{{ $ad_owner->name }} {{ $ad_owner->last_name }}</h4>
            </div>
        </div>
        <div class="col">
            <div id="ad" class="mx-auto">
                Reklama
            </div>
        </div>
    </div>
    <div class="row  mt-5">
        <div class="col" id="left">
            <div id="about-us" class="mx-auto">
                O nama
            </div>
        </div>
        <div class="col" id="right">
            <div id="contact" class="mx-auto">
                Kontakt
            </div>
        </div>
    </div>
</div>
<div id="background" class="mb-4">
    <div class="container">
        <div class="row" style="background-color: white">
            <div class="col-9">
                @foreach($complete_offers as $complete_offer)
                        <div class="card" style="max-width: 850px; height: 250px; margin-top: 20px">
                            <div class="row g-0">

                                <div class="col-md-5" style="background-color: #f5c2c7">
                                    <a href="{{ url('/ad/single-ad',['id'=>$complete_offer->id]) }}">
                                    <img src="/ad_photos/{{ \App\Models\Ad_photo::where('ad_id', $complete_offer->id)->first()->url }}" class="img-fluid rounded-start" alt="..." style="height: 249px">
                                    </a>
                                </div>
                                <div class="col-md-7" style="background-color: #f5c2c7">
                                    <div class="card-body">
                                        <a href="{{ url('/ad/single-ad',['id'=>$complete_offer->id]) }}">
                                        <h3 class="card-title fw-bold">{{ $complete_offer->brand }} {{ $complete_offer->model }}</h3>
                                        </a>
                                        @if($complete_offer->price == null)
                                            <h5 class="card-text m-0 d-inline-block" style="font-weight: bold">Po dogovoru</h5>
                                        @else
                                            <h4 class="card-text m-0 d-inline-block" style="font-weight: bold">{{ $complete_offer->price }} €</h4>
                                        @endif
                                        <div class="row mt-4">
                                            <div class="col">
                                                <p class="card-text m-0"><small class="text-muted">{{ $complete_offer->produced }}.
                                                        {{ $complete_offer->car_body }}</small></p>
                                                <hr class="m-0">
                                            </div>
                                            <div class="col">
                                                <p class="card-text m-0"><small class="text-muted">{{ $complete_offer->mileage }} km</small></p>
                                                <hr class="m-0">
                                            </div>
                                            <div class="col">
                                                <p class="card-text m-0"><small class="text-muted">{{ $complete_offer->transmission }}</small></p>
                                                <hr class="m-0">
                                            </div>
                                        </div>
                                        <div class="row mb-5">
                                            <div class="col">
                                                <p class="card-text"><small class="text-muted">{{ $complete_offer->fuel }} |
                                                        {{ $complete_offer->cubic_capacity }} cm³</small></p>
                                            </div>
                                            <div class="col">
                                                <p class="card-text"><small class="text-muted">{{ $complete_offer->power_kw }}kW ({{ $complete_offer->power_hp }}KS)</small></p>
                                            </div>
                                            <div class="col">
                                                <p class="card-text"><small class="text-muted">{{ $complete_offer->door_number }}, {{ $complete_offer->number_of_seats }}</small></p>
                                            </div>
                                        </div>
                                        <div style="display: flex; justify-content: space-between">
                                            <div><p class="card-text" style="background-color: yellowgreen; color: white; padding: 0 5px;">{{ $complete_offer->origin }}</p></div>
                                            <div><p class="card-text"><i class="fa-sharp fa-solid fa-location-dot"></i> {{ $ad_owner->city }}</p></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    </div>
</div>











@endsection


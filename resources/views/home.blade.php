@extends('layouts.app')

@section('content')
    <div class="container" style="margin-bottom: 150px">
       <div class="row">
           <div class="col-2">
               <div class="p-2" style="background-color: #d7d8da">
                   <button class="btn btn-primary form-control mb-5">Povezi FB profil</button>
                   <div style="padding: 10px; background-color: #bcbebf; margin-bottom: 2px">
                       <a href="{{ route('home') }}" style="text-decoration: none">Aktivni oglasi</a>
                   </div>
                   <div style="padding: 10px; background-color: #bcbebf; margin-bottom: 2px">
                       <a href="#" style="text-decoration: none">Neaktivni oglasi</a>
                   </div>
                   <div style="padding: 10px; background-color: #bcbebf; margin-bottom: 2px">
                       <a href="{{ route('home') }}" style="text-decoration: none">Moja vozila</a>
                   </div>
                   <div style="padding: 10px; background-color: #bcbebf; margin-bottom: 2px">
                       <a href="{{ route('showMessages') }}" style="text-decoration: none">Poruke <span>({{ auth()->user()->messages->count() }})</span></a>
                   </div>
                   <div style="padding: 10px; background-color: white; margin-bottom: 2px">
                       <p style="margin: 0">Korisnicka podrska</p>
                       <a href="#" style="text-decoration: none; font-weight: bold">E-mail kontakt</a>
                       <a href="#" style="text-decoration: none">021/1234567</a>
                   </div>
               </div>
           </div>
           @if($all_cars)
           <div class="col-10">
                   <h4>Aktivni oglasi</h4>
               @foreach($all_cars as $car)
                   <a href="{{ route('ad.singleAd', ['id'=>$car->id]) }}" style="display: inline-block; text-decoration: none">
                       <div class="card" style="width: 12rem; padding: 0; margin: 0.75rem">
                           <img src="/ad_photos/{{ \App\Models\Ad_photo::where('ad_id', $car->id)->first()->url }}" class="card-img-top" alt="...">
                           <div class="card-body p-1">
                               <h6 class="card-title m-0" style="font-weight: bold">{{ $car->brand }} {{ $car->model }}</h6>
                               @if($car->price != null)
                                   <h6 class="card-text m-0 d-inline-block" style="font-weight: bold">{{ $car->price }} €</h6>
                               @else
                                   <h6 class="card-text m-0 d-inline-block" style="font-weight: bold">Po
                                       dogovoru</h6>
                               @endif
                               <p class="float-end" style="color: grey">{{ $car->produced }}. god.</p>
                           </div>
                           <p class="text-center">Oglas za: {{ \App\Models\AdOwner::find($car->ad_owner_id)->name }}
                                        {{ \App\Models\AdOwner::find($car->ad_owner_id)->last_name }}</p>
                       </div>
                   </a>
               @endforeach
           </div>
           @else
           <div class="col-10 p-5">
               <h6 style="color: #bcbebf; display: inline-block;">Trenutno nemaš nijedan aktivan oglas</h6>
           </div>
           @endif
       </div>
   </div>



@endsection


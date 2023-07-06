@extends('layouts.master')

@section('main')

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    body {
        background-color: #bcbebf;
    }
    .slider-wrapper {
        max-width: 1000px;
        height: 450px;
        box-shadow: 0 24px 38px 3px rgba(0, 0, 0, 0.14), 0 9px 46px 8px rgba(0, 0, 0, 0.12), 0 11px 15px -7px rgba(0, 0, 0, 0.2);
        margin: auto;
        margin-top: 20px;
        position: relative;
        margin-bottom: 50px;
    }

    .slider-wrapper .slider-images {
        height: 100%;
    }

    .slider-wrapper .slider-images img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: none;
    }

    .slider-wrapper .slider-images img:first-child {
        display: block;
    }

    .slider-wrapper button {
        height: 65px;
        width: 65px;
        border: none;
        outline: none;
        background: rgba(0, 0, 0, 0.5);
        cursor: pointer;
        top: 40%;
        position: absolute;
        z-index: 999;
    }

    .slider-wrapper button .arrow {
        border: solid #fff;
        border-width: 0 4px 4px 0;
        display: inline-block;
        padding: 10px;
        transition: transform 0.3s ease-out;
        outline: none;
    }

    .slider-wrapper #right-btn {
        right: 0;
    }

    .slider-wrapper #right-btn .arrow {
        transform: rotate(-45deg);
    }

    .slider-wrapper #left-btn {
        left: 0;
    }

    .slider-wrapper #left-btn .arrow {
        transform: rotate(135deg);
    }

</style>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h1 style="font-weight: bold">{{ $single_car->brand }} &nbsp{{ $single_car->model }} &nbsp<span style="color: grey; font-size: 22px;">{{ $single_car->produced }}. godiste</span></h1>
            <div class="slider-wrapper">
                <button id="left-btn"><i class="arrow"></i></button>
                <div class="slider-images">
                    @foreach($photos as $photo)
                        <img src="/ad_photos/{{ $photo->url }}" alt="">
                    @endforeach

                </div>
                <button id="right-btn"><i class="arrow"></i></button>
            </div>
        </div>
        <div class="col-4">
            @if($single_car->price == null)
                <h1 style="font-weight: bold">Po dogovoru</h1>  {{-- ctrl + alt + e --}}
            @else
                <h1 style="font-weight: bold">{{ $single_car->price }} €</h1>  {{-- ctrl + alt + e --}}
            @endif
            <div class="card m-3" style="width: 20rem;">
                <div class="row">
                    <div class="col-7">
                        <h4 class="p-3">{{ $single_car->adOwner->name }} {{ $single_car->adOwner->last_name }}</h4>
                    </div>
                    <div class="col-5">
                        <img src="/ad_photos/{{ $single_car->photo1 }}" class="mt-2" style="width: 7rem; height: 4rem;"
                             alt="Vlasnik oglasa nije postavio fotku">
                    </div>
                </div>

                <div class="card-body">
                    <h5 class="card-title"><a href="{{ Route('complete_offer', ['ad_owner_id'=>$single_car->ad_owner_id]) }}" style="text-decoration: none">Kompletna ponuda <i class="fa-sharp fa-solid fa-chevron-right"></i></a></h5>
                    <h6 class="card-text">{{ $single_car->adOwner->city }}</h6>
                    <h6>{{ $single_car->adOwner->address }}</h6>
                    <button id="phone" class="form-control btn btn-outline-warning mt-2">KLIK DA VIDIS BROJ</button>
                    @if(auth()->check() && auth()->user()->id !== $single_car->user_id)
                        <button id="message-btn" class="form-control btn btn-warning mt-3">POSALJI PORUKU</button>
                    @endif
                        <button class="form-control btn btn-outline-primary mt-3">ZAKAZI TEST VOZNJU</button>
                </div>
            </div>
                <div id="message-send" class="m-3 p-2" style="width: 20rem; position: absolute; background: white; display: none;">
                    <form action="{{ route('sendMessage', ['id'=>$single_car->id]) }}" method="post">
                        @csrf
                        <textarea name="message" class="form-control" placeholder="Posalji poruku vlasniku ovog oglasa" style="background: white;" required></textarea>
                        <button class="form-control btn btn-primary mt-3">Posalji</button>
                    </form>
                </div>
                @if(session()->has('message'))
                    <div class="alert alert-success m-3" style="width: 20rem;">
                        {{ session()->get('message') }}
                    </div>
                @endif
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="general-info" style="background-color: white; border-radius: 10px;">
                <h4 class="p-3 fw-bold">Opste informacije</h4>
                <div class="row">
                    <div class="col-6">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Stanje</td>
                                <td class="fw-bold">{{ $single_car->new_car }}</td>
                            </tr>
                            <tr>
                                <td>Marka</td>
                                <td class="fw-bold" class="bold">{{ $single_car->brand }}</td>
                            </tr>

                            <tr>
                                <td>Model</td>
                                <td class="fw-bold" class="bold">{{ $single_car->model }}</td>
                            </tr>
                            <tr>
                                <td>Godište</td>
                                <td class="fw-bold" class="bold">{{ $single_car->produced }}</td>
                            </tr>
                            <tr>
                                <td>Kilometraža</td>
                                <td class="fw-bold">{{ $single_car->mileage }}</td>
                            </tr>
                            <tr>
                                <td>Karoserija</td>
                                <td class="fw-bold">{{ $single_car->car_body }}</td>
                            </tr>
                            <tr>
                                <td>Gorivo</td>
                                <td class="fw-bold">{{ $single_car->fuel }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-5">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Kubikaža</td>
                                <td class="fw-bold">{{ $single_car->cubic_capacity }}</td>
                            </tr>
                            <tr>
                                <td>Snaga motora</td>
                                <td class="fw-bold">{{ $single_car->power_kw}}/{{$single_car->power_hp }} (kW/KS)</td>
                            </tr>
                            <tr>
                                <td> Zamena:</td>
                                <td class="fw-bold">{{ $single_car->replacement }}</td>
                            </tr>
                            <tr>
                                <td>Broj oglasa:</td>
                                <td class="fw-bold">{{ $single_car->id}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4"></div>
    </div>
<div class="row">
    <div class="col-8">
        <div class="additional-info mt-4" style="background-color: white; border-radius: 10px;">
            <h4 class="p-3 fw-bold">Dodatne informacije</h4>
            <div class="row">
                <div class="col-6">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Emisiona klasa motora</td>
                            <td class="fw-bold">{{ $single_car->engine_emission_class }}</td>
                        </tr>

                        <tr>
                            <td>Pogon</td>
                            <td class="fw-bold">{{ $single_car->drive }}</td>
                        </tr>
                        <tr>
                            <td>Menjač</td>
                            <td class="fw-bold">{{ $single_car->transmission }}</td>
                        </tr>
                        <tr>
                            <td>Broj vrata</td>
                            <td class="fw-bold">{{ $single_car->door_number }}</td>
                        </tr>
                        <tr>
                            <td>Broj sedista</td>
                            <td class="fw-bold">{{ $single_car->number_of_seats }}</td>
                        </tr>
                        <tr>
                            <td>Strana volana</td>
                            <td class="fw-bold">{{ $single_car->steering_wheel_side }}</td>
                        </tr>
                        <tr>
                            <td>Klima</td>
                            <td class="fw-bold">{{ $single_car->climate }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-5">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Boja</td>
                            <td class="fw-bold">{{ $single_car->color }}</td>
                        </tr>
                        <tr>
                            <td>Materijal enterijera</td>
                            <td class="fw-bold">{{ $single_car->interior_material }}</td>
                        </tr>
                        <tr>
                            <td>Boja enterijera</td>
                            <td class="fw-bold">{{ $single_car->interior_color }}</td>
                        </tr>
                        <tr>
                            <td>Registrovan do</td>
                            <td class="fw-bold">{{ $single_car->registered_until }}</td>
                        </tr>
                        <tr>
                            <td>Poreklo vozila</td>
                            <td class="fw-bold">{{ $single_car->origin }}</td>
                        </tr>
                        <tr>
                            <td>Oštećenje</td>
                            <td class="fw-bold">{{ $single_car->damage }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4"></div>
</div>
<div class="row">
    <div class="col-8">
        <div class="safety mt-4 p-2" style="background-color: white; border-radius: 10px;">
                <h4 class="fw-bold">Sigurnost</h4>
            <div class="row">
                <div class="col">
                    <p>{{ $single_car->driver_airbag }}</p>
                    <p>{{ $single_car->passenger_airbag }}</p>
                </div>
                <div class="col">
                    <p>{{ $single_car->side_airbag }}</p>
                    <p>{{ $single_car->child_lock }}</p>
                </div>
                <div class="col">
                    <p>{{ $single_car->abs }}</p>
                    <p>{{ $single_car->esp }}</p>
                </div>
                <div class="col">
                    <p>{{ $single_car->asr }}</p>
                    <p>{{ $single_car->alarm }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-8">
            <div class="other_cars_from_this_seller mt-4 p-2" style="background-color: white; border-radius: 10px;">
                <h4 class="fw-bold" style="display: inline-block">Ostali automobili ovog prodavca</h4>
                <h5 style="float: right; margin-right: 20px">{{ $single_car->adOwner->name }} {{ $single_car->adOwner->last_name }}</h5>
                <div class="row">
                    <div class="col-12 m-3">
                        @foreach($my_ads as $my_ad)
                            @if($my_ad->new_car != 'Novo vozilo'  )
                                <a href="{{ route('ad.singleAd', ['id'=>$my_ad->id]) }}" style="display: inline-block; text-decoration: none; color: #1e2125">
                                    <div class="card" style="width: 11rem; padding: 0; margin: 0.75rem;">
                                        <img src="/ad_photos/{{ \App\Models\Ad_photo::where('ad_id', $my_ad->id)->first()->url }}" class="card-img-top" alt="...">
                                        <div class="card-body p-1">
                                            <h6 class="card-title m-0" style="font-weight: bold">{{ $my_ad->brand }} {{ $my_ad->model }}</h6>
                                            @if($my_ad->price == null)
                                                <h6 class="card-text m-0 d-inline-block" style="font-weight: bold">Po dogovoru</h6>
                                            @else
                                                <h6 class="card-text m-0 d-inline-block" style="font-weight: bold">{{ $my_ad->price }} €</h6>
                                            @endif
                                            <p class="float-end" style="color: grey">{{ $my_ad->produced }}. god.</p>
                                        </div>
                                    </div>
                                </a>
                            @else
                                <a href="{{ route('ad.singleAd', ['id'=>$my_ad->id]) }}" style="display: inline-block; text-decoration: none; color: #1e2125">
                                    <div class="card" style="width: 11rem; padding: 0; margin: 0.75rem; background-color: #0dcaf0">
                                        <img src="/ad_photos/{{ \App\Models\Ad_photo::where('ad_id', $my_ad->id)->first()->url }}" class="card-img-top" alt="...">
                                        <div class="new-car" style="position: absolute;top: 3px;left: 3px; background-color: #0dcaf0; color: white; padding: 0 6px; border-radius: 4px;">NOVO</div>
                                        <div class="card-body p-1">
                                            <h6 class="card-title m-0" style="font-weight: bold">{{ $my_ad->brand }} {{ $my_ad->model }}</h6>
                                            @if($my_ad->price == null)
                                                <h6 class="card-text m-0 d-inline-block" style="font-weight: bold">Po dogovoru</h6>
                                            @else
                                                <h6 class="card-text m-0 d-inline-block" style="font-weight: bold">{{ $my_ad->price }} €</h6>
                                            @endif
                                            <p class="float-end" style="color: grey">{{ $my_ad->produced }}. god.</p>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let phone = document.querySelector('#phone');
    phone.addEventListener('click', () => {
        phone.innerText = '{{ $single_car->adOwner->mobile_phone }}';
    });

    let rightBtn = document.querySelector('#right-btn');
    let leftBtn = document.querySelector('#left-btn');
    let pictures = document.querySelectorAll('.slider-images img');

    let imgNmb = 0;
    // if (imgNmb === 2){
    //     imgNmb = 0;
    // }
    rightBtn.addEventListener('click', () => {
        displayNone();
        imgNmb++;
        if (imgNmb === pictures.length){
            imgNmb = 0;
        }
        pictures[imgNmb].style.display = 'block';

    });
    leftBtn.addEventListener('click', () => {
        displayNone();
        imgNmb--;
        if (imgNmb === -1){
            imgNmb = pictures.length -1;
        }
        pictures[imgNmb].style.display = 'block';
    });
    /*
    Ova funkcija ce da sakrije sve slike
     */
    const displayNone = () => {
        pictures.forEach((img) => {
            img.style.display = 'none';
        })
    }
    let messageBtn = document.getElementById('message-btn');
    let messageSend = document.getElementById('message-send');
    messageBtn.addEventListener('click', function (){
       messageSend.style.display = 'block';
    });


</script>



@endsection

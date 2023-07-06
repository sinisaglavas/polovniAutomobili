@extends('layouts.master')

@section('main')
    <style>
        #cars i {
            color: #ffc107;
        }

        #motors i {
            color: black;
        }

        #motors {
            background-color: #babbbc;
        }

        #motors:hover {
            background-color: white;
        }

        #motors:hover i {
            color: #ffc107;
        }

        #cars a {
            display: block;
        }

        #motors a {
            display: block;
        }

        a {
            text-decoration: none;
        }

    </style>

    <div class="container mb-5">
        <div class="col-8"><br>
            <h2>Automobili &nbsp<span style="font-size: 18px;">{{ \Illuminate\Support\Facades\DB::table('ads')->count() }}&nbsp oglasa ukupno</span></h2>
            <div class="shadow-lg p-3 mb-5 ">
                <div class="row">
                    <div id="cars" class="col text-center p-0" style="background-color: white;">
                        <a href="{{ route('welcome') }}" class="active text-decoration-none"><i
                                class="fa-sharp fa-solid fa-car-side fa-3x"></i></a>
                    </div>
                    <div id="motors" class="col text-center p-0">
                        <a href="{{ route('motors') }}" class="active text-decoration-none"><i
                                class="fa-solid fa-motorcycle fa-3x"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="p-0" style="background-color: white">
                        <form action="{{ route('ad.searchCar') }}" method="POST" class="form-control border-0 p-4">
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    <select name="brand" class="form-control form-control-sm" id="brand">
                                        <option value="" disabled selected hidden>Marka</option>
                                        @foreach( $car_brands as $car_brand)
                                            <option value="{{ $car_brand->id }}">{{ $car_brand->brand }}</option>
                                        @endforeach
                                    </select></div>
                                <div class="col-4">
                                    <select name="model" class="form-control form-control-sm" id="model">
                                        <option value="" disabled selected hidden>Model</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <input type="number" name="price_up_to" placeholder="Cena do"
                                           class="form-control form-control-sm">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-2">
                                    <input id="years_of" oninput="checkOne()" type="text" name="years_of"
                                           placeholder="Godiste od" class="form-control form-control-sm">
                                </div>
                                <div class="col-2">
                                    <input id="years_up_to" oninput="checkTwo()" type="text" name="years_up_to"
                                           placeholder="do" class="form-control form-control-sm">
                                </div>
                                <div class="col-4">
                                    <select name="car_body" id="car_body" class="form-control form-control-sm">
                                        <option value="" disabled selected hidden>Karoserija</option>
                                        <option value=""></option>
                                        <option value="Limuzina">Limuzina</option>
                                        <option value="Hečbek">Hečbek</option>
                                        <option value="Karavan">Karavan</option>
                                        <option value="Kupe">Kupe</option>
                                        <option value="Kabriolet/Roadstar">Kabriolet/Roadstar</option>
                                        <option value="Monovolumen(Minivan)">Monovolumen(Minivan)</option>
                                        <option value="Džip/Suv">Džip/Suv</option>
                                        <option value="Pickup">Pickup</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select name="fuel" id="fuel" class="form-control form-control-sm">
                                        <option value="" disabled selected hidden>Gorivo</option>
                                        <option value=""></option>
                                        <option value="Benzin">Benzin</option>
                                        <option value="Dizel">Dizel</option>
                                        <option value="Benzin + Gas(TNG)">Benzin + Gas(TNG)</option>
                                        <option value="Benzin + Metan(CNG)">Benzin + Metan(CNG)</option>
                                        <option value="Električni">Električni</option>
                                        <option value="Hybrid">Hybrid</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-4">
                                    <select name="district" id="district" class="form-control form-control-sm">
                                        <option value="" disabled selected hidden>Region</option>
                                        @foreach( $districts as $district)
                                            <option value="{{ $district->district }}">{{ $district->district }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <input type="text" name="used_new_vehicles" placeholder="Polovna i nova vozila"
                                           class="form-control form-control-sm">
                                </div>
                                <div class="col-4">
                                    <input id="submit_search" type="submit" name="submit_search" value="PRETRAGA"
                                           class="form-control form-control-sm text-center"
                                           style="background-color: #ffc107">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-4">
                                            <input type="checkbox" id="alarm" name="alarm" value="alarm">
                                            <label for="alarm">Alarm</label>
                                        </div>
                                        <div class="col-4">
                                            <input type="checkbox" id="abs" name="abs" value="abs">
                                            <label for="abs">ABS</label>
                                        </div>
                                        <div class="col-4">
                                            <input type="checkbox" id="child_lock" name="child_lock" value="child-lock">
                                            <label for="child_lock">Child lock</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="{{ route('newCars') }}"><i class="fa-solid fa-car"></i> Novi
                                                automobili</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(isset($searches))
        <div class="container" style="margin-bottom: 150px">
            <div class="row">
                <div class="col-12">
                    @foreach($searches as $search)
                        @if($search->new_car != 'Novo vozilo'  )
                            <a href="{{ route('ad.singleAd', ['id'=>$search->id]) }}" style="display: inline-block">
                                <div class="card" style="width: 11.5rem; padding: 0; margin: 0.75rem">
                                    <img src="/ad_photos/{{ \App\Models\Ad_photo::where('ad_id',$search->id)->first()->url }}" class="card-img-top" alt="...">
                                    <div class="card-body p-1">
                                        <h6 class="card-title m-0"
                                            style="font-weight: bold">{{ $search->brand }} {{ $search->model }}</h6>
                                        @if($search->price != null)
                                            <h6 class="card-text m-0 d-inline-block" style="font-weight: bold">
                                                {{ $search->price }} €</h6>
                                        @else
                                            <h6 class="card-text m-0 d-inline-block" style="font-weight: bold">Po
                                                dogovoru</h6>
                                        @endif
                                        <p class="float-end m-0" style="color: grey">{{ $search->produced }}. god.</p>
                                    </div>
                                </div>
                            </a>
                        @else
                            <a href="{{ route('ad.singleAd', ['id'=>$search->id]) }}" style="display: inline-block">
                                <div class="card" style="width: 11.5rem; padding: 0; margin: 0.75rem">
                                    <img src="/ad_photos/{{ $search->photo1 }}" class="card-img-top" alt="...">
                                    <div class="new-car"
                                         style="position: absolute;top: 3px;left: 3px; background-color: #0dcaf0; color: white; padding: 0 6px; border-radius: 4px;">
                                        NOVO
                                    </div>
                                    <div class="card-body p-1">
                                        <h6 class="card-title m-0"
                                            style="font-weight: bold">{{ $search->brand }} {{ $search->model }}</h6>
                                        @if($search->price != null)
                                            <h6 class="card-text m-0 d-inline-block" style="font-weight: bold">
                                                {{ $search->price }} €</h6>
                                        @else
                                            <h6 class="card-text m-0 d-inline-block" style="font-weight: bold">Po
                                                dogovoru</h6>
                                        @endif
                                        <p class="float-end m-0" style="color: grey">{{ $search->produced }}. god.</p>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="container" style="margin-bottom: 150px">
            <div class="row">
                <div class="col-12">
                    @foreach($ads as $ad)
                        {{--                    @if($ad->created_at->diffInSeconds() > 86400  )   kada zelimo da oglas bude mladji od 24h--}}
                        @if($ad->new_car != 'Novo vozilo'  )
                            <a href="{{ route('ad.singleAd', ['id'=>$ad->id]) }}"
                               style="display: inline-block; text-decoration: none; color: #1e2125">
                                <div class="card" style="width: 11.5rem; padding: 0; margin: 0.75rem;">
                                    <img src="/ad_photos/{{ \App\Models\Ad_photo::where('ad_id',$ad->id)->first()->url }}" class="card-img-top" alt="...">
                                    <div class="card-body p-1">
                                        <h6 class="card-title m-0"
                                            style="font-weight: bold">{{ $ad->brand }} {{ $ad->model }}</h6>
                                        @if($ad->price == null)
                                            <h6 class="card-text m-0 d-inline-block" style="font-weight: bold">Po
                                                dogovoru</h6>
                                        @else
                                            <h6 class="card-text m-0 d-inline-block"
                                                style="font-weight: bold">{{ $ad->price }} €</h6>
                                        @endif
                                        <p class="float-end m-0" style="color: grey">{{ $ad->produced }}. god.</p>
                                    </div>
                                </div>
                            </a>
                        @else
                            <a href="{{ route('ad.singleAd', ['id'=>$ad->id]) }}"
                               style="display: inline-block; text-decoration: none; color: #1e2125">
                                <div class="card"
                                     style="width: 11.5rem; padding: 0; margin: 0.75rem; background-color: #0dcaf0">
                                    <img src="/ad_photos/{{ $ad->photo1 }}" class="card-img-top" alt="...">
                                    <div class="new-car"
                                         style="position: absolute;top: 3px;left: 3px; background-color: #0dcaf0; color: white; padding: 0 6px; border-radius: 4px;">
                                        NOVO
                                    </div>
                                    <div class="card-body p-1">
                                        <h6 class="card-title m-0"
                                            style="font-weight: bold">{{ $ad->brand }} {{ $ad->model }}</h6>
                                        @if($ad->price == null)
                                            <h6 class="card-text m-0 d-inline-block" style="font-weight: bold">Po
                                                dogovoru</h6>
                                        @else
                                            <h6 class="card-text m-0 d-inline-block"
                                                style="font-weight: bold">{{ $ad->price }} €</h6>
                                        @endif
                                        <p class="float-end m-0" style="color: grey">{{ $ad->produced }}. god.</p>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
            <h2 id="ajax">Click</h2>
        </div>
    @endif


    <script>
        function checkOne() {
            let years_of = document.querySelector('#years_of');
            let years_up_to = document.querySelector('#years_up_to');
            if (years_of.value) {
                years_up_to.setAttribute("required", "true");
            }
            if (!years_of.value) {
                years_up_to.removeAttribute("required");
            }
        }

        function checkTwo() {
            let years_of = document.querySelector('#years_of');
            let years_up_to = document.querySelector('#years_up_to');
            if (years_up_to.value) {
                years_of.setAttribute("required", "true");
            }
            if (!years_up_to.value) {
                years_of.removeAttribute("required");
            }
        }

        $('#ajax').click(function (){
            $.get('/ajax', function (data) {
                for (let i=0; i<data.length;i++){
                    $('body').append("<h1>"+data[i].brand+"</h1>")
                }
            })
        })


        $('#brand').change(function () {
            var id = $(this).val();
            $('#model').find('option').remove();
            $.get('/get-model-by-car-id?cid=' + id, function (data) {
                $('#model').append(`<option value=""></option>`);
                for(var i = 0; i < data.length;i++) {
                    $('#model').append(`<option value="${data[i].id}"> ${data[i].model} </option>`);
                }
            })
        })

    </script>
@endsection




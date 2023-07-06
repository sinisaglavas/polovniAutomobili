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
            <h2>Novi automobili</h2>
            <div class="shadow-lg p-3 mb-5 ">
                <div class="row">
                    <div id="cars" class="col text-center p-0" style="background-color: white;">
                        <a href="{{ route('welcome') }}" class="active text-decoration-none"><i class="fa-sharp fa-solid fa-car-side fa-3x"></i></a>
                    </div>
                    <div id="motors" class="col text-center p-0">
                        <a href="{{ route('motors') }}" class="active text-decoration-none"><i class="fa-solid fa-motorcycle fa-3x"></i></a>
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
                                    </select>                            </div>
                                <div class="col-4">
                                    <select name="model" class="form-control form-control-sm" id="model">
                                        <option value="" disabled selected hidden>Model</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <input type="number" name="price_up_to" placeholder="Cena do" class="form-control form-control-sm">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-2">
                                    <input id="years_of" oninput="checkOne()" type="text" name="years_of" placeholder="Godiste od" class="form-control form-control-sm">
                                </div>
                                <div class="col-2">
                                    <input id="years_up_to" oninput="checkTwo()" type="text" name="years_up_to" placeholder="do" class="form-control form-control-sm">
                                </div>
                                <div class="col-4">
                                    <select name="car_body" id="car_body" class="form-control form-control-sm">
                                        <option value="" disabled selected hidden>Karoserija</option>
                                        <option value="Limuzina">Limuzina</option>
                                        <option value="Hečbek">Hečbek</option>
                                        <option value="Karavan">Karavan</option>
                                        <option value="Kupe">Kupe</option>
                                        <option value="Kabriolet/Roadster">Kabriolet/Roadstar</option>
                                        <option value="Monovolumen(Minivan)">Monovolumen(Minivan)</option>
                                        <option value="Džip/Suv">Džip/Suv</option>
                                        <option value="Pickup">Pickup</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select name="fuel" id="fuel" class="form-control form-control-sm">
                                        <option value="" disabled selected hidden>Gorivo</option>
                                        <option value="Benzin">Benzin</option>
                                        <option value="Dizel">Dizel</option>
                                        <option value="Benzin + gas(TNG)">Benzin + Gas(TNG)</option>
                                        <option value="Benzin + metan(CNG)">Benzin + Metan(CNG)</option>
                                        <option value="Elektricni">Električni</option>
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
                                    <input type="text" name="used_new_vehicles" placeholder="Polovna i nova vozila" class="form-control form-control-sm" >
                                </div>
                                <div class="col-4">
                                    <input id="submit_search" type="submit" name="submit_search" value="PRETRAGA" class="form-control form-control-sm text-center" style="background-color: #ffc107">
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
                                            <input type="checkbox" id="child_lock" name="child_lock" value="child_lock">
                                            <label for="child_lock">Child lock</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="{{ route('newCars') }}" ><i class="fa-solid fa-car"></i> Novi automobili</a>
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

        <div class="container" style="margin-bottom: 150px">
            <div class="row">
                <div class="col-12">
                    @foreach($new_cars as $new_car)
                            <a href="{{ route('ad.singleAd', ['id'=>$new_car->id]) }}" style="display: inline-block; text-decoration: none; color: #1e2125">
                                <div class="card" style="width: 11.5rem; padding: 0; margin: 0.75rem;">
                                    <img src="/ad_photos/{{ \App\Models\Ad_photo::where('ad_id',$new_car->id)->first()->url }}" class="card-img-top" alt="...">
                                    <div class="card-body p-1">
                                        <h6 class="card-title m-0" style="font-weight: bold">{{ $new_car->brand }} {{ $new_car->model }}</h6>
                                        @if($new_car->price == null)
                                            <h6 class="card-text m-0 d-inline-block" style="font-weight: bold">Po dogovoru</h6>
                                        @else
                                            <h6 class="card-text m-0 d-inline-block" style="font-weight: bold">{{ $new_car->price }} €</h6>
                                        @endif
                                        <p class="float-end m-0" style="color: grey">{{ $new_car->produced }}. god.</p>
                                    </div>
                                </div>
                            </a>
                    @endforeach
                </div>
            </div>
        </div>


    <script>
        function checkOne(){
            let years_of = document.querySelector('#years_of');
            let years_up_to = document.querySelector('#years_up_to');
            if (years_of.value) {
                years_up_to.setAttribute("required", "true");
            }
            if (!years_of.value){
                years_up_to.removeAttribute("required");
            }
        }

        function checkTwo(){
            let years_of = document.querySelector('#years_of');
            let years_up_to = document.querySelector('#years_up_to');
            if (years_up_to.value) {
                years_of.setAttribute("required", "true");
            }
            if (!years_up_to.value){
                years_of.removeAttribute("required");
            }
        }

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



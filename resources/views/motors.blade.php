@extends('layouts.master')

@section('main')
    <style>
        #cars i {
            color: black;
        }
        #motors i {
            color: #ffc107;
        }
        #cars {
            background-color: #babbbc;
        }
        #cars:hover {
            background-color: white;
        }
        #cars:hover i {
            color: #ffc107;
        }
        #motors a {
            display: block;
        }
        #cars a {
            display: block;
        }

    </style>

    <div class="container mb-5">
        <div class="col-8"><br>
            <h2>Motori</h2>
            <div class="shadow-lg p-3 mb-5 ">
                <div class="row">
                    <div id="cars" class="col text-center p-0">
                        <a href="{{ route('welcome') }}" class="active text-decoration-none"><i class="fa-sharp fa-solid fa-car-side fa-3x"></i></a>
                    </div>
                    <div id="motors" class="col text-center p-0" style="background-color: white;">
                        <a href="{{ route('motors') }}" class="active text-decoration-none"><i class="fa-solid fa-motorcycle fa-3x"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="p-0" style="background-color: white">
                        <form action="" class="form-control border-0 p-4">
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    <select name="brand" class="form-control form-control-sm" id="brand">
                                        <option value="" disabled selected hidden>Marka</option>
                                        @foreach( $car_brands as $car_brand)
                                            <option value="{{ $car_brand->brand }}">{{ $car_brand->brand }}</option>
                                        @endforeach
                                    </select>                            </div>
                                <div class="col-4">
                                    <select name="model" class="form-control form-control-sm" id="model">
                                        <option value="" disabled selected hidden>Model</option>
                                        @foreach( $car_models as $car_model)
                                            <option value="{{ $car_model->model }}">{{ $car_model->model }}</option>
                                        @endforeach
                                    </select>                            </div>
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
                                        <option value="limuzina">Limuzina</option>
                                        <option value="hecbek">Hečbek</option>
                                        <option value="karavan">Karavan</option>
                                        <option value="kupe">Kupe</option>
                                        <option value="kabriolet/roadster">Kabriolet/Roadstar</option>
                                        <option value="minivan">Monovolumen(Minivan)</option>
                                        <option value="suv">Džip/Suv</option>
                                        <option value="pickup">Pickup</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select name="fuel" id="fuel" class="form-control form-control-sm">
                                        <option value="" disabled selected hidden>Gorivo</option>
                                        <option value="benzin">Benzin</option>
                                        <option value="dizel">Dizel</option>
                                        <option value="benzin-gas">Benzin + Gas(TNG)</option>
                                        <option value="benzin-metan">Benzin + Metan(CNG)</option>
                                        <option value="elektricni">Električni</option>
                                        <option value="hybrid">Hybrid</option>
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
                        </form>
                    </div>
                </div>
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

    </script>

@endsection




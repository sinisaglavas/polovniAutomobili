@extends('layouts.app')

@section('content')
    <style>
        a i {
            color: grey;
        }
        a i:hover {
            color: #ffc107;
        }
    </style>
    <div class="container" style="margin-bottom: 150px">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8"><br>
                <h2 class="text-center">Formular za postavku oglasa</h2>
                <h4 class="text-center">Postavi jedan oglas za sopstveno vozilo <span style="color: #ffc107">potpuno besplatno</span></h4>
            </div>
            <div class="col-2"></div>
        </div>
        <br><br><br><br>
        <div class="row">
            <h4>Odaberi kategoriju oglasa:</h4><br><br>
            <div class="col-2"><a href="{{ route('ad.adInputCar', ['id'=>1]) }}" class="text-center text-decoration-none"><i class="fa-sharp fa-solid fa-car-side fa-3x"></i></a></div>
            <div class="col-2"><a href="" class="text-center text-decoration-none"><i class="fa-solid fa-motorcycle fa-3x"></i></a></div>
        </div>
    </div>
@endsection

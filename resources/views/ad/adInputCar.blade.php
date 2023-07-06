@extends('layouts.app')

@section('content')
    <style>
        .hover select:hover {
            background-color: #FFF6F6;
            border: 1px solid #ffc107;
        }
        select:focus > option:checked {
            background: #ccc !important;
        }
        select > option:hover
        {
            color: #ccc;
            cursor: pointer;
        }
    </style>

    <div class="container"><br><br>
        <div class="row">
            <div class="col-2">
                <div class="row">
                    <div class="col-2">
                        <a href="{{ url('/ad/category-selection') }}"><i class="fa-sharp fa-solid fa-chevron-left fa-2x"></i></a>
                    </div>
                    <div class="col-10">
                        <a href="{{ url('/ad/category-selection') }}" class="text-decoration-none">Povratak na odabir kategorije</a>
                    </div>
                </div>
            </div>
            <div class="col-8 text-center"><h2>Automobili</h2></div>
            <div class="col-2"><i class="fa-sharp fa-solid fa-car-side fa-3x" style="color: #ffc107"></i></div>
        </div>
        <br>
        <div style="background-color: #f5f5f5; padding: 6px;">
            <p style="margin-top: 5px">Ukoliko imaš stalnu potrebu za postavkom 3 i više oglasa u istoj kategoriji, kontaktiraj nas putem email-a na
                <a href="" style="text-decoration: none">prodaja@polovniautomobili.com</a> ili <a href="" style="text-decoration: none">pogledajte ponudu</a>.</p>
        </div>
        <br><br>
        <h4 class="fw-bold" style="color: #ffc107">Unos fotografija</h4>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div style="border: 1px dotted darkgray; width: 800px;">
                    <div id="containerImage" style="height: 600px; width: 800px; display: flex; align-items: center; justify-content: center; flex-wrap: wrap;">
                        <img id="imgPreview1" src="#" alt="" style="max-width: 200px; max-height: 200px; min-width: 200px; min-height: 200px;">
                        <img id="imgPreview2" src="#" alt="" style="max-width: 200px; max-height: 200px; min-width: 200px; min-height: 200px;">
                        <img id="imgPreview3" src="#" alt="" style="max-width: 200px; max-height: 200px; min-width: 200px; min-height: 200px;">
                        <img id="imgPreview4" src="#" alt="" style="max-width: 200px; max-height: 200px; min-width: 200px; min-height: 200px;">
                        <img id="imgPreview5" src="#" alt="" style="max-width: 200px; max-height: 200px; min-width: 200px; min-height: 200px;">
                        <img id="imgPreview6" src="#" alt="" style="max-width: 200px; max-height: 200px; min-width: 200px; min-height: 200px;">
                        <img id="imgPreview7" src="#" alt="" style="max-width: 200px; max-height: 200px; min-width: 200px; min-height: 200px;">
                        <img id="imgPreview8" src="#" alt="" style="max-width: 200px; max-height: 200px; min-width: 200px; min-height: 200px;">
                        <img id="imgPreview9" src="#" alt="" style="max-width: 200px; max-height: 200px; min-width: 200px; min-height: 200px;">
                        <img id="imgPreview10" src="#" alt="" style="max-width: 200px; max-height: 200px; min-width: 200px; min-height: 200px;">
                        <img id="imgPreview11" src="#" alt="" style="max-width: 200px; max-height: 200px; min-width: 200px; min-height: 200px;">
                        <img id="imgPreview12" src="#" alt="" style="max-width: 200px; max-height: 200px; min-width: 200px; min-height: 200px;">
                    </div>
                </div>
            </div>
            <div class="text-center border mt-3 mb-3 p-3" style="background-color: #f5f5f5">
                Prevuci fotografije u polje iznad ili izaberi neke sa svog računara ili uređaja klikom na "Dodaj fotografije".<br>
                    Maksimalan broj fotografija je 12
            </div>
                <form id="fileUploadForm" method="POST" action="{{ route('home.saveAd') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group mb-3" id="parent">
                                <input name="photos[]" type="file" class="form-control" multiple id="photos">
                                <div id="progress"></div>
                            </div>
                        </div>
                        <div class="col-2">
                            <input type="button" class="btn btn-warning form-control" value="Ponisti" id="delete-pics">
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <h4 class="fw-bold" style="color: #ffc107">Marka i model</h4><br><br>
                        <div class="col-3 hover">
                                <label for="brand"></label>
                                <select name="brand" class="form-control form-control-sm" id="brand" required>
                                    <option value="" disabled selected hidden>Marka</option>
                                    @foreach( $car_brands as $car_brand)
                                        <option value="{{ $car_brand->id }}">{{ $car_brand->brand }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="col-3 hover">
                            <label for="model"></label>
                            <select name="model" class="form-control form-control-sm" id="model" required>
                                <option value="" disabled selected hidden>Model</option>
                            </select>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <h4 class="fw-bold" style="color: #ffc107">Osnovne informacije</h4><br><br>
                        <div class="row">
                            <div class="col-3 mt-2">
                                <input type="checkbox" id="new_car" name="new_car" value="new_car">
                                <label for="new_car">Novo vozilo</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="row">
                                <div class="col-4">
                                    <p class="pt-4 m-0">Godište</p>
                                </div>
                                <div class="col-8">
                                    <label for="produced"></label>
                                    <input type="text" name="produced" id="produced" class="form-control form-control-sm" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 hover">
                            <label for="car_body"></label>
                            <select name="car_body" id="car_body" class="form-control form-control-sm" required>
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
                    </div>
                    <div class="row">
                        <div class="col-3 hover">
                            <label for="fuel"></label>
                            <select name="fuel" id="fuel" class="form-control form-control-sm" required>
                                <option value="" disabled selected hidden>Gorivo</option>
                                <option value="Benzin">Benzin</option>
                                <option value="Dizel">Dizel</option>
                                <option value="Benzin + gas(TNG)">Benzin + Gas(TNG)</option>
                                <option value="Benzin + metan(CNG)">Benzin + Metan(CNG)</option>
                                <option value="Elektricni">Električni</option>
                                <option value="Hybrid">Hybrid</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <div class="row">
                                <div class="col-4">
                                    <p class="pt-4 m-0">Obeležje</p>
                                </div>
                                <div class="col-8">
                                    <label for="mark"></label>
                                    <input type="text" name="mark" id="mark" class="form-control form-control-sm" placeholder="1.6 HDI, 2.0 TDI... ">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <h4 class="fw-bold" style="color: #ffc107">Dodatne informacije</h4><br><br>
                        <div class="col-3">
                            <div class="row">
                                <div class="col-5">
                                    <p class="pt-4 m-0">Kubikaža(cm3)</p>
                                </div>
                                <div class="col-7">
                                    <label for="cubic_capacity"></label>
                                    <input type="text" name="cubic_capacity" id="cubic_capacity" class="form-control form-control-sm" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="row">
                                <div class="col-5">
                                    <p class="pt-4 m-0">Snaga(kW)</p>
                                </div>
                                <div class="col-7">
                                    <label for="power_kw"></label>
                                    <input type="text" name="power_kw" id="power_kw" class="form-control form-control-sm" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="row">
                                <div class="col-5">
                                    <p class="pt-4 m-0">Snaga(KS)</p>
                                </div>
                                <div class="col-7">
                                    <label for="power_hp"></label>
                                    <input type="text" name="power_hp" id="power_hp" class="form-control form-control-sm" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="row">
                                <div class="col-5">
                                    <p class="pt-4 m-0">Kilometraza</p>
                                </div>
                                <div class="col-7">
                                    <label for="mileage"></label>
                                    <input type="text" name="mileage" id="mileage" class="form-control form-control-sm" required>
                                </div>
                            </div>
                        </div>
                    </div>

                      <div class="row">
                          <div class="col-3 hover">
                              <label for="engine_emission_class"></label>
                              <select name="engine_emission_class" id="engine_emission_class" class="form-control form-control-sm" required>
                                  <option value="" disabled selected hidden>Emisiona klasa motora</option>
                                  <option value="Euro 1">Euro 1</option>
                                  <option value="Euro 2">Euro 2</option>
                                  <option value="Euro 3">Euro 3</option>
                                  <option value="Euro 4">Euro 4</option>
                                  <option value="Euro 5">Euro 5</option>
                                  <option value="Euro 6">Euro 6</option>
                              </select>
                          </div>
                          <div class="col-3 hover">
                              <label for="floating_flywheel"></label>
                              <select name="floating_flywheel" id="floating_flywheel" class="form-control form-control-sm" required>
                                  <option value="" disabled selected hidden>Odaberi plivajući zamajac</option>
                                  <option value="Sa plivajućim zamajcem">Sa plivajućim zamajcem</option>
                                  <option value="Bez plivajućeg zamajca">Bez plivajućeg zamajca</option>
                              </select>
                          </div>
                      </div>

                    <div class="row">
                        <div class="col-3 hover">
                            <label for="drive"></label>
                            <select name="drive" id="drive" class="form-control form-control-sm" required>
                                <option value="" disabled selected hidden>Pogon</option>
                                <option value="Prednji">Prednji</option>
                                <option value="Zadnji">Zadnji</option>
                                <option value="4x4">4x4</option>
                                <option value="4x4 reduktor">4x4 Reduktor</option>
                            </select>
                        </div>
                        <div class="col-3 hover">
                            <label for="transmission"></label>
                            <select name="transmission" id="transmission" class="form-control form-control-sm" required>
                                <option value="" disabled selected hidden>Menjač</option>
                                <option value="Manuelni 4 brzine">Manuelni 4 brzine</option>
                                <option value="Manuelni 5 brzina">Manuelni 5 brzina</option>
                                <option value="Manuelni 6 brzina">Manuelni 6 brzina</option>
                                <option value="Automatski/Poluautomatski">Automatski/Poluautomat.</option>
                            </select>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-3 hover">
                                <label for="door_number"></label>
                                <select name="door_number" id="door_number" class="form-control form-control-sm" required>
                                    <option value="" disabled selected hidden>Broj vrata</option>
                                    <option value="2/3 vrata">2/3 vrata</option>
                                    <option value="4/5 vrata">4/5 vrata</option>
                                </select>
                            </div>
                            <div class="col-3 hover">
                                <label for="number_of_seats"></label>
                                <select name="number_of_seats" id="number_of_seats" class="form-control form-control-sm" required>
                                    <option value="" disabled selected hidden>Broj sedišta</option>
                                    <option value="2 sedišta">2 sedišta</option>
                                    <option value="3 sedišta">3 sedišta</option>
                                    <option value="4 sedišta">4 sedišta</option>
                                    <option value="5 sedišta">5 sedišta</option>
                                    <option value="6 sedišta">6 sedišta</option>
                                    <option value="7 sedišta">7 sedišta</option>
                                    <option value="8 sedišta">8 sedišta</option>
                                    <option value="9 sedišta">9 sedišta</option>
                                </select>
                            </div>
                        </div>

                    <div class="row">
                        <div class="col-3 hover">
                            <label for="steering_wheel_side"></label>
                            <select name="steering_wheel_side" id="steering_wheel_side" class="form-control form-control-sm" required>
                                <option value="" disabled selected hidden>Strana volana</option>
                                <option value="Levi volan">Levi volan</option>
                                <option value="Desni volan">Desni volan</option>
                            </select>
                        </div>
                        <div class="col-3 hover">
                            <label for="climate"></label>
                            <select name="climate" id="climate" class="form-control form-control-sm" required>
                                <option value="" disabled selected hidden>Klima</option>
                                <option value="Nema">Nema</option>
                                <option value="Manuelna">Manuelna</option>
                                <option value="Automatska">Automatska</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 hover">
                            <label for="color"></label>
                            <select name="color" id="color" class="form-control form-control-sm" required>
                                <option value="" disabled selected hidden>Boja</option>
                                @foreach( $colors as $color)
                                    <option value="{{ $color->color }}">{{ $color->color }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3 hover">
                            <label for="interior_material"></label>
                            <select name="interior_material" id="interior_material" class="form-control form-control-sm" required>
                                <option value="" disabled selected hidden>Materijal enterijera</option>
                                <option value="Štof">Štof</option>
                                <option value="Prirodna koža">Prirodna koža</option>
                                <option value="Kombinovana koža">Kombinovana koža</option>
                                <option value="Velur">Velur</option>
                                <option value="Drugo">Drugo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 hover">
                            <label for="interior_color"></label>
                            <select name="interior_color" id="interior_color" class="form-control form-control-sm" required>
                                <option value="" disabled selected hidden>Boja enterijera</option>
                                <option value="Crna">Crna</option>
                                <option value="Bež">Bež</option>
                                <option value="Smeđa">Smeđa</option>
                                <option value="Siva">Siva</option>
                                <option value="Druga">Druga</option>
                            </select>
                        </div>
                        <div class="col-3 hover">
                            <label for="registered_until"></label>
                            <select name="registered_until" id="registered_until" class="form-control form-control-sm">
                                <option value="" disabled selected hidden>Registrovan do</option>
                                <option value="Nije registrovan">Nije registrovan</option>
                                <option value="04.2023.">04.2023.</option>
                                <option value="05.2023.">05.2023.</option>
                                <option value="06.2023.">06.2023.</option>
                                <option value="07.2023.">07.2023.</option>
                                <option value="08.2023.">08.2023.</option>
                                <option value="09.2023.">09.2023.</option>
                                <option value="10.2023.">10.2023.</option>
                                <option value="11.2023.">11.2023.</option>
                                <option value="12.2023.">12.2023.</option>
                                <option value="01.2024.">01.2024.</option>
                                <option value="02.2024.">02.2024.</option>
                                <option value="03.2024.">03.2024.</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 hover">
                            <label for="damage"></label>
                            <select name="damage" id="damage" class="form-control form-control-sm" required>
                                <option value="" disabled selected hidden>Ostećenje</option>
                                <option value="Nije oštećen">Nije oštećen</option>
                                <option value="Oštećen - u voznom stanju">Oštećen - u voznom stanju</option>
                                <option value="Oštećen - nije u voznom stanju">Oštećen - nije u voznom stanju</option>
                            </select>
                        </div>
                        <div class="col-3 hover">
                            <label for="replacement"></label>
                            <select name="replacement" id="replacement" class="form-control form-control-sm" required>
                                <option value="" disabled selected hidden>Zamena</option>
                                <option value="Bez zamene">Bez zamene</option>
                                <option value="Zamena za jeftinije">Zamena za jeftinije</option>
                                <option value="U istoj ceni">U istoj ceni</option>
                                <option value="Zamena za skuplje">Zamena za skuplje</option>
                            </select>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <h4 class="fw-bold" style="color: #ffc107" >Informacije o vlasnistvu</h4><br><br>
                        <div class="col-3 hover">
                            <label for="origin"></label>
                            <select name="origin" id="origin" class="form-control form-control-sm" required>
                                <option value="" disabled selected hidden>Poreklo vozila</option>
                                <option value="Domaće tablice">Domaće tablice</option>
                                <option value="Na ime kupca">Na ime kupca</option>
                                <option value="Strane tablice">Strane tablice</option>
                            </select>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <h4 class="fw-bold"  style="color: #ffc107">Sigurnost</h4><br><br>
                        <div class="col-3">
                            <input type="checkbox" id="driver_airbag" name="driver_airbag" value="driver_airbag">
                            <label for="driver_airbag">Airbag za vozaca</label>
                        </div>
                        <div class="col-3">
                            <input type="checkbox" id="passenger_airbag" name="passenger_airbag" value="passenger_airbag">
                            <label for="passenger_airbag">Airbag za suvozaca</label>
                        </div>
                        <div class="col-3">
                            <input type="checkbox" id="side_airbag" name="side_airbag" value="side_airbag">
                            <label for="side_airbag">Bočni airbag</label>
                        </div>
                        <div class="col-3">
                            <input type="checkbox" id="child_lock" name="child_lock" value="child_lock">
                            <label for="child_lock">Child lock</label>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-3">
                            <input type="checkbox" id="abs" name="abs" value="abs">
                            <label for="abs">ABS</label>
                        </div>
                        <div class="col-3">
                            <input type="checkbox" id="esp" name="esp" value="esp">
                            <label for="esp">ESP</label>
                        </div>
                        <div class="col-3">
                            <input type="checkbox" id="asr" name="asr" value="asr">
                            <label for="asr">ASR</label>
                        </div>
                        <div class="col-3">
                            <input type="checkbox" id="alarm" name="alarm" value="alarm">
                            <label for="alarm">Alarm</label>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <h4 class="fw-bold" style="color: #ffc107">Cena</h4><br><br>
                        <div class="col-3">
                            <div class="row">
                                <div class="col-4">
                                    <p class="mt-4 p-0">Cena</p>
                                </div>
                                <div class="col-8">
                                    <label for="price"></label>
                                    <input id="price" type="number" name="price" placeholder="Po dogovoru" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <h4 class="fw-bold" style="color: #ffc107">Opis oglasa</h4>
                    <textarea name="describe" cols="170" rows="5" class="rounded-3"></textarea>
                    <div class="text-center border mt-3 mb-3 p-3" style="background-color: #f5f5f5; border: 1px dotted deepskyblue">
                        Oglasi sa opisom imaju više pregleda od oglasa bez opisa. <br>
                        <a href="" class="text-decoration-none">Primer dobrog opisa oglasa</a>
                    </div>
                    <br><br>
                    <div class="row">
                        <h4 class="fw-bold" style="color: #ffc107">Kontakt podaci</h4><br><br>
                        <div class="col-3">
                            <div class="row">
                                <div class="col-5">
                                    <p class="pt-4 m-0">Mesto</p>
                                </div>
                                <div class="col-7">
                                    <label for="city"></label>
                                    <input type="text" name="city" id="city" class="form-control form-control-sm" value="{{ $user->city }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="row">
                                <div class="col-6">
                                    <p class="pt-4 m-0">Postanski broj</p>
                                </div>
                                <div class="col-6">
                                    <label for="post_code"></label>
                                    <input type="text" name="post_code" id="post_code" class="form-control form-control-sm" value="{{ $user->post_code }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 hover">
                            <label for="district"></label>
                            <select name="district" id="district" class="form-control form-control-sm" required>
                                <option value="" disabled selected hidden>Region</option>
                                @foreach( $districts as $district)
                                    <option value="{{ $district->district }}">{{ $district->district }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3 hover">
                            <label for="country"></label>
                            <select name="country" id="country" class="form-control form-control-sm" required>
                                <option value="" disabled selected hidden>Država</option>
                                @foreach( $countries as $country)
                                    <option value="{{ $country->country }}">{{ $country->country }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-3">
                                    <p class="pt-4 m-0">Adresa</p>
                                </div>
                                <div class="col-9">
                                    <label for="address"></label>
                                    <input id="address" type="text" name="address" class="form-control form-control-sm" value="{{ $user->address }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="row">
                                <div class="col-5">
                                    <p class="pt-4 m-0">Mobilni</p>
                                </div>
                                <div class="col-7">
                                    <label for="mobile_phone"></label>
                                    <input type="text" name="mobile_phone" id="mobile_phone" class="form-control form-control-sm" value="{{ $user->mobile_phone }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="row">
                                <div class="col-5">
                                    <p class="pt-4 m-0">Telefon</p>
                                </div>
                                <div class="col-7">
                                    <label for="phone"></label>
                                    <input type="text" name="phone" id="phone" class="form-control form-control-sm" value="{{ $user->phone }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="row">
                                <div class="col-5">
                                    <p class="pt-4 m-0">Ime</p>
                                </div>
                                <div class="col-7">
                                    <label for="name"></label>
                                    <input type="text" name="name" id="name" class="form-control form-control-sm" value="{{ $user->name }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="row">
                                <div class="col-5">
                                    <p class="pt-4 m-0">Prezime</p>
                                </div>
                                <div class="col-7">
                                    <label for="last_name"></label>
                                    <input type="text" name="last_name" id="last_name" class="form-control form-control-sm" value="{{ $user->last_name }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3 mb-3 p-3 fs-6">
                        <p>Oglašivač unosom podataka garantuje za tačnost i istinitost unetih podataka u skladu sa članom 301 stav 1 Krivičnog zakona RS (Sl. glasnik RS, br. 85/2005, 88/2005 - ispr, 107/2005 - ispr., 72/2009, 111/2009, 121/2012, 104/2013 i 108/2014 )</p>
                        <p>Zadržavamo pravo da uklonimo oglas ukoliko nije u skladu sa uslovima korišćenja sajta.</p>
                        <p>JATO Automatski unos podataka u ovom oglasu realizovan je u saradnji sa JATO-m. Copyright@JATO Dynamics Limited, 1990-2021. Sva prava su zadržana.</p>
                    </div>
                    <div class="row">
                        <div class="col-9"></div>
                        <div class="col-3">
                            <div class=" d-grid">
                                <input type="submit" value="Postavi oglas" class="btn" id="submit" style="background-color: lawngreen; color: white"><br>
                            </div>
                        </div>
                    </div>
                </form>
            @if(session()->has('message'))
                <div class="alert alert-info form-control m-2 text-center text-uppercase">
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>

        $(document).ready(() => {
            let photo = $("#photos");
            photo.change(function (event) {

                    // console.log(this.files)
                    for (let i = 0; i < this.files.length; i++){
                        //    console.log(i);
                        let file = this.files;
                        if (file) {
                            let reader = new FileReader();
                            reader.onload = function (event) {
                                let cimage = i+1;
                                let image = $("#imgPreview" + cimage);
                                //  console.log(image);
                                let results = event.target.result.split('data:image');
                                if (image) {
                                    image.attr("src", 'data:image'+results[1]);
                                    // console.log(results);
                                }
                            };
                            reader.readAsDataURL(file[i]);

                        }
                    }
            })
            });

        function showAlert() {
            // Create div
            const div = document.createElement('div');
            div.className = 'alert form-control';
            div.style.color = 'red';
            // Add text
            div.appendChild(document.createTextNode('Mozete dodati 12 slika!'));
            // Get parent
            const parent = document.getElementById('parent');
            const progress = document.getElementById('progress');
            parent.insertBefore(div, progress); // div-sta ubacujes,form-iznad cega ga ubacujes
            // Timeout after 3 sec
            setTimeout(function (){
                document.querySelector('.alert').remove()
            }, 5000);
        }

           document.getElementById('photos').addEventListener('change', function (){
               const photos = document.getElementById('photos');
               const submit = document.getElementById('submit');
               const file = this.files;
               if (file.length > 12){
                   photos.disabled = 'true';
                   photos.style.backgroundColor = 'red';
                   showAlert();
                   submit.disabled = true;
                   submit.style.backgroundColor = 'red';

                   } else {
                   photos.disabled = 'true';
               }

           });

        document.getElementById('delete-pics').addEventListener('click', function (){
           const photos = document.getElementById('photos');
           const deletePics = document.getElementById('delete-pics');
           if (photos.value) {
               photos.value = '';
               //const removeDiv = document.getElementById('containerImage');
              // removeDiv.remove();
               const photo1 = document.getElementById('imgPreview1');
               photo1.src = '#';
               const photo2 = document.getElementById('imgPreview2');
               photo2.src = '#';
               const photo3 = document.getElementById('imgPreview3');
               photo3.src = '#';
               const photo4 = document.getElementById('imgPreview4');
               photo4.src = '#';
               const photo5 = document.getElementById('imgPreview5');
               photo5.src = '#';
               const photo6 = document.getElementById('imgPreview6');
               photo6.src = '#';
               const photo7 = document.getElementById('imgPreview7');
               photo7.src = '#';
               const photo8 = document.getElementById('imgPreview8');
               photo8.src = '#';
               const photo9 = document.getElementById('imgPreview9');
               photo9.src = '#';
               const photo10 = document.getElementById('imgPreview10');
               photo10.src = '#';
               const photo11 = document.getElementById('imgPreview11');
               photo11.src = '#';
               const photo12 = document.getElementById('imgPreview12');
               photo12.src = '#';

               photos.style.backgroundColor = 'white';
               submit.disabled = false;
               submit.style.backgroundColor = 'lawngreen';
               photos.disabled = false;


               }

        });




        $('#brand').change(function () {
            var id = $(this).val();
            $('#model').find('option').remove();
            $.get('/get-model-by-car-id?cid=' + id, function (data) {
                for(var i = 0; i < data.length;i++) {
                    $('#model').append(`<option value="${data[i].id}"> ${data[i].model} </option>`);
                }
            })
        })


    </script>

@endsection

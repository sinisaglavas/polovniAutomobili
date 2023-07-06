<?php

namespace App\Http\Controllers;



use App\Models\Ad;
use App\Models\Ad_photo;
use App\Models\AdOwner;
use App\Models\CarBody;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Category;
use App\Models\Climate;
use App\Models\Color;
use App\Models\Country;
use App\Models\Damage;
use App\Models\District;
use App\Models\DoorNumber;
use App\Models\Drive;
use App\Models\EmissionClassEngine;
use App\Models\FloatingFlywheel;
use App\Models\Fuel;
use App\Models\InteriorColor;
use App\Models\InteriorMaterial;
use App\Models\Message;
use App\Models\NumberOfSeat;
use App\Models\Origin;
use App\Models\RegisteredUntil;
use App\Models\Replacement;
use App\Models\SteeringWheelSide;
use App\Models\Transmission;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdController extends Controller
{

    public function index()
    {
        $ads = Ad::all();
        $car_brands = CarBrand::all();
        $car_models = CarModel::all();
        $districts = District::all();

        return view('ajaxtest', compact('ads', 'car_brands','car_models','districts'));

    }

    public function ajax()
    {
        $ads = Ad::all();

        return $ads;
    }

    public function category()
    {
        return view('ad.category_selection');
    }

    public function adInputCar()
    {
        $user = auth()->user();

        $all_categories = Category::all(); // ka modelu i nazad u $all_categories
        $car_brands = CarBrand::all();
        $car_models = CarModel::all();
        $colors = Color::all();
        $countries = Country::all();
        $districts = District::all();

        return view('ad.adInputCar', compact('user', 'all_categories', 'car_brands', 'car_models',
            'colors', 'countries', 'districts'));
    }


    public function singleAd($id)
    {
        $single_car = Ad::find($id);
        $photos = Ad_photo::where('ad_id', $single_car->id)->get();
        $my_ads = AdOwner::find($single_car->ad_owner_id)->myAds;

       // $single_client = Client::find($id);
     //   $all_distances = $single_client->distances;

        return view('ad.singleAd', compact('single_car','my_ads', 'photos'));
    }


    public function searchCar(Request $request)
    {
        //dd($request->brand ? true : false);

        $car_brands = DB::table('car_brands')->get();
        $car_models = DB::table('car_models')->get();
        $districts = DB::table('districts')->get();

        $ads = Ad::all();

        $brand = $request->brand ? CarBrand::find($request->brand)->brand : null;
        $model = $request->model ? CarModel::find($request->model)->model : null;
        $car_body = $request->car_body;
        $fuel = $request->fuel;
        $years_of = $request->years_of;
        $years_up_to = $request->years_up_to;
        $district = $request->district;
        $new_car = $request->used_new_vehicles;
        $price_up_to = $request->price_up_to;
        $alarm = $request->alarm;
        $abs = $request->abs;
        $child_lock = $request->child_lock;


            $searches = Ad::when($brand, function ($q) use ($brand) {
                return $q->where('brand', 'LIKE', '%' . $brand . '%');
            })
                ->when($model, function ($q) use ($model) {
                    return $q->where('model', 'LIKE', '%' . $model . '%');
                })
                ->when($car_body, function ($q) use ($car_body) {
                    return $q->where('car_body', 'LIKE', '%' . $car_body . '%');
                })
                ->when($fuel, function ($q) use ($fuel) {
                    return $q->where('fuel', 'LIKE', '%' . $fuel . '%');
                })
                ->when($years_of && $years_up_to, function ($q) use ($years_of, $years_up_to) {
                    return $q->whereBetween('produced', [$years_of, $years_up_to]);
                })
                ->when($district, function ($q) use ($district) {
                    return $q->where('district', 'LIKE', '%' . $district . '%');
                })
                ->when($new_car, function ($q) use ($new_car) {
                    return $q->where('new_car', 'LIKE', '%' . $new_car . '%');
                })
                ->when($price_up_to, function ($q) use ($price_up_to) {
                    return $q->where('price', '<=', $price_up_to);
                })
                ->when($alarm, function ($q) use ($alarm) {
                    return $q->where('alarm', $alarm);
                })
                ->when($abs, function ($q) use ($abs) {
                    return $q->where('abs', $abs);
                })
                ->when($child_lock, function ($q) use ($child_lock) {
                    return $q->where('child_lock', $child_lock);
                })
                ->get();

            Session::flash('message', 'Trazeni oglas nije pronadjen');
          //  dd($searches);
            return view('welcome', compact('ads', 'searches','car_brands','car_models','districts'));


        // kontrola iz baze na frontu
//        $("#select").change(function(){
//            var marka_id = $(this).val();
//            $.get("ruta_ka_metodi_koja_vraca_modele_preko_id_marke/"+marka_id, function(data, status){
//                console.log("Data: " + data + "\nStatus: " + status);
//            });
//        });

//ovo bi moglo biti kao uslov za odredjivanje cene
//        $users = DB::table('users')
//            ->where('votes', '=', 100)
//            ->where('age', '>', 35)
//            ->get();

// OVO ISPROBATI https://stackoverflow.com/questions/62599531/laravel-multiple-filter-with-search


    }

    public function motors()
    {
        $ads = Ad::all();
        $car_brands = CarBrand::all();
        $car_models = CarModel::all();
        $districts = District::all();

        return view('motors', compact('ads','car_brands','car_models','districts'));
    }

    public function newCars()
    {
        $new_cars = DB::table('ads')->where('new_car', 'Novo vozilo')->get();
        $car_brands = CarBrand::all();
        $car_models = CarModel::all();
        $districts = District::all();

        return view('newCars', compact('new_cars','car_brands','car_models','districts'));
    }

    public function sendMessage(Request $request, $id) {

        $request->validate([
            "message"=>"required"
        ]);

        $ad = Ad::find($id);
        $adOwner = $ad->adOwner; // dobijamo vlasnika izabranog oglasa
        $adCreator = $ad->adCreator; // dobijamo ko je postavio oglas u ime vlasnika
        $new_msg = new Message();
        $new_msg->text = $request->message; // dolazi iz <textarea name="message">
        $new_msg->sender_id = auth()->user()->id; // ko salje poruku
        $new_msg->receiver_id = $adCreator->id;
        $new_msg->ad_owner_id = $adOwner->id; // ko prima poruku - vlasnik oglasa
        $new_msg->ad_id = $ad->id; // id samog oglasa
        $new_msg->save();

        return redirect()->back()->with('message', 'Poruka je poslata');

    }


}



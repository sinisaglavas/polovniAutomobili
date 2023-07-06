<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Ad_photo;
use App\Models\CarBody;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Category;
use App\Models\AdOwner;
use App\Models\District;
use App\Models\Fuel;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    public function index()
    {
        $all_cars = Ad::where('user_id', Auth::user()->id)->get();

        return view('home', compact('all_cars'));
    }

    public function saveAd(Request $request)
    {
        $category = 1;

        $request->validate([
            "city" => "required",//zahtevam popunjeno polje
            "post_code" => "required",
            "district" => "required",
            "country" => "required",
            "address" => "required",
            "mobile_phone" => "required",
            "phone" => "required",
            "name" => "required",
            "last_name" => "required",

            "brand" => "required | max:255",//zahtevam popunjeno polje i maksimalno 255 karaktera
            "model" => "required",//zahtevam obavezno popunjeno polje
            //   "price" => "required",
            "produced" => "required",
            "car_body" => "required",
            "fuel" => "required",
            "mark" => "required",

            "photo1" => "mimes:jpeg,jpg,png",//zahtevam da slike budu u odredjenom formatu-mimes su mime tipovi
//            "photo2" => "mimes:jpeg,jpg,png",
//            "photo3" => "mimes:jpeg,jpg,png",
//            "photo4" => "mimes:jpeg,jpg,png",
//            "photo5" => "mimes:jpeg,jpg,png",
//            "photo6" => "mimes:jpeg,jpg,png",
//            "photo7" => "mimes:jpeg,jpg,png",
//            "photo8" => "mimes:jpeg,jpg,png",
//            "photo9" => "mimes:jpeg,jpg,png",
//            "photo10" => "mimes:jpeg,jpg,png",
//            "photo11" => "mimes:jpeg,jpg,png",
//            "photo12" => "mimes:jpeg,jpg,png",

            "cubic_capacity" => "required",
            "power_kw" => "required",
            "power_hp" => "required",
            "mileage" => "required",
            "engine_emission_class" => "required",
            "floating_flywheel" => "required",
            "drive" => "required",
            "transmission" => "required",
            "door_number" => "required",
            "number_of_seats" => "required",
            "steering_wheel_side" => "required",
            "climate" => "required",
            "color" => "required",
            "interior_material" => "required",
            "interior_color" => "required",
            "registered_until" => "required",
            "damage" => "required",
            "replacement" => "required",
            "origin" => "required",
        ]);




        $ad_owner = DB::table('ad_owners')->where('mobile_phone', $request->mobile_phone)->first();


        if(!$ad_owner){
            $ad_owner = AdOwner::create([
                'city' => $request->city,
                'post_code' => $request->post_code,
                'district' => $request->district,
                'country' => $request->country,
                'address' => $request->address,
                'mobile_phone' => $request->mobile_phone,
                'phone' => $request->phone,
                'name' => $request->name,
                'last_name' => $request->last_name
            ]);
        }
            $ad = Ad::create([
                "brand" => CarBrand::find($request->brand)->brand,
                "model" => CarModel::find($request->model)->model,
                "price" => $request->price,
                "produced" => $request->produced,
                "new_car" => $request-> has('new_car') ? 'Novo vozilo' : 'Polovno vozilo',
                "car_body" => $request->car_body,
                "fuel" => $request->fuel,
                "mark" => $request->mark,


                "cubic_capacity" => $request->cubic_capacity,
                "power_kw" => $request->power_kw,
                "power_hp" => $request->power_hp,
                "mileage" => $request->mileage,
                "engine_emission_class" => $request->engine_emission_class,
                "floating_flywheel" => $request->floating_flywheel,
                "drive" => $request->drive,
                "transmission" => $request->transmission,
                "door_number" => $request->door_number,
                "number_of_seats" => $request->number_of_seats,
                "steering_wheel_side" => $request->steering_wheel_side,
                "climate" => $request->climate,
                "color" => $request->color,
                "interior_material" => $request->interior_material,
                "interior_color" => $request->interior_color,
                "registered_until" => $request->registered_until,
                "damage" => $request->damage,
                "replacement" => $request->replacement,
                "origin" => $request->origin,

                "driver_airbag" => $request-> has('driver_airbag') ? 'Driver airbag' : '',
                "passenger_airbag" => $request-> has('passenger_airbag') ? 'Passenger airbag' : '',
                "side_airbag" => $request-> has('side_airbag') ? 'Side airbag' : '',
                "child_lock" => $request-> has('child_lock') ? 'Child-lock' : '',
                "abs" => $request-> has('abs') ? 'Abs' : '',
                "esp" => $request-> has('esp') ? 'Esp' : '',
                "asr" => $request-> has('asr') ? 'Asr' : '',
                "alarm" => $request-> has('alarm') ? 'Alarm' : '',
                "describe" => $request->describe,
                'district' => $request->district,

                "ad_owner_id" => $ad_owner->id,
                "user_id" => auth()->id(),
                "category_id" => $category
            ]);
        foreach ($request->photos as $photo){
            $photo1 =$photo;//sada je slika u varijabli $photo1
            $photo1_name = rand(1,100000).time() . '1.' . $photo1->extension();//sada je ime slike jedinstveno
            $photo1->move(public_path('ad_photos'), $photo1_name);//premestanje slike u public folder koji cemo kreirati

            Ad_photo::create([
                'ad_id'=>$ad->id,
                'url'=>$photo1_name
            ]);
        }

        return redirect()->back()->with('message','Oglas je uspesno postavljen');
    }

    public function showMessages() {
        $messages = Message::where('receiver_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        // selektujemo vremenski (nove poruke na vrh stranice) poruke za korisnika koji je ulogovan

        return view('messages', compact('messages'));
    }

    public function replyMessage() {
        $sender_id = \request()->sender_id;
        $ad_owner_id = \request()->ad_owner_id;
        $ad_id = \request()->ad_id;

        $messages = Message::where('sender_id', $sender_id)->where('ad_id', $ad_id)->get(); // sve poruke koje su vezane za taj oglas

        return view('replyMessage', compact('sender_id', 'ad_owner_id', 'ad_id' ,'messages'));
    }

    public function confirmReply(Request $request) {
        $request->validate([
            "message"=>"required"
        ]);
        $sender = User::find($request->sender_id);
        $ad = Ad::find($request->ad_id);
        $ad_owner = AdOwner::find($request->ad_owner_id);

        $new_msg = new Message();
        $new_msg->text = $request->message;
        $new_msg->sender_id = \auth()->user()->id; // ko odgovara na ovu poruku, ko salje reply
        $new_msg->receiver_id = $sender->id; // primalac je onaj koji je malopre bio posiljalac
        $new_msg->ad_owner_id = $ad_owner->id; // prosledjujemo vlasnika oglasa
        $new_msg->ad_id = $ad->id; // o kom oglasu govorimo
        $new_msg->save();

        return redirect()->route('showMessages')->with('message', 'Odgovor je uspesno poslat');

    }

    public function deleteMessage($id){
        $message = Message::find($id);
        $message->delete();

        return redirect()->route('showMessages')->with('message', 'Poruka je obrisana');
    }




}

<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarModelController extends Controller
{
    public function models($id) {
        $models = CarModel::where('brand_id', $id)->get();
    }

    public function modelData($brand_id)
    {
//        $models = [];
//        $all_models = DB::table('car_models')->get();
//        foreach ($all_models as $model){
//            $models[] = $model;
//        }
//        return $models;

//        $brand = CarBrand::where('brand', $brand)->first();
//        $brand_id = $brand->id;                                    // preko naziva brenda trazim brand_id
        $models = CarModel::where('brand_id', $brand_id)->get();
        $array = [];
        foreach ($models as $model){
        $array[] = $model->model;

        }
        return $array;
    }

    public function carModel()
    {
        $cid= \request()->cid;
        $car_model = CarModel::where('brand_id', $cid)->get();
        return $car_model;

        //vaditi na osnovu carId gde cu vaditi modele

    }




//$("#select").change(function(){
//    var marka_id = $(this).val();
//    $.get("ruta_ka_metodi_koja_vraca_modele_preko_id_marke/"+marka_id, function(data, status){
//        console.log("Data: " + data + "\nStatus: " + status);
//    });
//});


}

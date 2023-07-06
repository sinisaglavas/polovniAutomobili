<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->integer('price')->nullable();
            $table->string('produced')->nullable();
            $table->string('car_body')->nullable();
            $table->string('fuel')->nullable();
            $table->string('mark')->nullable();

            $table->string('photo1')->nullable();
            $table->string('photo2')->nullable();
            $table->string('photo3')->nullable();
            $table->string('photo4')->nullable();
            $table->string('photo5')->nullable();
            $table->string('photo6')->nullable();
            $table->string('photo7')->nullable();
            $table->string('photo8')->nullable();
            $table->string('photo9')->nullable();
            $table->string('photo10')->nullable();
            $table->string('photo11')->nullable();
            $table->string('photo12')->nullable();

            $table->string('cubic_capacity')->nullable();
            $table->string('power_kw')->nullable();
            $table->string('power_hp')->nullable();
            $table->string('mileage')->nullable();
            $table->string('engine_emission_class')->nullable();
            $table->string('floating_flywheel')->nullable();
            $table->string('drive')->nullable();
            $table->string('transmission')->nullable();
            $table->string('door_number')->nullable();
            $table->string('number_of_seats')->nullable();
            $table->string('steering_wheel_side')->nullable();
            $table->string('climate')->nullable();
            $table->string('color')->nullable();
            $table->string('interior_material')->nullable();
            $table->string('interior_color')->nullable();
            $table->string('registered_until')->nullable();
            $table->string('damage')->nullable();
            $table->string('replacement')->nullable();
            $table->string('origin')->nullable();

            $table->string('driver_airbag')->nullable();
            $table->string('passenger_airbag')->nullable();
            $table->string('side_airbag')->nullable();
            $table->string('child_lock')->nullable();
            $table->string('abs')->nullable();
            $table->string('esp')->nullable();
            $table->string('asr')->nullable();
            $table->string('alarm')->nullable();
            $table->string('describe')->nullable();

            $table->unsignedBigInteger('ad_owner_id');
            $table->unsignedBigInteger('user_id');//kom user-u pripada ad
            $table->unsignedBigInteger('category_id');

            $table->timestamps();

            $table->foreign('ad_owner_id')->references('id')->on('ad_owners')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}

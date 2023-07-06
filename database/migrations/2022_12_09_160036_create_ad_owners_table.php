<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_owners', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('post_code');
            $table->string('district');
            $table->string('country');
            $table->string('address');
            $table->string('mobile_phone');
            $table->string('phone');
            $table->string('name');
            $table->string('last_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_owners');
    }
}

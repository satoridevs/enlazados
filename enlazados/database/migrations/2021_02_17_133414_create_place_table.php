<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('direccion');
            $table->string('barrio');
            $table->string('ciudad');
            $table->boolean('apartamento')->nullable();
            $table->boolean('habitacion')->nullable();
            $table->boolean('bano')->nullable();
            $table->boolean('sala')->nullable();
            $table->boolean('comedor')->nullable();
            $table->boolean('cocina')->nullable();
            $table->boolean('lavadero')->nullable();
            $table->boolean('patio')->nullable();
            $table->boolean('amoblado')->nullable();
            $table->Integer('cant_habitaciones')->nullable(); 
            $table->boolean('active')->nullable();   
            $table->string('imagen_1')->default('imgs/no-photo.png');
            $table->string('imagen_2')->default('imgs/no-photo.png');
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
        Schema::dropIfExists('places');
    }
}

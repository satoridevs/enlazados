<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->string('documentnumber')->unique();            
            $table->string('email');
            $table->BigInteger('phone');
            $table->date('birthdate');
            $table->string('gender');            
            $table->string('photo')->default('imgs/no-photo.png');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verified')->default(User::USUARIO_NO_VERIFICADO);
            $table->string('verification_token')->nullable();                                        
            $table->string('password');                    
            $table->boolean('active')->default(1);
            $table->Integer('role_id')->default(3);    
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

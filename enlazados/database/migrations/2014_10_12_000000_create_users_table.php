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
            $table->string('namecomplete');            
            $table->string('documentnumber')->nullable();            
            $table->string('email')->unique();
            $table->BigInteger('phone')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('gender')->nullable();            
            $table->string('photo')->default('imgs/no-photo.png');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verified')->default(User::USUARIO_NO_VERIFICADO);
            $table->string('verification_token')->nullable();                                        
            $table->string('password')->nullable();                    
            $table->string('active')->default('1');
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

<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use App\SocialProfile;
use App\Place;

class User extends Authenticatable
{
    use Notifiable;

    const USUARIO_NO_VERIFICADO = '1';
    const USUARIO_VERIFICADO = '0';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'namecomplete',        
        'documentnumber',
        'email',
        'phone',        
        'birthdate',
        'gender',        
        'photo',
        'password',                
        'active',
        'role_id',
        'verified',
        'verification_token',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'birthdate'
    ];

        //uno a muchos
    public function socialProfiles(){
        return $this->hasMany(SocialProfile::class);
        //return $this->hasMany('App\Game');
    }

    public function places(){
        return $this->hasMany(Place::class);
        //return $this->hasMany('App\Game');
    }

    public function setNameAttribute($valor) {
        
        $this->attributes['namecomplete'] = strtolower($valor);
    }

    public function  getNameAttribute($valor){
        return ucfirst($valor);
    }

    public function getLastNameAttribute($valor){
        return ucfirst($valor);
    }

    public function setEmailAttribute($valor) {
        
        $this->attributes['email'] = strtolower($valor);
    }

    public function getEmailAttribute($valor){
        return $valor;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'verification_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function esVerificado() {
        return $this->verified == User::USUARIO_VERIFICADO;
    }

    public static function verificationToken(){

        $random = Str::random(40);
        return $random;
    }

}

<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    const USUARIO_NO_VERIFICADO = '1';
    const USUARIO_VERIFICADO = '0';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'lastname',
        'documentnumber',
        'email',
        'phone',        
        'birthdate',
        'gender',        
        'photo',
        'password',                
        'active',
        'verified',
        'verification_token'        
    ];

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

        return str_random(40);
    }

}

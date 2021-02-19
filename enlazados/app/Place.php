<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Place extends Model
{
    protected $table = 'places';
    
    protected $fillable = [
        'direccion',
        'barrio',
        'ciudad',
        'apartamento',
        'habitacion',
        'bano',
        'sala',
        'comedor',
        'cocina',
        'lavadero',
        'patio',
        'amoblado',
        'cant_habitaciones',
        'active',
        'imagen_1',
        'imagen_2',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

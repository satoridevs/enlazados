<?php

namespace App\Http\Controllers\Rol;

use App\Http\Controllers\ApiController;
use App\Rol;
use Illuminate\Http\Request;

class RolController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::all();
        return $this->showAll($roles);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $rol = Rol::findOrFail($id);
        return $this->showOne($rol);
    }

}

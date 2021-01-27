<?php

namespace App\Http\Controllers\Rol;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Rol;

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rol = Rol::findOrFail($id);
        return $this->showOne($rol);
    }

}

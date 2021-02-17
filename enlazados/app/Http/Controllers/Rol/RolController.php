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

    public function store(Request $request)
    {

       $campos  = $request->all();
       $rol = Rol::create($campos);       
       //$usuario = User::create($user);
       
       return $this->showOne($rol,201);
    }

    public function update(Request $request, int $id)
    {
        
        $rol = Rol::findOrFail($id);
        
        if ($request->has('name')) {
            $rol->name = $request->name;
        }

        if ($request->has('description')) {
            $rol->description = $request->description;
        }

        if (!$rol->isDirty()) {
            return $this->errorResponse('Se debe especificar un valor diferente para poder actualizar',422);            
        }

        $rol -> save();
        
        //return $this->$request;
        return $this->showOne($rol);
    }

    public function destroy(int $id)
    {   
        $rol = Rol::findOrFail($id);  
        $rol->delete();
        return $this->showOne($rol);
    }

}

<?php

namespace App\Http\Controllers\Place;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Place;
use App\User;

class PlaceController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::all();
        return $this->showAll($places);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = User::findOrFail($request->user_id); 

        if($user){
            $campos  = $request->all();
            $campos['user_id'] = $user->id;  
            $place = Place::create($campos);      
            
            if ($request->hasFile('imagen_1')) {

                //$campos['imagen_1'] = $request->imagen_1->store('');  

                $file = time().'.'.$request->imagen_1->extension();
                $request->imagen_1->move(public_path('img'), $file);
                $campos['imagen_1'] = $file;
            }

            return $this->showOne($place,201);
            
        }else{
            return $this->errorResponse('El usuario al cual desea asociar el espacio no existe',422);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $place = Place::findOrFail($id);
        return $this->showOne($place);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $place = Place::findOrFail($id);
        
        if ($request->has('direccion')) {
            $place->direccion = $request->direccion;
        }

        if ($request->has('barrio')) {
            $place->barrio = $request->barrio;
        }

        if ($request->has('ciudad')) {
            $place->ciudad = $request->ciudad;
        }

        if ($request->has('apartamento')) {
            $place->apartamento = $request->apartamento;
        }

        if ($request->has('habitacion')) {
            $place->habitacion = $request->habitacion;
        }

        if ($request->has('baño')) {
            $place->baño = $request->baño;
        }

        if ($request->has('sala')) {
            $place->sala = $request->sala;
        }

        if ($request->has('comedor')) {
            $place->comedor = $request->comedor;
        }

        if ($request->has('cocina')) {
            $place->cocina = $request->cocina;
        }

        if ($request->has('lavadero')) {
            $place->lavadero = $request->lavadero;
        }

        if ($request->has('patio')) {
            $place->patio = $request->patio;
        }

        if ($request->has('amoblado')) {
            $place->amoblado = $request->amoblado;
        }

        if ($request->has('cant_habitaciones')) {
            $place->cant_habitaciones = $request->cant_habitaciones;
        }
        
        if ($request->has('active')) {
            $place->active = $request->active;
        }

        if ($request->has('user_id')) {
            $place->user_id = $request->user_id;
        }

        if ($request->has('imagen_1')) {
            $place->imagen_1 = $request->imagen_1;
        }

        if ($request->has('imagen_2')) {
            $place->imagen_2 = $request->imagen_2;
        }

        if (!$place->isDirty()) {
            return $this->errorResponse('Se debe especificar un valor diferente para poder actualizar',422);            
        }

        $place -> save();
        
        //return $this->$request;
        return $this->showOne($place);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Place::findOrFail($id);  
        $place->delete();
        
        return $this->showOne($place);
    }
}

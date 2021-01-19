<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();        
        return $this->showAll($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {               

        // $rules =  [
        //     'name'           => 'required',
        //     'lastname'       => 'required',
        //     'documentnumber' => 'required|unique:users',
        //     'email'          => 'required|email',
        //     'phone'          => 'required|numeric',
        //     'birthdate'      => 'required|date',
        //     'gender'         => 'required',                 
        //     'photo'          => 'max:1000',
        //     'password'       => 'required|min:6',   
        // ]; 

        // $this->validate($request, $rules);

        // $user->name            = $request->name;
        // $user->lastname        = $request->lastname;
        // $user->documentnumber  = $request->documentnumber;        
        // $user->email           = $request->email;        
        // $user->phone           = $request->phone;
        // $user->birthdate       = $request->birthdate;
        // $user->gender          = $request->gender;
        
        // if ($request->hasFile('photo')) {
        //     $file = time().'.'.$request->photo->extension();
        //     $request->photo->move(public_path('imgs'), $file);
        //     $user->photo = 'imgs/'.$file;
        // }
        // $user->password  = bcrypt($request->password);

         $campos  = $request->all();
         $campos['password'] = bcrypt($request->password);
         $campos['verified'] = User::USUARIO_NO_VERIFICADO;
         $campos['verification_token'] = User::verificationToken();        
        
         if ($request->hasFile('photo')) {
             $file = time().'.'.$request->photo->extension();
             $request->photo->move(public_path('imgs'), $file);
             $campos['photo'] = 'imgs/'.$file;
         }

        $usuario = User::create($campos);

        //$usuario = User::create($user);
        
        return $this->showOne($usuario,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);        
        return $this->showOne($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('lastname')) {
            $user->lastname = $request->lastname;
        }

        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }

        if ($request->has('birthdate')) {
            $user->birthdate = $request->birthdate;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        if (!$user->isDirty()) {
            return $this->errorResponse('Se debe especificar un valor diferente para poder actualizar',422);            
        }

        $user -> save();
        
        return $this->showOne($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return $this->showOne($user);
    }
}
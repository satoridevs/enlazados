<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\User;
use App\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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

        $campos  = $request->all();
        //$campos['password'] = bcrypt($request->password);
        $campos['password'] = Crypt::encrypt($request->password);        
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        
        $roles = Rol::findOrFail($user->role_id);        
        //return $this->showOne($user);
        return response()->json([
            'Usuario' => $user,
            'Rol' => $roles->name
       ]);
       
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        //$user = User::findOrFail($id);

        if ($request->has('namecomplete')) {
            $user->namecomplete = $request->namecomplete;
        }

        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }

        if ($request->has('role_id')) {
            $user->role_id = $request->role_id;
        }

        if ($request->has('active')) {
            $user->active = $request->active;
        }

        if ($request->has('birthdate')) {
            $user->birthdate = $request->birthdate;
        }

        if ($request->has('password')) {            
            //$user->password = bcrypt($request->password);
            $user->password = Crypt::encrypt($request->password);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {        
        $user->delete();
        return $this->showOne($user);
    }

    public function login(Request $request)
    {                

        $user = User::where('email', $request->email)->first();        
        
        if(!$user){
            return $this->errorResponse('Email o password invalido.',403);
        } else{
            if (Crypt::decrypt($user->password) == $request->password) {
            
                //return response()->json($user,200);
                $roles = Rol::findOrFail($user->role_id);        
                //return $this->showOne($user);
                return response()->json([
                    'Usuario' => $user,
                    'Rol' => $roles->name
                ],200);
            }
            else {            
                return $this->errorResponse('Email o password invalido',403);
            }
        }        
    }
}

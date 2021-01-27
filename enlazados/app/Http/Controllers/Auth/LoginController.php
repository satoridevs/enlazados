<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;


class LoginController extends Controller
{
    public function redirectToProvider($driver)
    {           
        
        $drivers = ['facebook','google'];
        
        if(in_array($driver,$drivers)){                        
            return Socialite::with($driver)->stateless()->redirect()->getTargetUrl();
        }else{
            return response()->json("no es una aplicacion valida",200);
        }        

    }

    public function handleProviderCallback(Request $request, $driver){

        if($request->get('error')){
            return response()->json("error",200);
        }

        try{
            $userSocialite = Socialite::driver($driver)->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('status', 'Something went wrong or You have rejected the app!');
        }
        

        return response()->json($userSocialite,200);

    }
}

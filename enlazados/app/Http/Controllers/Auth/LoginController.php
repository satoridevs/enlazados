<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;
use App\User;
use App\Socialprofile;

class LoginController extends ApiController
{
    public function redirectToProvider($driver)
    {           
        
        $drivers = ['facebook','google'];
        
        if(in_array($driver,$drivers)){                        
            return Socialite::with($driver)->stateless()->redirect()->getTargetUrl();
        }else{            
            return $this->errorResponse('no es una aplicacion valida',422);
        }        

    }

    public function handleProviderCallback(Request $request, $driver){

        $code = 0;        
        $data = "";

        if($request->get('error')){            
            return $this->errorResponse('error inesperado con el proveedor del login',500);
        }

        try{
            $userSocialite = Socialite::driver($driver)->stateless()->user();
        } catch (\Exception $e) {
            return $this->errorResponse('error inesperado al iniciar sesion con el proveedor',500);            
        }
        
        
        $social_profile = Socialprofile::where('social_id',$userSocialite->getid())
                                       ->where('social_name',$driver)->first();

        if(!$social_profile){
            $user = User::where('email', $userSocialite->getEmail())->first();

            if(!$user){
                $user= User::create([
                    'namecomplete' => $userSocialite->getName(),
                    'email' => $userSocialite->getEmail(),            
                ]);
                $code = 201;                
            }

            Socialprofile::create([
                'user_id'       => $user->id,
                'social_id'     => $userSocialite->getId(),
                'social_name'   => $driver,
                'social_avatar' => $userSocialite->getAvatar(),
            ]);
        }        
        
        if(!$social_profile){
            $code = 201;
            $data = $user;
        }else{
            $code = 200;
            $data = $social_profile->user;
        }

        return $this->showOne($data,$code);

    }
}

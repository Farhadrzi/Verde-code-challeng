<?php


namespace App\Services;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function register(array $userData){
        //todo:Create User

//        $token = Auth::login($user);
//        return [
////            'user' => $user,
////            'authorisation' => [
////                'token' => $token,
////                'type' => 'bearer',
////            ]
////        ];
    }

    public function login(array $credentials){
        try {
            $token = Auth::attempt($credentials);
            if (!$token) {
                throw new Exception('Email or Password Not Valid');
            }

            $user = Auth::user();
            return [
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ];
        }catch (Exception $exception){
            throw new Exception($exception->getMessage());
        }
    }

    public function logout(){
        Auth::logout();
        return true;
    }

    public function refresh(){
        return [
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ];
    }
}

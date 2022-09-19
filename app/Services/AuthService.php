<?php


namespace App\Services;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthService
{

    /**
     * @var UserService
     */
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(array $userData){
        try {
            $user = $this->userService->createUser($userData);
            $token = Auth::login($user);
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
        try {
            Auth::logout();
        }catch (Exception $exception){
            throw new Exception($exception->getMessage());
        }
    }

    public function refresh(){
        try {
            return [
                'user' => Auth::user(),
                'authorisation' => [
                    'token' => Auth::refresh(),
                    'type' => 'bearer',
                ]
            ];
        }catch (Exception $exception){
            throw new Exception($exception->getMessage());
        }
    }
}

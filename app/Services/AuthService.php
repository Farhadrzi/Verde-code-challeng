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

    /**
     * Register User and create JWT token
     * @param array $userData
     * @return array
     * @throws Exception
     */
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

    /**
     *
     * Login user with email and password
     * @param array $credentials
     * @return array
     * @throws Exception
     */
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

    /**
     * Logout user
     * @throws Exception
     */
    public function logout(){
        try {
            Auth::logout();
        }catch (Exception $exception){
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * refresh user jwt token
     * @return array
     * @throws Exception
     */
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

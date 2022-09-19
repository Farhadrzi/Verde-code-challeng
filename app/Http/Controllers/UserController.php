<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var AuthService
     */
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {

        $this->authService = $authService;
    }

    public function register(RegisterRequest $request){
        $registerTokenData = $this->authService->register(['name'=>$request->name,'email'=>$request->email,'password'=>$request->password]);
    }

    public function login(LoginRequest $request){
        $authTokenData = $this->authService->login($request->only(['email','password']));
    }

    public function logout(){
        $this->authService->logout();
    }

    public function refresh(){
        $this->authService->refresh();
    }
}

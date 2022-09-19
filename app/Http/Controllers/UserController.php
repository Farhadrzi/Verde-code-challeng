<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class UserController extends AppBaseController
{
    /**
     * @var AuthService
     */
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        parent::__construct();
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request){
        try {
            $registerTokenData = $this->authService->register(['name'=>$request->name,'email'=>$request->email,'password'=>$request->password]);
            return $this->response->success($registerTokenData,'success');
        }catch (\Exception $exception){
            return $this->response->error($exception->getMessage());
        }
    }

    public function login(LoginRequest $request){
        try {
            $authTokenData = $this->authService->login($request->only(['email','password']));
            return $this->response->success($authTokenData,'success');
        }catch (\Exception $exception){
            return $this->response->error($exception->getMessage());
        }
    }

    public function logout(){
        try {
            $this->authService->logout();
            return $this->response->success(null,'user logout successfully');
        }catch (\Exception $exception){
            return $this->response->error($exception->getMessage());
        }
    }

    public function refresh(){
        try {
            $authTokenData = $this->authService->refresh();
            return $this->response->success($authTokenData,'success');
        }catch (\Exception $exception){
            return $this->response->error($exception->getMessage());
        }
    }
}

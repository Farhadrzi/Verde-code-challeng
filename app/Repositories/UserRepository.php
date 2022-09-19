<?php


namespace App\Repositories;


use App\Interfaces\UserInterface;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    /**
     * Create User In Database
     * @param array $userData
     * @return mixed
     */
    public function createUser(array $userData){
        try {
            return User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
            ]);
        }catch (Exception $exception){
            throw new Exception('error while register user data');
        }
    }
}

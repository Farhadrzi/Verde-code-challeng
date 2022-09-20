<?php


namespace App\Services;


use App\Interfaces\UserInterface;
use Exception;

class UserService
{
    /**
     * @var UserInterface
     */
    private UserInterface $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    /**
     *
     * Create User and insert to database
     * @param array $userData
     * @return mixed
     */
    public function createUser(array $userData){
        try {
            return $this->userInterface->createUser($userData);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage());
        }
    }
}

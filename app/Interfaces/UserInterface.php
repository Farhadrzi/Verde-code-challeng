<?php

namespace App\Interfaces;

interface UserInterface
{
    /**
     * Create User In Database
     * @param array $userData
     * @return mixed
     */
    public function createUser(array $userData);
}

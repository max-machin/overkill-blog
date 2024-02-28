<?php

namespace App\Authentication;

use App\Interfaces\Authentication\AuthInterface;

class Auth implements AuthInterface
{
    public function login($email, $password)
    {
        return true;
    }

    public function register(array $data)
    {
        return true;
    }
}

?>
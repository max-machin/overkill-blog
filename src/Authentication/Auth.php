<?php

namespace App\Authentication;

use App\Class\Crud;
use App\Interfaces\Authentication\AuthInterface;

class Auth implements AuthInterface
{
    private $crud;

    public function __construct()
    {
        $this->crud = new Crud('user');
    }

    public function login($email, $password)
    {
        return true;
    }

    public function register($email, $password, $confirmPassword, $firstname, $lastname)
    {
        if ($this->crud->GetByAttributes(['email' => $email])) {
            throw new \Exception("L'email existe déjà");

            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->crud->Create(['email' => $email, 'password' => $hashedPassword, 'firstname' => $firstname, 'lastname' => $lastname, 'role' =>json_encode(["ROLE_USER"])]);

        echo ('enregistrer en base de données');
        return true;
    }
}

?>
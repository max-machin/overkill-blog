<?php

namespace App\Authentication;

use App\Class\Crud;
use App\Interfaces\Authentication\AuthInterface;

/**
 * Class Auth : Responsable d'échanger avec la BDD pour la gestion d'authentification
 * Exemple illustrant le design pattern : facade
 * @attribut crud -> permet d'utiliser les fonctions génériques d'accès aux données
 * @function login -> Connexion de l'utilisateur 
 * @function register -> Inscription de l'utilisateur
 */
class Auth implements AuthInterface
{
    private $crud;

    public function __construct()
    {
        $this->crud = new Crud('user');
    }

    /**
     * function Login : chargé de l'état de connexion de l'utilisateur, ce dernier est enregistré en session
     *
     * @param [string] $email
     * @param [string] $password
     * @return void
     */
    public function login(string $email, string $password)
    {
        $user = $this->crud->GetByAttributes(['email' => $email]);

        if (!empty($user) && password_verify($password, $user[0]['password'])) {

            $_SESSION['user'] = $user[0];
            
            return true;
        } else {
           
            return false;
        }
    }

    /**
     * function Register : Charger d'inscrire l'utilisateur en base de données
     *
     * @param [string] $email
     * @param [string] $password
     * @param [string] $confirmPassword
     * @param [string] $firstname
     * @param [string] $lastname
     * @return void
     */
    public function register(string $email, string $password, string $confirmPassword, string $firstname, string $lastname)
    {
        if ($this->crud->GetByAttributes(['email' => $email])) {
            throw new \Exception("L'email existe déjà");

            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->crud->Create(['email' => $email, 'password' => $hashedPassword, 'firstname' => $firstname, 'lastname' => $lastname, 'role' =>json_encode(["ROLE_USER"])]);

        return true;
    }
}

?>
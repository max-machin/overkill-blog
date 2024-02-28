<?php

namespace App\Facade\Authentication;

use App\Interfaces\Authentication\AuthInterface;
use App\Interfaces\Authentication\MailInterface;
use App\Interfaces\Authentication\ValidateInterface;

/**
 * Class AuthenticationFacade : Responsable du groupement des éléments et du fonctionnement de divers service.
 * @attribut validate : service de validation des entrées de formulaire.
 * @attribute auth : service d'authentification.
 * @attribute mail : service d'email.
 * Exemple illustrant le design pattern : facade
 */
class AuthenticationFacade
{
    protected $validate;
    protected $auth;
    protected $mail;

    public function __construct(ValidateInterface $validate, AuthInterface $auth, MailInterface $mail)
    {
        $this->validate = $validate;
        $this->auth = $auth;
        $this->mail = $mail;
    }

    /**
     * function signUpUser : Responsable de l'ensemble du processus d'authentification.
     *
     * @param [string] $email
     * @param [string] $password
     * @param [string] $confirmPassword
     * @param [string] $firstname
     * @param [string] $lastname
     * @return void
     */
    public function signUpUser($email, $password, $confirmPassword, $firstname, $lastname)
    {
        if ($this->validate->isValid(['mail' => $email, 'password' => $password, 'confirmPass' => $confirmPassword, 'firstname' => $firstname, 'lastname' => $lastname]))
        {
            $this->auth->register($email, $password, $confirmPassword, $firstname, $lastname);
            $this->auth->login($email, $password);
            $this->mail->to($email)->subject('Welcome')->send();

            return true;
        }

        return false;
    }

}

?>
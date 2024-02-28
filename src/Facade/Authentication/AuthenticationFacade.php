<?php

namespace App\Facade\Authentication;

use App\Interfaces\Authentication\AuthInterface;
use App\Interfaces\Authentication\MailInterface;
use App\Interfaces\Authentication\ValidateInterface;

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

    public function signUpUser($email, $password, $confirmPassword, $firstname, $lastname)
    {
        if ($this->validate->isValid(['mail' => $email, 'password' => $password, 'confirmPass' => $confirmPassword, 'firstname' => $firstname, 'lastname' => $lastname]))
        {
            $this->auth->register(['firstname' => $firstname, 'lastname' => $lastname, 'password' => $password, 'mail' => $email]);
            $this->auth->login($email, $password);
            $this->mail->to($email)->subject('Welcome')->send();
        }
    }

}

?>
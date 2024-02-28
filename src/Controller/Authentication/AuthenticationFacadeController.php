<?php

namespace App\Controller\Authentication;

use App\Authentication\Auth;
use App\Authentication\Mail;
use App\Authentication\Validate;
use App\Class\Controller;
use App\Facade\Authentication\AuthenticationFacade;

class AuthenticationFacadeController extends Controller
{

    public function signUpNewUser($email, $password, $confirmPassword, $firstname, $lastname)
    {
        $validate = new Validate();
        $auth = new Auth();
        $mail = new Mail();

        $facade = new AuthenticationFacade($validate, $auth, $mail);
        $facade->signUpUser($email, $password, $confirmPassword, $firstname, $lastname);
    }
}


?>
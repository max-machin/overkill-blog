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
        $rep = $facade->signUpUser($email, $password, $confirmPassword, $firstname, $lastname);

        if ($rep === true)
        {
            $this->redirect('home');
        } else {
            throw new \Exception("Une erreur est survenue durant le processus d'inscription.");
        }
    }

    public function loginSelf($email, $password)
    {

        if (empty($email) || empty($password))
        {
            throw new \Exception("veuillez renseignez les champs requis.");
        }

        $auth = new Auth();
        $rep = $auth->login($email, $password);

        if ($rep == true)
        {
            $this->redirect('home');
        } else {
            throw new \Exception("Login ou mot de passe incorrect.");
        }

    }
}


?>
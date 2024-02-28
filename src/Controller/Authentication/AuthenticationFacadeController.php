<?php

namespace App\Controller\Authentication;

// Classes d'authentification 
use App\Authentication\Auth;
use App\Authentication\Mail;
use App\Authentication\Validate;
// Controller
use App\Class\Controller;
// Facade
use App\Facade\Authentication\AuthenticationFacade;

/**
 * Class AuthenticationFacadeController : Responsable d'instancier les classes dont la facade aura besoin.
 * @function signUpNewUser : Effectue tout le processus d'autentification d'un utilisateur.
 * Exemple illustrant le design pattern : facade
 */
class AuthenticationFacadeController extends Controller
{

    /**
     * function signUpNewUser : Instancie toutes les classes nécessaires à la facade d'autentification
     *
     * @param [string] $email
     * @param [string] $password
     * @param [string] $confirmPassword
     * @param [string] $firstname
     * @param [string] $lastname
     * @return void
     */
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

    /**
     * function loginSelf : Permet d'effctuer une connexion sans passer par la facade
     *
     * @param [string] $email
     * @param [string] $password
     * @return void
     */
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
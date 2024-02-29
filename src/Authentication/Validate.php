<?php

namespace App\Authentication;

use App\Interfaces\Authentication\ValidateInterface;

// handler de chaine de reponsabilite
use App\LinkResponsability\MailValidationHandler;
use App\LinkResponsability\PasswordValidationHandler;
use App\LinkResponsability\SanitizeValidationHandler;

/**
 * Class Validate : Responsable de la validation des données entrer en formulaire.
 * Exemple illustrant le design pattern : facade
 * Exemple illustrant le design pattern : chaine de reponsabilite
 */
class Validate implements ValidateInterface
{
    // Handlers 
    private $sanitizeValidationHandler;
    private $mailValidationHandler;
    private $passwordValidationHandler;

    public function __construct()
    {
        $this->sanitizeValidationHandler = new SanitizeValidationHandler();
        $this->mailValidationHandler= new MailValidationHandler();
        $this->passwordValidationHandler = new PasswordValidationHandler();
    }

    public function isValid(array $data)
    {

        // Construction de la chaine de responsabilite
        $this->sanitizeValidationHandler->setNextHandler($this->mailValidationHandler);
        $this->mailValidationHandler->setNextHandler($this->passwordValidationHandler);

        $this->sanitizeValidationHandler->handlerRequest($data);

        return true;
    }
}

?>
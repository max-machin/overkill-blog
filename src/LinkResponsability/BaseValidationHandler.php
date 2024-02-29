<?php 

namespace App\LinkResponsability;

/**
 * BaseValidationHandler : Base de la chaine de responabilité, qui va initialisé la fonction commune et l'enchainement des handlers
 * Exemple illustrant le design pattern : chaine de responsabilite
 */
class BaseValidationHandler implements IValidationHandler
{
    private $nextValidationHandler;

    /**
     * setNextHandler : enchainement des handlers
     *
     * @param IValidationHandler $handler
     * @return void
     */
    public function setNextHandler(IValidationHandler $handler)
    {
        $this->nextValidationHandler = $handler;
    }

    /**
     * handlerRequest : Fonction commune aux handlers
     *
     * @param [array] $credentials
     * @param [bool] $updatedValidationResponse
     * @return void
     */
    public function handlerRequest($credentials, $updatedValidationResponse = null)
    {

        if ($this->nextValidationHandler != null)
        {
            $this->nextValidationHandler->handlerRequest($credentials, $updatedValidationResponse);
        }
    }
}
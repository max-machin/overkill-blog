<?php

namespace App\LinkResponsability;

// Interface de validation
// Exemple illustrant le design pattern : chaine de responsabilite
interface IValidationHandler 
{
    public function handlerRequest($credentials, $updatedValidationResponse = null);

}
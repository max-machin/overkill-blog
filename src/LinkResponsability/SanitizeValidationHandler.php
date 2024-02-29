<?php

namespace App\LinkResponsability;

/**
 * SanitizeValidationHandler : validation des entrées en formulaire
 * Exemple illustrant le design pattern : chaine de responsabilite
 */
class SanitizeValidationHandler extends BaseValidationHandler
{
    public function handlerRequest($credentials, $updatedValidationResponse = null)
    {
        if (empty($credentials))
        {
            throw new \Exception("Veuillez renseigner les informations requises.");
            return false;
        }

        $sanitizeData = [];

        foreach($credentials as $key => $value)
        {
            $sanitizeData[$key] = trim(htmlspecialchars($value));
        }
        
        parent::handlerRequest($credentials, true);
    }
}
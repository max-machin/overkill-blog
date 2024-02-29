<?php

namespace App\LinkResponsability;

/**
 * MailValidationHandler : validation du format de mail
 * Exemple illustrant le design pattern : chaine de responsabilite
 */
class MailValidationHandler extends BaseValidationHandler
{
    public function handlerRequest($credentials, $updatedValidationResponse = null)
    {

        foreach($credentials as $key => $value)
        {
            if ($key == 'mail')
            {
                $pattern = "/^\S+@\S+\.\S+$/";
                if (!preg_match($pattern, filter_var($value, FILTER_SANITIZE_EMAIL)))
                {
                    throw new \Exception("Veuillez insérer un format de mail valide."); 
                    return false;
                } else if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    throw new \Exception("Veuillez insérer un format de mail valide.");
                    return false;
                }
                    
            }
        }
        
        parent::handlerRequest($credentials, true);
    }
}
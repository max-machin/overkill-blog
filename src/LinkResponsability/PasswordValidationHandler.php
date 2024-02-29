<?php

namespace App\LinkResponsability;

/**
 * PasswordValidationHandler : validation du format de password et confirmation de password
 * Exemple illustrant le design pattern : chaine de responsabilite
 */
class PasswordValidationHandler extends BaseValidationHandler
{
    public function handlerRequest($credentials, $updatedValidationResponse = null)
    {
        foreach($credentials as $key => $value)
        {
            if ($key == 'password')
            {

                $pattern = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$^";
                if (!preg_match($pattern, $value))
                {
                    throw new \Exception("Le mot de passe doit contenir au minimum 8 caractères, 1 majuscule et 1 chiffre."); 
                    return false;
                }
                
            }
        }

        if ($credentials['password'] != $credentials['confirmPass'])
        {
            throw new \Exception("Les mots de passes doivent correspondrent."); 
            return false;
        }
        return true;
        parent::handlerRequest($credentials, true);
    }
}
<?php

namespace App\Authentication;

use App\Interfaces\Authentication\ValidateInterface;

class Validate implements ValidateInterface
{
    public function isValid(array $data)
    {
        
        foreach($data as $key => $value)
        {

            if ($key == 'mail')
            {
                $pattern = "/^\S+@\S+\.\S+$/";
                if (!preg_match($pattern, $value))
                {
                    throw new \Exception("Veuillez insérer un format de mail valide."); 
                    return false;
                } 
            }
            else if ($key == 'password')
            {

                $pattern = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$^";
                if (!preg_match($pattern, $value))
                {
                    throw new \Exception("Le mot de passe doit contenir au minimum 8 caractères, 1 majuscule et 1 chiffre."); 
                    return false;
                }
                
            } else if (empty($value)){
                throw new \Exception("Veuillez renseigner tous les champs."); 
                return false;
            }
        }

        if ($data['password'] != $data['confirmPass'])
        {
            throw new \Exception("Les mots de passes doivent correspondrent."); 
            return false;
        }

        return true;
    }
}

?>
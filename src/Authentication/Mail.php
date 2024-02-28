<?php

namespace App\Authentication;

use App\Interfaces\Authentication\MailInterface;

/**
 * Class Mail : Responsable d'envoyer un mail à l'utilisateur nouvellement inscrit.
 * Exemple illustrant le design pattern : facade
 */
class Mail implements MailInterface
{
    public function to($to)
    {
        return $this;
    }

    public function subject($subject)
    {
        return $this;
    }

    public function send()
    {
        return true;
    }
}

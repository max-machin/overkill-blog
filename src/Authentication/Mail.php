<?php

namespace App\Authentication;

use App\Interfaces\Authentication\MailInterface;

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

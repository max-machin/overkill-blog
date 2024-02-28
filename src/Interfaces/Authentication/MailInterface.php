<?php

namespace App\Interfaces\Authentication;

interface MailInterface
{
	public function to($to);
	public function subject($subject);
	public function send();
}


?>
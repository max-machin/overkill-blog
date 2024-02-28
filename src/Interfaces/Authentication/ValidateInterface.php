<?php

namespace App\Interfaces\Authentication;

interface ValidateInterface
{
	public function isValid(array $data);
}

?>
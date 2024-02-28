<?php

namespace App\Interfaces\Authentication;

interface AuthInterface
{
	public function login($username, $password);
    public function register($mail, $password, $confirmPassword, $firstname, $lastname);
}
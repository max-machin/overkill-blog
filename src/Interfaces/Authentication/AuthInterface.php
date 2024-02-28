<?php

namespace App\Interfaces\Authentication;

interface AuthInterface
{
	public function login(string $username, string $password);
    public function register(string $mail, string $password, string $confirmPassword, string $firstname, string $lastname);
}
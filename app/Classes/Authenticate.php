<?php

require_once 'app/Security/Authenticator.php';

class Authenticate
{

    private Authenticator $authenticator;

    public function __construct()
    {
        $this->authenticator = new Authenticator();
    }

    public function authenticateUser(string $email, string $password): bool{
        return $this->authenticator->Authenticate($email,$password);
    }

    public function logout(): bool{
        return $this->authenticator->logout();
    }

}
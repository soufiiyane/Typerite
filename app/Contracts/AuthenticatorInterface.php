<?php

interface AuthenticatorInterface
{

    public function Authenticate(string $email, string $password): bool;

    public function logout(): bool;

}
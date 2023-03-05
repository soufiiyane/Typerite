<?php

require_once 'app/Repositories/UserRepository.php';
require_once 'app/Contracts/AuthenticatorInterface.php';

class Authenticator implements AuthenticatorInterface
{

    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function Authenticate(string $email, string $password): bool
    {
        $user = $this->userRepository->findOneBy(['email'=>$email]);
        if ($user) {
            if ($this->verifyPassword($password,$user->getPassword())) {
                $this->onAuthenticateSuccess($user);

                return true;
            }

            return false;
        }

        return false;
    }

    private function verifyPassword(string $plainText, string $password): bool
    {
        return md5($plainText) === $password;
    }

    private function onAuthenticateSuccess(User $user): void
    {
        $_SESSION['user'] = $user;
    }

    public function logout(): bool
    {
        if (isset($_SESSION['user'])) {
            session_unset();
            session_destroy();

            return true;
        }

        return false ;
    }

}
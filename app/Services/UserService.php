<?php

require_once 'app/Repositories/UserRepository.php';

class UserService
{

    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function getAllUsers(): array|bool
    {
        $users = $this->userRepository->getAllUsers();
        if (!empty($users)) {

            return $users;
        }

        return false;
    }

    public function findOneBy(array $criteria, array $orderBy = null): ?User
    {
        return $this->userRepository->findOneBy($criteria,$orderBy);
    }

    public function saveUser(User $user): bool
    {
        $exist = $this->userRepository->findOneBy(['email'=>$user->getEmail()]);
        if (!is_null($exist)) {

            return false;
        }
        if ($this->userRepository->saveUser($user)) {

            return true;
        }

        return false;
    }

    public function deleteUserById(int $id): bool
    {
        $user = $this->userRepository->findOneBy(['id'=>$id]);
        if (!is_null($user)) {
            if ($this->userRepository->deleteUserById($id)) {

                return true;
            }

            return false;
        }

        return false;
    }

}
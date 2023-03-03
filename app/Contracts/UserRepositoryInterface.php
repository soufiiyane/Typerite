<?php

interface UserRepositoryInterface
{

    public function getAllUsers(): array;

    public function findOneBy(array $criteria, array $orderBy = null): ?User;

    public function saveUser(User $user): void;

    public function deleteUserById(int $id): void ;

}
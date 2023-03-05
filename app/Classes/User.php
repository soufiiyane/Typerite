<?php

class User
{

    private int $id;
    private string $name;
    private string $lastName;
    private string $email;
    private string $password;
    private string $role;
    private string $imagePath;
    private string $createdAt ;

    public function __construct()
    {
        $this->createdAt =  date('Y-m-d h:i:s');
        $this->imagePath = 'uploades/profile/default.jpg';
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getImagePath(): string
    {
        return $this->imagePath;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
       $this->name = $name;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = md5($password);
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function setImagePath(string $imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

}
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
    private string $createdAt;
    private bool   $isVerified;
    private string $token;

    public function __construct()
    {
        $createdat = new DateTime('Y-m-d h:i:s');
        $createdat = $createdat->format("M d, Y");
        $this->createdAt = strtoupper($createdat);
        $this->imagePath = 'uploads/profile/default.jpg';
        $this->role = 'user';
        $this->isVerified = false;
        $this->token = '';
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

    public function getIsVerified(): bool
    {
        return $this->isVerified;
    }

    public function getToken(): string
    {
        return $this->token;
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

    public function setIsVerified(bool $isVerified): void
    {
        $this->isVerified = $isVerified;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

}
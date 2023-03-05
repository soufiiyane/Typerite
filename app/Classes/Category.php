<?php

class Category
{

    private readonly int $id;
    private string $name;

    public function __construct()
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCategoryName(): string
    {
        return $this->name;
    }

    public function setCategoryName(string $name): void
    {
        $this->name = $name;
    }

}
<?php

interface CategoryInterface
{

    public function getAll(): array;

    public function save(string $name): void;

    public function delete(int $id): void;

    public function getCategoryPosts(int $id): array;

}
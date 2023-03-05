<?php

interface CategoryInterface
{

    public function getAll(): array;

    public function save(string $name): bool;

    public function delete(int $id): bool;

    public function getCategoryPosts(int $id): array;

}

<?php

interface PostInterface
{

    public function getAllPosts(): array;

    public function findOneBy(array $criteria, array $orderBy = null): ?Post;

    public function deletePost(int $id): bool;

    public function savePost(Post $post): bool;

}
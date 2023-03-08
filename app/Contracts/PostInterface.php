<?php

interface PostInterface
{

    public function getAllPosts(): array;

    public function findById(int $id): ?Post;

    public function deletePost(int $id): bool;

    public function savePost(Post $post): bool;

}
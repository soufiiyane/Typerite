<?php

class Post
{

    private readonly int $id;
    private string $headline;
    private string $content;
    private int $category;
    private int $postType;
    private int $author;
    private string $discr;
    private string $createdAt;

    public function __construct()
    {
        $createdat = new DateTime('Y-m-d h:i:s');
        $createdat = $createdat->format("M d, Y");
        $this->createdAt = strtoupper($createdat);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getHeadline(): string
    {
        return $this->headline;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCategory(): int
    {
        return $this->category;
    }

    public function getPostType(): int
    {
        return $this->postType;
    }

    public function getAuthor(): int
    {
        return $this->author;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setHeadline(string $headline): void
    {
        $this->headline = $headline;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function setCategory(int $category): void
    {
        $this->category = $category;
    }

    public function setPostType(int $postType): void
    {
        $this->postType = $postType;
    }

    public function setAuthor(int $author): void
    {
        $this->author = $author;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

}
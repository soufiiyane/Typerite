<?php

class VideoPost extends Post
{

    private string $thumbnail;
    private string $url;

    public function __construct()
    {
        parent::__construct();
    }

    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setThumbnail(string $thumbnail): void
    {
        $this->thumbnail = $thumbnail;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

}
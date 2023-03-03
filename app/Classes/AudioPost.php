<?php

class AudioPost extends Post
{

    private string $url;

    public function __construct()
    {
        parent::__construct();
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

}
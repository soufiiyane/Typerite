<?php

class AudioPost extends Post
{

    private string $url;
    private string $embedHtml;

    public function __construct()
    {
        parent::__construct();
        $this->embedHtml = '';
        $this->setDiscr('audio');
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getEmbedHtml(): string
    {
        return $this->embedHtml;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function setEmbedHtml(string $embedHtml): void
    {
        $this->embedHtml = $embedHtml;
    }
}
<?php

class AudioPost extends Post
{

    private string $url;
    private string $embedHtml;
    private string $thumbnail;
    public function __construct()
    {
        parent::__construct();
        $this->embedHtml = '';
        $this->setDiscr('audio');
        $this->thumbnail = '';
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getEmbedHtml(): string
    {
        return $this->embedHtml;
    }

    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function setEmbedHtml(string $embedHtml): void
    {
        $this->embedHtml = $embedHtml;
    }

    public function setThumbnail(string $thumbnail): void
    {
        $this->thumbnail = $thumbnail;
    }
}
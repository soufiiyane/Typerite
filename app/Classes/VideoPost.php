<?php


class VideoPost extends Post
{

    private string $embedHtml;
    private string $url;

    public function __construct()
    {
        parent::__construct();
    }

    public function getEmbedHtml(): string
    {
        return $this->embedHtml;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setEmbedHtml(string $embedHtml): void
    {
        $this->embedHtml = $embedHtml;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

}
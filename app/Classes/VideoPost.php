<?php


class VideoPost extends Post
{

    private string $embedHtml = '';
    private string $thumbnail = '';
    private string $url;

    public function __construct()
    {
        parent::__construct();
        $this->setDiscr('video');
    }

    public function getEmbedHtml(): string
    {
        return $this->embedHtml;
    }

    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setEmbedHtml(string $embedHtml): void
    {
        $this->embedHtml = $embedHtml;
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
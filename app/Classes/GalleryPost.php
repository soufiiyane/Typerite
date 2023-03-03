<?php

class GalleryPost extends Post
{

    /**
     * @var array[GalleryPostMedia]
     */
    private array $media;

    public function __construct()
    {
        parent::__construct();
    }

    public function getMedia(): array
    {
        return $this->media;
    }

    public function setMedia(array $media): void
    {
        $this->media = $media;
    }

}
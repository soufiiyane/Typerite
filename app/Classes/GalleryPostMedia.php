<?php

class GalleryPostMedia
{

    private string $imagePath;
    private string $altImage;

    public function __construct()
    {

    }

    public function getImagePath(): string
    {
        return $this->imagePath;
    }

    public function getAltImage(): string
    {
        return $this->altImage;
    }

    public function setImagePath(string $imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    public function setAltImage(string $altImage): void
    {
        $this->altImage = $altImage;
    }

}
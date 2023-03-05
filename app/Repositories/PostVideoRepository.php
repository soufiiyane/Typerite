<?php

require_once 'vendor/autoload.php';
use Embera\Embera;

class PostVideoRepository
{

    private BDConnection $connection;
    private PostRepository $postRepository;

    public function __construct()
    {
        $this->connection = BDConnection::getInstance();
        $this->postRepository = new PostRepository();
    }

    public function getEmbedHtml(string $url): string|bool
    {
        $embera = new Embera();
        $data = $embera->getUrlData($url);
        if (!empty($data)) {
            if ($data[$url]['type'] === 'video' || $data[$url]['type'] === 'rich') {
                return $data[$url]['html'];
            }

            return false;
        }

        return false;

    }

    public function savePost(VideoPost $videoPost): bool
    {
        $this->postRepository->savePost($videoPost);

        return true;
    }

}
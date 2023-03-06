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

    private function getEmbedHtml(string $url): string|bool
    {
        $embera = new Embera();
        $data = $embera->getUrlData([$url]);
        if (!empty($data)) {
            if ($data[$url]['type'] === 'video' || $data[$url]['type'] === 'rich') {

                return $data[$url]['html'];
            }

            return false;
        }

        return false;

    }

    public function saveVideoPost(VideoPost $videoPost): bool
    {

        if ($this->getEmbedHtml($videoPost->getUrl())) {
            if ( $this->postRepository->savePost($videoPost)) {
                $videoPost->setEmbedHtml($this->getEmbedHtml($videoPost->getUrl()));
                $htmlContent = $videoPost->getEmbedHtml();
                $url = $videoPost->getUrl();
                $postId = $this->connection->getConnection()->lastInsertId();
                $query = $this->connection->getConnection()->prepare(/** @lang text */'insert into video_post(
                post_id,embedHtml,url) values(?,?,?)');
                $query->bindParam(1,$postId);
                $query->bindParam(2,$htmlContent);
                $query->bindParam(3,$url);
                if ($query->execute()) {

                    return true ;
                }

                return false;
            }

            return false;
        }

        return false;
    }

    public function deleteVideoPost(int $post_id): bool
    {
        if ($this->postRepository->deletePost($post_id)) {

            return true;
        }

        return false;
    }

    // Unfinished
    public function findOneBy(array $criteria, array $orderBy = null): ?VideoPost
    {
        $post = $this->postRepository->findOneBy($criteria, $orderBy);
        if ($post) {

            // TO DO
            return true;
        }
        return false;
    }

}
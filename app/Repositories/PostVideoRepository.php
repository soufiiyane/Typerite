<?php

require_once 'vendor/autoload.php';
use Embera\Embera;

class PostVideoRepository
{

    private PDO $db;
    private PostRepository $postRepository;

    public function __construct()
    {
        $this->db = BDConnection::getInstance()->getConnection();
        $this->postRepository = new PostRepository();
    }

    private function getEmbedHtml(string $url): array|bool
    {
        $embera = new Embera();
        $data = $embera->getUrlData([$url]);
        if (!empty($data)) {
            if ($data[$url]['type'] === 'video' || $data[$url]['type'] === 'rich') {

                return $data[$url];
            }

            return false;
        }

        return false;

    }

    public function saveVideoPost(VideoPost $videoPost): bool
    {
        if ($this->getEmbedHtml($videoPost->getUrl())) {
            if ( $this->postRepository->savePost($videoPost)) {
                $url = $videoPost->getUrl();
                $videoData = $this->getEmbedHtml($url);
                $videoPost->setEmbedHtml($videoData['html']);
                $htmlContent = $videoPost->getEmbedHtml();
                $postId = $videoPost->getId();
                $query = $this->db->prepare(/** @lang text */'insert into video_post(
                post_id,embedHtml,thumbnail,url) values(?,?,?,?)');
                $query->bindParam(1,$postId);
                $query->bindParam(2,$htmlContent);
                $query->bindParam(3,$videoData['thumbnail_url']);
                $query->bindParam(4,$url);
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

    public function findById(int $id): ?VideoPost
    {
        $post = $this->postRepository->findById($id);
        if ($post) {
            $query = $this->db->prepare(/** @lang text */ 'select * from video_post where post_id = ?');
            $query->bindParam(1,$post->getId());
            if ($query->execute()) {
                $query = $query->fetchObject();
                $videoPost = new VideoPost();
                $videoPost->setHeadline($post->getHeadline());
                $videoPost->setContent($post->getContent());
                $videoPost->setCategory($post->getCategory());
                $videoPost->setPostType($post->getCategory());
                $videoPost->setAuthor($post->getAuthor());
                $videoPost->setDiscr($post->getDiscr());
                $videoPost->setCreatedAt($post->getCreatedAt());
                $videoPost->setId($query->id);
                $videoPost->setUrl($query->url);
                $videoPost->setEmbedHtml($query->embedHtml);
                $videoPost->setThumbnail($query->thumbnail);

                return $videoPost;
            }

            return null;
        }

        return null;
    }

}
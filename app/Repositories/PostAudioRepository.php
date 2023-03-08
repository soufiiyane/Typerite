<?php

require_once 'vendor/autoload.php';
use MediaEmbed\MediaEmbed;

class PostAudioRepository
{
    private PDO $db;
    private PostRepository $postRepository;

    public function __construct()
    {
        $this->db = BDConnection::getInstance()->getConnection();
        $this->postRepository = new PostRepository();
    }

    private function isSoundCloud(string $url): bool
    {
        if(str_contains($url, "soundcloud")){

            return true;
        }

        return false;
    }

    private function is_url_valid($url): bool {

        // Removing whiteSpaces
        $url = trim($url);

        // getting the HTTP Headers
        $headers = get_headers($url);

        // Checking if the headers contain a status code
        if ($headers && isset($headers[0])) {
            $status_code = intval(substr($headers[0], 9, 3));

            // Check if the status code indicates success
            if ($status_code >= 200 && $status_code < 300) {
                return true;
            }
        }

        return false;
    }

    private function getEmbedHtml(string $url): bool|string
    {
        if ($this->is_url_valid($url)) {
            if ($this->isSoundCloud($url)) {
                $media = new MediaEmbed();

                return $media->parseUrl($url)->getEmbedCode();
            }
        }

        return false;
    }

    public function saveAudioPost(AudioPost $audioPost): bool
    {
        if ($this->getEmbedHtml($audioPost->getUrl())) {
            if ( $this->postRepository->savePost($audioPost) ) {
                $url = $audioPost->getUrl();
                $audioPost->setEmbedHtml($this->getEmbedHtml($audioPost->getUrl()));
                $htmlContent = $audioPost->getEmbedHtml();
                $postId = $audioPost->getId();
                $thumbnail = $audioPost->getThumbnail();
                $query = $this->db->prepare(/** @lang text */'insert into audio_post(
                post_id,embedHtml,url,thumbnail) values(?,?,?,?)');
                $query->bindParam(1,$postId);
                $query->bindParam(2,$htmlContent);
                $query->bindParam(3,$url);
                $query->bindParam(4,$thumbnail);
                if ($query->execute()) {

                    return true ;
                }

                return false;
            }

            return false;
        }

        return false;
    }

    public function deleteAudioPost(int $postId): bool
    {
        if ($this->postRepository->deletePost($postId)) {

            return true;
        }

        return false;
    }

    public function findById(int $id): ?AudioPost
    {
        $post = $this->postRepository->findById($id);
        if ($post) {
            $query = $this->db->prepare(/** @lang text */ 'select * from audio_post where post_id = ?');
            $id1 = $post->getId();
            $query->bindParam(1, $id1);
            if ($query->execute()) {
                $query = $query->fetchObject();
                $audioPost = new AudioPost();
                $audioPost->setHeadline($post->getHeadline());
                $audioPost->setContent($post->getContent());
                $audioPost->setCategory($post->getCategory());
                $audioPost->setPostType($post->getCategory());
                $audioPost->setAuthor($post->getAuthor());
                $audioPost->setDiscr($post->getDiscr());
                $audioPost->setCreatedAt($post->getCreatedAt());
                $audioPost->setId($query->id);
                $audioPost->setUrl($query->url);
                $audioPost->setEmbedHtml($query->embedHtml);
                $audioPost->setThumbnail($query->thumbnail);

                return $audioPost;
            }

            return null;
        }

        return null;
    }
}
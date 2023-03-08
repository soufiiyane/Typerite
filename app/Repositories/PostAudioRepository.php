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

    function is_url_valid($url): bool {

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

    public function getEmbedHtml(string $url): bool|string
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
                $query = $this->db->prepare(/** @lang text */'insert into audio_post(
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

}
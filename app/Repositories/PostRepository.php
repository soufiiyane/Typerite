<?php

require_once 'app/Contracts/PostInterface.php';

class PostRepository implements PostInterface
{

    private PDO $db;

    public function __construct()
    {
        $this->db = BDConnection::getInstance()->getConnection();
    }

    public function savePost(Post $post): bool
    {
        $query = $this->db->prepare(/** @lang text */ 'insert post(headline,
         content, category_id, post_type_id, user_id, discr, createdat) values(?,?,?,?,?,?,?)');
        $headline = $post->getHeadline();
        $content = $post->getContent();
        $category = $post->getCategory();
        $post_id = $post->getPostType();
        $user = $post->getAuthor();
        $discrimination = $post->getDiscr();
        $createdAt = $post->getCreatedAt();
        $query->bindParam(1,$headline);
        $query->bindParam(2,$content);
        $query->bindParam(3,$category);
        $query->bindParam(4,$post_id);
        $query->bindParam(5,$user);
        $query->bindParam(6,$discrimination);
        $query->bindParam(7,$createdAt);
        if ($query->execute()) {
            $post->setId($this->db->lastInsertId());
            return true;
        }

        return false ;
    }

    public function deletePost(int $id): bool
    {
        $query = $this->db->prepare(/** @lang text */ 'delete from post where id = ?');
        $query->bindParam(1,$id);
        if ($query->execute()) {

            return true;
        }

        return false ;
    }

    public function findById(int $id): ?Post
    {
        $query = $this->db->prepare(/** @lang text */'select * from post where id = ?');
        $query->bindParam(1,$id);
        $query->execute();
        if ($query->rowCount()>0) {
            $query = $query->fetchObject();
            $post = new Post();
            $post->setId($query->id);
            $post->setHeadline($query->headline);
            $post->setContent($query->content);
            $post->setCategory($query->category_id);
            $post->setPostType($query->post_type_id);
            $post->setAuthor($query->user_id);
            $post->setCreatedAt($query->createdat);

            return $post;
        }

        return false;
    }

    public function getAllPosts(): array
    {
        $query = $this->db->prepare(/** @lang text */ 'select
        p.id as postId, p.headline as postHeadline, p.content as postContent, p.category_id as postCategoryId, 
        p.post_type_id as postTypeId, p.user_id as author, p.discr as discr, p.createdat as createdAt,vp.id as 
        videoId, vp.post_id as videoPostId, vp.embedHtml as videoEmbedHtml, vp.thumbnail as videoThumbnail,
        vp.url as videoUrl,gp.id as galleryId, gp.post_id as galleryPostId,ap.id as audioId,
        ap.post_id as audioPostId, ap.url as audioUrl, ap.embedHtml as audioEmbedHtml, ap.thumbnail as audioThumbnail
        from post p left join video_post vp on p.id = vp.post_id left join gallery_post gp on p.id = gp.post_id
        left join audio_post ap on p.id = ap.post_id order by p.id desc');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}
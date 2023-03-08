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

        return null;
    }

    public function getAllPosts(): array
    {
        $query = $this->db->prepare(/** @lang text */ 'select * from post');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}
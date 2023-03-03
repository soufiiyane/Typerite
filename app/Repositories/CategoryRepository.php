<?php

require_once 'app/Contracts/CategoryInterface.php';

class CategoryRepository implements  CategoryInterface
{

    private BDConnection $connection;

    public function __construct()
    {
        $this->connection = BDConnection::getInstance();
    }

    public function getAll(): array
    {
        $query = $this->connection->getConnection()->prepare(/** @lang text */ 'select * from category');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save(string $name): void
    {
        $query = $this->connection->getConnection()->prepare(/** @lang text */ 'insert into category(name) 
        values(?)');
        $query->bindParam(1,$name);
        $query->execute();
    }

    public function delete(int $id): void
    {
        $query = $this->connection->getConnection()->prepare(/** @lang text */ 'delete from category where id = 
        ?');
        $query->bindParam(1,$id);
        $query->execute();
    }

    public function getCategoryPosts(int $id): array
    {
        $query = $this->connection->getConnection()->prepare(/** @lang text */ 'select  * from post p left join 
         audio_post ap on p.id = ap.post_id left join video_post vp on p.id = vp.post_id left join 
         gallery_post gp on p.id = gp.post_id left join gallery_post_media gpm on gp.id = gpm.gallery_post_id 
         where p.category_id = ?');
        $query->bindParam(1,$id);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}
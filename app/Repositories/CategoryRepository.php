<?php

require_once 'app/Contracts/CategoryInterface.php';

class CategoryRepository implements  CategoryInterface
{

    private PDO $db;

    public function __construct()
    {
        $this->db = BDConnection::getInstance()->getConnection();
    }

    public function getAll(): array
    {
        $query = $this->db->prepare(/** @lang text */ 'select * from category');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save(string $name): bool
    {
        $query = $this->db->prepare(/** @lang text */ 'insert into category(name) 
        values(?)');
        $query->bindParam(1,$name);
        if ($query->execute()) {

            return true;
        }

        return false;
    }

    public function delete(int $id): bool
    {
        $query = $this->db->prepare(/** @lang text */ 'delete from category where id = 
        ?');
        $query->bindParam(1,$id);
        if ($query->execute()) {

            return true;
        }

        return false;
    }

    public function getCategoryPosts(int $id): array
    {
        $query = $this->db->prepare(/** @lang text */ 'select  * from post p inner join video_post vp 
        on p.id = vp.post_id where p.category_id = ?');
        $query->bindParam(1,$id);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}
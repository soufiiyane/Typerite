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
        $query = $this->db->prepare(/** @lang text */ 'select
        p.id as postId, p.headline as postHeadline, p.content as postContent, p.category_id as postCategoryId, 
        p.post_type_id as postTypeId, p.user_id as author, p.discr as discr, p.createdat as createdAt,vp.id as 
        videoId, vp.post_id as videoPostId, vp.embedHtml as videoEmbedHtml, vp.thumbnail as videoThumbnail,
        vp.url as videoUrl,gp.id as galleryId, gp.post_id as galleryPostId,ap.id as audioId,
        ap.post_id as audioPostId, ap.url as audioUrl, ap.embedHtml as audioEmbedHtml, ap.thumbnail as audioThumbnail
        from post p left join video_post vp on p.id = vp.post_id left join gallery_post gp on p.id = gp.post_id
        left join audio_post ap on p.id = ap.post_id where p.category_id = ?');
        $query->bindParam(1,$id);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGalleries(int $id): string
    {
        $query = $this->db->prepare(/** @lang text */'select gpm.alt_text as galleryAltText, gpm.imagepath as 
        galleryImage from gallery_post gp inner join gallery_post_media gpm on gp.id = gpm.gallery_post_id
        where gpm.gallery_post_id = ?');
        $query->bindParam(1,$id);
        $query->execute();
        $galleries= $query->fetchAll(PDO::FETCH_ASSOC);
        $html = '';
        foreach ($galleries as $gallery){
            $html .= '
                <div class="slider__slide">
                    <img src="'.$gallery["galleryImage"].'" srcset="'.$gallery["galleryImage"].'" 
                    alt="'.$gallery["galleryAltText"].'"> 
                </div>
            ';
        };

        return $html;
    }

}
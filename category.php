<?php

require_once 'includes/header.php';
require_once 'app/Classes/User.php';
require_once 'app/Repositories/UserRepository.php';
require_once 'app/Classes/Post.php';
require_once 'app/Repositories/CategoryRepository.php';
require_once 'app/Classes/VideoPost.php';
require_once 'app/Repositories/PostVideoRepository.php';
require_once 'app/Repositories/PostRepository.php';

    if (isset($_GET["id"])) {
        extract($_GET);
        $category = new CategoryRepository();
        $posts = $category->getCategoryPosts($id);
        $categoryObject = $category->findOneById($id);
    }

?>

<div class="s-content">

    <header class="listing-header">
        <h1 class="h2">Category: <?php echo $categoryObject->name ?></h1>
    </header>

    <div class="masonry-wrap">
        <div class="masonry">
            <div class="grid-sizer"></div>

            <?php
            foreach ( $posts as $data)
            {
                if ($data['discr']==='video') {
                    ?>
                    <article class="masonry__brick entry format-video animate-this">
                        <div class="entry__thumb video-image">
                            <a href="<?php echo $data["videoUrl"] ?>" data-lity class="entry__thumb-link">
                                <img src="<?php echo $data["videoThumbnail"] ?>"
                                     srcset="<?php echo $data["videoThumbnail"] ?>">
                            </a>
                        </div>
                        <div class="entry__text">
                            <div class="entry__header">
                                <h2 class="entry__title"><a href="#"><?php echo $data["postHeadline"] ?></a></h2>
                                <div class="entry__meta">
                                        <span class="entry__meta-date">
                                            <a href="#"><?php echo $data["createdAt"] ?></a>
                                        </span>
                                </div>
                            </div>
                            <div class="entry__excerpt">
                                <p>
                                    <?php echo substr($data["postContent"],0,150) ?>
                                </p>
                            </div>
                        </div>
                    </article>

                    <?php
                }
                elseif ($data['discr']=='gallery') {
                    ?>
                    <article class="masonry__brick entry format-gallery animate-this">
                        <div class="entry__thumb slider">
                            <div class="slider__slides">
                                <?php echo $category->getGalleries($data["galleryId"]) ?>
                            </div>
                        </div>
                        <div class="entry__text">
                            <div class="entry__header">
                                <h2 class="entry__title"><a href="#"><?php echo $data["postHeadline"] ?></a></h2>
                                <div class="entry__meta">
                                        <span class="entry__meta-date">
                                            <a href="#"><?php echo $data["createdAt"] ?></a>
                                        </span>
                                </div>
                            </div>
                            <div class="entry__excerpt">
                                <p>
                                    '<?php echo substr($data["postContent"],0,150) ?>
                                </p>
                            </div>
                        </div>
                    </article>
                    <?php
                }
                elseif ($data["discr"]==="audio"){
                    ?>
                    <article class="masonry__brick entry format-audio animate-this">
                        <div class="entry__thumb">
                            <a href="#" class="entry__thumb-link">
                                <img src="<?php echo $data["audioThumbnail"] ?>"
                                     srcset="<?php echo $data["audioThumbnail"] ?>" alt="">
                            </a>
                        </div>
                        <div class="entry__text">
                            <div class="entry__header">
                                <h2 class="entry__title"><a href="#"><?php echo $data["postHeadline"] ?></a></h2>
                                <div class="entry__meta">
                                        <span class="entry__meta-date">
                                            <a href="#"><?php echo $data["createdAt"] ?></a>
                                        </span>
                                </div>
                            </div>
                            <div class="entry__excerpt">
                                <p>
                                    <?php echo substr($data["postContent"],0,150) ?>
                                </p>
                            </div>
                        </div>
                    </article>
                    <?php
                }
            }
            ?>

        </div>
    </div>
<?php
    require_once 'includes/footer.php'; ?>



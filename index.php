<?php
require_once 'includes/header.php';
require_once 'app/Classes/User.php';
require_once 'app/Repositories/UserRepository.php';
require_once 'app/Classes/Post.php';
require_once 'app/Repositories/CategoryRepository.php';
require_once 'app/Classes/VideoPost.php';
require_once 'app/Repositories/PostVideoRepository.php';

$category = new CategoryRepository();
$posts= $category->getCategoryPosts(1);
?>

<div class="s-content">

    <header class="listing-header">
        <h1 class="h2">Category: Music</h1>
    </header>

    <div class="masonry-wrap">
        <div class="masonry">
            <div class="grid-sizer"></div>

            <?php
                foreach ( $posts as $data)
                {
                    echo  '
                        <article class="masonry__brick entry format-video animate-this">
                            <div class="entry__thumb video-image">
                                <a href="'.$data["url"].'" data-lity class="entry__thumb-link">
                                    <img src="'.$data["thumbnail"].'" srcset="'.$data["thumbnail"].'" alt="">
                                </a>
                            </div>
                            <div class="entry__text">
                                <div class="entry__header">
                                    <h2 class="entry__title"><a href="#">'.$data["headline"].'</a></h2>
                                    <div class="entry__meta">
                                        <span class="entry__meta-date">
                                            <a href="#">'.$data["createdat"].'</a>
                                        </span>
                                    </div>
                                </div>
                                <div class="entry__excerpt">
                                    <p>
                                        '.substr($data["content"],0,150).'
                                    </p>
                                </div>
                            </div>
                        </article>
                    ';
                }
            ?>
            
        </div>
    </div>
            <?php
require_once 'includes/footer.php'; ?>



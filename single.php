<?php

require_once 'includes/header.php';
require_once 'app/Classes/User.php';
require_once 'app/Classes/Post.php';
require_once 'app/Classes/AudioPost.php';
require_once 'app/Classes/VideoPost.php';

require_once 'app/Repositories/UserRepository.php';
require_once 'app/Repositories/PostRepository.php';
require_once 'app/Repositories/PostVideoRepository.php';
require_once 'app/Repositories/PostAudioRepository.php';

$postRepository = new PostRepository();
$userRepository = new UserRepository();
$categoryRepository = new CategoryRepository();
$post = $postRepository->findById($_GET["id"]);
$category = $categoryRepository->findOneById($post->getCategory());
?>
<div class="s-content content">
    <main class="row content__page">
        <?php
            if ($post) {
                $audioRepository = new PostAudioRepository();
                $audio = $audioRepository->findById($_GET["id"]);
            ?>
                <article class="column large-full entry format-audio">
                    <div class="media-wrap entry__media">
                        <?php echo $audio->getEmbedHtml(); ?>
                    </div>
                    <div class="content__page-header entry__header">
                        <h1 class="display-1 entry__title"><?php echo $audio->getHeadline(); ?></h1>
                        <ul class="entry__header-meta">
                            <li class="author">By
                                <a href="#0"><?php echo $userRepository->getUserName($post->getAuthor()) ?></a>
                            </li>
                            <li class="date"><?php echo $post->getCreatedAt(); ?></li>
                            <li class="cat-links">
                                <a href="#0"><?php echo $category->name ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="entry__content">
                        <p class="lead drop-cap">
                            <?php echo $audio->getContent(); ?>
                        </p>
                    </div>
                    <div class="entry__related">
                        <h3 class="h2">Related Articles</h3>
                        <ul class="related">
                            <li class="related__item">
                                <a href="single-standard.html" class="related__link">
                                    <img src="images/thumbs/masonry/walk-600.jpg" alt="">
                                </a>
                                <h5 class="related__post-title">Using Repetition and Patterns in Photography.</h5>
                            </li>
                            <li class="related__item">
                                <a href="single-standard.html" class="related__link">
                                    <img src="images/thumbs/masonry/dew-600.jpg" alt="">
                                </a>
                                <h5 class="related__post-title">Health Benefits Of Morning Dew.</h5>
                            </li>
                            <li class="related__item">
                                <a href="single-standard.html" class="related__link">
                                    <img src="images/thumbs/masonry/rucksack-600.jpg" alt="">
                                </a>
                                <h5 class="related__post-title">The Art Of Visual Storytelling.</h5>
                            </li>
                        </ul>
                    </div>
                </article>
        <?php
            }
        ?>
    </main>
</div>
<?php
require_once 'includes/footer.php'; ?>

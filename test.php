<?php
require_once 'app/Classes/Post.php';
require_once 'app/Classes/BDConnection.php';
require_once 'app/Repositories/PostRepository.php';
require_once 'app/Classes/AudioPost.php';
require_once 'app/Repositories/PostAudioRepository.php';

$audio = new PostAudioRepository();
$post = new AudioPost();
$post->setHeadline('Shiloh dynast');
$post->setContent('As of 2020, it is generally agreed upon that Shiloh will not be returning to the public eye, posting on Instagram or releasing official music ever again, but all public info about Shiloh Dynasty can be found in the new Shiloh Dynasty Discord Server or on the Shiloh Dynasty Mega Discussion Thread run and consistently');
$post->setAuthor(1);
$post->setPostType(1);
$post->setCategory(1);
$post->setUrl('https://soundcloud.com/shilohsdynasty/hesitations?utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing');
var_dump($audio->saveAudioPost($post));
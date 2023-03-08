<?php
require_once 'app/Classes/Post.php';
require_once 'app/Classes/BDConnection.php';
require_once 'app/Repositories/PostRepository.php';
require_once 'app/Classes/AudioPost.php';
require_once 'app/Repositories/PostAudioRepository.php';

require_once 'vendor/autoload.php';
use MediaEmbed\MediaEmbed;

$media = new MediaEmbed();
var_dump($media->parseUrl('https://soundcloud.com/shilohsdynasty/hesitations?utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing'));
<?php
session_start();

require_once 'app/Repositories/UserRepository.php';
require_once 'app/Classes/Post.php';
require_once 'app/Services/UserService.php';
require_once 'app/Security/Authenticator.php';
require_once 'app/Classes/Authenticate.php';
require_once 'app/Repositories/PostRepository.php';
?>

<?php
    $post = new PostRepository();
    if($post->findOneBy(['id'=>8])){
        echo "yes";
    }
    else{
        echo "n";
    }
?>



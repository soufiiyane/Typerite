<?php
require_once 'app/Classes/BDConnection.php';
require_once 'app/Classes/Category.php';
require_once 'app/Repositories/CategoryRepository.php';

$categoryRepository = new CategoryRepository();
$categories = $categoryRepository->getAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Typerite</title>

    <link rel="stylesheet" href="includes/css/base.css">
    <link rel="stylesheet" href="includes/css/vendor.css">
    <link rel="stylesheet" href="includes/css/main.css">

    <link rel="apple-touch-icon" sizes="180x180" href="icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="icons/favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">

</head>
<body>
<header class="s-header">

<div class="header__top">
    <div class="header__logo">
        <a class="site-logo" href="#">
            <img src="uploads/typeriteImages/logo.svg" draggable="false" alt="Logo">
        </a>
    </div>

    <div class="header__search">

        <form role="search" method="get" class="header__search-form" action="#">
            <label>
                <span class="hide-content">Search for:</span>
                <input type="search" class="header__search-field" placeholder="Type Keywords" value="" name="s" title="Search for:" autocomplete="off">
            </label>
            <input type="submit" class="header__search-submit" value="Search">
        </form>

        <a href="#" title="Close Search" class="header__search-close">Close</a>

    </div>  <!-- end header__search -->

    <!-- toggles -->
    <a href="#" class="header__search-trigger"></a>
    <a href="#" class="header__menu-toggle"><span>Menu</span></a>

</div> <!-- end header__top -->

<nav class="header__nav-wrap">

    <ul class="header__nav">
        <li class="current"><a href="#" title="">Home</a></li>
        <li class="has-children">
            <a href="#" title="">Categories</a>
            <ul class="sub-menu">
                <?php
                    foreach ($categories as $category){
                     ?>
                        <li>
                            <a href="category.php?id=<?php echo $category["id"]?>"><?php echo $category["name"]?></a>
                        </li>
                     <?php
                    }
                ?>
            </ul>
        </li>
        <li><a href="#" title="">About</a></li>
        <li><a href="#" title="">Contact</a></li>
    </ul> <!-- end header__nav -->

    <ul class="header__social">
        <li class="ss-facebook">
            <a href="https://facebook.com/">
                <span class="screen-reader-text">Facebook</span>
            </a>
        </li>
        <li class="ss-twitter">
            <a href="#">
                <span class="screen-reader-text">Twitter</span>
            </a>
        </li>
        <li class="ss-dribbble">
            <a href="#">
                <span class="screen-reader-text">Dribbble</span>
            </a>
        </li>
        <li class="ss-pinterest">
            <a href="#">
                <span class="screen-reader-text">Behance</span>
            </a>
        </li>
    </ul>

</nav> <!-- end header__nav-wrap -->
</header>
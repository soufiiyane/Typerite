<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Typerite</title>

    <link rel="stylesheet" href="includes/template/css/base.css">
    <link rel="stylesheet" href="includes/template/css/vendor.css">
    <link rel="stylesheet" href="includes/template/css/main.css">

    <link rel="apple-touch-icon" sizes="180x180" href="includes/template/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="includes/template/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="includes/template/favicon-16x16.png">
    <link rel="manifest" href="includes/template/site.webmanifest">

</head>
<body>
<header class="s-header">

<div class="header__top">
    <div class="header__logo">
        <a class="site-logo" href="index.html">
            <img src="includes/template/images/logo.svg" draggable="false" alt="Logo">
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

        <a href="#0" title="Close Search" class="header__search-close">Close</a>

    </div>  <!-- end header__search -->

    <!-- toggles -->
    <a href="#0" class="header__search-trigger"></a>
    <a href="#0" class="header__menu-toggle"><span>Menu</span></a>

</div> <!-- end header__top -->

<nav class="header__nav-wrap">

    <ul class="header__nav">
        <li class="current"><a href="index.html" title="">Home</a></li>
        <li class="has-children">
            <a href="#0" title="">Categories</a>
            <ul class="sub-menu">
            <li><a href="category.html">Lifestyle</a></li>
            <li><a href="category.html">Health</a></li>
            <li><a href="category.html">Family</a></li>
            <li><a href="category.html">Management</a></li>
            <li><a href="category.html">Travel</a></li>
            <li><a href="category.html">Work</a></li>
            </ul>
        </li>
        <li class="has-children">
            <a href="#0" title="">Blog Posts</a>
            <ul class="sub-menu">
            <li><a href="single-video.html">Video Post</a></li>
            <li><a href="single-audio.html">Audio Post</a></li>
            <li><a href="single-gallery.html">Gallery Post</a></li>
            <li><a href="single-standard.html">Standard Post</a></li>
            </ul>
        </li>
        <li><a href="page-about.html" title="">About</a></li>
        <li><a href="page-contact.html" title="">Contact</a></li>
    </ul> <!-- end header__nav -->

    <ul class="header__social">
        <li class="ss-facebook">
            <a href="https://facebook.com/">
                <span class="screen-reader-text">Facebook</span>
            </a>
        </li>
        <li class="ss-twitter">
            <a href="#0">
                <span class="screen-reader-text">Twitter</span>
            </a>
        </li>
        <li class="ss-dribbble">
            <a href="#0">
                <span class="screen-reader-text">Dribbble</span>
            </a>
        </li>
        <li class="ss-pinterest">
            <a href="#0">
                <span class="screen-reader-text">Behance</span>
            </a>
        </li>
    </ul>

</nav> <!-- end header__nav-wrap -->
</header>
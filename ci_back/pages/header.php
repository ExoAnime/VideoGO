<!DOCTYPE html>
<!--
Project's Name: VideoGO
Description: Script con la finalidad para implementar un sitio web de pliculas, series y anime online
Programming Languages: PHP, JavaScript, HTML, CSS
Programmer: Jose Luis Coyotzi Ipatzi
File Created: 12-jul-2017, 17:13:22
File Name: header.php
Email: jlci811122@gmail.com

Copyright @2017 xlfederalelk0lx.
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?= @$site->title ?> - <?= @$site->slogan ?></title>

        <meta name="identifier-url" content="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ?>" />
        <meta name="Title" content="<?= @$site->title ?>" />
        <meta name="Description" content="<?= @$site->c_description ?>" />
        <meta name="Keywords" content="<?= @$site->c_seo ?>" />
        <meta name="Abstract" content="<?= @$site->c_description ?>" />
        <meta name="Author" content="xlFederalElk0lx" />
        <meta name="Designer" content="xlFederalElk0lx">
        <meta name="Rating" content="General" />
        <meta name="revisit-after" content="2 days">
        <meta name="Language" content="ES" />
        <meta name="Copyright" content="©2017 xlFederalElk0lx" />
        <meta name="Robots" content="All" />
        <meta name="googlebot" content="index, follow" />
        <meta http-equiv="content-language" content="ES" />
        <meta name="Distribution" content="Global" />

        <!-- Schema.org for Google -->
        <meta itemprop="name" content="<?= @$site->title ?>">
        <meta itemprop="description" content="Descripcion">
        <meta itemprop="image" content="http://www.pelispedia.tv/cdn/img/pelispedia.jpg">
        <!-- Twitter -->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="<?= @$site->title ?>">
        <meta name="twitter:description" content="<?= @$site->c_description ?>">
        <meta name="twitter:site" content="@<?= @$site->c_name ?>">
        <meta name="twitter:creator" content="@JLCI811122">
        <meta name="twitter:image:src" content="">
        <!-- Open Graph general (Facebook, Pinterest & Google+) -->
        <meta name="og:title" content="<?= @$site->title ?>">
        <meta name="og:description" content="<?= @$site->c_description ?>">
        <meta name="og:image" content="">
        <meta name="og:url" content="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ?>">
        <meta name="og:site_name" content="<?= @$site->c_name ?>">
        <meta name="og:locale" content="es_ES">
        <meta name="og:type" content="website">

        <link href="<?= @$site->url ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?= @$site->url ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="<?= @$site->url ?>/vendors/nprogress/nprogress.css" rel="stylesheet" />
        <link href="<?= @$site->url ?>/vendors/animate.css/animate.min.css" rel="stylesheet" />
        <link href="<?= @$site->url ?>/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
        <link href="<?= @$site->url ?>/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
        <link href="<?= @$site->url ?>/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
        <link href="<?= @$site->url ?>/vendors/build/css/custom.min.css" rel="stylesheet" />

    </head>
    <body class="<?= (@$vg_user == '') ? "login" : "nav-md" ?>">

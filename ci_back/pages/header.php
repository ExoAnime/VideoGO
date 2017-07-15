<?= doctype('html4-trans') ?>

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
        <?php
        $metas = array(
            array("name" => "Content-Type", "content" => "text/html; charset=UTF-8", "type" => "equiv"),
            array("name" => "X-UA-Compatible", "content" => "IE=edge", "type" => "equiv"),
            array("name" => "content-language", "content" => "ES", "type" => "equiv"),
            array("name" => "viewport", "content" => "width=device-width, initial-scale=1"),
            array("name" => "Title", "content" => @$site->title),
            array("name" => "Description", "content" => @$site->c_description),
            array("name" => "Keywords", "content" => @$site->c_seo),
            array("name" => "Abstract", "content" => @$site->c_description),
            array("name" => "Author", "content" => "xlFederalElk0lx"),
            array("name" => "Designer", "content" => "xlFederalElk0lx"),
            array("name" => "Rating", "content" => "General"),
            array("name" => "revisit-after", "content" => "2 days"),
            array("name" => "Language", "content" => "ES"),
            array("name" => "Copyright", "content" => "©2017 xlFederalElk0lx"),
            array("name" => "Robots", "content" => "ALL"),
            array("name" => "googlebot", "content" => "index, follow"),
            array("name" => "Distribution", "content" => "Global"),
            array("name" => "twitter:card", "content" => "summary"),
            array("name" => "twitter:title", "content" => @$site->title),
            array("name" => "twitter:description", "content" => @$site->c_description),
            array("name" => "twitter:site", "content" => "@" . @$site->c_name),
            array("name" => "twitter:creator", "content" => "@JLCI811122"),
            array("name" => "twitter:image:src", "content" => ""),
            array("name" => "og:title", "content" => @$site->title),
            array("name" => "og:description", "content" => @$site->c_description),
            array("name" => "og:image", "content" => ""),
            array("name" => "og:url", "content" => $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']),
            array("name" => "og:site_name", "content" => @$site->c_name),
            array("name" => "og:locale", "content" => "es_ES"),
            array("name" => "og:type", "content" => "website"),
            array("name" => "identifier-url", "content" => $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'])
        );
        echo str_replace("<meta", "\t\t<meta", meta($metas));
        ?>
        <meta itemprop="name" content="<?= @$site->title ?>">
        <meta itemprop="description" content="Descripcion">
        <meta itemprop="image" content="http://www.pelispedia.tv/cdn/img/pelispedia.jpg">
        <title><?= @$site->title ?> - <?= @$site->slogan ?></title>
        <?php
        $css_files = array("/vendors/bootstrap/dist/css/bootstrap.min.css", "/vendors/font-awesome/css/font-awesome.min.css", "/vendors/nprogress/nprogress.css", "/vendors/animate.css/animate.min.css", "/vendors/pnotify/dist/pnotify.css", "/vendors/pnotify/dist/pnotify.buttons.css", "/vendors/pnotify/dist/pnotify.nonblock.css", "/vendors/build/css/custom.min.css",);
        for ($i = 0; $i < sizeof($css_files); $i++) {
            if ($i > 0)
                echo "\t\t";
            echo link_tag(@$site->url . $css_files[$i]);
        }
        ?>
    </head>
    <body class="<?= (@$vg_user == '') ? "login" : "nav-md" ?>">

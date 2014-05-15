<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $title ?></title>
        <meta name="robots" content="noindex, nofollow">
        <meta name="keywords" content="<?php if (isset($keywords)) echo $keywords ?>">
        <meta name="description" content="<?php if (isset($description)) echo $description ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="<?php echo base_url() ?>css/main.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!--[if gte IE 9]>
        <style type="text/css">
          .gradient {
             filter: none;
          }
        </style>
        <![endif]-->
        <div class="container">
            <header>
                <h1 class="logo"><a href="<?php echo base_url() ?>">La Ruta del Gin Tonic</a></h1>
                <div class="search">
                    <form action="<?php echo base_url('search/search_keyword');?>" method = "post">
                        <input class="search-input" type="text" name="keyword">
                        <button type="submit"><span class="glyphicon glyphicon-search"</span></button>
                    </form>
                </div>
                <nav class="menu secondary">
                    <a href="<?php echo base_url() ?>quienes-somos">Quienes somos</a>
                    <a href="<?php echo base_url() ?>contacto">Contacto</a>
                </nav>
                <h2 class="description">Mucho más que rutas</h2>
            </header>    
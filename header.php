<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">     
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Sacramento&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Hentaigana:wght@200..900&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="logo-container">
        <a href="<?php echo home_url(); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo" class="logo">
        </a>
    </div>

    <div class="menu-toggle" id="mobile-menu">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>

    <nav class="main-navigation">
        <?php
        if ( has_nav_menu('header-menu') ) {
            wp_nav_menu(array(
                'theme_location' => 'header-menu',
                'menu_class'     => 'nav-menu',
                'container'      => false
            ));
        } else {
            echo '<ul class="nav-menu"><li><a href="#">Asigna un Menú desde el Personalizador</a></li></ul>';
        }
        ?>
    </nav>
</header>

<div id="content" class="site-content">

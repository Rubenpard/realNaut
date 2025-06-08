<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="Navbar">
    <nav>
        <?php
        wp_nav_menu([
            'theme_location' => 'main_menu',
            'container' => false,
            'menu_class' => 'main-menu',
        ]);
        ?>
    </nav>
</header>

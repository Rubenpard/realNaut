<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo esc_html(get_bloginfo('name')); ?><?php if (is_single() || is_page()) { echo ' | ' . get_the_title(); } ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="header" style="background-color: <?php echo esc_attr(get_theme_mod('headerrealnaut_bg_color', '#000')); ?>;">
    <div class="header__container">
        <div class="header__left">
            <div class="header__logo">
                <a href="<?php echo home_url(); ?>">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <span class="header__logo-text"><?php bloginfo('name'); ?></span>
                    <?php endif; ?>
                </a>
            </div>

            <nav class="header__menu header__mobile-menu" role="navigation" aria-label="Main Menu">
                <button type="button" class="header__burger" id="burger" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle menu">
                    ☰
                </button>

                <?php
                wp_nav_menu([
                    'theme_location' => 'main_menu',
                    'container' => false,
                    'menu_class' => 'header__menu-list header__menu-list--main',
                    'items_wrap' => '<ul id="primary-menu" class="%2$s">%3$s</ul>',
                    'walker' => new Walker_Nav_Menu_BEM()
                ]);
                ?>
            </nav>
        </div>

        <div class="header__right">
            <nav class="header__menu" role="navigation" aria-label="User Menu">
                <?php
                wp_nav_menu([
                    'theme_location' => 'us_menu',
                    'container' => false,
                    'menu_class' => 'header__menu-list header__menu-list--main',
                    'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                    'walker' => new Walker_Nav_Menu_BEM(),
                ]);
                ?>
            </nav>

            <div class="header__unir">
                <span>By</span>
                <?php
                $unir_img = get_theme_mod('headerrealnaut_unir_image');
                if ($unir_img) : ?>
                    <img src="<?php echo esc_url($unir_img); ?>" alt="Universidad Internacional de La Rioja" class="header__unir-logo">
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<?php
require_once get_template_directory() . '/class-walker-nav-menu-bem.php';

add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('main-style', get_stylesheet_uri());
});

function headerrealnaut_enqueue_assets() {
    wp_enqueue_style('headerrealnaut-style', get_template_directory_uri() . '/style.css', [], '1.0');
    wp_enqueue_script('headerrealnaut-script', get_template_directory_uri() . '/assets/js/main.js', [], '1.0', true);
}
add_action('wp_enqueue_scripts', 'headerrealnaut_enqueue_assets');

function headerrealnaut_theme_setup() {
    register_nav_menus([
        'main_menu' => __('Menú principal', 'headerrealnaut'),
        'us_menu'   => __('Menú US', 'headerrealnaut'), 
    ]);
    add_theme_support('custom-logo', [
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
}
add_action('after_setup_theme', 'headerrealnaut_theme_setup');

function headerrealnaut_customize_register($wp_customize) {
    $wp_customize->add_section('headerrealnaut_unir_section', [
        'title'       => __('Imagen UNIR', 'headerrealnaut'),
        'description' => __('Imagen secundaria', 'headerrealnaut'),
        'priority'    => 30,
    ]);

    $wp_customize->add_setting('headerrealnaut_unir_image');

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'headerrealnaut_unir_image', [
        'label'    => __('Sube imagen UNIR', 'headerrealnaut'),
        'section'  => 'headerrealnaut_unir_section',
        'settings' => 'headerrealnaut_unir_image',
    ]));
}
add_action('customize_register', 'headerrealnaut_customize_register');

<?php
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
    ]);
}
add_action('after_setup_theme', 'headerrealnaut_theme_setup');

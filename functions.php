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
        'us_menu'   => __('Menú US', 'headerrealnaut'), 
    ]);
    add_theme_support('custom-logo', [
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    
    // Añadir soporte para campos ACF en menús
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => 'Configuración del Tema',
            'menu_title' => 'Configuración del Tema',
            'menu_slug'  => 'theme-settings',
            'capability' => 'edit_posts',
            'redirect'   => false
        ]);
    }
}
add_action('after_setup_theme', 'headerrealnaut_theme_setup');

// Registrar campos ACF para los iconos del menú
function headerrealnaut_register_menu_icon_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group([
            'key' => 'group_menu_icons',
            'title' => 'Iconos del Menú',
            'location' => [
                [
                    [
                        'param' => 'nav_menu_item',
                        'operator' => '==',
                        'value' => 'all',
                    ],
                ],
            ],
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'fields' => [
                [
                    'key' => 'field_menu_icon_type',
                    'label' => 'Tipo de ícono',
                    'name' => 'menu_icon_type',
                    'type' => 'radio',
                    'instructions' => 'Selecciona el tipo de ícono que deseas usar',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'choices' => [
                        'fontawesome' => 'Font Awesome',
                        'custom' => 'Imagen personalizada',
                    ],
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'default_value' => 'fontawesome',
                    'layout' => 'horizontal',
                    'return_format' => 'value',
                    'save_other_choice' => 0,
                ],
                [
                    'key' => 'field_menu_fontawesome',
                    'label' => 'Icono Font Awesome',
                    'name' => 'menu_fontawesome',
                    'type' => 'select',
                    'instructions' => 'Selecciona un ícono de Font Awesome',
                    'required' => 0,
                    'conditional_logic' => [
                        [
                            [
                                'field' => 'field_menu_icon_type',
                                'operator' => '==',
                                'value' => 'fontawesome',
                            ],
                        ],
                    ],
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'choices' => [
                        'fas fa-home' => 'Home',
                        'fas fa-user' => 'Usuario',
                        'fas fa-envelope' => 'Email',
                        'fas fa-phone' => 'Teléfono',
                        'fas fa-search' => 'Buscar',
                        'fas fa-shopping-cart' => 'Carrito',
                        'fas fa-bars' => 'Menú',
                        'fas fa-chevron-down' => 'Flecha abajo',
                    ],
                    'default_value' => false,
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'return_format' => 'value',
                    'ajax' => 0,
                    'placeholder' => '',
                ],
                [
                    'key' => 'field_menu_custom_icon',
                    'label' => 'Icono personalizado',
                    'name' => 'menu_custom_icon',
                    'type' => 'image',
                    'instructions' => 'Sube tu propio ícono',
                    'required' => 0,
                    'conditional_logic' => [
                        [
                            [
                                'field' => 'field_menu_icon_type',
                                'operator' => '==',
                                'value' => 'custom',
                            ],
                        ],
                    ],
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'return_format' => 'array',
                    'preview_size' => 'thumbnail',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => '',
                ],
            ],
        ]);
    }
}
add_action('acf/init', 'headerrealnaut_register_menu_icon_fields');

// Mostrar campos ACF en la administración de menús
add_action('wp_nav_menu_item_custom_fields', function($item_id, $item, $depth, $args) {
    // Asegurarnos de que ACF esté cargado
    if (!function_exists('get_field_objects')) return;
    
    // Configurar el post_id correcto para ACF
    $post_id = 'menu_item_' . $item_id;
    
    // Obtener todos los campos para este ítem de menú
    $fields = get_field_objects($post_id);
    
    if ($fields) {
        echo '<div class="acf-menu-item-fields" style="padding: 10px; background: #f9f9f9; margin: 10px 0; border: 1px solid #ddd;">';
        echo '<h4 style="margin-top: 0;">Configuración de Ícono</h4>';
        
        foreach ($fields as $field_name => $field) {
            // Renderizar cada campo ACF
            acf_render_field_wrap($field);
        }
        
        echo '</div>';
    }
}, 10, 4);

// Guardar los valores de los campos ACF
add_action('wp_update_nav_menu_item', function($menu_id, $menu_item_db_id) {
    if (!function_exists('update_field')) return;
    
    // Verificar nonce y permisos (simplificado)
    if (!current_user_can('edit_theme_options')) return;
    
    // Configurar el post_id correcto para ACF
    $post_id = 'menu_item_' . $menu_item_db_id;
    
    // Actualizar campos ACF
    if (isset($_POST['acf'])) {
        foreach ($_POST['acf'] as $field_key => $value) {
            update_field($field_key, $value, $post_id);
        }
    }
}, 10, 2);

// Cargar Font Awesome en el admin también
function enqueue_font_awesome_admin() {
    wp_enqueue_style('font-awesome-admin', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
}
add_action('admin_enqueue_scripts', 'enqueue_font_awesome_admin');

// Cargar estilos para los campos ACF en el admin
function headerrealnaut_admin_styles() {
    echo '<style>
        .acf-menu-item-fields .acf-field {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .acf-menu-item-fields .acf-field:last-child {
            border-bottom: none;
        }
        .acf-menu-item-fields .acf-label label {
            font-weight: 600;
        }
    </style>';
}
add_action('admin_head', 'headerrealnaut_admin_styles');

// Resto de tu código existente...
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

function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');

add_action('after_setup_theme', function() {
    require_once get_template_directory() . '/class-walker-nav-menu-bem.php';
});

add_filter('nav_menu_description', 'wp_kses_post');

function theme_assets() {
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_script('theme-js', get_template_directory_uri() . '/assets/js/main.js', [], false, true);
}
add_action('wp_enqueue_scripts', 'theme_assets');

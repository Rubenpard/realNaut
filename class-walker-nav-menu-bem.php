<?php
class Walker_Nav_Menu_BEM extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'header__menu-item';

        $has_children = in_array('menu-item-has-children', $classes);
        if ($has_children) {
            $classes[] = 'header__menu-item--has-children';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        $output .= '<li' . $class_names .'>' ;

        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target)     ? $item->target     : '';
        $atts['rel']    = !empty($item->xfn)        ? $item->xfn        : '';
        $atts['href']   = !empty($item->url)        ? $item->url        : '';

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);

        $before      = is_object($args) ? $args->before      : ($args['before'] ?? '');
        $link_before = is_object($args) ? $args->link_before : ($args['link_before'] ?? '');
        $link_after  = is_object($args) ? $args->link_after  : ($args['link_after'] ?? '');
        $after       = is_object($args) ? $args->after       : ($args['after'] ?? '');

        $item_output  = $before;

        // Abrimos el div flex container
        $item_output .= '<div class="header__menu-item-inner">';

        // Mostrar imagen de ACF si existe
        $icon = $this->get_menu_item_icon($item);
        if ($icon) {
            $item_output .= $icon . ' ';
        }

        $item_output .= '<a' . $attributes . '>' . $link_before . $title . $link_after . '</a>';

        // Añadimos botón toggle si tiene submenu
        if ($has_children) {
            $item_output .= '<button class="header__submenu-toggle" aria-expanded="false" aria-label="Toggle submenu"></button>';
        }

        // Cerramos el div
        $item_output .= '</div>';

        $item_output .= $after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

protected function get_menu_item_icon($item) {
    if (!function_exists('get_field')) return '';
    $post_id = 'menu_item_' . $item->ID;

    $icon_type = get_field('menu_icon_type', $post_id);

    if ($icon_type === 'fontawesome') {
        $icon_class = get_field('menu_fontawesome', $post_id);
        return $icon_class ? '<i class="' . esc_attr($icon_class) . '"></i>' : '';
    } elseif ($icon_type === 'custom') {
        $icon = get_field('menu_custom_icon', $post_id);
        if ($icon && isset($icon['url'])) {
            return '<img src="' . esc_url($icon['url']) . '" alt="' . esc_attr($icon['alt'] ?? '') . '" class="menu-custom-icon" />';
        }
    }
    return '';
    }

}
?>
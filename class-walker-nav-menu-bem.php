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

        // Aquí abrimos el div flex container
        $item_output .= '<div class="header__menu-item-inner">';

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

}
?>

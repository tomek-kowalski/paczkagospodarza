<?php 
class Custom_Menu_Walker extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)  {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . ' menu-item-info-custom"' : '';

        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $class_names . '>';

        $icon = get_post_meta($item->ID, '_menu_item_icon', true);

        if ($icon) {
            $output .= '<img class="icon-menu-img" src="' . esc_url($icon) . '" alt="Menu Icon">';
        }

        $atts = array();
        $atts['title']  = ! empty( $item->title )   ? $item->title  : '';
        $atts['target'] = ! empty( $item->target )  ? $item->target : '';
        $atts['rel']    = ! empty( $item->xfn )     ? $item->xfn    : '';
        $atts['href']   = ! empty( $item->url )     ? $item->url    : '';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a class="nav__link"' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}



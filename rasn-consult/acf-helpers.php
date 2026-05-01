<?php

/**
 * Populate ACF Select with menus
 */
function acf_load_menu_choices( $field ) {
    
    // reset choices
    $field['choices'] = array();
    
    // get all menus
    $menus = wp_get_nav_menus();
    
    if( $menus ) {
        
        foreach( $menus as $menu ) {
            $field['choices'][ $menu->slug ] = $menu->name;
        }
    }

    return $field;
}

add_filter('acf/load_field/name=header_menu', 'acf_load_menu_choices');
add_filter('acf/load_field/name=right_header_menu', 'acf_load_menu_choices');
add_filter('acf/load_field/name=footer_menu_1', 'acf_load_menu_choices');
add_filter('acf/load_field/name=footer_menu_2', 'acf_load_menu_choices');
add_filter('acf/load_field/name=page_menu', 'acf_load_menu_choices');

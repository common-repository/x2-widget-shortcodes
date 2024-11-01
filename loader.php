<?php
/*
 Plugin Name: X2 Widget ShortCodes
 Plugin URI:  http://themekraft.com/
 Description: X2 Theme Extension - Add Widgets via ShortCodes
 Version: 1.0
 Author: svenl77
 Author URI: http://themekraft.com/members/svenl77/
 Licence: GPLv3
*/

register_sidebars( 5,
    array(
        'name'          => 'shortcode %1$s',
        'id'            => 'shortcode',
        'before_widget' => '<div id="%1$s" class="widget %2$s shortcode_widgetarea">',
        'after_widget'  => '</div><div class="clear"></div>',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>'
    )
);


// [shortcode widget]
add_shortcode('x2_widget', 'x2_shortcode_widget');
function x2_shortcode_widget($atts) {
    extract(shortcode_atts(array(
        'id'  => '',
        'css' => ''
    ), $atts));

    $tmp .= '<style type="text/css">';
    $tmp .= 'div.widget'.$id.'{ width:auto !important; }';
    $tmp .= $css;
    $tmp .= '</style>';

    $tmp .= '<div class="widgetarea cc-widget widget'.$id.' widget">';
    $tmp .= get_dynamic_sidebar( 'shortcode '.$id);
    $tmp .= '</div><div class="clear"></div>';
    return $tmp;

}

function get_dynamic_sidebar($index = 1) {
    $sidebar_contents = "";
    ob_start();
    dynamic_sidebar($index);
    $sidebar_contents = ob_get_contents();
    ob_end_clean();
    return $sidebar_contents;
}
?>
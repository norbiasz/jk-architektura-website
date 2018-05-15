<?php if( !defined('ABSPATH') ) { die('No direct access'); }

require_once get_template_directory() . '/lib/class.base.php';
require_once get_template_directory() . '/lib/class.portfolio.php';

function copyrightyear( $start = 0 ) {
    $now = date('Y');
    if(!$start) { $start = $now; }

    if( $start != $now ) {
        echo $start . '-' . $now;
    } else {
        echo $start;
    }
}

add_filter('style_loader_tag', 'codeless_remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'codeless_remove_type_attr', 10, 2);
function codeless_remove_type_attr($tag, $handle) {
    return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}
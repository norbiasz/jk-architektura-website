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
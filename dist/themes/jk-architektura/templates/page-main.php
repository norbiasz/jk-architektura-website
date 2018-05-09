<?php if( !defined('ABSPATH') ) { die('No direct access'); } ?>
<?php
/**
 * Template name: Strona główna
 */
?>
<?php get_header(); ?>
    
    
    <?php get_template_part('elements/home-slider'); ?>
    <?php get_template_part('elements/home-about-us'); ?>
    <?php get_template_part('elements/home-offer'); ?>

    <?php get_template_part('elements/we-use'); ?>
    <?php get_template_part('elements/home-contact'); ?>



<?php get_footer();
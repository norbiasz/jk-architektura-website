<?php if( !defined('ABSPATH') ) { die('No direct access'); } ?>
<?php
/**
 * Template name: Strona kontakt
 */
?>
<?php get_header(); ?>
    
<div class="page-contact">
    <div class="container">
        <?php get_template_part('elements/title-black'); ?>
        <?php get_template_part('elements/contact-form'); ?>
    </div>
    <?php get_template_part('elements/map'); ?>
</div> 
<?php get_footer();
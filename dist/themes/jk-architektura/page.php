<?php if( !defined('ABSPATH') ) { die('No direct access'); } ?>

<?php get_header(); ?>
    
<div class="page-default">
    <?php get_template_part('elements/title-bg'); ?>
    <div class="container">     
        <?php get_template_part('elements/back-page'); ?>
        <?php get_template_part('elements/content'); ?>
    </div>
</div>

<?php get_footer();
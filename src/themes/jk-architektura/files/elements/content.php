<?php if( !defined('ABSPATH') ) { die('No direct access'); } ?>

<div class="row">
    <div class="col-sm-12">
        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            <div class="page__content">
                <?php the_content(); ?>
            </div>
        <?php endwhile; endif; ?>
    </div>
</div>

<?php if( !defined('ABSPATH') ) { die('No direct access'); } ?>

<div class="home-slider">  
    <?php if( have_rows('slider') ): ?>
    <?php while( have_rows( 'slider' )  ) : the_row(); ?>
    <?php $image = get_sub_field('background'); ?>
        <div id="home-slider__wrap" class="home-slider__wrap">
            <div class="slick-wrapper">
                <div class="home-slider__image" style="background-image: url(<?php echo $image['url']; ?>)">
                </div>
            </div>
            <div class="container home-slider__container">
                <div class="home-slider__prev-slide"></div>
                <div class="home-slider__next-slide"></div>
            </div>
        </div> 
    <?php endwhile; ?>    
    <?php endif; ?>
</div>

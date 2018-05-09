<?php if( !defined('ABSPATH') ) { die('No direct access'); } 
    $about_us = get_field('about_us'); 
    $about_us_link = get_field('about_us_link'); 
?>

<div class="home-about-us">
      
    <div class="container home-about-us__container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title-section">
                    <div class="title-section__wrap title-section--black">
                        <h1><?php _e("O firmie", 'jk-architektura'); ?></h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="home-about-us__content">
                    <?php echo $about_us ?>
                </div>
            </div>
        </div>

        <?php  if($about_us_link) : ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="button--center">
                    <a class="button button--black" href=" <?php echo $about_us_link ?>"><?php _e("czytaj więcej", 'jk-architektura'); ?></a>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>
   
</div>

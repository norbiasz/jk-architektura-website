<?php if( !defined('ABSPATH') ) { die('No direct access'); }
get_header(); ?>

<div class="page-realizations">
    <div class="container">

        <?php get_template_part('elements/back-page'); ?>

        <div class="row">
        <?php 
            if(have_posts()) : $i=0; 
            while(have_posts()) : $i++; the_post(); 
            $gallery_list = get_field('gallery');
            $galleries_count = count($gallery_list);
        ?>      
            <div class="col-md-6 col-lg-4">
                <div class="gallery-box">
                <?php 
                    $images = $gallery_list;
                    if( $images ) :
                    foreach( $images as $key => $image ) :
                    if($key == 0) : 
                ?>
                    <div class="gallery-box__image"style="background-image: url(<?php echo $image['sizes']['medium_large']; ?>)">
                        <a class="gallery-box__hover" href="<?php echo $image['url']; ?>" data-lightbox="image-<?php echo $i; ?>" data-title="<?php echo $image['title']; ?>">
                            <span class="gallery-box--outer"><span class="gallery-box--inner">
                                <span class="icon-search gallery-box__icon"></span>
                            </span></span>
                        </a>
                        <div class="gallery-box__title">
                            <?php the_title(); ?>
                        </div>
                    </div>
                <?php else : ?>
                    <a class="hidden" href="<?php echo $image['url']; ?>" data-lightbox="image-<?php echo $i ?>" data-title="<?php echo $image['title']; ?>"></a> 
                <?php 
                    endif;
                    endforeach; 
                    endif; 
                ?>
                </div>
            </div>
        <?php 
            endwhile; 
            endif; 
        ?>
        </div>

    </div>
</div>

<?php get_footer();
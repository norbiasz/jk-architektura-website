<?php if( !defined('ABSPATH') ) { die('No direct access'); }
get_header(); ?>

<div class="page-realizations">
    <div class="container">
        
        <div class="row">
            <div class="col-sm-12">
                <div class="title-section">
                    <div class="title-section__wrap title-section--black">
                        <?php _e('Projekty', 'jk-architektura'); ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
        <?php 
            $terms = get_terms( array(
                'taxonomy' => 'realizations_cat',
                'hide_empty' => true,
            )); 
            if($terms) :  
            foreach($terms as $key => $term) : 
            $image = get_field('cover_cat', $term);  
        ?>   
            <div class="col-sm-6">
                <div class="offer-box offer-box--page-info">
                    <img class="offer-box__img" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
                    <div class="offer-box__inner">
                        <div class="offer-box__title"><?php echo $term->name ?> </div>
                        <a class="offer-box__link" href="<?php echo get_term_link( $term );  ?>"></a>
                    </div>			
                </div>
            </div>
        <?php 
            endforeach;  
            else :  
            if(have_posts()) : $i=0; 
            while(have_posts()) : 
            $i++; the_post(); 
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
            endif; 
        ?>
        </div>

    </div>
</div>

<?php get_footer();
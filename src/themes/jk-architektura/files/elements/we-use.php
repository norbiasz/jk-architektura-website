<?php if( !defined('ABSPATH') ) { die('No direct access'); } ?>

<div class="we-use">
      
    <div class="container we-use__container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title-section">
                    <div class="title-section__wrap title-section--black">
                        <h2><?php _e("Projektujemy w:", 'jk-architektura'); ?></h2>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="we-use__content">
        <?php if( have_rows('images', 'options') ): ?>
            <div class="row">   
            <?php while( have_rows('images', 'options') ): the_row(); 
                $image = get_sub_field('image', 'options');
            ?>
                <div class="col-sm-4">
                    <div class="we-use__wrap">
                        <img class="we-use___img" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />			
                    </div>
                </div>
            <?php endwhile; ?>
            </div>
        <?php endif; ?>
        </div>
    

    </div>
</div>

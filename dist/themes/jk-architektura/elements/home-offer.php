<?php if( !defined('ABSPATH') ) { die('No direct access'); } 
    $offer_url = get_field('offer-url'); 
?>

<div class="home-offer">
      
    <div class="container home-offer__container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title-section">
                    <div class="title-section__wrap title-section--white">
                        <?php _e("Oferta", 'jk-architektura'); ?>
                    </div>
                </div>
            </div>
        </div>
        
        <?php get_template_part('elements/offer-box'); ?>
        
        <div class="row">
            <div class="col-sm-12">
                <div class="button--center button--offer">
                    <a class="button button--white" href="<?php echo $offer_url ?>"><?php _e("pełna oferta", 'jk-architektura'); ?></a>
                </div>
            </div>
        </div>
      

    </div>
   
</div>

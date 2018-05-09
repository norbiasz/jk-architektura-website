<?php if( !defined('ABSPATH') ) { die('No direct access'); } ?>

<div class="offer__content">
    <?php if( have_rows('catalogs') ): ?>
    <div class="row">   
    <?php while( have_rows('catalogs') ): the_row(); 
        $image = get_sub_field('image');
        $content = get_sub_field('title');
        $link = get_sub_field('url');
    ?>
        <div class="col-md-6">
            <div class="offer-box offer-box--page-offer">
                <img class="offer-box__img" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
                <div class="offer-box__inner">
                    <div class="offer-box__title"><?php echo $content; ?></div>
                    <a class="offer-box__link" href="<?php echo $link; ?>"></a>
                </div>			
            </div>
        </div>
    <?php endwhile; ?>
    </div>
    <?php endif; ?>
</div>
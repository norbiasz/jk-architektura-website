<?php if( !defined('ABSPATH') ) { die('No direct access'); } ?>
<?php 
if( have_rows('map-points') ): ?>
    <div class="acf-map">
        <?php while( have_rows('map-points') ) : the_row(); 
        $location = get_sub_field('map-point'); 
        $icon = get_sub_field('map-icon'); ?>
        <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>" <?php echo $icon ? 'data-icon="'.$icon['url'].'"' : ''; ?>></div>
        <?php endwhile; ?>
    </div>
<?php endif;
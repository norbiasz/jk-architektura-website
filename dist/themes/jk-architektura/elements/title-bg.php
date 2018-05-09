<?php if( !defined('ABSPATH') ) { die('No direct access'); } 
    $title_bg = get_field('title-background'); 
    $title_color = get_field("title-color")
?>

<div class="page__title-background" <?php echo $title_bg ? 'style="background-image: url('.$title_bg['url'].'); "' : ''; ?>>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page__title" <?php echo $title_color ? 'style="color: '. $title_color . ';"' : ''; ?>>
                    <h1><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
    </div>
</div>
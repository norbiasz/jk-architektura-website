<?php if( !defined('ABSPATH') ) { die('No direct access'); } ?>
<!DOCTYPE html>
<html <?php echo language_attributes(); ?>>
<head>
<meta http-equiv="content-type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="google-site-verification" content="yclmnSkTMSQ-JdE8XZhKk3XR44No1dbQV5z_KWHQtxQ" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<title><?php bloginfo('name'); ?></title>
<meta name="description" content="<?php bloginfo('description'); ?>" />
<meta name="format-detection" content="telephone=no" />
<?php wp_head(); ?>
</head>

<body <?php echo body_class(); ?>>

<header class="header">
    <div class="container-fluid header__container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto"> 
                <a id="header__logo" class="header__logo" title="<?php bloginfo('name'); ?>" href="<?php echo home_url(); ?>">
                    <?php $custom_logo = get_theme_mod( 'custom_logo' ); ?>							
                    <?php if($custom_logo) : 
                        $image = wp_get_attachment_image_src( $custom_logo, 'full' ); ?>
                        <img src="<?php echo $image[0]; ?>" alt="<?php bloginfo('name'); ?>" data-rjs="2" class="header__logo-image" >
                    <?php else : ?>
                        <span class="header__logo-text"><?php bloginfo('name'); ?></span>
                    <?php endif; ?>
                </a>
            </div>
		
            <div id="header__toggle-menu" class="header__toggle-menu">
                <div class="header__toggle-icon" >
                    <span class="bar first"></span>
                    <span class="bar middle"></span>
                    <span class="bar last"></span>
                </div>    
            </div>
      
            <div class="col-auto">   
                <?php 
                wp_nav_menu( array(
                        'theme_location'    => 'main-menu',
                        'depth'             => 2,
                        'container'         => 'div',
                        'container_class'   => 'header__wrap-nav',
                        'menu_class'        => 'nav header__nav',
                    )); 
                    
                ?>
            </div> 
	    </div>		
    </div><!-- /.container-->
    <?php  $fb = get_field("fb", "options");
        if($fb) :
    ?>
    <a href="<?php echo $fb ?>" target="_blank" class="facebook">
        <span class="icon-facebook facebook__icon"></span>
    </a>
    <?php endif; ?>
</header>
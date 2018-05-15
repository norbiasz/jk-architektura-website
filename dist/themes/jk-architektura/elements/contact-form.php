<?php if( !defined('ABSPATH') ) { die('No direct access'); } ?>

<div class="contact__content">
    <div class="row">
        <div class="col-sm-6">     
            <div class="contact__content--left">
                <?php 
                    $tel = get_field('phone', 'options');
                    $mail = get_field('mail', 'options');
                    $adress = get_field('adress', 'options');
                    $contact_form = get_field('contact_form', 'options');
                ?>
                <div class="contact__title">
                    <?php _e("Adres:", 'jk-architektura'); ?>
                </div>
                <div class="contact__data">
                    <?php echo $adress ?>
                </div>

                <div class="contact__title">
                    <?php _e("Telefon:", 'jk-architektura'); ?>
                </div>
                <div class="contact__data">
                    <a href="tel:<?php echo str_replace(' ','', $tel) ?>"><?php echo $tel ?></a> 
                </div>

                <div class="contact__title">
                    <?php _e("Adres e-mail:", 'jk-architektura'); ?>
                </div>
                <div class="contact__data">
                    <a href="mailto:<?php echo $mail ?>"><?php echo $mail ?></a>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6">
            <div class="contact__content--right">
                <div class="contact__title-form">
                    <?php _e("Formularz kontaktowy:", 'jk-architektura'); ?>
                </div>
                <div class="contact__data-form">
                    <?php echo do_shortcode( $contact_form ); ?>
                </div>
                                        
            </div>
        </div>
    </div>
</div>
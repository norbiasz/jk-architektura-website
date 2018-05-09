<?php if( !defined('ABSPATH') ) { die('No direct access'); } 
    global $post; 
    if (  is_tax() || (is_page() && $post->post_parent ) ): 
?>
<div class="row">
    <div class="col-sm-12">
        <div class="page__back">
            <a class="page__back-link" href="javascript:history.go(-1)">wstecz</a>
        </div>
    </div>
</div>
<?php endif; ?>
<?php 
if ( have_posts() ) { 
    twentyeleven_content_nav( 'nav-above' ); 
    while ( have_posts() ) {
        the_post();
        get_template_part( 'content', get_post_format() ); 
    }
    twentyeleven_content_nav( 'nav-below' );
}
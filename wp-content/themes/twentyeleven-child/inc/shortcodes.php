<?php 
require_once('shortcode-functions.php');
/*
Añade shortcode [get_blog_intro] para las entradas de los Libros en el timeline del blog
@see: https://www.wpbeginner.com/wp-tutorials/how-to-add-a-shortcode-in-wordpress/
*/
add_shortcode( 'get_blog_intro', 'the_dramatist_return_post_id' );

/* Grid de iframes de compra Amazon en template de Pods */
add_shortcode( 'get_amazon_grid_shortcode_beta', 'get_amazon_grid_shortcode_beta' );

/* Grid de reviews en la página ppal de reviews */
add_shortcode( 'get_grid_reviews_shortcode', 'get_grid_reviews_shortcode' );



function wpb_tag_cloud() { 
    $tags = get_tags();
    $args = array(
        'smallest'                  => 12, 
        'largest'                   => 25,
        'unit'                      => 'px', 
        'number'                    => 50,  
        'format'                    => 'flat',
        'separator'                 => " ",
        'orderby'                   => 'count', 
        'order'                     => 'DESC',
        'show_count'                => 1,
        'echo'                      => false
    ); 
    $tag_string = wp_generate_tag_cloud( $tags, $args );
    return $tag_string; 
} 
// Add a shortcode so that we can use it in widgets, posts, and pages
add_shortcode('wpb_popular_tags', 'wpb_tag_cloud'); 
// Enable shortcode execution in text widget
add_filter ('widget_text', 'do_shortcode');

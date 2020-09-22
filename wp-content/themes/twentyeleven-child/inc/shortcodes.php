<?php 
require_once('shortcode-functions.php');
/*
Añade shortcode [get_blog_intro] para las entradas de los Libros en el timeline del blog
@see: https://www.wpbeginner.com/wp-tutorials/how-to-add-a-shortcode-in-wordpress/
*/
add_shortcode( 'get_blog_intro', 'the_dramatist_return_post_id' );

/* Cajita de estrellas de puntuación para los lectores */
add_shortcode( 'get_kkstarring', 'get_kkstarring' );

/* Grid de iframes de compra Amazon en template de Pods */
add_shortcode( 'get_amazon_grid_shortcode_beta', 'get_amazon_grid_shortcode_beta' );

/* Grid de reviews en la página ppal de reviews */
add_shortcode( 'get_grid_reviews_shortcode', 'get_grid_reviews_shortcode' );
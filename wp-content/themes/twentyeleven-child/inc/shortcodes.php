<?php 
require_once('shortcode-functions.php');
/*
Añade shortcode [get_blog_intro] para las entradas de los Libros en el timeline del blog
@see: https://www.wpbeginner.com/wp-tutorials/how-to-add-a-shortcode-in-wordpress/
*/
add_shortcode( 'get_blog_intro', 'the_dramatist_return_post_id' );
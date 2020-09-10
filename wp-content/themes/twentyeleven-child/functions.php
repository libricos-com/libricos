<?php
/**
Usada en el template Libros Grid de Pods
@see:
- https://www.ta-camp.de/news/howto-format-the-post_date-in-a-template 
- https://www.php.net/manual/en/function.date.php
*/
function my_datum($input_date) 
{
	return date_i18n('Y F d', strtotime($input_date));
}

/**
Activada carga de Javascript en el fichero js/custom.js
@see:
- https://wordpress.stackexchange.com/questions/306604/adding-javascript-to-child-theme
*/
function carga_bootstrap(){
	$version = '4.5.2';
    wp_enqueue_script( 'bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/'.$version.'/js/bootstrap.min.js', array('jquery'), NULL, true );
    wp_enqueue_style( 'bootstrap-css', '//maxcdn.bootstrapcdn.com/bootstrap/'.$version.'/css/bootstrap.min.css', false, NULL, 'all' );
}
function my_custom_scripts() {
	carga_bootstrap();	
    wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ),'',true );
    }
add_action( 'wp_enqueue_scripts', 'my_custom_scripts' );

/*
Añadir CPTs (objetos propios de PODs) a la línea de tiempo del blog
@see: https://docs.pods.io/code-snippets/modifying-pre_get_posts-categories-tags-show-custom-post-types/
*/
add_action( 'pre_get_posts', function ( $q )
{
    if (  !is_admin() // Only target front end queries
          && $q->is_main_query() // Only target the main query
          // && $q->is_category()   // Only target category archives [comment out if not needed]
          // && $q->is_tag()        // Only target tag archives [comment out if not needed]
    ) {
        $q->set( 'post_type', ['post', 'libro'] ); 
        // Change 'custom_post_type' to YOUR Custom Post Type
        // You can add multiple CPT's separated by comma's
    }
});

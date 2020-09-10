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
@see: https://wordpress.stackexchange.com/questions/241060/display-custom-post-type-in-recent-posts
*/
add_filter( 'pre_get_posts', 'my_get_posts' );
function my_get_posts( $query ) 
{
    if ( is_home() && $query->is_main_query() )
        $query->set( 'post_type', array( 'post', 'libro' ) );

    return $query;
}


/*
Añade shortcode para las entradas de los Libros en el timeline del blog
@see: https://www.wpbeginner.com/wp-tutorials/how-to-add-a-shortcode-in-wordpress/
*/
add_shortcode( 'get_libro_intro', 'the_dramatist_return_post_id' );
function the_dramatist_return_post_id() 
{
    global $post;
    return do_shortcode('[pods name="libro" id="'.$post->ID.'" template="Libro Blog Intro"]') ?? '';
}

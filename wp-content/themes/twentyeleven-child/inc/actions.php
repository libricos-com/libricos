<?php

/**
* Activada carga de Javascript en el fichero js/custom.js
* @see:
* - https://wordpress.stackexchange.com/questions/306604/adding-javascript-to-child-theme
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
¡¡OJO!! esta función mal usada bloqueaba PODs y el blog. Al guardar datos petaba Wordpress impidiendo añadir nuevos datos o modificar existentes y el blog quedaba estático.
@see https://github.com/pods-framework/pods/issues/5845


@param int $id ID of the post to change, example: get_the_ID()
@param string $pod_name Nombre del pod a cambiar, example: 'libro'
@param array $data nuevos datos a introducir, example:
    $data = array(
        'name' => 'New book name',
        'author' => 2,
        'description' => 'Awesome book, read worthy!'
    );

@see: 
- https://pods.io/docs/code/pods/save/
- https://developer.wordpress.org/reference/hooks/save_post/
- https://developer.wordpress.org/reference/hooks/post_updated/
- https://pods.io/docs/code/pods/
- https://wordpress.org/support/topic/update-pods-fields-by-code/

IMPORTANT: This example skips data sanitization and validation for the sake of simplicity to explain a concept. 
Do not use as is, always sanitize data from a form.

@example:
- Set the author (a user relationship field in pod libro) to a user with an ID of 2
    $pod->save( 'author', 2 );
- Let's save another book's data.. Save the same data from above, but for the book with an ID of 4
    $pod->save( $data, null, 4 );
*/
/*
function update_pod_campos($id, $pod_name, $data = [])
{
    if(empty($id) || empty($pod_name) || empty($data)){
        return false;
    }
   
    // Get the book item with an ID of 5
    $pod = pods( $pod_name, $id );

    // Save the data as set above
    if ( $pod->exists() ) {
        $pod->save( $data );
    }
    
}
// add_action( 'save_post', 'update_pod_campos', 1000, 2 );
add_action( 'post_updated', 'update_pod_campos', 10, 3 );
*/
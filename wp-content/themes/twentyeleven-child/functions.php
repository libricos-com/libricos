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
Añade shortcode [get_blog_intro] para las entradas de los Libros en el timeline del blog
@see: https://www.wpbeginner.com/wp-tutorials/how-to-add-a-shortcode-in-wordpress/
*/
add_shortcode( 'get_blog_intro', 'the_dramatist_return_post_id' );
function the_dramatist_return_post_id() 
{
    global $post;
    $postType = get_post_type();

    return do_shortcode('[pods name="'.$postType.'" id="'.$post->ID.'" template="Blog Intro '.$postType.'"]') ?? '';
}


/*
@see: https://wordpress.stackexchange.com/questions/39918/wordpress-hooks-filters-insert-before-content-or-after-title
*/
function theme_slug_filter_the_content( $content ) 
{
	global $post;
    $postType = get_post_type();
    $id = get_the_id();

    switch ($postType) {
    	case 'libro':
    		$color = 'btn-primary';
    		$title = 'Ficha técnica del libro';
    		$icon  = 'fa-book';
    		break;
    	case 'review':
    		$color = 'btn-danger';
    		$title = 'Esto es un análisis del libro';
    		$icon  = 'fa-clipboard-list';
    		break;
    	case 'nota':
    		$color = 'btn-warning';
    		$title = 'Esto es un conjunto de apuntes y pensamientos de un libro';
    		$icon  = 'fa-pencil-alt';
    		break;
    	default:
    		$color = 'btn-primary-orange';
    		$title = 'Esto es una entrada del blog';
    		$icon  = 'fa-rss';
    		break;
    }

    $entidad = '<a href="'.get_permalink().'" class="btn '.$color.'" role="button" data-toggle="tooltip" title="'.$title.' '.get_the_title().'"><i class="fas '.$icon.'"></i> '.ucfirst($postType).'</a>';



    $meta = get_post_meta($id);
    $htmlReviews = '';
    if(!empty($meta['reviews'])){
    	$numReviews = count($meta['reviews']);
    	$htmlReviews = '<button type="button" class="btn btn-danger ml-2"><i class="fas fa-clipboard-list"></i> Reviews <span class="badge badge-danger">'.$numReviews.'</span>
</button>';
    }
    $htmlNotas = '';
    if(!empty($meta['notas'])){
    	$numNotas = count($meta['notas']);
    	$htmlNotas = '<button type="button" class="btn btn-warning ml-2"><i class="fas fa-pencil-alt"></i> Notas <span class="badge badge-danger">'.$numNotas.'</span>
</button>';
    }
 


    $portada = get_post_meta($id,'portada');
    $htmlImagen = '';
     if( !empty($portada[0]['guid']) ){
     	$htmlImagen = '<div class="text-center"><a href="'.esc_url( get_permalink( $id ) ).'"><img src="'.$portada[0]['guid'].'" alt="Imagen de "></a></div>';
     }



    $estado = get_post_meta($id,'estado');
    /*
	0 | Por leer
	1 | Siguiente
	2 | Leído
	3 | Leyendo
	4 | Cerrado
	5 | Pausado
	6 | No interesado
	7 | Cuarentena
    */
    $estadoHtml = '';
    if($postType == 'libro'){
	    if( !empty($estado[0]) ){
	    	$estado = $estado[0];
	    }else{
	    	$estado = '';
	    }
		switch ($estado) {
	    	case 1:
	    		$color = 'btn-info';
	    		$icon = 'fab fa-hotjar';
	    		$title = 'A leer próximamente';
	    		$text = 'Siguiente';
	    		break;
	    	case 2:
	    		$color = 'btn-success';
	    		$icon = 'fa-check';
	    		$title = 'Libro leído a la espera de reseña';
	    		$text = 'Leído';
	    		break;
	    	case 3:
	    		$color = 'btn-warning';
	    		$icon = 'fa-book-reader';
	    		$title = 'Leyendo ahora';
	    		$text = 'Leyendo';
	    		break;
	    	
	    	default:
	    		$color = 'btn-primary';
	    		$icon = 'fa-layer-group';
	    		$title = 'Libro añadido a la biblioteca';
	    		$text = 'Quiero leer';
	    		break;
	    }
	    $estadoHtml = '<a href="#" class="btn '.$color.' ml-2" role="button" data-toggle="tooltip" title="'.$title.'"><i class="fas '.$icon.'"></i> '.$text.'</a>';
    }

    $barra = '<div>'.$entidad.$estadoHtml.$htmlReviews.$htmlNotas.'</div>';
   
    $expectativasHtml = '';
    if($postType == 'libro'){
    	$expectativas = get_post_meta($id,'expectativas');
	    if(!empty($expectativas[0])){
	    	$expectativasHtml = '<p>'.$expectativas[0].'</p>';
	    }
	}

    return $barra.$content.$htmlImagen.$expectativasHtml;
    
}
add_filter( 'the_content', 'theme_slug_filter_the_content' );

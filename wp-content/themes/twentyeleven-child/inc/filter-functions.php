<?php 
/**
 * templateRedirect
 * En Admin Wp -> Settings -> Permalinks -> add . to category and tag base. 
 *
 * @return void
 * @see: https://www.codeforest.net/custom-template-redirect-in-wordpress
 * @see: https://wordpress.stackexchange.com/questions/268589/how-to-override-a-query-and-display-specific-page-by-id
 */
function templateRedirect() 
{
	global $wp;
	global $wp_query;
	
	// TODO: Mis pruebas
	$isTag = is_tag();
	$isSingle = is_single();
	$isMainQuery = $wp_query->is_main_query();
	$tagName = get_query_var('name'); // Psicología

	if ( $wp_query->is_404
		// $wp_query->is_404 && !$isSingle
	) {

		// if we have a 404 status, set status of 404 to false
		$wp_query->is_404 = false;
		$wp_query->is_archive = true;
	
		$term = $wp_query->get_queried_object();

		
		
		if ($wp->request == $tagName) {

			$original_query = $wp_query;
			$wp_query = null;
			$args = array(
				'posts_per_page' => -1, 
				'tag'            => $tagName,
				'post_type'      => array( 'post', 'libro', 'review', 'nota', 'autor', 'foto' )
			);
			$wp_query = new WP_Query( $args );

			// change the header to 200 OK
			header("HTTP/1.1 200 OK");
			// loadWordPressTemplate(TEMPLATEPATH . '/super-custom-template.php');
			echo view('../layout/base', ['page' =>  'tags']);
		}
			
    }
}
add_action( 'template_redirect', 'templateRedirect' );

/**
 * my_get_posts
 *
 * @param [type] $query
 * @return void
 * 
 * @see: 
 * - Tag templates https://codex.wordpress.org/Tag_Templates
 * - https://wordpress.stackexchange.com/questions/142439/main-menu-not-appearing-on-category-pages
 */ 
function my_get_posts( $query ) 
{
    if( is_archive() && (is_category() || is_tag()) && empty( $query->query_vars['suppress_filters'] ) ) {
    // if(is_category() || is_tag()) {
        $post_type = get_query_var('post_type');
        if($post_type){
            $post_type = $post_type;
        }else{
            $post_type = array( 'post', 'libro', 'review', 'nota', 'autor', 'foto' );
        }
        $query->set('post_type', $post_type);
        $query->set( 'posts_per_page', -1 );
        return $query;
    } 
}

function str_replace_first($from, $to, $content)
{
    $from = '/'.preg_quote($from, '/').'/';
    return preg_replace($from, $to, $content, 1);
}

/*
En DEV las urls cambian con las IPs del XAMPP
Por ejemplo: http://192.168.1.44/jesuserro.com/wp-content/uploads/2020/09/ignacio-loyola.jpg
Cuando el domain ha cambiado a .47
*/
function fix_url_domain($src)
{
    $domain = get_site_url(); // http://192.168.1.47/jesuserro.com
    return preg_replace('/(.*\/jesuserro\.com)/m', $domain, $src);
}

function theme_slug_filter_the_content( $content ) 
{
	global $post;
    $postType = get_post_type();
    $titulo = get_the_title();
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
		case 'autor':
    		$color = 'btn-info';
    		$title = 'Ficha de autor';
    		$icon  = 'fa-user';
    		break;
		case 'editorial':
    		$color = 'btn-info';
    		$title = 'Ficha de la editorial';
    		$icon  = 'fa-newspaper';
    		break;
    	default:
    		$color = 'orange';
    		$title = 'Esto es una entrada del blog';
    		$icon  = 'fa-rss';
    		break;
    }

    $entidad = '<a href="'.get_permalink().'" class="btn '.$color.'" role="button" data-toggle="tooltip" title="'.$title.' '.$titulo.'"><i class="fas '.$icon.'"></i> '.ucfirst($postType).'</a>';



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
        $src = $portada[0]['guid']; 
        if(WP_DEBUG){
            $src = fix_url_domain($src);
        }
            $htmlImagen = 
            '<div class="text-center">'.
                '<a href="'.esc_url( get_permalink( $id ) ).'">'.
                    '<img width="400px" class="rounded img-fluid img-thumbnail" src="'.$src.'" alt="Imagen de portada del libro '.$titulo.'">'.
                '</a>'.
            '</div>';
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
	    		$color = 'orange';
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
   
    $libroHtml = $contentHtml = $expectativasHtml = '';
    if($postType == 'libro'){
        $contentHtml = get_post_meta($id,'sinopsis')[0];
	}else if($postType == 'review'){
        $libro = get_post_meta($id,'libro')[0];
        $portada = get_post_meta($libro['ID'],'portada');
        $htmlImagen = '';
        $content2 = get_post_meta($id,'contenido')[0];
        $contentHtml = get_first_paragraph($content2);
        if( !empty($portada[0]['guid']) ){
            $htmlImagen = '<div class="text-center"><a href="'.esc_url( get_permalink( $id ) ).'"><img src="'.$portada[0]['guid'].'" alt="Imagen de portada del libro '.$titulo.'"></a></div>';
        }
    
    }else if($postType == 'autor' || $postType == 'foto'){
        
        $content2 = get_post_meta($id,'contenido')[0];
        $contentHtml = get_first_paragraph($content2);
    }
    $contentHtml = '<p>'.$contentHtml.'</p>';

    $return = $barra.$content.$htmlImagen.$contentHtml;
    
    if($postType != 'post'){
        $return .='<a href="'.get_permalink().'">'.__( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyeleven' );
    }
    return $return;
    
}
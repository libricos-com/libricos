<?php 
/*
The template for displaying content in the single-libro.php template
@see: https://docs.pods.io/tutorials/get-values-from-a-relationship-field/
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php twentyeleven_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->




	<div class="entry-content">
		


<?php 
	global $post;
    $postType = get_post_type();
    $id = get_the_id();

    $titulo = get_post_meta( $id, 'titulo', true );
    $asin = get_post_meta( $id, 'asin', true );
    $post_title = get_the_title();
    $url = esc_url( get_permalink( $id ) );

	$portada = get_post_meta($id,'portada');
	$src = wp_get_attachment_image_src($portada[0]['ID'], 400);
	$sinopsis = get_post_meta($id,'sinopsis')[0];

	//get Pods object for current post
    $pod = pods( 'libro', $id );
?>


<div>
	
	<div class="text-center mb-4">
		<a href="<?php echo $url;?>"><img src="<?php echo $src[0];?>" alt="Portada del libro <?php echo $titulo;?>" class="img-fluid" /></a>
		<div><?php // echo get_kkstarring();?></div>
	</div>

	<h2>Sinopsis</h2>
	<p><?php echo $sinopsis;?></p>


	<?php 
	//get the value for the relationship field 
	//loop through related field, creating links to their own pages
	//only if there is anything to loop through
	$autores = $pod->field( 'autores' );
	if ( ! empty( $autores ) ) {
		?>
		<h2>Autor/es</h2>
		<ul class="list-group list-group-horizontal-sm mb-4">
		<?php
		foreach ( $autores as $autor ) { 
			//get id for related post and put in ID
			//for advanced content types use $id = $rel[ 'id' ];
			$idA = $autor[ 'ID' ];
			//show the related post name as link
			$urlAutor = esc_url( get_permalink( $idA ) );
			$nombreAutor = get_the_title( $idA );
			//get the value for some_field in related post and echo it
			// $someField = get_post_meta( $idA, 'post_title', true );
			?>
			<li class="list-group-item">
				<a href="<?php echo $urlAutor;?>"><?php echo $nombreAutor;?></a>
			</li>
			<?php
		} //end of foreach
		?>
		</ul>
		<?php
	} //endif ! empty ( $autores )
	?>

	<?php 
	$generos = $pod->field( 'generos_literarios' );
	if ( ! empty( $generos ) ) {
		?>
		<h2>Géneros</h2>
		<ul class="d-flex flex-wrap mb-4">
		<?php
		foreach ( $generos as $genero ) { 
			$idA = $genero['term_id'];
			$nombreGenero = $genero['name'];
			// $urlGenero    = esc_url(get_term_link( $genero['slug'], $nombreGenero ));
			// $urlGenero    = esc_url(get_term_link( $genero['slug'], 'generos_literarios' ));
			// $genre = get_the_term_list($idA,'generos_literarios',"Generos: ", " / ","");
			//get the value for some_field in related post and echo it
			// $someField = get_post_meta( $idA, 'post_title', true );
			$urlGenero = esc_url( get_bloginfo('url').'/generos/'.$genero['slug'] );
			$numPosts = $genero['count'];
			?>
			<li class="list-group-item">
				<a href="<?php echo $urlGenero;?>"><?php echo $nombreGenero;?></a> (<?php echo $numPosts;?>)
			</li>
			<?php
		} //end of foreach
		?>
		</ul>
		<?php
	} //endif ! empty ( $generos )
	?>

	<?php 
	// @see: https://developer.wordpress.org/reference/functions/wp_list_categories/
	$taxonomy = 'category';
	// Get the term IDs assigned to post.
	$post_terms = wp_get_object_terms( $id, $taxonomy, array( 'fields' => 'ids' ) ); 
	if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
	    $term_ids = implode( ',' , $post_terms );
	    $args = array(
	        'title_li'   => '',
	        'style'      => 'list',
	        'echo'       => false,
	        'taxonomy'   => $taxonomy,
	        'include'    => $term_ids,
	        'orderby'    => 'name',
        	'show_count' => true
	    );
	    $terms = wp_list_categories( $args );
	    $terms = str_replace('cat-item', 'list-group-item', $terms);
	    ?>
	    <h2>Categorías</h2>
		<ul class="d-flex flex-wrap mb-4">
	    	<?php echo $terms;?>
		</ul>
	    <?php
	}
	?>


	<?php 
	// @see: https://developer.wordpress.org/reference/functions/wp_list_categories/
	$taxonomy = 'post_tag';
	// Get the term IDs assigned to post.
	$post_terms = wp_get_object_terms( $id, $taxonomy, array( 'fields' => 'ids' ) ); 
	if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
	    $term_ids = implode( ',' , $post_terms );
	    $args = array(
	        'title_li'   => '',
	        'style'      => 'list',
	        'echo'       => false,
	        'taxonomy'   => $taxonomy,
	        'include'    => $term_ids,
	        'orderby'    => 'name',
        	'show_count' => true
	    );
	    $terms = wp_list_categories( $args );
	    $terms = str_replace('cat-item', 'list-group-item', $terms);
	    ?>
	    <h2>Etiquetas</h2>
		<ul class="d-flex flex-wrap mb-4">
	    	<?php echo $terms;?>
		</ul>
	    <?php
	}
	?>

	<?php 
	$editorial = $pod->field( 'editorial' );
	$urlEditorial = esc_url( get_permalink( $editorial['ID'] ) );

	$fecha_publicacion = get_post_meta($id,'fecha_publicacion')[0];
	$paginas = get_post_meta($id,'paginas')[0];
	$idioma = get_post_meta($id,'idioma')[0];
	$url_goodreads = get_post_meta($id,'url_goodreads')[0];
	
    $formato = get_post_meta($id,'formato');
    if(!empty($formato[0])){
        $formato = $formato[0];
    }
	/*
	Formato:
	1 | Kindle
	2 | E-book
	3 | Paperback
	4 | Hardback
	5 | Audiobook
	*/
	switch ($formato) {
		case 1:
			$iconFormato = 'fab fa-amazon';
			$textoFormato = 'Kindle';
			break;
		case 2:
			$iconFormato = 'fas fa-tablet-alt';
			$textoFormato = 'E-book';
			break;
		case 3:
			$iconFormato = 'fas fa-book-open';
			$textoFormato = 'Paperback';
			break;
		case 4:
			$iconFormato = 'fas fa-book';
			$textoFormato = 'Hardback';
			break;
		case 5:
			$iconFormato = 'fas fa-volume-up';
			$textoFormato = 'Audiobook';
			break;
		default:
			$iconFormato = 'fas fa-question';
			$textoFormato = '-';
			break;
	}
	?>
	


	<h2>Ficha técnica</h2>
	<ul class="list-group mb-4">
		<li class="list-group-item"><strong>Editorial</strong>: <a href="<?php echo $urlEditorial;?>"><?php echo $editorial['post_title'];?></a></li>
		<li class="list-group-item"><strong>Fecha publicación</strong>: <?php echo $fecha_publicacion;?></li>
		<li class="list-group-item"><strong>Formato</strong>: <span class="<?php echo $iconFormato;?>"></span> <?php echo $textoFormato;?></li>
		<li class="list-group-item"><strong>Páginas</strong>: <?php echo $paginas;?></li>
		<li class="list-group-item"><strong>Idioma</strong>: <span class="flag-icon flag-icon-<?php echo $idioma;?>"></span></li>
		<li class="list-group-item"><i class="fab fa-goodreads"></i><a href="<?php echo $url_goodreads;?>" target="blank" rel="noopener noreferrer"> Ficha Goodreads</a></li>
	</ul>
	
	<?php 
    $params = array( 
        'orderby' => 'post_date DESC'
    ); 
	$reviews = $pod->field( 'reviews', $params );
	if ( ! empty( $reviews ) ) {
		$numReviews = count($reviews);
		?>
		<h2>Reviews <span class="badge badge-danger"><i class="fas fa-clipboard-list mr-1"></i><span class="badge badge-danger"><?php echo $numReviews;?></span></span></h2>
		<ul class="list-unstyled">
			<?php
			foreach ( $reviews as $review ) { 
				$idA = $review[ 'ID' ];
				$urlReview = esc_url( get_permalink( $idA ) );
				$nombreReview = get_the_title( $idA );
				?>
				<li>
					<span class="badge badge-pill btn-secondary"><i class="fas fa-clock" aria-hidden="true"></i> <?php echo date('d-m-y', strtotime($review['post_date']));?></span>
					<i class="fas fa-clipboard-list"><a href="<?php echo $urlReview;?>" data-toggle="tooltip" title="Esto es una reseña del libro <?php echo $post_title;?>"></i> <?php echo $nombreReview;?></a>
				</li>
				<?php
			} //end of foreach
			?>
		</ul>
		<?php
	} //endif ! empty ( $reviews )
	?>


	<?php 
    $params = array( 
        'orderby' => 'post_date DESC'
    ); 
	$notas = $pod->field( 'notas', $params );
	if ( ! empty( $notas ) ) {
		$numNotas = count($notas);
		?>
		<h2>Notas <span class="badge badge-warning"> <i class="fas fa-pencil-alt mr-1"></i><span class="badge badge-danger"><?php echo $numNotas;?></span></span></h2>
		<ul class="list-unstyled">
			<?php
			foreach ( $notas as $nota ) { 
				$idA = $nota[ 'ID' ];
				$urlNota = esc_url( get_permalink( $idA ) );
				$nombreNota = get_the_title( $idA );
				?>
				<li>
					<span class="badge badge-pill btn-secondary"><i class="fas fa-clock" aria-hidden="true"></i> <?php echo date('d-m-y', strtotime($nota['post_date']));?></span>
					<i class="fas fa-pencil-alt"></i> <a href="<?php echo $urlNota;?>" data-toggle="tooltip" title="Esto es una nota del libro <?php echo $post_title;?>"><?php echo $nombreNota;?></a>
				</li>
				<?php
			} //end of foreach
			?>
		</ul>
		<?php
	} //endif ! empty ( $notas )
	?>

    <hr />
	<div class="text-center p-2">
        <?php echo do_shortcode('[amazon box="'.$asin.'"]');?>
	</div>
    <hr />

    <h2>Similares</h2>
	<div class="text-center p-2">
        <?php echo do_shortcode('[amazon bestseller="'.	get_post_meta($id,'titulo')[0].'"]');?>
	</div>

</div>	









		
		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>',
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
			/* translators: Used between list items, there is a space after the comma. */
			$categories_list = get_the_category_list( __( ', ', 'twentyeleven' ) );

			/* translators: Used between list items, there is a space after the comma. */
			$tag_list = get_the_tag_list( '', __( ', ', 'twentyeleven' ) );
		if ( '' != $tag_list ) {
			/* translators: 1: Categories list, 2: Tag list, 3: Permalink, 4: Post title, 5: Author name, 6: Author URL. */
			$utility_text = __( 'This entry was posted in %1$s and tagged %2$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyeleven' );
		} elseif ( '' != $categories_list ) {
			/* translators: 1: Categories list, 2: Tag list, 3: Permalink, 4: Post title, 5: Author name, 6: Author URL. */
			$utility_text = __( 'This entry was posted in %1$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyeleven' );
		} else {
			/* translators: 1: Categories list, 2: Tag list, 3: Permalink, 4: Post title, 5: Author name, 6: Author URL. */
			$utility_text = __( 'This entry was posted by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyeleven' );
		}

			printf(
				$utility_text,
				$categories_list,
				$tag_list,
				esc_url( get_permalink() ),
				the_title_attribute( 'echo=0' ),
				get_the_author(),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
			);
			?>
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>

		<?php
		// If a user has filled out their description and this is a multi-author blog, show a bio on their entries.
		if ( get_the_author_meta( 'description' ) && ( ! function_exists( 'is_multi_author' ) || is_multi_author() ) ) :
			?>
		<div id="author-info">
			<div id="author-avatar">
				<?php
				/** This filter is documented in author.php */
				$author_bio_avatar_size = apply_filters( 'twentyeleven_author_bio_avatar_size', 68 );
				echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
				?>
			</div><!-- #author-avatar -->
			<div id="author-description">
				<h2>
				<?php
				/* translators: %s: Author name. */
				printf( __( 'About %s', 'twentyeleven' ), get_the_author() );
				?>
				</h2>
				<?php the_author_meta( 'description' ); ?>
				<div id="author-link">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
						<?php
						/* translators: %s: Author name. */
						printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentyeleven' ), get_the_author() );
						?>
					</a>
				</div><!-- #author-link	-->
			</div><!-- #author-description -->
		</div><!-- #author-info -->
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

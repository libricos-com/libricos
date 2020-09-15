<?php
/*
Template Name: Libro detail page
@see: 
- https://wordpress.org/support/topic/providing-templates-with-php/
- https://docs.pods.io/tutorials/get-values-from-a-relationship-field/
*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title">Content libro <?php the_title(); ?></h1>

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
    $url = esc_url( get_permalink( $id ) );

	$portada = get_post_meta($id,'portada');
	$sinopsis = get_post_meta($id,'sinopsis')[0];


	//get Pods object for current post
    $pod = pods( 'libro', $id );
	//get the value for the relationship field
	$autores = $pod->field( 'autores' );
	$generos = $pod->field( 'generos_literarios' );
    
?>


<div>
	
	<div class="text-center mb-4">
		<a href="<?php echo $url;?>"><img src="<?php echo $portada[0]['guid'];?>" alt="Portada del libro <?php echo $titulo;?>" class="img-fluid" /></a>
	</div>

	<h2>Sinopsis</h2>
	<p><?php echo $sinopsis;?></p>


	<?php 
	//loop through related field, creating links to their own pages
	//only if there is anything to loop through
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
			?>
			<li class="list-group-item">
				<a href="<?php echo $urlGenero;?>"><?php echo $nombreGenero;?></a>
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
	


	<h2>Ficha técnica</h2>
	<ul class="list-group mb-4">
		<li class="list-group-item"><strong>Editorial</strong>: <a href="{@editorial.permalink}">{@editorial}</a></li>
		<li class="list-group-item"><strong>Fecha publicación</strong>: {@fecha_publicacion}</li>
		<li class="list-group-item"><strong>Páginas</strong>: {@paginas}</li>
		<li class="list-group-item"><strong>Idioma</strong>: <span class="flag-icon flag-icon-{@idioma}"></span></li>
		<li class="list-group-item"><i class="fab fa-goodreads"></i><a href="{@url_goodreads}" target="blank" rel="noopener noreferrer"> Ficha Goodreads</a></li>
	</ul>
	
	[if reviews]
		<h2>Mis Reseñas</h2>
		<ul>
		[each reviews]
			<li>{@post_date, my_datum}: <a href="{@permalink,esc_url}">{@post_title}</a> Mi puntuación: {@puntuacion}</li>
		[/each]
		</ul>
	[/if]

	[if notas]
		<h2>Mis Notas</h2>
		<ul>
		[each notas]
			<li>{@post_date, my_datum}: <a href="{@permalink,esc_url}">{@post_title}</a></li>
		[/each]
		</ul>
	[/if]

	[if recomendaciones]
		<h2>Mis Recomendaciones</h2>
		<ul>
		[each recomendaciones]
			<li>{@post_date, my_datum}: <a href="{@permalink,esc_url}">{@post_title}</a></li>
		[/each]
		</ul>
	[/if]

	<div class="text-center p-2">
		{@iframe_compra_amazon}
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

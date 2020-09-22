<?php 
/*
The template for displaying content in the single-review.php template
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
        $post_title = get_the_title();
        $url = esc_url( get_permalink( $id ) );

        $texto = get_post_meta($id,'texto')[0];
        $entradilla = get_post_meta($id,'entradilla')[0];
        $puntuacion = get_post_meta($id,'puntuacion')[0];
        $url_goodreads = get_post_meta($id,'url_goodreads')[0];
        
        //get Pods object for current post
        $pod = pods( 'review', $id );

        $libro = $pod->field( 'libro' );
        $portada = get_post_meta($libro['ID'],'portada');
        $src = wp_get_attachment_image_src($portada[0]['ID'], 400);
        $iframe_compra_amazon = get_post_meta($libro['ID'],'iframe_compra_amazon')[0];

        $fecha = get_the_date('Y F d');

        $libro_link = get_permalink($libro['ID']);
        $libro_title = get_the_title($libro['ID']);
    ?>



        <div>
            <strong>Fecha reseña</strong>: <?php echo $fecha;?> 

            <div class="text-center mb-4">
                <a href="<?php echo $libro_link;?>"><img src="<?php echo $src[0];?>" alt="Portada del libro <?php echo $titulo;?>" class="img-fluid" /></a>
                <div><?php echo get_kkstarring();?></div>
            </div>

            <p><?php echo $entradilla;?></p>
            <p><?php echo $texto;?></p>

            <ul>
                <li><strong>Mi puntuación</strong>: <?php echo $puntuacion;?></li>
                <li><a href="<?php echo $url_goodreads;?>">Reseña en Goodreads</a></li>
            </ul>

            <div class="text-center"><?php echo $iframe_compra_amazon;?></div>
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

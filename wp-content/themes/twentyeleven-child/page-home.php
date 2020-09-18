<?php
/* Template Name: Page Home */

get_header(); 

$urlBase = get_site_url();
?>

<div id="primary">
	<div id="content" role="main">


        <!-- wp:columns -->
        <div class="wp-block-columns"><!-- wp:column -->
            <div class="wp-block-column"><!-- wp:image {"align":"center","id":13561,"width":183,"height":183,"sizeSlug":"large"} -->
                <div class="wp-block-image">
        	       <figure class="aligncenter size-large is-resized"><a href="<?php echo $urlBase;?>/libros/"><img src="<?php echo $urlBase;?>/wp-content/uploads/2020/09/libros.png" alt="" class="wp-image-13561" width="183" height="183"/></a></figure>
               </div>
                <!-- /wp:image -->

                <!-- wp:heading {"align":"center"} -->
                <h2 class="has-text-align-center">Libros</h2>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center"} -->
                <p class="has-text-align-center">Libros que cuidan y sanan el alma. </p>
                <!-- /wp:paragraph --></div>
                <!-- /wp:column -->

                <!-- wp:column -->
                <div class="wp-block-column"><!-- wp:image {"align":"center","id":13560,"sizeSlug":"large"} -->
                    <div class="wp-block-image"><figure class="aligncenter size-large"><a href="<?php echo $urlBase;?>/fotos/"><img src="<?php echo $urlBase;?>/wp-content/uploads/2020/09/instagram.png" alt="" class="wp-image-13560"/></a></figure>
                </div>
                <!-- /wp:image -->

                <!-- wp:heading {"align":"center"} -->
                <h2 class="has-text-align-center">Fotos</h2>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"align":"center"} -->
                <p class="has-text-align-center">A través de la imagen trato de describir el mundo tal y como lo veo.</p>
                <!-- /wp:paragraph --></div>
                <!-- /wp:column -->

                <!-- wp:column -->
                <div class="wp-block-column"><!-- wp:image {"align":"center","id":13562,"sizeSlug":"large"} -->
                    <div class="wp-block-image">
                        <figure class="aligncenter size-large"><a href="<?php echo $urlBase;?>/blog/"><img src="<?php echo $urlBase;?>/wp-content/uploads/2020/09/wordpress.png" alt="" class="wp-image-13562"/></a></figure>
                    </div>
                    <!-- /wp:image -->

                    <!-- wp:heading {"align":"center"} -->
                    <h2 class="has-text-align-center">Blog</h2>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"align":"center"} -->
                    <p class="has-text-align-center">Pildoras de fe, pensamientos y palabras.</p>
                    <!-- /wp:paragraph -->
            </div>
            <!-- /wp:column -->
        </div>
        <!-- /wp:columns -->


    	<h2>Leyenda mía</h2>
    	<a href="#" class="badge badge-primary">Libro</a>
    	<span class="badge badge-primary"><i class="fas fa-book"></i> Libro</span>
    	<button type="button" class="btn btn-primary"><i class="fas fa-book"></i> Libros <span class="badge badge-danger">4,3</span>
    	</button>

    	<i class="fa fa-star fa-lg color-yellow" aria-hidden="true"></i> Mi puntuación <span class="badge badge-warning">4,3</span> <br><br>

    	<span class="fa fa-star checked"></span>
    	<span class="fa fa-star checked"></span>
    	<span class="fa fa-star checked"></span>
    	<span class="fa fa-star fa-star-half"></span>
    	<br>

    	<a href="#" class="btn btn-lg px-3 btn-primary" role="button" data-toggle="tooltip" title="Ficha técnica del libro"><i class="fas fa-book"></i> Libro</a>

    	<a href="#" class="btn btn-lg px-3 btn-danger" role="button" data-toggle="tooltip" title="Esto es un análisis del libro"><i class="fas fa-clipboard-list"></i> Review</a>

    	<a href="#" class="btn btn-lg px-3 btn-warning" role="button" data-toggle="tooltip" title="Esto es un conjunto de apuntes y pensamientos de un libro"><i class="fas fa-pencil-alt"></i> Nota</a>

    	<a href="#" class="btn btn-lg px-3 btn-primary-orange" role="button" data-toggle="tooltip" title="Esto es una entrada del blog"><i class="fas fa-rss"></i> Post</a>

    	<a href="#" class="btn btn-lg px-3 btn-info" role="button" data-toggle="tooltip" title="Ficha de autor"><i class="fas fa-user"></i> Autor</a>

    	<a href="#" class="btn btn-lg px-3 btn-info" role="button" data-toggle="tooltip" title="Ficha de la editorial"><i class="fas fa-newspaper"></i> Editorial</a>

    	<br><br>

    	<a href="#" class="btn btn-lg px-3 btn-primary" role="button" data-toggle="tooltip" title="Libro añadido a la biblioteca"><i class="fas fa-layer-group"></i> Quiero leer</a>

    	<a href="#" class="btn btn-lg px-3 btn-success" role="button" data-toggle="tooltip" title="Libro leído. Reseña en proceso."><i class="fas fa-check"></i> Leído</a>

    	<a href="#" class="btn btn-lg px-3 btn-warning" role="button" data-toggle="tooltip" title="Leyendo"><i class="fas fa-book-reader"></i> Leyendo</a>

    	<a href="#" class="btn btn-lg px-3 btn-primary-orange" role="button" data-toggle="tooltip" title="A leer próximamente"><i class="fab fa-hotjar"></i> Siguiente</a>	



		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php comments_template( '', true ); ?>

		<?php endwhile; // End of the loop. ?>


	</div><!-- #content -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php
/*
Template Name: JEI Review detail PAGE
@see: 
- https://florianbrinkmann.com/en/organizing-files-functions-wordpress-theme-4190/
- https://wordpress.org/support/topic/providing-templates-with-php/
- https://docs.pods.io/tutorials/get-values-from-a-relationship-field/
*/
get_header(); ?>

<div id="primary">
	<div id="content" role="main">

		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<nav id="nav-single">
				<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
				<span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous', 'twentyeleven' ) ); ?></span>
				<span class="nav-next"><?php next_post_link( '%link', __( 'Next <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></span>
			</nav><!-- #nav-single -->

			<?php get_template_part( 'page-content/review', get_post_format() ); ?>

			<?php comments_template( '', true ); ?>

		<?php endwhile; // End of the loop. ?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>

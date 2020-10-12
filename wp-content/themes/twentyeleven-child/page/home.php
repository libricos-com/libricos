<?php
/*
Template Name: JEI Home Page 

@see: 
- https://florianbrinkmann.com/en/organizing-files-functions-wordpress-theme-4190/
- https://developer.wordpress.org/themes/basics/template-hierarchy/
- https://wordpress.org/support/topic/providing-templates-with-php/
*/

get_header(); 

$urlBase = get_site_url();
?>

<div id="primary">
	<div id="content" role="main">

        <?php 
         // Include the page content template.
        get_template_part( 'page-content/home', 'page' );
        ?>

		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php // get_template_part( 'content', 'page' ); ?>

			<?php comments_template( '', true ); ?>

		<?php endwhile; // End of the loop. ?>


	</div><!-- #content -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

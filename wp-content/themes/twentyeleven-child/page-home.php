<?php
/* Template Name: Page Home */

get_header(); 

$urlBase = get_site_url();
?>

<div id="primary">
	<div id="content" role="main">

        <?php include('page-home-content.php');?>

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

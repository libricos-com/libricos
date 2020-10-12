<?php
/*
Layout base 

@see: 
- https://florianbrinkmann.com/en/organizing-files-functions-wordpress-theme-4190/
- https://developer.wordpress.org/themes/basics/template-hierarchy/
- https://wordpress.org/support/topic/providing-templates-with-php/
*/

get_header(); 
?>

<div id="primary">
	<div id="content" role="main">

        <?php get_template_part( 'page-content/'.$page, 'page' );?>

        <?php comments_template( '', true ); ?>
        
	</div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

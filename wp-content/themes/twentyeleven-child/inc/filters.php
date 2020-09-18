<?php
require_once('filter-functions.php');

/*
Añadir CPTs (objetos propios de PODs) a la línea de tiempo del blog
@see: https://wordpress.stackexchange.com/questions/241060/display-custom-post-type-in-recent-posts
*/
add_filter( 'pre_get_posts', 'my_get_posts' );

/*
Para el índice de posts en el blog
@see: https://wordpress.stackexchange.com/questions/39918/wordpress-hooks-filters-insert-before-content-or-after-title
*/
add_filter( 'the_content', 'theme_slug_filter_the_content' );

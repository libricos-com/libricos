<?php 
/*
The template for displaying content in the tpl/libros.php template
@see: https://docs.pods.io/tutorials/get-values-from-a-relationship-field/
*/
?>


<h2>Libros cristianos/espiritualidad de autoayuda (más vendidos, emocional, ansiedad, autoestima, depresión, imprescindibles)</h2>

<h2>Libros cristianos gratis, español y Kindle (más vendidos)</h2>

<h2>Libros cristianos para jóvenes, hombres, mujeres, niños</h2>

<h2>Libros de historias y testimonios cristianos.</h2>

<h2>Libros sobre el sentido del sufrimiento</h2>

<h2>Libros sobre la palabra de Dios Padre Nuestro (Oración?)</h2>
<?php 
// http://192.168.1.44/jesuserro.com/tag/oracion/
// taxonomy=post_tag&tag_ID=246&post_type=post
$args = array(
    'posts_per_page' => -1,
    // 'post_type' => 'libro',
    'tax_query' => array(
        array(
            'taxonomy' => 'post_tag',
             'terms' => 246
        )
    )
);
$args2 = array(
    'posts_per_page' => -1,
    'post_type' => 'libro',
    'tax_query' => array(
        array(
            'taxonomy' => 'post_tag',
            'terms' => 246
        )
    )
);
$posts = get_posts($args);
$posts2 = get_posts($args2);
$posts = array_merge($posts, $posts2);
$num = count($posts);
if( ! empty( $posts ) ){
	?>
	<ul class="list-group mb-4">
	<?php
	foreach ( $posts as $p ){
		?>
		<li class="list-group-item">
			<a href="<?php echo get_permalink($p->ID);?>"><?php echo $p->post_title;?></a>
		</li>
		<?php
	}
	?>
	</ul>
	<?php
}
?>

<h2>Libros sobre profecías cumplidas</h2>

<h2>Libros para sanar el alma (paz y libertad interior)</h2>

<h2>Libros sobre psicología y amor de pareja</h2>
<?php 
// Género psicologia 374 http://192.168.1.44/jesuserro.com/generos/psicologia
$args = array(
    'posts_per_page' => -1,
    'post_type' => 'libro',
    'tax_query' => array(
        array(
            'taxonomy' => 'generos',
            // 'field' => 'tag_ID',
            'terms' => 374
            // 'slug' => 'psicologia'
        )
    )
);
$posts = get_posts($args);
$num = count($posts);
if( ! empty( $posts ) ){
	?>
	<ul class="list-group mb-4">
	<?php
	foreach ( $posts as $p ){
		?>
		<li class="list-group-item">
			<a href="<?php echo get_permalink($p->ID);?>"><?php echo $p->post_title;?></a>
		</li>
		<?php
	}
	?>
	</ul>
	<?php
}
?>

<h2>Categoría Libros</h2>
<?php
// taxonomy=category&tag_ID=3&post_type=post
$args = array(
    'posts_per_page' => -1,
    'post_type' => 'libro',
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
             'terms' => 3
        )
    )
);
$posts = get_posts($args);
$num = count($posts);
if( ! empty( $posts ) ){
	?>
	<ul class="list-group mb-4">
	<?php
	foreach ( $posts as $p ){
		?>
		<li class="list-group-item">
			<a href="<?php echo get_permalink($p->ID);?>"><?php echo $p->post_title;?></a> (<?php echo $p->asin;?>)
		</li>
		<?php
	}
	?>
	</ul>
	<?php
}
?>

<h2>Libros leídos</h2>
<?php echo get_amazon_grid_beta(2);?>


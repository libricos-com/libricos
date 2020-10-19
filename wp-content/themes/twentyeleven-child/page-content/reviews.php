<?php 
/*
The template for displaying content in the tpl/reviews.php template
@see: https://docs.pods.io/tutorials/get-values-from-a-relationship-field/
*/
$input = array(
    'posts_per_page' => -1,
    'post_type' => 'review',
    'orderby' => 'post_date DESC'
);
$libros_con_reviews = get_reviews_asins($input);
$asins = $libros_con_reviews[0];
$ids = $libros_con_reviews[1];
?>

<h1>Últimas reseñas</h1>
<?php
if(!empty($asins)){ 
    echo do_shortcode('[amazon box="'.$asins.'" tpl_ids="'.$ids.'" template="my-horizontal"]');
}else{
    echo 'No hay reviews';
}
?>

<h2>Bestsellers espiritualidad</h2>
<?php // echo do_shortcode('[amazon bestseller="%novedades + cristianismo%"]'); ?>
<?php 
/*
The template for displaying content in the tpl/reviews.php template
@see: https://docs.pods.io/tutorials/get-values-from-a-relationship-field/
*/
$input = array(
    'posts_per_page' => -1,
    'post_type' => 'nota',
    'orderby' => 'post_date DESC'
);
use App\Entity\Review;
$review = new Review(null);

$libros_con_notas = $review->get_all($input);
$asins = $libros_con_notas[0];
$ids = $libros_con_notas[1];

if(!empty($asins)){ 
    echo do_shortcode('[amazon box="'.$asins.'" tpl_ids="'.$ids.'" template="nota-item-horizontal"]');
}else{
    echo 'No hay notas';
}
?>

<h2>Bestsellers espiritualidad</h2>
<?php echo do_shortcode('[amazon template="vertical" grid="4" bestseller="%novedades + cristianismo%"]'); ?>
<?php 
/*
The template for displaying content in the tpl/reviews.php template
@see: https://docs.pods.io/tutorials/get-values-from-a-relationship-field/
*/
use App\Entity\Review;
$review = new Review(null);

$reviews = $review->get_all();
$asins = $reviews[0];
$ids = $reviews[1];
?>

<?php
if(!empty($asins)){  
    echo do_shortcode('[amazon box="'.$asins.'" tpl_ids="'.$ids.'" template="review-item-horizontal"]');
}else{
    echo 'No hay reviews';
}
?>

<h2>Bestsellers espiritualidad</h2>
<?php echo do_shortcode('[amazon bestseller="%novedades + cristianismo%"]'); ?>
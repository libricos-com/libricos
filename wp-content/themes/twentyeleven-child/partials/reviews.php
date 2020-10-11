<?php 
/*
The template for displaying content in the tpl/reviews.php template
@see: https://docs.pods.io/tutorials/get-values-from-a-relationship-field/
*/

// echo get_grid_reviews_shortcode();

$asins = $ids = '';
$input = array(
    'posts_per_page' => -1,
    'post_type' => 'review',
    'orderby' => 'post_date DESC'
);
$reviews = get_posts($input);
$num = count($reviews);
$asins = $ids = '';
if( ! empty( $reviews ) ){
	foreach ( $reviews as $review ){
        $libro = get_post_meta( $review->ID, 'libro', true );
        $id = $libro['ID'];
        $asin = get_post_meta( $id, 'asin', true );
        if(!empty($asin)){
            $asins .= $asin.',';
            $ids .= $id.',';
        }
        
    }
}

// Remove duplicate ids
$asins = implode(',', array_unique(explode(',', $asins)));
$ids = implode(',', array_unique(explode(',', $ids)));

?>
<h1>Reseñas recientes de todos los libros</h1>
<?php
if(!empty($asins)){ 
    echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3"]');
}else{
    echo 'No hay reviews';
}
?>

<h2>Bestsellers espiritualidad</h2>
<?php echo do_shortcode('[amazon bestseller="%novedades + cristianismo%"]'); ?>
<?php 
/*
The template for displaying content in the tpl/notas.php template
@see: https://docs.pods.io/tutorials/get-values-from-a-relationship-field/
*/

// echo get_grid_notas_shortcode();

$asins = $ids = '';
$input = array(
    'posts_per_page' => -1,
    'post_type' => 'nota'
);
$notas = get_posts($input);
$num = count($notas);
$asins = $ids = '';
if( ! empty( $notas ) ){
	foreach ( $notas as $nota ){
        $libro = get_post_meta( $nota->ID, 'libro', true );
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

if(!empty($asins)){ 
    echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3"]');
}
?>

<h2>Bestsellers espiritualidad</h2>
<?php echo do_shortcode('[amazon bestseller="%novedades + cristianismo%"]'); ?>
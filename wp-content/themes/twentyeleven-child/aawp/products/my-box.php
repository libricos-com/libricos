<?php
/**
 * Vertical template
 *
 * @var AAWP_Template_Functions $this
 * 
 * @see https://stackoverflow.com/questions/5629853/creating-a-custom-php-template
 */

if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$asin = $this2->get_product_id();
$index = $this2->item_index;
// $variables = $this2->get_template_variables();
$ids = $this2->get_template_variable( 'ids', false );

if( !is_array($ids) ){
    $ids = explode(',', $ids);
}

$id_libro =  $ids[ $index - 1 ];
$post_title = get_the_title($id_libro);

$pod = pods( 'libro', $id_libro );
$params = array( 
    'orderby' => 'post_date DESC'
); 
$reviews = $pod->field( 'reviews', $params );
if($reviews){
    $numReviews = count($reviews);
}else{
    $numReviews = 0;
}
// echo aawp_get_field_value($asin, 'price');
?>

<div class="jei12345" style="clear:both; min-height:73px; overflow:hidden;">
    <a href="<?php echo get_permalink($id_libro);?>" data-toggle="tooltip" title="Ficha del libro <?php echo $post_title;?>" class="badge badge-primary"><i class="fas fa-book"></i> Ficha</a>
    <?php if($reviews){ ?>
        <ul class="list-unstyled" style="margin:0;">
            <?php
                $i = 1;
                foreach ( $reviews as $review ) { 
                    $idA = $review[ 'ID' ];
                    $urlReview = esc_url( get_permalink( $idA ) );
                    $nombreReview = get_the_title( $idA );
                    ?>
                    <li>
                        <span class="badge badge-pill btn-secondary">
                            <i class="fas fa-clock" aria-hidden="true"></i> 
                            <?php echo date('d-m-y', strtotime($review['post_date']));?>
                        </span>
                        <a class="badge badge-danger" href="<?php echo $urlReview;?>" data-toggle="tooltip" title="Ficha del libro <?php echo $post_title;?>"><i class="fas fa-clipboard-list"></i> Review <?php echo $i;?></a>
                    </li>
                    <?php
                    $i++;
                }
            ?>
        </ul>
    <?php } ?>
</div>

        
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

$this->asin = $this->get_product_id();
$this->index = $this->item_index;
// $variables = $this->get_template_variables();
$this->ids = $this->get_template_variable( 'ids', false );

if( !is_array($this->ids) ){
    $this->ids = explode(',', $this->ids);
}

$this->id_libro =  $this->ids[ $this->index - 1 ];
$this->post_title = get_the_title($this->id_libro);

$this->pod = pods( 'libro', $this->id_libro );
$this->params = array( 
    'orderby' => 'post_date DESC'
); 
$this->reviews = $this->pod->field( 'reviews', $this->params );
if($this->reviews){
    $this->numReviews = count($this->reviews);
}else{
    $this->numReviews = 0;
}
// echo aawp_get_field_value($asin, 'price');
?>

<div class="<?php echo $this->get_product_container_classes('aawp-product aawp-product--vertical'); ?>" <?php $this->the_product_container(); ?>>

    <?php $this->the_product_ribbons(); ?>

    <a class="aawp-product__image--link aawp-product__image"
       href="<?php echo $this->get_product_image_link(); ?>" title="<?php echo $this->get_product_image_link_title(); ?>" rel="nofollow" target="_blank" style="background-image: url('<?php echo $this->get_product_image('large'); ?>');">
        <img class="aawp-product__image-spacer" src="<?php echo aawp_get_assets_url(); ?>img/thumb-spacer.png" alt="<?php echo $this->get_product_image_alt(); ?>" />
    </a>

    <div class="aawp-product__content">
        <a class="aawp-product__title" href="<?php echo $this->get_product_url(); ?>" title="<?php echo $this->get_product_link_title(); ?>" rel="nofollow" target="_blank">
            <?php echo $this->truncate( $this->get_product_title(), 50 ); ?>
        </a>

        <div class="aawp-product__meta">
            <?php if ( $this->get_product_rating() ) { ?>
                <?php echo $this->get_product_star_rating( array( 'size' => 'small' ) ); ?>
                <?php if ( $this->get_product_reviews() ) { ?>
                    <span class="aawp-product__reviews">(<?php echo $this->get_product_reviews( $label = false ); ?>)</span>
                <?php } ?>
            <?php } ?>

            <?php $this->the_product_check_prime_logo(); ?>

            <?php echo view('my-box', array('this2' => $this));?>

        </div>

    </div>


    <div class="aawp-product__footer">

        <div class="aawp-product__pricing">

            <?php if ( $this->get_product_is_sale() && $this->sale_show_old_price() ) { ?>
                <span class="aawp-product__price aawp-product__price--old"><?php echo $this->get_product_pricing('old'); ?></span>
            <?php } ?>

            <?php if ( $this->show_advertised_price() ) { ?>
                <span class="aawp-product__price aawp-product__price--current"><?php echo $this->get_product_pricing(); ?></span>
            <?php } ?>
        </div>

        <?php echo $this->get_button('detail'); ?>
        <?php echo $this->get_button(); ?>

        <?php if ( $this->get_inline_info() ) { ?>
            <span class="aawp-product__info"><?php echo $this->get_inline_info_text(); ?></span>
        <?php } ?>
    </div>
</div>

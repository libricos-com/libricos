<?php
/**
 * Standard horizontal template
 *
 * @var AAWP_Template_Functions $this
 */

if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

use App\Entity\Review;
$review = new Review($this);
?>

<div class="<?php echo $this->get_product_container_classes('aawp-product aawp-product--horizontal'); ?>" <?php $this->the_product_container(); ?>>

    <?php $this->the_product_ribbons(); ?>

    <div class="aawp-product__thumb">
        <a class="aawp-product__image-link"
           href="<?php echo $review->url_libro; ?>" title="<?php echo $this->get_product_image_link_title(); ?>" rel="nofollow" target="_blank">
            <img class="aawp-product__image" src="<?php echo $this->get_product_image(); ?>" alt="<?php echo $this->get_product_image_alt(); ?>" <?php $this->the_product_image_title(); ?> />
        </a>

        <?php if ( $this->get_product_rating() ) { ?>
            <div class="aawp-product__rating">
                <?php echo $this->get_product_star_rating(); ?>

                <?php if ( $this->get_product_reviews() ) { ?>
                    <div class="aawp-product__reviews"><?php echo $this->get_product_reviews(); ?></div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

    <div class="aawp-product__content">
    
        <?php echo view('../partials/chip', ['this2' =>  $review]);?>
        
        <a class="aawp-product__title" href="<?php echo $this->get_product_url();?>" title="<?php echo $this->get_product_link_title(); ?>" rel="nofollow" target="_blank">
            <?php echo $this->get_product_title();?>
        </a>

        <div class="aawp-product__description">
            <?php //echo $review->get_product_description();?>
            <?php echo view('../partials/libro-autores', ['this2' =>  $review]);?>
        </div>

        <?php echo view('../partials/review-summary', ['this2' =>  $review]);?>

    </div>

    <div class="aawp-product__footer">

        <div class="aawp-product__pricing">
            <?php if ( $this->product_is_on_sale() ) { ?>
                <?php if ( $this->sale_show_old_price() ) { ?>
                    <span class="aawp-product__price aawp-product__price--old"><?php echo $this->get_product_pricing('old'); ?></span>
                <?php } ?>
                <?php if ( $this->sale_show_price_reduction() ) { ?>
                    <span class="aawp-product__price aawp-product__price--saved"><?php echo $this->get_saved_text(); ?></span>
                <?php } ?>
            <?php } ?>

            <?php if ( $this->show_advertised_price() ) { ?>
                <span class="aawp-product__price aawp-product__price--current"><?php echo $this->get_product_pricing(); ?></span>
            <?php } ?>

            <?php $this->the_product_check_prime_logo(); ?>
        </div>

        <?php echo $this->get_button('detail'); ?>
        <?php echo $this->get_button(); ?>

        <?php if ( $this->get_inline_info() ) { ?>
            <span class="aawp-product__info"><?php echo $this->get_inline_info_text(); ?></span>
        <?php } ?>
    </div>

</div>

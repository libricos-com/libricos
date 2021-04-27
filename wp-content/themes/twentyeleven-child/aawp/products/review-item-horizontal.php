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
$urlLibro = $review->url_libro;
// $url = $this->get_product_url();

// $imgProduct = $this->get_product_image();
// $id = $review->getReviewIdWp(); 
// $img = get_the_post_thumbnail_url($id, 'medium'); // large, thumbnail, post_thumbnail, medium  
?>

<div class="container-fluid p-3 rounded lbc-review-item-h <?php echo $this->get_product_container_classes('aawp-product'); ?>" <?php $this->the_product_container(); ?>>

    <?php $this->the_product_ribbons(); ?>

    <div class="row">

        <div class="col-sm-2 col-md-2 aawp-product__thumb">
            <a class="aawp-product__image-link"
            href="<?php echo $urlLibro; ?>" title="<?php echo $this->get_product_image_link_title(); ?>" target="_blank">
                <img class="aawp-product__image rounded" src="<?php echo $this->get_product_image('large');?>" alt="<?php echo $this->get_product_image_alt(); ?>" <?php $this->the_product_image_title(); ?> />
            </a>

            <?php if ( $this->get_product_rating() ) { ?>
                <div class="aawp-product__rating">
                    <?php echo $this->get_product_star_rating(); ?>

                    <?php if ( $this->get_product_reviews() ) { ?>
                        <div class="aawp-product__reviews"><?php echo $this->get_product_reviews();?></div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>

        <div class="col-sm-10 col-md-10 aawp-product__content">
        
            <h2 class="h4"><a href="<?php echo $review->url_review;?>" alt=""><?php echo $review->post_title;?></a></h2>

            <?php echo view('../partials/publish-info', ['this2' => $review]);?>
                
            <h3>
                <a class="aawp-product__title" href="<?php echo $this->get_product_url();?>" title="<?php echo $this->get_product_link_title(); ?>" rel="nofollow" target="_blank">
                    <?php echo $this->get_product_title();?>
                </a>
            </h3>

            <div class="aawp-product__description">
                <?php //echo $review->get_product_description();?>
                <?php echo view('../partials/libro-autores', ['this2' =>  $review]);?>
            </div>

            <div class="review-summary">
                <span class="summary">
                    <p class="collapse font-italic" id="collapseSummary_idreview_<?php echo $review->getReviewIdWp();?>">
                        <?php echo $review->texto;?>
                    </p>
                    <a class="collapsed" data-toggle="collapse" href="#collapseSummary_idreview_<?php echo $review->getReviewIdWp();?>" aria-expanded="false" aria-controls="collapseSummary_idreview_<?php echo $review->getReviewIdWp();?>"></a>
                </span> 
            
                <span class="float-right">
                    <ul class="list-inline-bullets">
                        <li class="list-inline-item">
                            <i class="far fa-comments"></i> <?php echo $review->num_comments;?> 
                            <a href="<?php echo the_permalink($review->getReviewIdWp());?>#respond" alt="Deja tu comentario">Comenta</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="<?php echo $review->url_review;?>" alt="">Ver reseña</a>
                        </li>
                        <?php
                        if(!empty($review->goodreads_url)){
                        ?>
                            <li class="list-inline-item">
                                <i class="fab fa-goodreads"> 
                                <a href="<?php echo $review->goodreads_url;?>" alt="">Goodreads review</i></a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </span>
            </div>

        </div>

        <div class="col-sm-12 col-md-12 aawp-product__footer text-right">

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

</div>

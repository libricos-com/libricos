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

use App\Entity\BookAmazonFactory;
$libro = BookAmazonFactory::create($this);
$urlLibro = $libro->getUrl();
// $urlProducto = $this->get_product_url();

$numNotas = 0;
$notas = $libro->getNotas();
if($notas){
    $numNotas = count($notas);
}
?>

<div class="jei-amz-grd <?php echo $this->get_product_container_classes('aawp-product aawp-product--vertical');?>" <?php $this->the_product_container(); ?>>

    <?php if($libro->getReviews()){
        echo view('/../partials/review-list-amazon-box', array('this2' => $libro));
    }?>
    
    <?php $this->the_product_ribbons(); ?>

    <a class="aawp-product__image--link aawp-product__image"
       href="<?php echo $urlLibro;?>" title="Ficha libro: <?php echo $this->get_product_image_link_title();?>" rel="nofollow" target="_blank">
        <img class="aawp-product__image" src="<?php echo $this->get_product_image('large'); ?>" alt="<?php echo $this->get_product_image_alt(); ?>" <?php $this->the_product_image_title(); ?> />
    </a>

    <?php if($numNotas > 0){ ?>
        <div class="d-flex flex-wrap justify-content-start top-right flex-row-reverse">
            <a href="<?php echo $urlLibro;?>#notas" data-toggle="tooltip" title="Ver notas del libro <?php echo $this->get_product_image_link_title();?>"><i class="fas fa-bookmark fa-2x text-primary"> <?php echo $numNotas;?></i>
            </a>
        </div>
    <?php }?>

    <div class="aawp-product__content">
        <a class="aawp-product__title" href="<?php echo $urlLibro;?>" title="<?php echo $this->get_product_link_title(); ?>" target="_blank">
            <?php echo $this->truncate( $this->get_product_title(), 50 ); ?>
        </a>

        <div class="aawp-product__meta">

            <?php //echo view('../partials/rating', ['this2' =>  $this]);?>

            <?php if ( $this->get_product_rating() ) { ?>
                <?php echo $this->get_product_star_rating( array( 'size' => 'small' ) ); ?>
                <?php if ( $this->get_product_reviews() ) { ?>
                    <span class="aawp-product__reviews">(<?php echo $this->get_product_reviews( $label = false ); ?>)</span>
                <?php } ?>
            <?php } ?>

            <div class="aawp-correccion-altura">
                <?php $this->the_product_check_prime_logo(); ?>
            </div>

            
            <?php if(!$libro->getReviews() && $libro->getEstado()){
                // echo view('/../partials/libro-estado', array('this2' => $libro));
            }
            ?>
            

        </div>

    </div>


    <div class="aawp-product__footer">

        <div class="aawp-product__pricing">
            <div class="aawp-correccion-altura">
                <?php if ( $this->get_product_is_sale() && $this->sale_show_old_price() ) { ?>
                    <span class="aawp-product__price aawp-product__price--old"><?php echo $this->get_product_pricing('old'); ?></span>
                <?php } ?>
            </div>

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

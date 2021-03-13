<?php 
global $post;
use App\Entity\Review;
$review = new Review($post);

$keywords = $review->libroTitle;
if(!empty($review->autores[0]['post_title'])){
    $keywords = $review->autores[0]['post_title'];
}
// TODO: review pasar keywords a bbdd? 
// Review 5 lenguajes del amor
$id = $review->getReviewIdWp();
if($id == 10215){
    $keywords = 'peregrino ruso';
}elseif($id == 383){
    $keywords = 'apariciones fatima';
}
?>

<div class="lbc-file">

    <h1 class="lbc-h1"><?php echo $review->post_title;?></h1>

    <?php echo view('../partials/publish-info', ['this2' => $review]);?>

    <div class="mt-3">
        <?php echo do_shortcode("[addthis tool='addthis_inline_share_toolbox_qzzu']");?>
    </div>

    <hr />

    <div>
        <div class="d-flex justify-content-end float-right col-sm-6 col-md-4">
            <?php 
            echo do_shortcode('[amazon box="'.$review->asin.'" template="vertical-book" style="dark" value="thumb" image_size="large" tpl_urllibro="'.$review->url_libro.'"]');
            ?>
        </div>
        <div class="lbc-contenido">
            <?php echo $review->contenido;?>
        </div>  
    </div>

</div>

<hr />

<h2>Libros similares a <?php echo $review->libroTitle;?></h2>

<div class="text-center p-2">
    <?php echo do_shortcode('[amazon template="vertical" grid="4" bestseller="'.$keywords.'"]');?>
</div>


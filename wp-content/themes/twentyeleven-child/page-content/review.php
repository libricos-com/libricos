<?php 
    global $post;
    use App\Entity\Review;
    $review = new Review($post);
?>

<div class="lbc-file">

    <h1 class="lbc-h1"><?php echo $review->post_title;?></h1>

    <?php echo view('../partials/publish-info', ['this2' => $review]);?>

    <div class="mt-3">
        <?php echo do_shortcode("[addthis tool='addthis_inline_share_toolbox_qzzu']");?>
    </div>

    <hr />

    <div>
        <div class="d-flex justify-content-end float-right col-md-4">
            <?php echo do_shortcode(' [amazon box="'.$review->asin.'" template="vertical" style="dark" value="thumb" image_size="large"] ');?>
        </div>
        <div class="lbc-contenido">
            <?php echo $review->contenido;?>
        </div>  
    </div>

    <ul>
        <li><strong>Mi puntuación</strong>: <?php echo $review->get_rating();?></li>
        <li><a href="<?php echo $review->getGoodreadsUrl();?>">Reseña en Goodreads</a></li>
    </ul>

</div>

<hr />
<div class="text-center p-2">
    <?php echo do_shortcode('[amazon box="'.$review->asin.'"]');?>
</div>
<hr />

<h2>Similares</h2>
<div class="text-center p-2">
    <?php echo do_shortcode('[amazon bestseller="'.$review->libroTitle.'"]');?>
</div>


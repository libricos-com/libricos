<?php
$rating = $linkHtml = $textoLink = '';
$valor = $valorPercent = 0;

$textoLink = 'ha reseñado';
$urlReview = '';
if(!empty($this2->url_review)){
    $urlReview = $this2->url_review;
}
if(!empty($review)){
    // Venimos desde nota.php (review)
    $valor = $review->get_rating();
    $valorPercent = $review->get_rating_percent(); 
    $textoLink = 'reseñó';
    $urlReview = $review->url_review;
}
$linkHtml = '<a href="'.$urlReview.'" title="Libro reseñado">'.$textoLink.'</a> ';
if(empty($url_review)){
    $linkHtml = $textoLink;
}

$categories = get_the_category();
if(!empty($categories[0])){
    $referer = $categories[0]->slug;
    if($referer == 'reviews' ) {
        $linkHtml = $textoLink;
    }
}
$rating = '<span>&nbsp;'.$linkHtml;


// TODO: pasar lógica partial publish-info a un nivel mayor
if( method_exists($this2, 'get_rating') ){
    // Venimos desde libro, review
    $valor = $this2->get_rating();
    $valorPercent = $this2->get_rating_percent();
}

$rating .= view('../partials/rating', ['this2' => (object) ['puntuacion' => $valor, 'rating_percent' => $valorPercent] ] );

$rating .= '</span>';


if($valor == 0 && empty($review)){
    $rating = ''; 
}
?>

<div class="d-flex flex-row w-100">
    <div class="chip">
        <a href="<?php echo get_site_url();?>/about/" title="Post by Libricos">
            <img src="<?php echo get_site_url();?>/wp-content/uploads/2019/10/cropped-20160915_202651-02-01.jpeg" alt="Post by Libricos">
        </a>
    </div> 
    
    <?php echo $rating;?> 
    <?php if(!empty($urlReview) && get_post_type() !== 'review'){ ?>
        &nbsp; <a href="<?php echo $urlReview;?>">Ver reseña</a>
    <?php } ?>

    <div class="ml-auto">
        <?php echo view('../partials/review-fecha', ['this2' =>  $this2]);?>
    </div> 
</div>
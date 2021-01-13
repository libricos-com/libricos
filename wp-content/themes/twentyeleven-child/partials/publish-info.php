<?php
// TODO: pasar esta lógica a un nivel mayor:
if( method_exists($this2, 'get_rating') ){

    $rating = '<span>&nbsp;ha reseñado ';

    $rating .= view('../partials/rating', ['this2' => (object) ['puntuacion' => $this2->get_rating(), 'rating_percent' => $this2->get_rating_percent()] ] );

    $rating .= '</span>';
}else{
    $rating = '';
}
?>

<div class="d-flex flex-row">
    <div class="chip">
        <a href="<?php echo get_site_url();?>/about/" target="blank" alt="El autor del sitio hace una reseña">
            <img src="<?php echo get_site_url();?>/wp-content/uploads/2019/10/cropped-20160915_202651-02-01.jpeg" alt="Contact Libricos.com">
        </a>
    </div> 
    
    <?php echo $rating;?>

    <div class="ml-auto">
        <?php echo view('../partials/review-fecha', ['this2' =>  $this2]);?>
    </div> 
</div>
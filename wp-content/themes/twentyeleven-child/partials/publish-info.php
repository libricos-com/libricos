<?php
// TODO: pasar lógica partial publish-info a un nivel mayor
if( method_exists($this2, 'get_rating') ){
    $link = 'ha reseñado ';
    $categories = get_the_category();
    if(!empty($categories[0])){
        $referer = $categories[0]->slug;
        if( $referer == 'libros' ) {
            $link = '<a href="'.$this2->url_review.'">ha reseñado</a> ';
        }
    }
    
    $rating = '<span>&nbsp;'.$link;

    $rating .= view('../partials/rating', ['this2' => (object) ['puntuacion' => $this2->get_rating(), 'rating_percent' => $this2->get_rating_percent()] ] );

    $rating .= '</span>';
}else{
    $rating = '';
}
?>

<div class="d-flex flex-row">
    <div class="chip">
        <a href="<?php echo get_site_url();?>/about/" title="Post by Libricos">
            <img src="<?php echo get_site_url();?>/wp-content/uploads/2019/10/cropped-20160915_202651-02-01.jpeg" alt="Post by Libricos">
        </a>
    </div> 
    
    <?php echo $rating;?>

    <div class="ml-auto">
        <?php echo view('../partials/review-fecha', ['this2' =>  $this2]);?>
    </div> 
</div>
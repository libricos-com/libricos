<div>
    <div class="chip">
        <img src="<?php echo get_site_url();?>/wp-content/uploads/2019/10/cropped-20160915_202651-02-01.jpeg" alt="Contact Person">
        <a href="<?php echo get_site_url();?>/about/" target="blank" alt="El autor del sitio hace una reseña">Jesuserro</a>
    </div> ha reseñado <?php echo view('../partials/rating', ['this2' =>   (object) ['puntuacion' => $this2->get_rating(), 'rating_percent' => $this2->get_rating_percent()] ] );?>
</div>
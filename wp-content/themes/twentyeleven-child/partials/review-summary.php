<div class="review-summary">
    <strong>Jesuserro</strong> dijo en <a href="<?php echo $this2->url_review;?>" alt=""><?php echo $this2->post_title;?></a>
    <!-- https://codepen.io/joserick/pen/ooVPwR -->
    <span class="summary">
        <p class="collapse" id="collapseSummary_idreview_<?php echo $this2->id_review;?>">
            <?php echo $this2->texto;?>
        </p>
        <a class="collapsed" data-toggle="collapse" href="#collapseSummary_idreview_<?php echo $this2->id_review;?>" aria-expanded="false" aria-controls="collapseSummary_idreview_<?php echo $this2->id_review;?>"></a>
    </span> 
 
    <span class="float-right">
        <ul class="list-inline-bullets">
            <li class="list-inline-item"><a href="" alt=""><?php echo $this2->num_comments;?> comentarios</a></li>
            <li class="list-inline-item"><a href="<?php echo $this2->url_review;?>" alt="">Ir a reseña</a></li>
        </ul>
    </span>
</div>
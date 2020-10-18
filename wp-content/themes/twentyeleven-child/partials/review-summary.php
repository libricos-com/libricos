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
            <li class="list-inline-item">
                <i class="far fa-comments"></i> <?php echo $this2->num_comments;?> 
                <a href="<?php echo the_permalink($this2->id_review);?>#respond" alt="Deja tu comentario">Comenta</a>
            </li>
            <li class="list-inline-item">
                <a href="<?php echo $this2->url_review;?>" alt="">Ver reseña</a>
            </li>
            <?php
            if(!empty($this2->url_goodreads)){
            ?>
                <li class="list-inline-item">
                    <i class="fab fa-goodreads"> 
                    <a href="<?php echo $this2->url_goodreads;?>" alt="">Goodreads review</i></a>
                </li>
            <?php
            }
            ?>
        </ul>
    </span>
</div>
<div class="container-fluid p-3 rounded aawp-product lbc-home-item" data-aawp-product-title="<?php echo $this2->post_title;?>">

    <div class="row">

        <div class="col-sm-2 col-md-2 aawp-product__thumb">
            <a class="aawp-product__image-link" href="<?php echo $this2->urlArticulo; ?>" title="<?php echo $this2->post_title; ?>" target="_blank">
                <img class="img-fluid rounded" src="<?php echo $this2->pic; ?>" alt="<?php echo $this2->post_title; ?>">
            </a>
        </div>

        <div class="col-sm-10 col-md-10 aawp-product__content mb-3">
            <div>
        
                <div class="review-date">
                    <span class="badge badge-secondary">
                        <i class="far fa-calendar-check" aria-hidden="true"></i>
                    </span> <?php echo $this2->fecha; ?>
                </div>
            </div>

            <a class="h3" href="<?php echo $this2->urlArticulo; ?>" title="<?php echo $this2->post_title;?>" target="_blank">
            <?php echo $this2->post_title;?></a>
            

            <div class="aawp-product__description">

                Por <div class="chip align-bottom">
                        <a href="/about/" target="blank" alt="Autor Libricos.com"><img src="/wp-content/uploads/2019/10/cropped-20160915_202651-02-01.jpeg" alt="Contact Libricos.com"></a>
                    </div>
        
            </div>

            <div class="review-summary">
        
                <span class="summary">
                    <p class="collapse font-italic" id="collapseSummary_idreview<?php echo $this2->ID;?>">
                        <?php echo $this2->firstParagraph;?></p>
                    <a class="collapsed" data-toggle="collapse" href="#collapseSummary_idreview<?php echo $this2->ID;?>" aria-expanded="false" aria-controls="collapseSummary_idreview<?php echo $this2->ID;?>"></a>
                </span>

                <span class="float-right">
                    <ul class="list-inline-bullets">
                        <li class="list-inline-item">
                            <i class="far fa-comments"></i> 0
                            <a href="<?php echo $this2->urlArticulo;?>#comments" alt="Deja tu comentario">Comentarios</a>
                        </li>
                                </ul>
                </span>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 aawp-product__footer">

            <?php echo do_shortcode("[addthis tool='addthis_inline_share_toolbox_qzzu']");?>
            
        </div>

    </div>

</div>

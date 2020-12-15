<!-- <span class="patatab badge badge-pill badge-success">
    <i class="fas fa-check fa-4x" aria-hidden="true"></i>
</span>  -->

<div class="review-list-amazon-box">
    <ul class="list-unstyled">
        <?php
            foreach ( $this2->getReviews() as $review ) { 
                $id_review = $review[ 'ID' ];
                $urlReview = esc_url( get_permalink( $id_review ) );
                $nombreReview = get_the_title( $id_review );
                $pod_id = $review['pod_item_id'];
                $pod = pods('review', $pod_id);
                $puntuacion = round($pod->field('rating'), 1);
                ?>
                <li>
                    <a class="nounderline" href="<?php echo $urlReview;?>" data-toggle="tooltip" title="Reseña: <?php echo $nombreReview;?>">
                        <div class="number-circle bg-success">                         
                            <span class="text-light"><?php echo $puntuacion;?></span><small class="mismall">/5</small>       
                        </div>
                    </a>
                </li>
                <?php
            }
        ?>
    </ul>
</div>



        
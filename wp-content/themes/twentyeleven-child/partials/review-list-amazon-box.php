
<?php if( $this2->getReviews() ){ ?>
    <ul class="list-unstyled">
        <?php
            $i = 1;
            foreach ( $this2->getReviews() as $review ) { 
                $id_review = $review[ 'ID' ];
                $urlReview = esc_url( get_permalink( $id_review ) );
                $nombreReview = get_the_title( $id_review );
                $pod_id = $review['pod_item_id'];
                $pod = pods('review', $pod_id);
                $puntuacion = round($pod->field('rating'), 1);
                ?>
                <li>
                    <div><small class="align-middle"><?php echo get_fecha_corta($id_review);?></small></div>
                    <a class="badge badge-success align-middle" href="<?php echo $urlReview;?>" data-toggle="tooltip" title="Ficha del libro <?php echo $this2->get_titulo();?>">
                        <i class="fas fa-check align-middle"></i>
                        Reviewed
                    </a>  
                    <i class="fas fa-star align-middle color-yellow"></i> <h6 class="bold d-inline align-middle"><span class="text-success"><?php echo $puntuacion;?></span><small>/5</small></h6>   
                </li>
                <?php
                $i++;
            }
        ?>
    </ul>
<?php } ?>


        
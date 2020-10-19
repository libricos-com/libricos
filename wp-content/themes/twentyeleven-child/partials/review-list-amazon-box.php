<div class="review-list-amazon-box">
    <?php if($this2->reviews){ ?>
        <ul class="list-unstyled">
            <?php
                $i = 1;
                foreach ( $this2->reviews as $review ) { 
                    $id_review = $review[ 'ID' ];
                    $urlReview = esc_url( get_permalink( $id_review ) );
                    $nombreReview = get_the_title( $id_review );
                    ?>
                    <li>
                        <a class="badge badge-success" href="<?php echo $urlReview;?>" data-toggle="tooltip" title="Ficha del libro <?php echo $this2->post_title;?>">
                            <i class="fas fa-check"></i>
                            Reviewed
                        </a> 
                        <small><?php echo get_fecha_larga($id_review);?></small>   
                    </li>
                    <?php
                    $i++;
                }
            ?>
        </ul>
    <?php } ?>
</div>

        
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
                        <span class="badge badge-secondary">
                            <i class="fas fa-clock" aria-hidden="true"></i> 
                        </span>  
                        <?php echo get_fecha_corta($id_review);?>
                        <a class="badge badge-danger" href="<?php echo $urlReview;?>" data-toggle="tooltip" title="Ficha del libro <?php echo $this2->post_title;?>"><i class="fas fa-clipboard-list"></i> Review <?php echo $i;?></a>
                    </li>
                    <?php
                    $i++;
                }
            ?>
        </ul>
    <?php } ?>
</div>

        
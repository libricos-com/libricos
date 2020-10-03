<div class="my-box">
    <?php if($this2->reviews){ ?>
        <ul class="list-unstyled">
            <?php
                $i = 1;
                foreach ( $this2->reviews as $review ) { 
                    $idA = $review[ 'ID' ];
                    $urlReview = esc_url( get_permalink( $idA ) );
                    $nombreReview = get_the_title( $idA );
                    ?>
                    <li>
                        <span class="badge badge-pill btn-secondary">
                            <i class="fas fa-clock" aria-hidden="true"></i> 
                            <?php echo date('d-m-y', strtotime($review['post_date']));?>
                        </span>
                        <a class="badge badge-danger" href="<?php echo $urlReview;?>" data-toggle="tooltip" title="Ficha del libro <?php echo $this2->post_title;?>"><i class="fas fa-clipboard-list"></i> Review <?php echo $i;?></a>
                    </li>
                    <?php
                    $i++;
                }
            ?>
        </ul>
    <?php } ?>
</div>

        
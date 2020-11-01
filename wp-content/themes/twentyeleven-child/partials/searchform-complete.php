
<div class="card">
    <div class="card-body">
        
        <?php echo view('../searchform', ['this2' => $this2 ]);?>

        <h4 class="card-title">Busca por categoría <i class="fas fa-tag"></i></h4>

        <ul class="jei-tag-cloud list-unstyled">  
            <?php 
            foreach ( $this2->terms as $term ) {
            ?>
                <li class="d-inline">
                    <a href="<?php echo get_term_link($term->term_id);?>" class="btn m-1">
                        <?php echo $term->name;?> 
                        <span class="badge badge-light"><?php echo $term->count;?></span>
                    </a>
                </li>
            <?php 
            }
            ?>
        </ul>
    </div>
</div>

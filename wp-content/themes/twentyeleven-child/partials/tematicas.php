
<div class="lbc-search-complete card">
    <div class="card-body">
        
        <h4 class="card-title">Todos los géneros</h4>

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

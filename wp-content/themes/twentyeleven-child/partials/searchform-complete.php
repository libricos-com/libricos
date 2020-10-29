
<div class="card">
    <div class="card-body">
        
        <?php echo view('../searchform', ['this2' => $this2 ]);?>

        <h4 class="card-title">Busca por categoría <i class="fas fa-tag"></i></h4>
            
        <?php 
        $i = 0;
        foreach ( $this2->terms as $term ) {
            $index = array_rand ($this2->colors);
        ?>
            <a href="<?php echo get_term_link($term->term_id);?>" class="btn btn-<?php echo $this2->colors[$i];?> m-1">
                <?php echo $term->name;?> 
                <span class="badge badge-light"><?php echo $term->count;?></span>
            </a>
        <?php 
            $i++;
            if($i > count($this2->colors) - 1){
                $i = 0;
            }  
        }
        ?>
    </div>
</div>

<div class="aawp-libro-estado">    
    <a class="badge badge-<?php echo $this2->getEstado()->color;?>" href="<?php echo $this2->getEstado()->url_libro;?>" 
        data-toggle="tooltip" 
        title="<?php echo $this2->getEstado()->tooltip;?>">
            <i class="fas fa-<?php echo $this2->getEstado()->icon_cls;?>"></i>
            <?php echo $this2->getEstado()->txt;?>
    </a> 
</div>

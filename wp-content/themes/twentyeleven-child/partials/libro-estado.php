<div>    
    <a class="badge badge-<?php echo $this2->get_estado()->color;?>" href="<?php echo $this2->get_estado()->url_libro;?>" 
        data-toggle="tooltip" 
        title="<?php echo $this2->get_estado()->tooltip;?>">
            <i class="fas fa-<?php echo $this2->get_estado()->icon_cls;?>"></i>
            <?php echo $this2->get_estado()->txt;?>
    </a> 
</div>
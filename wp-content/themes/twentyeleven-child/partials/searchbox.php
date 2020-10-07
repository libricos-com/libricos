<?php 
$txt = 'Buscar en este sitio';
?>

<div class="jeisearchbox input-group">
    <div class="input-group-prepend">
        <div class="input-group-text"><i class="fa fa-search"></i></div>
    </div>
    <input class="form-control py-2 border-right-0 border" type="search" placeholder="<?php echo $txt;?>" onfocus="this.placeholder=''" onblur="this.placeholder='<?php echo $txt;?>'">
    <span class="input-group-append">
        <button class="btn btn-outline-secondary border-left-0 border input-group-text" type="button">Buscar</button>
    </span>
</div>

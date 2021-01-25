<?php
// TODO: pasar lógica partial review-fecha a un nivel mayor:
if( method_exists($this2, 'get_post_date') ){
    $fecha = $this2->get_post_date();
}else{
    $fecha = get_the_date('d F Y');
}
?>

<div class="review-date">
    <span class="badge badge-secondary">
        <i class="far fa-calendar-check" aria-hidden="true"></i> 
    </span> <?php echo $fecha;?>
</div>
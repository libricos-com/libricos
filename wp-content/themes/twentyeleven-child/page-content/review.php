<?php 
    global $post;
    $postType = get_post_type();
    $id = get_the_id();

    $titulo = get_post_meta( $id, 'titulo', true );
    $post_title = get_the_title();
    $url = esc_url( get_permalink( $id ) );

    $texto = get_post_meta($id,'contenido')[0];
    $puntuacion = get_post_meta($id,'rating')[0];
    $goodreads_url = get_post_meta($id,'goodreads_url')[0];
    
    //get Pods object for current post
    $pod = pods( 'review', $id );

    $libro = $pod->field( 'libro' );
    $asin = get_post_meta($libro['ID'],'asin')[0];
    $portada = get_post_meta($libro['ID'],'portada');

    $src = get_the_post_thumbnail_url( $id, 'post_thumbnail'  );

    $fecha = get_the_date('d F Y');

    $libro_link = get_permalink($libro['ID']);
    $libro_title = get_the_title($libro['ID']);
?>

<h1 class="lbc-h1"><?php echo $post_title;?></h1>

<?php echo view('../partials/publish-info', array('fechaPublicacion' => $fecha));?>

<div>
    <?php echo do_shortcode("[addthis tool='addthis_inline_share_toolbox_qzzu']");?>
</div>

<hr />

<div class="float-right w-30 p-3">
    <?php echo do_shortcode('[amazon box="'.$asin.'" template="vertical"]');?>
</div>


<?php echo $texto;?>

<ul>
    <li><strong>Mi puntuación</strong>: <?php echo $puntuacion;?></li>
    <li><a href="<?php echo $goodreads_url;?>">Reseña en Goodreads</a></li>
</ul>

<hr />
<div class="text-center p-2">
    <?php echo do_shortcode('[amazon box="'.$asin.'"]');?>
</div>
<hr />

<h2>Similares</h2>
<div class="text-center p-2">
    <?php echo do_shortcode('[amazon bestseller="'.$libro_title.'"]');?>
</div>


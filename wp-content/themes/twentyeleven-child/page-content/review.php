<?php 
    global $post;
    $postType = get_post_type();
    $id = get_the_id();

    $titulo = get_post_meta( $id, 'titulo', true );
    $post_title = get_the_title();
    $url = esc_url( get_permalink( $id ) );

    $texto = get_post_meta($id,'texto')[0];
    $entradilla = get_post_meta($id,'entradilla')[0];
    $puntuacion = get_post_meta($id,'puntuacion')[0];
    $url_goodreads = get_post_meta($id,'url_goodreads')[0];
    
    //get Pods object for current post
    $pod = pods( 'review', $id );

    $libro = $pod->field( 'libro' );
    $asin = get_post_meta($libro['ID'],'asin')[0];
    $portada = get_post_meta($libro['ID'],'portada');
    $src = wp_get_attachment_image_src($portada[0]['ID'], 400);

    $fecha = get_the_date('d F Y');

    $libro_link = get_permalink($libro['ID']);
    $libro_title = get_the_title($libro['ID']);
?>



<div class="entry-content">
    <strong>Fecha reseña</strong>: <?php echo $fecha;?> 

    <div class="text-center mb-4">
        <a href="<?php echo $libro_link;?>"><img src="<?php echo $src[0];?>" alt="Portada del libro <?php echo $titulo;?>" class="img-fluid" /></a>
        <div><?php // echo get_kkstarring();?></div>
    </div>

    <p><?php echo $entradilla;?></p>
    <p><?php echo $texto;?></p>

    <ul>
        <li><strong>Mi puntuación</strong>: <?php echo $puntuacion;?></li>
        <li><a href="<?php echo $url_goodreads;?>">Reseña en Goodreads</a></li>
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

</div>
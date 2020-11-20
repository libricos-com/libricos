<?php 
    global $post;
    $postType = get_post_type();
    $id = get_the_id();

    $titulo = get_post_meta( $id, 'titulo', true );
    $post_title = get_the_title();
    $url = esc_url( get_permalink( $id ) );

    $texto = get_post_meta($id,'contenido')[0];
    $url = get_post_meta($id,'url')[0];
    
    //get Pods object for current post
    $pod = pods( 'editorial', $id );
    // $portada = $pod->field( 'portada' );
    // $portada = wp_get_attachment_image_src($portada['ID'], 400)[0];

    $libros = $pod->field( 'libros' );
    $asins = $ids = '';
    foreach ( $libros as $libro ){
        $id = $libro['ID'];
        $libro = pods( 'libro', $id );
        $asin = $libro->field( 'asin' );
        if(empty($asin)){
            continue;
        }
        $asins .= $asin.',';
        $ids .= $id.',';
    }
    
    // Remove duplicate ids 
    $asins = implode(',', array_unique(explode(',', $asins)));
    $ids = implode(',', array_unique(explode(',', $ids)));

    // and remove last comma
    $asins = rtrim($asins,',');
    $ids = rtrim($ids,',');
    $fecha = get_the_date('d F Y');
?>

<h1 class="text-center"><?php echo $post_title;?></h1>
Publicado el <?php echo $fecha;?> 

<p><?php echo $texto;?></p>
<div><a href="<?php echo $url;?>">Web de la editorial</a></div>

<hr />
<h2>Bibliografía</h2>
<div class="text-center p-2">
    <?php echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3" template="my-vertical"]');?>
</div>





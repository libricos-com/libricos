<?php 
    global $post;
    $postType = get_post_type();
    $id = get_the_id();

    $titulo = get_post_meta( $id, 'titulo', true );
    $post_title = get_the_title();
    $url = esc_url( get_permalink( $id ) );

    $texto = get_post_meta($id,'contenido')[0];
  
    //get Pods object for current post
    $pod = pods( 'nota', $id );

    $libro = $pod->field( 'libro' );
    $asin = get_post_meta($libro['ID'],'asin')[0];
    $portada = get_post_meta($libro['ID'],'portada');
    
    $src = get_the_post_thumbnail_url( $id, 'post_thumbnail'  );

    $fecha = get_the_date('d F Y');

    $libro_link = get_permalink($libro['ID']);
    $libro_title = get_the_title($libro['ID']);
    $titulo_a_secas = get_post_meta($libro['ID'],'titulo')[0];
?>

<h1 class="lbc-h1"><?php echo $post_title;?></h1>

<?php echo view('../partials/publish-info', array('fechaPublicacion' => $fecha));?>

<div>
    <?php echo do_shortcode("[addthis tool='addthis_inline_share_toolbox_qzzu']");?>
</div>

<hr />

<div class="text-center mb-4">
    <a href="<?php echo $libro_link;?>">
        <img src="<?php echo $src;?>" alt="<?php echo $titulo;?>" class="img-fluid" />
    </a>
    <div class="float-right w-30 p-3">
        <?php echo do_shortcode('[amazon box="'.$asin.'" template="vertical"]');?>
    </div>
</div>

<?php echo $texto;?>

<hr />
<div class="text-center p-2">
    <?php echo do_shortcode('[amazon box="'.$asin.'"]');?>
</div>
<hr />

<h2>Libros similares a <?php echo $titulo_a_secas;?></h2>
<?php 
$searchkeys = $titulo_a_secas;
if($id == 8734){ // nota 4 amores, la mejor posicionada
    // $searchkeys = 'libros+cristianos';
    // $searchkeys = 'C.S. Lewis';
}
?>

<hr />

<div class="text-center p-2">
    <?php echo do_shortcode('[amazon bestseller="'.$searchkeys.'" items="12"]');?>
</div>


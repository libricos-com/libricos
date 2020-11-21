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
    $src = wp_get_attachment_image_src($portada[0]['ID'], 400);

    $fecha = get_the_date('d F Y');

    $libro_link = get_permalink($libro['ID']);
    $libro_title = get_the_title($libro['ID']);
    $titulo_a_secas = get_post_meta($libro['ID'],'titulo')[0];
?>

<h1><?php echo $post_title;?></h1>

<strong>Fecha publicación</strong>: <?php echo $fecha;?> 

<div class="text-center mb-4">
    <a href="<?php echo $libro_link;?>"><img src="<?php echo $src[0];?>" alt="Portada del libro <?php echo $titulo;?>" class="img-fluid" /></a>
</div>

<?php echo $texto;?>

<hr />
<div class="text-center p-2">
    <?php echo do_shortcode('[amazon box="'.$asin.'"]');?>
</div>
<hr />

<h2>Similares</h2>
<?php 
$searchkeys = $titulo_a_secas;
if($id == 8734){ // nota 4 amores, la mejor posicionada
    // $searchkeys = 'libros+cristianos';
    // $searchkeys = 'C.S. Lewis';
}
?>
<div class="text-center p-2">
    <?php echo do_shortcode('[amazon bestseller="'.$searchkeys.'" items="12"]');?>
</div>


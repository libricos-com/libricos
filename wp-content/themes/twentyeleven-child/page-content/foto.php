<?php 
/*
The template for displaying content in the single-foto.php template
@see: https://docs.pods.io/tutorials/get-values-from-a-relationship-field/
*/
global $post;

$postType = get_post_type();
$id = get_the_id();

$titulo = get_post_meta( $id, 'titulo', true );
$post_title = get_the_title();
$url = esc_url( get_permalink( $id ) );

$texto = get_post_meta($id,'contenido')[0];
$goodreads_url = get_post_meta($id,'instagram_url')[0];
$portada = get_post_meta($id,'portada');
$src = wp_get_attachment_image_src($portada[0]['ID'], 400);

$fecha = get_the_date('d F Y');
?>

<h1><?php echo $post_title;?></h1>

<strong>Fecha reseña</strong>: <?php echo $fecha;?> 

<div class="text-center mb-4">
    <a href="<?php echo $goodreads_url;?>"><img src="<?php echo $src[0];?>" alt="Portada del libro <?php echo $titulo;?>" class="img-fluid" /></a>
</div>

<?php echo $texto;?>
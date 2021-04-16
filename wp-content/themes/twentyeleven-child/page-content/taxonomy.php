<?php 
/*
The template for displaying content in the tpl/libros.php template
@see: https://developer.wordpress.org/themes/template-files-section/taxonomy-templates/
@see: https://stackoverflow.com/questions/44219423/php-fatal-error-cannot-instantiate-abstract-class
@see: https://stackoverflow.com/questions/53895044/clarifying-uml-class-diagram-of-factory-method-design-pattern
@see: https://docs.pods.io/tutorials/get-values-from-a-relationship-field/

Ideas/más buscadas:
<h2>Libros sobre el sentido del sufrimiento</h2>
<h2>Libros sobre la palabra de Dios Padre Nuestro (Oración?)</h2>
*/
$tamano_grid = 4;
$asins = $ids = '';
$term = get_queried_object();
?>

<h2>Citas sobre <?php echo $term->name;?></h2>
<?php
while ( have_posts() ) : the_post();
    $post = get_post();
    $post_type = $post->post_type;
    $id = $post->ID;
    $cita = get_post_meta( $id, 'cita', true );
    $citatags = get_the_terms( $id, 'citatag' );

    echo $cita;

endwhile; 
?>


<h2>Otros libros de <?php echo $term->name;?></h2>
<?php echo do_shortcode('[amazon template="vertical" grid="'.$tamano_grid.'" items="12" bestseller="'.$term->name.'"]'); ?>

<h2>Novedades Amazon de <?php echo $term->name;?></h2>
<?php echo do_shortcode('[amazon template="vertical" items="12" new="libros+'.$term->name.'" grid="'.$tamano_grid.'"]'); ?>


<?php 
/*
The template for displaying content in the tpl/libros.php template
@see: https://stackoverflow.com/questions/44219423/php-fatal-error-cannot-instantiate-abstract-class
@see: https://stackoverflow.com/questions/53895044/clarifying-uml-class-diagram-of-factory-method-design-pattern
@see: https://docs.pods.io/tutorials/get-values-from-a-relationship-field/

Ideas/más buscadas:
<h2>Libros sobre el sentido del sufrimiento</h2>
<h2>Libros sobre la palabra de Dios Padre Nuestro (Oración?)</h2>
*/
use App\Util\Wp;
$tamano_grid = 4;
$asins = $ids = '';
$term = get_queried_object();
$arr_asins = [];

while ( have_posts() ) : the_post();
    $post = get_post();
    $post_type = $post->post_type;
    $id = $post->ID;

    if($post_type == 'libro'){
        $asin = get_post_meta( $id, 'asin', true );
    }else{
        $libro = get_post_meta( $id, 'libro', true );
        if(empty($libro['ID'])){
            continue;
        }
        $id = $libro['ID'];
        $asin = get_post_meta( $id, 'asin', true );
    }

    if(!in_array($asin, $arr_asins)){
        $arr_asins[] = $asin;
    }else{
        continue;
    }
    $asins .= $asin.',';
    $ids .= $id.',';
endwhile; 
?>

<h2>Libros sobre <?php echo $term->name;?></h2>
<?php 
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="'.$tamano_grid.'" template="my-vertical"]');
?>

<h2>Otros libros de <?php echo $term->name;?></h2>
<?php echo do_shortcode('[amazon template="vertical" grid="'.$tamano_grid.'" items="12" bestseller="'.$term->name.'"]'); ?>

<h2>Novedades Amazon de <?php echo $term->name;?></h2>
<?php echo do_shortcode('[amazon template="vertical" items="12" new="libros+'.$term->name.'" grid="'.$tamano_grid.'"]'); ?>


<h6 class="text-right">Último artículo</h6>
<?php
use App\Util\Wp;
$tamano_grid = 4;

$posts = wp_get_recent_posts(
    array(
        'post_type'      => array('post'),
        'post_status'    => 'publish',
        'posts_per_page' => 1
    )
);
?>
<div class="aawp">
<?php
foreach( $posts as $post ){

    $id = $post['ID'];

    $pod = pods( $post['post_type'], $id );
    $portada = $pod->field( 'portada' );
    $portada_src = wp_get_attachment_image_src($portada['ID'], 400)[0];
    $post['pic'] = $portada_src;

    if(empty($post['pic'])){
        $post['pic'] = get_the_post_thumbnail_url($id,'full'); // large, thumbnail
    }

    $post['fecha'] = get_fecha_larga($id);

    $post['urlArticulo'] = esc_url( get_permalink( $id ) );

    // TODO: hacer en libro campo pod llamado contenido? 
    $campo = 'contenido';
    if($post['post_type'] == 'libro'){
        $campo = 'descripcion';
    }
    $contenido = $pod->field( $campo );
    $post['firstParagraph'] = $contenido;
    if($post['post_type'] == 'review' || $post['post_type'] == 'nota'){
        $post['firstParagraph'] = get_first_paragraph($contenido);
    }elseif($post['post_type'] == 'post'){
        $post['firstParagraph'] = get_first_paragraph($post['post_content']);
    }
    
    echo view('../partials/home-item', array('this2' => $post));
}
?>
</div>

<hr />

<h6>Novedades</h6>
<?php
$libros = Wp::get_books_by_category_id(3);
$asins = Wp::get_libros_asins($libros)[0];
$ids = Wp::get_libros_asins($libros)[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="'.$tamano_grid.'" template="my-vertical"]');
?>

<hr />

<h6>Novedades Amazon</h6>
<?php echo do_shortcode('[amazon new="mejores libros" items="12"]');?>






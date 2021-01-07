<h6 class="text-right">Últimos artículos</h6>
<?php
use App\Util\Wp;
$tamano_grid = 4;

$posts = get_posts(
    array(
        'post_type'      => array('post'),
        'post_status'    => 'publish',
        'posts_per_page' => -1
    )
);
?>
<div class="aawp">
<?php
foreach( $posts as $post ){

    $id = $post->ID;
    
    $post->pic = get_the_post_thumbnail_url($id,'full'); // large, thumbnail
    
    $post->fecha = get_fecha_larga($id);

    $post->urlArticulo = esc_url( get_permalink( $id ) );

    $post->firstParagraph = get_first_paragraph($post->post_content);
    
    echo view('../partials/home-item', array('this2' => $post));
}
?>
</div>






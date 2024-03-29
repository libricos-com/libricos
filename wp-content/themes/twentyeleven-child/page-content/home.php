<?php
use App\Util\Wp;
$tamano_grid = 4;

$posts = get_posts(
    array(
        'post_type'      => array('post'),
        'post_status'    => 'publish',
        'posts_per_page' => 1
    )
);
?>
<h2><a href="./biblioteca">Últimas recomendaciones</a></h2>
<?php
$libros = Wp::get_books_by_category_id(3, $tamano_grid);
$asins = Wp::get_libros_asins($libros)[0];
$ids = Wp::get_libros_asins($libros)[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="'.$tamano_grid.'" template="my-vertical"]');
?>

<h6 class="text-right">Último artículo</h6>
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

<div>
    <h2><a href="citas/">Últimas citas</a></h2>
    <?php echo view('../partials/quotes-latest', []);?>
</div>


<h2><a href="<?php echo get_tag_link(470);?>">Libros de cocina</a></h2>
<?php 
$libros = Wp::get_books_by_tag_id(470, $tamano_grid);
$asins = Wp::get_libros_asins($libros)[0];
$ids = Wp::get_libros_asins($libros)[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="'.$tamano_grid.'" template="my-vertical"]');
?>
<hr />


<h2><a href="<?php echo get_term_link(410, 'genero');?>">Libros de autoayuda</a></h2>
<p>Selección de libros imprescindibles sobre espiritualidad, populares, de los más vendidos, 
emocional, ansiedad, autoestima, depresión, imprescindibles.</p>
<?php 
// Género autoayuda 410 http://192.168.1.44/jesuserro.com/generos/autoayuda
$libros = Wp::get_books_by_genero_id(410, $tamano_grid);
$asins = Wp::get_libros_asins($libros)[0];
$ids = Wp::get_libros_asins($libros)[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="'.$tamano_grid.'" template="my-vertical"]');
?>
<hr />


<h2><a href="<?php echo get_term_link(405, 'genero');?>">Libros sobre psicología y amor de pareja</a></h2>
<?php 
$libros = Wp::get_books_by_genero_id(405, $tamano_grid);
$asins = Wp::get_libros_asins($libros)[0];
$ids = Wp::get_libros_asins($libros)[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="'.$tamano_grid.'" template="my-vertical"]');
?>
<hr />


<h2><a href="<?php echo get_tag_link(275);?>">Libros sobre profecías cumplidas</a></h2>
<?php 
$libros = Wp::get_books_by_tag_id(275, $tamano_grid);
$asins = Wp::get_libros_asins($libros)[0];
$ids = Wp::get_libros_asins($libros)[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="'.$tamano_grid.'" template="my-vertical"]');
?>
<hr />


<h2><a href="<?php echo get_tag_link(344);?>">Libros sobre historias y testimonios</a></h2>
<p>Libros que cuentan historias de cambio para jóvenes, hombres, mujeres, niños.</p>
<?php 
$libros = Wp::get_books_by_tag_id(344, $tamano_grid);
$asins = Wp::get_libros_asins($libros)[0];
$ids = Wp::get_libros_asins($libros)[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="'.$tamano_grid.'" template="my-vertical"]');
?>
<hr />


<h2><a href="<?php echo get_tag_link(246);?>">Libros sobre oración</a></h2>
<?php 
/*
Tag oración ID 246
http://192.168.1.44/jesuserro.com/tag/oracion/
taxonomy=post_tag&tag_ID=246&post_type=post
*/
$libros = Wp::get_books_by_tag_id(246, $tamano_grid);
$asins = Wp::get_libros_asins($libros)[0];
$ids = Wp::get_libros_asins($libros)[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="'.$tamano_grid.'" template="my-vertical"]');
?>
<hr />

<h2>Novedades Amazon</h2>
<div class="jei-amz-grd">
    <?php echo do_shortcode('[amazon template="vertical" grid="'.$tamano_grid.'" new="mejores libros" items="24"]');?>
</div>






<?php 
/*
The template for displaying content in the tpl/libros.php template
@see: https://docs.pods.io/tutorials/get-values-from-a-relationship-field/
Ancient code before AAWP @see: https://gist.github.com/jesuserro/9d504d06aaa2094d42d6e8e5a498d45b

Ideas/más buscadas:
<h2>Libros sobre el sentido del sufrimiento</h2>
<h2>Libros sobre la palabra de Dios Padre Nuestro (Oración?)</h2>
*/
?>

<h1>Últimos libros</h1>
<?php
// taxonomy=category&tag_ID=3&post_type=post
$args = array(
    'posts_per_page' => -1,
    'post_type' => 'libro',
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
             'terms' => 3
        )
    )
);
$libros = get_libros_asins($args);
$asins = $libros[0];
$ids = $libros[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3" template="my-vertical"]');
?>

<h2>Libros de autoayuda</h2>
<p>Selección de libros imprescindibles cristianos sobre espiritualidad, populares, de los más vendidos, 
emocional, ansiedad, autoestima, depresión, imprescindibles. Libros cristianos a buen precio, español y Kindle.</p>
<?php 
// Género psicologia 374 http://192.168.1.44/jesuserro.com/generos/psicologia
$args = array(
    'posts_per_page' => -1,
    'post_type' => 'libro',
    'tax_query' => array(
        array(
            'taxonomy' => 'genero',
            // 'field' => 'tag_ID',
            'terms' => 410
            // 'slug' => 'autoayuda'
        )
    )
);
$libros = get_libros_asins($args);
$asins = $libros[0];
$ids = $libros[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3" template="my-vertical"]');
?>

<h2>Libros de historias y testimonios cristianos.</h2>
<p>Libros que cuentan historias para jóvenes, hombres, mujeres, niños.</p>
<?php 
// Género testimonios http://192.168.1.44/jesuserro.com/generos/psicologia
$args = array(
    'posts_per_page' => -1,
    'post_type' => 'libro',
    'tax_query' => array(
        array(
            'taxonomy' => 'genero',
            'terms' => 426
        )
    )
);
$libros = get_libros_asins($args);
$asins = $libros[0];
$ids = $libros[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3" template="my-vertical"]');
?>

<h2>Libros sobre la oración</h2>
<?php 
/*
Tag oración ID 246
http://192.168.1.44/jesuserro.com/tag/oracion/
taxonomy=post_tag&tag_ID=246&post_type=post
*/
$args = array(
    'posts_per_page' => -1,
    'post_type' => 'libro',
    'tax_query' => array(
        array(
            'taxonomy' => 'post_tag',
            'terms' => 246
        )
    )
);

$libros = get_libros_asins($args);
$asins = $libros[0];
$ids = $libros[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3" template="my-vertical"]');
?>

<h2>Libros sobre profecías cumplidas</h2>
<?php 
// Género psicologia 374 http://192.168.1.44/jesuserro.com/generos/psicologia
$args = array(
    'posts_per_page' => -1,
    'post_type' => 'libro',
    'tax_query' => array(
        array(
            'taxonomy' => 'genero',
            'terms' => 434
        )
    )
);
$libros = get_libros_asins($args);
$asins = $libros[0];
$ids = $libros[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3" template="my-vertical"]');
?>

<h2>Libros sobre psicología y amor de pareja</h2>
<?php 
// Género psicologia 405 http://192.168.1.44/jesuserro.com/generos/psicologia
$args = array(
    'posts_per_page' => -1,
    'post_type' => 'libro',
    'tax_query' => array(
        array(
            'taxonomy' => 'genero',
            // 'field' => 'tag_ID',
            'terms' => 405
            // 'slug' => 'psicologia'
        )
    )
);
$libros = get_libros_asins($args);
$asins = $libros[0];
$ids = $libros[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3" template="my-vertical"]');
?>

<h2>Novedades Amazon</h2>
<?php echo do_shortcode('[amazon new="libros+catolicos" grid="3"]'); ?>

<h2>Otros libros de cristianismo</h2>
<?php echo do_shortcode('[amazon bestseller="%cristianismo%"]'); ?>


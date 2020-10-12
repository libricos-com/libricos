<?php 
/*
The template for displaying content in the tpl/libros.php template
@see: https://docs.pods.io/tutorials/get-values-from-a-relationship-field/
Ancient code before AAWP @see: https://gist.github.com/jesuserro/9d504d06aaa2094d42d6e8e5a498d45b
*/
?>


<h2>Libros cristianos/espiritualidad de autoayuda (más vendidos, emocional, ansiedad, autoestima, depresión, imprescindibles)</h2>

<h2>Libros cristianos gratis, español y Kindle (más vendidos)</h2>

<h2>Libros cristianos para jóvenes, hombres, mujeres, niños</h2>

<h2>Libros de historias y testimonios cristianos.</h2>

<h2>Libros sobre el sentido del sufrimiento</h2>

<h2>Libros sobre la palabra de Dios Padre Nuestro (Oración?)</h2>
<?php 
/*
Tag oración ID 246
http://192.168.1.44/jesuserro.com/tag/oracion/
taxonomy=post_tag&tag_ID=246&post_type=post
*/
$argsLibros = array(
    'posts_per_page' => -1,
    'post_type' => 'libro',
    'tax_query' => array(
        array(
            'taxonomy' => 'post_tag',
            'terms' => 246
        )
    )
);
$libros = get_posts($argsLibros);
$num = count($libros);
$asins = $ids = '';
if( ! empty( $libros ) ){
	foreach ( $libros as $libro ){
        if(empty($libro->asin)){
            continue;
        }
        $asins .= $libro->asin.',';
        $ids .= $libro->ID.',';
    }
    echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3"]');
}
?>

<h2>Libros sobre profecías cumplidas</h2>

<h2>Libros para sanar el alma (paz y libertad interior)</h2>

<h2>Libros sobre psicología y amor de pareja</h2>
<?php 
// Género psicologia 374 http://192.168.1.44/jesuserro.com/generos/psicologia
$args = array(
    'posts_per_page' => -1,
    'post_type' => 'libro',
    'tax_query' => array(
        array(
            'taxonomy' => 'generos',
            // 'field' => 'tag_ID',
            'terms' => 374
            // 'slug' => 'psicologia'
        )
    )
);
$libros = get_posts($args);
$asins = $ids = '';
$num = count($libros);
if( ! empty( $libros ) ){
	foreach ( $libros as $libro ){
        if(empty($libro->asin)){
            continue;
        }
        $asins .= $libro->asin.',';
        $ids .= $libro->ID.',';
    }
    echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3"]');
}
?>

<h2>Categoría Libros</h2>
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
$libros = get_posts($args);
$asins = $ids = '';
$num = count($libros);
if( ! empty( $libros ) ){
	foreach ( $libros as $libro ){
        if(empty($libro->asin)){
            continue;
        }
        $asins .= $libro->asin.',';
        $ids .= $libro->ID.',';
    }
    echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3"]');
}
?>

<h2>Novedades Amazon</h2>
<?php echo do_shortcode('[amazon new="cristianismo" grid="3"]'); ?>


<h2>Otros libros de cristianismo</h2>
<?php echo do_shortcode('[amazon bestseller="%cristianismo%"]'); ?>


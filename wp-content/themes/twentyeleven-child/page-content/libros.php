<?php 
/*
The template for displaying content in the tpl/libros.php template
@see: https://docs.pods.io/tutorials/get-values-from-a-relationship-field/
Ancient code before AAWP @see: https://gist.github.com/jesuserro/9d504d06aaa2094d42d6e8e5a498d45b

Ideas/más buscadas:
<h2>Libros sobre el sentido del sufrimiento</h2>
<h2>Libros sobre la palabra de Dios Padre Nuestro (Oración?)</h2>
*/
use App\Entity\Libro;
$libro = new Libro(null);
?>

<h1>Últimos libros</h1>
<?php
$libros = $libro->get_books_by_category_id(3);
$asins = $libro->get_libros_asins($libros)[0];
$ids = $libro->get_libros_asins($libros)[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3" template="my-vertical"]');
?>

<h2>Libros de autoayuda</h2>
<p>Selección de libros imprescindibles cristianos sobre espiritualidad, populares, de los más vendidos, 
emocional, ansiedad, autoestima, depresión, imprescindibles. Libros cristianos a buen precio, español y Kindle.</p>
<?php 
// Género autoayuda 410 http://192.168.1.44/jesuserro.com/generos/autoayuda
$libros = $libro->get_books_by_genero_id(410);
$asins = $libro->get_libros_asins($libros)[0];
$ids = $libro->get_libros_asins($libros)[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3" template="my-vertical"]');
?>

<h2>Libros de historias y testimonios cristianos.</h2>
<p>Libros que cuentan historias para jóvenes, hombres, mujeres, niños.</p>
<?php 
// Género testimonios http://192.168.1.44/jesuserro.com/generos/psicologia
$libros = $libro->get_books_by_genero_id(426);
$asins = $libro->get_libros_asins($libros)[0];
$ids = $libro->get_libros_asins($libros)[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3" template="my-vertical"]');
?>

<h2>Libros sobre la oración</h2>
<?php 
/*
Tag oración ID 246
http://192.168.1.44/jesuserro.com/tag/oracion/
taxonomy=post_tag&tag_ID=246&post_type=post
*/
$libros = $libro->get_books_by_tag_id(246);
$asins = $libro->get_libros_asins($libros)[0];
$ids = $libro->get_libros_asins($libros)[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3" template="my-vertical"]');
?>

<h2>Libros sobre profecías cumplidas</h2>
<?php 
$libros = $libro->get_books_by_genero_id(434);
$asins = $libro->get_libros_asins($libros)[0];
$ids = $libro->get_libros_asins($libros)[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3" template="my-vertical"]');
?>

<h2>Libros sobre psicología y amor de pareja</h2>
<?php 
$libros = $libro->get_books_by_genero_id(405);
$asins = $libro->get_libros_asins($libros)[0];
$ids = $libro->get_libros_asins($libros)[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3" template="my-vertical"]');
?>

<h2>Novedades Amazon</h2>
<?php echo do_shortcode('[amazon new="libros+catolicos" grid="3"]'); ?>

<h2>Otros libros de cristianismo</h2>
<?php echo do_shortcode('[amazon bestseller="%cristianismo%"]'); ?>


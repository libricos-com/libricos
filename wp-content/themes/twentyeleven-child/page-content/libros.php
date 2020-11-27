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
?>

<h1>Últimos libros recomendados</h1>
<?php
$libros = Wp::get_books_by_category_id(3);
$asins = Wp::get_libros_asins($libros)[0];
$ids = Wp::get_libros_asins($libros)[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3" template="my-vertical"]');
?>

<h2>Libros de autoayuda recomendados</h2>
<p>Selección de libros imprescindibles cristianos sobre espiritualidad, populares, de los más vendidos, 
emocional, ansiedad, autoestima, depresión, imprescindibles. Libros cristianos a buen precio, español y Kindle.</p>
<?php 
// Género autoayuda 410 http://192.168.1.44/jesuserro.com/generos/autoayuda
$libros = Wp::get_books_by_genero_id(410);
$asins = Wp::get_libros_asins($libros)[0];
$ids = Wp::get_libros_asins($libros)[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3" template="my-vertical"]');
?>

<h2>Libros de historias y testimonios cristianos recomendados</h2>
<p>Libros que cuentan historias para jóvenes, hombres, mujeres, niños.</p>
<?php 
// Género testimonios http://192.168.1.44/jesuserro.com/generos/psicologia
$libros = Wp::get_books_by_genero_id(426);
$asins = Wp::get_libros_asins($libros)[0];
$ids = Wp::get_libros_asins($libros)[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3" template="my-vertical"]');
?>

<h2>Libros sobre la oración recomendados</h2>
<?php 
/*
Tag oración ID 246
http://192.168.1.44/jesuserro.com/tag/oracion/
taxonomy=post_tag&tag_ID=246&post_type=post
*/
$libros = Wp::get_books_by_tag_id(246);
$asins = Wp::get_libros_asins($libros)[0];
$ids = Wp::get_libros_asins($libros)[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3" template="my-vertical"]');
?>

<h2>Libros sobre profecías cumplidas recomendados</h2>
<?php 
$libros = Wp::get_books_by_genero_id(434);
$asins = Wp::get_libros_asins($libros)[0];
$ids = Wp::get_libros_asins($libros)[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3" template="my-vertical"]');
?>

<h2>Libros sobre psicología y amor de pareja recomendados</h2>
<?php 
$libros = Wp::get_books_by_genero_id(405);
$asins = Wp::get_libros_asins($libros)[0];
$ids = Wp::get_libros_asins($libros)[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3" template="my-vertical"]');
?>

<h2>Novedades Amazon</h2>
<?php echo do_shortcode('[amazon new="libros+catolicos" grid="3"]'); ?>

<h2>Otros libros de cristianismo</h2>
<?php echo do_shortcode('[amazon bestseller="%cristianismo%"]'); ?>


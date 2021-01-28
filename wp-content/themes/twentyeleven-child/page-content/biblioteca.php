<h2>Últimos libros</h2>
<?php
use App\Util\Wp;
$tamano_grid = 3;
$libros = Wp::get_books_by_category_id(3);
$asins = Wp::get_libros_asins($libros)[0];
$ids = Wp::get_libros_asins($libros)[1];
echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="'.$tamano_grid.'" template="my-vertical"]');
?>



<?php 
// $quote = '<blockquote class="blockquote text-center"><p class="mb-0">Un libro que deja huella, deja de ser un libro - forma parte de ti - se convierte en tu librico.</p><footer class="blockquote-footer">Cuando amas un <cite title="Source Title">libro</cite></footer></blockquote>';

/*
The template for displaying content in the tpl/home.php template
@see: 
- https://florianbrinkmann.com/en/organizing-files-functions-wordpress-theme-4190/
- https://docs.pods.io/tutorials/get-values-from-a-relationship-field/
*/
$urlBase = get_site_url();

$args = array(
    'taxonomy' => 'genero',
    'hide_empty' => false
);
$terms = get_terms($args);
if($terms){
    echo view('../partials/searchform-complete', array(
        'this2' => (object)[
            'terms' => $terms,
            'placeholder' => 'Busca libricos por temática, título, autor, ...'
        ])
    );
}
?>


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
?>
<hr />



<h2>Novedades Amazon sobre espiritualidad</h2>
<?php echo do_shortcode('[amazon template="vertical" new="libros+catolicos" grid="'.$tamano_grid.'"]'); ?>

<h2>Otros libros</h2>
<?php echo do_shortcode('[amazon template="vertical" grid="3" bestseller="libros %psicología% cristiana"]'); ?>


<?php 
/*
The template for displaying content in the tpl/home.php template
@see: 
- https://florianbrinkmann.com/en/organizing-files-functions-wordpress-theme-4190/
- https://docs.pods.io/tutorials/get-values-from-a-relationship-field/
*/
$urlBase = get_site_url();
?>

<?php 
$args = array(
    'taxonomy' => 'genero',
    'hide_empty' => false
);
$terms = get_terms($args);
if($terms){
    echo view('../partials/searchform-complete', array(
        'this2' => (object)[
            'terms' => $terms,
            'placeholder' => 'Busca libro en nuestros recomendados por temática, título, autor, ...'
        ])
    );
}
?>

<hr />

<h2>Novedades Amazon libros espiritualidad</h2>
<?php echo do_shortcode('[amazon new="libros+cristianos" items="12"]');?>






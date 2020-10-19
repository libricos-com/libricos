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
    'taxonomy' => 'generos',
    'hide_empty' => false
);
$terms = get_terms($args);
echo view('../partials/searchform-complete', array(
    'this2' => (object)[
        'terms' => $terms,
        'colors' => ['danger', 'warning', 'success', 'primary', 'info', 'secondary'],
        'placeholder' => 'Busca tu libro por temática, título, autor, ...'
    ])
);
?>

<hr />

<h2>Novedades libros espiritualidad</h2>
<?php echo do_shortcode('[amazon new="libros+cristianos" items="12"]');?>

<h2>Leyenda</h2>
<a href="#" class="badge badge-primary">Libro</a>
<span class="badge badge-primary"><i class="fas fa-book"></i> Libro</span>
<button type="button" class="btn btn-primary"><i class="fas fa-book"></i> Libros <span class="badge badge-danger">4,3</span>
</button>

<i class="fa fa-star fa-lg color-yellow" aria-hidden="true"></i> Mi puntuación <span class="badge badge-warning">4,3</span> <br><br>

Puntuación sobre 5: <span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star fa-star-half"></span>
<br>

<a href="#" class="btn btn-lg px-3 btn-primary" role="button" data-toggle="tooltip" title="Ficha técnica del libro"><i class="fas fa-book"></i> Libro</a>

<a href="#" class="btn btn-lg px-3 btn-danger" role="button" data-toggle="tooltip" title="Esto es un análisis del libro"><i class="fas fa-clipboard-list"></i> Review</a>

<a href="#" class="btn btn-lg px-3 btn-warning" role="button" data-toggle="tooltip" title="Esto es un conjunto de apuntes y pensamientos de un libro"><i class="fas fa-pencil-alt"></i> Nota</a>

<a href="#" class="btn btn-lg px-3 btn-primary-orange" role="button" data-toggle="tooltip" title="Esto es una entrada del blog"><i class="fas fa-rss"></i> Post</a>

<a href="#" class="btn btn-lg px-3 btn-info" role="button" data-toggle="tooltip" title="Ficha de autor"><i class="fas fa-user"></i> Autor</a>

<a href="#" class="btn btn-lg px-3 btn-info" role="button" data-toggle="tooltip" title="Ficha de la editorial"><i class="fas fa-newspaper"></i> Editorial</a>

<br><br>

<a href="#" class="btn btn-lg px-3 btn-primary" role="button" data-toggle="tooltip" title="Libro añadido a la biblioteca"><i class="fas fa-layer-group"></i> Quiero leer</a>

<a href="#" class="btn btn-lg px-3 btn-success" role="button" data-toggle="tooltip" title="Libro leído. Reseña en proceso."><i class="fas fa-check"></i> Leído</a>

<a href="#" class="btn btn-lg px-3 btn-warning" role="button" data-toggle="tooltip" title="Leyendo"><i class="fas fa-book-reader"></i> Leyendo</a>

<a href="#" class="btn btn-lg px-3 btn-primary-orange" role="button" data-toggle="tooltip" title="A leer próximamente"><i class="fab fa-hotjar"></i> Siguiente</a>	






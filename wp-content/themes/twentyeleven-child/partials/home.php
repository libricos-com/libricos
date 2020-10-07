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
echo view('../partials/searchbox', array('this2' => null));
?>

<div class="container">
  <div class="row">
        <div class="col-md text-center">
            <a href="<?php echo $urlBase;?>/libros/">
                <!-- <img class="img-fluid img-thumbnail rounded" src="<?php echo $urlBase;?>/wp-content/uploads/2020/09/libros.png" alt=""/> -->
                <i class="fas fa-book-reader fa-10x text-primary"></i>
            </a>
            <h2 class="has-text-align-center">Libros</h2>
            <p class="has-text-align-center">Libros revisados por este site o próximos a ser leídos. Obras que cuidan y sanan el alma.</p>
        </div>
        <div class="col-md text-center">
            <a href="<?php echo $urlBase;?>/reviews/">
                <!-- <img class="img-fluid img-thumbnail rounded" src="<?php echo $urlBase;?>/wp-content/uploads/2020/10/256px-Feed-icon.svg_.png" alt=""/> -->
                <i class="fas fa-clipboard-list fa-10x text-danger"></i>
            </a>
            <h2 class="has-text-align-center">Reviews</h2>
            <p class="has-text-align-center">Reseñas de libros.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md text-center">
            <a href="<?php echo $urlBase;?>/fotos/">
                <!-- <img class="img-fluid img-thumbnail rounded" src="<?php echo $urlBase;?>/wp-content/uploads/2020/09/instagram.png" alt=""/> -->
                <i class="fab fa-instagram fa-10x color-instagram"></i>
            </a>
            <h2 class="has-text-align-center">Fotos</h2>
            <p class="has-text-align-center">A través de la imagen trato de describir el mundo tal y como lo veo.</p>
        </div>
        <div class="col-md text-center">
            <a href="<?php echo $urlBase;?>/blog/">
                <!-- <img class="img-fluid img-thumbnail rounded" src="<?php echo $urlBase;?>/wp-content/uploads/2020/10/256px-Feed-icon.svg_.png" alt=""/> -->
                <i class="fas fa-rss-square fa-10x color-darkorange"></i>
            </a>
            <h2 class="has-text-align-center">Blog</h2>
            <p class="has-text-align-center">Pildoras de fe, pensamientos y palabras.</p>
        </div>
    </div>
  </div>
</div>

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






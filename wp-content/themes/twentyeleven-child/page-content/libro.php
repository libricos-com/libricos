<?php 
/*
The template for displaying content in the single-libro.php template
@see: https://docs.pods.io/tutorials/get-values-from-a-relationship-field/
*/
use App\Entity\BookWpFactory;
$libro = BookWpFactory::create($post);
?>

<h1><?php echo $libro->getTitulo();?></h1>

<div class="mb-3">Fecha post: <?php echo $libro->post_date;?></div>

<div class="text-center mb-4">
    <a href="<?php echo $libro->getUrl();?>"><img src="<?php echo $libro->getPortada_src();?>" alt="Portada del libro <?php echo $libro->getTitulo();?>" class="img-fluid" />
    </a>
</div>

<h2>Sinopsis</h2>
<p><?php echo $libro->getSinopsis();?></p>


<?php 
if ( ! empty( $libro->getAutores() ) ) {
    ?>
    <h2>Autor/es</h2>
    <ul class="list-group list-group-horizontal-sm mb-4">
    <?php
    foreach ( $libro->getAutores() as $autor ) { 
        //get id for related post and put in ID
        //for advanced content types use $id = $rel[ 'id' ];
        $idA = $autor[ 'ID' ];
        //show the related post name as link
        $urlAutor = esc_url( get_permalink( $idA ) );
        $nombreAutor = get_the_title( $idA );
        //get the value for some_field in related post and echo it
        // $someField = get_post_meta( $idA, 'post_title', true );
        ?>
        <li class="list-group-item">
            <a href="<?php echo $urlAutor;?>"><?php echo $nombreAutor;?></a>
        </li>
        <?php
    } //end of foreach
    ?>
    </ul>
    <?php
} //endif ! empty ( $autores )
?>

<?php 
if ( ! empty( $libro->getGeneros() ) ) {
    ?>
    <h2>Géneros</h2>
    <ul class="d-flex flex-wrap mb-4">
    <?php
    foreach ( $libro->getGeneros() as $genero ) { 
        $idA = $genero['term_id'];
        $nombreGenero = $genero['name'];
        $urlGenero = esc_url( get_bloginfo('url').'/generos/'.$genero['slug'] );
        $numPosts = $genero['count'];
        ?>
        <li class="list-group-item">
            <a href="<?php echo $urlGenero;?>"><?php echo $nombreGenero;?></a> (<?php echo $numPosts;?>)
        </li>
        <?php
    } //end of foreach
    ?>
    </ul>
    <?php
} //endif ! empty ( $generos )
?>

<h2>Categorías</h2>
<ul class="d-flex flex-wrap mb-4">
<?php 
    $categorias = $libro->getCategorias();
    foreach ($categorias as $cat) { 
    ?>
        <li class="list-group-item">
            <a href="<?php echo get_tag_link($cat->term_id);?>"><?php echo $cat->name;?></a> (<?php echo $cat->count;?>)
        </li>
    <?php
    }           
    ?>
</ul>

<h2>Etiquetas</h2>
<ul class="d-flex flex-wrap mb-4">
    <?php 
    $tags = $libro->getTags();
    foreach ($tags as $tag) { 
    ?>
        <li class="list-group-item">
            <a href="<?php echo get_tag_link($tag->term_id);?>"><?php echo $tag->name;?></a> (<?php echo $tag->count;?>)
        </li>
    <?php
    }           
    ?>
</ul>

<h2>Ficha técnica</h2>
<ul class="list-group mb-4">
    <li class="list-group-item"><strong>Editorial</strong>: <a href="<?php echo $libro->getEditorial_url();?>"><?php echo $libro->getEditorial_nombre();?></a></li>
    <li class="list-group-item"><strong>Fecha publicación</strong>: <?php echo $libro->getFecha_publicacion();?></li>
    <li class="list-group-item"><strong>Formato</strong>: <span class="<?php echo $libro->getFormato_icon();?>"></span> <?php echo $libro->getFormato_texto();?></li>
    <li class="list-group-item"><strong>Páginas</strong>: <?php echo $libro->getPaginas();?></li>
    <li class="list-group-item"><strong>Idioma</strong>: <span class="flag-icon flag-icon-<?php echo $libro->getIdioma();?>"></span></li>
    <li class="list-group-item"><i class="fab fa-goodreads"></i><a href="<?php echo $libro->getGoodreads_url();?>" target="blank" rel="noopener noreferrer"> Ficha Goodreads</a></li>
</ul>

<?php 
if ( ! empty( $libro->getReviews() ) ) {
    ?>
    <h2>Reviews <span class="badge badge-danger"><i class="fas fa-clipboard-list mr-1"></i><span class="badge badge-danger"><?php echo count($libro->getReviews());?></span></span></h2>
    <ul class="list-unstyled">
        <?php
        foreach ( $libro->getReviews() as $review ) { 
            $idA = $review[ 'ID' ];
            $urlReview = esc_url( get_permalink( $idA ) );
            $nombreReview = get_the_title( $idA );
            ?>
            <li>
                <span class="badge badge-pill btn-secondary"><i class="fas fa-clock" aria-hidden="true"></i> <?php echo date('d-m-y', strtotime($review['post_date']));?></span>
                <i class="fas fa-clipboard-list"><a href="<?php echo $urlReview;?>" data-toggle="tooltip" title="Esto es una reseña del libro <?php echo $libro->getTitulo();?>"></i> <?php echo $nombreReview;?></a>
            </li>
            <?php
        } 
        ?>
    </ul>
    <?php
} 
?>


<?php 
if ( ! empty( $libro->getNotas() ) ) { ?>
    <h2>Notas <span class="badge badge-warning"> <i class="fas fa-pencil-alt mr-1"></i><span class="badge badge-danger"><?php echo count($libro->getNotas());?></span></span></h2>
    <ul class="list-unstyled">
        <?php
        foreach ( $libro->getNotas() as $nota ) { 
            $idA = $nota[ 'ID' ];
            $urlNota = esc_url( get_permalink( $idA ) );
            $nombreNota = get_the_title( $idA );
            ?>
            <li>
                <span class="badge badge-pill btn-secondary"><i class="fas fa-clock" aria-hidden="true"></i> <?php echo date('d-m-y', strtotime($nota['post_date']));?></span>
                <i class="fas fa-pencil-alt"></i> <a href="<?php echo $urlNota;?>" data-toggle="tooltip" title="Esto es una nota del libro <?php echo $libro->getTitulo();?>"><?php echo $nombreNota;?></a>
            </li>
            <?php
        } 
        ?>
    </ul>
    <?php
} 
?>

<hr />
<div class="text-center p-2">
    <?php echo do_shortcode('[amazon box="'.$libro->getAsin().'"]');?>
</div>
<hr />

<h2>Similares</h2>
<div class="text-center p-2">
    <?php echo do_shortcode('[amazon bestseller="'.	get_post_meta($libro->getId(),'titulo')[0].'"]');?>
</div>	





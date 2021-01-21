<?php 
/*
The template for displaying content in the single-libro.php template
@see: https://docs.pods.io/tutorials/get-values-from-a-relationship-field/
*/
use App\Entity\BookWpFactory;
use App\Entity\Review;
$libro = BookWpFactory::create($post);
$reviews = $libro->getReviews();
if(empty($reviews[0])){
    $object = $libro;
}else{
    $firstReview = (object)$reviews[0];
    $object = new Review($firstReview);
}
$notas = $libro->getNotas();
?>

<div class="lbc-file">

    <h1 class="lbc-h1"><?php echo $libro->getTitulo();?></h1>

    <ul class="list-inline-bullets">
        <li class="list-inline-item">
            <?php echo view('../partials/libro-autores', ['this2' =>  $object]);?>
        </li>
        <li class="list-inline-item">
            <a href="<?php echo $libro->getEditorial_url();?>" title="Editorial"><?php echo $libro->getEditorial_nombre();?></a> (<?php echo substr($libro->getFecha_publicacion(), 0, 4);?>)
        </li>
        <li class="list-inline-item">
            <a href="<?php echo $libro->getGoodreads_url();?>" target="blank" rel="noopener noreferrer" title="Ficha del libro en Goodreads"><i class="fab fa-goodreads fa-2x"></i>
            </a>
        </li>
    </ul>


    <?php echo view('../partials/publish-info', ['this2' => $object]);?>

    <!-- https://www.w3schools.com/howto/howto_css_image_text.asp -->
    <div class="container text-center mt-4">
        <figure class="figure">
            <img src="<?php echo $libro->getPortada_src();?>" class="figure-img img-fluid rounded" alt="Portada del libro <?php echo $libro->getTitulo();?>">
            <figcaption class="figure-caption text-right">Portada del libro <?php echo $libro->getTitulo();?></figcaption>

            <?php 
            if ( ! empty( $notas ) ) { ?>
                <div class="d-flex justify-content-start top-left flex-row-reverse">
                    <?php
                    foreach ( $notas as $nota ) { 
                        $idA = $nota[ 'ID' ];
                        $urlNota = esc_url( get_permalink( $idA ) );
                        $nombreNota = get_the_title( $idA );
                        // $fechaNota = date('d-m-y', strtotime($nota['post_date']));
                        ?>
                        <div class="pl-2">
                            <a href="<?php echo $urlNota;?>" data-toggle="tooltip" title="<?php echo $nombreNota;?>"><i class="fas fa-bookmark fa-4x text-primary"></i></a>
                        </div>
                        <?php
                    } 
                    ?>
                </div>
                <span class="fa-layers-counter fa-4x" style="background:Tomato"><?php echo count($notas);?> notas</span>
                <?php
            } 
            ?>
        
            <div class="bottom-right"><?php echo $libro->getPaginas();?> páginas</div>
            <div class="centered">Centered</div>

            <div class="d-flex justify-content-start bottom-left">
                <div>ISBN <?php echo $libro->getIsbn();?></div>&nbsp;|&nbsp; 
                <div>ASIN <?php echo $libro->getAsin();?></div>&nbsp;|&nbsp; 
                <div>
                    <span class="<?php echo $libro->getFormato_icon();?>"></span>
                    <?php echo $libro->getFormato_texto();?>&nbsp;<span class="flag-icon flag-icon-<?php echo $libro->getIdioma();?>"></span>
                </div>
            </div>
        </figure>
    </div>

    <h2>Sinopsis del libro <?php echo $libro->getTitulo();?></h2>
    <p><?php echo $libro->getSinopsis();?></p>

    <h2>Índice del libro <?php echo $libro->getTitulo();?></h2>
    <p><?php echo $libro->getTableOfContents();?></p>


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
</div>

<hr />
<div class="text-center p-2">
    <?php echo do_shortcode('[amazon box="'.$libro->getAsin().'"]');?>
</div>
<hr />

<h2>Libros similares a <?php echo $libro->getTitulo();?></h2>
<div class="text-center p-2">
    <?php echo do_shortcode('[amazon bestseller="'.	get_post_meta($libro->getId(),'titulo')[0].'"]');?>
</div>	





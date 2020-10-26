<?php 
/*
The template for displaying content in the single-libro.php template
@see: https://docs.pods.io/tutorials/get-values-from-a-relationship-field/
*/

use App\Entity\Libro;
$libro = new Libro($post);
?>

<div class="entry-content">
    
    <div><?php echo get_fecha_larga($libro->get_post_date());?></div>
    
    <div class="text-center mb-4">
        <a href="<?php echo $libro->get_url();?>"><img src="<?php echo $libro->get_portada_src();?>" alt="Portada del libro <?php echo $libro->get_titulo();?>" class="img-fluid" /></a>
        <div><?php // echo get_kkstarring();?></div>
    </div>

    <h2>Sinopsis</h2>
    <p><?php echo $libro->get_sinopsis();?></p>


    <?php 
    if ( ! empty( $libro->get_autores() ) ) {
        ?>
        <h2>Autor/es</h2>
        <ul class="list-group list-group-horizontal-sm mb-4">
        <?php
        foreach ( $libro->get_autores() as $autor ) { 
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
    if ( ! empty( $libro->get_generos() ) ) {
        ?>
        <h2>Géneros</h2>
        <ul class="d-flex flex-wrap mb-4">
        <?php
        foreach ( $libro->get_generos() as $genero ) { 
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
        $categorias = $libro->get_categorias();
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
        $tags = $libro->get_tags();
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
        <li class="list-group-item"><strong>Editorial</strong>: <a href="<?php echo $libro->get_editorial_url();?>"><?php echo $libro->get_editorial_nombre();?></a></li>
        <li class="list-group-item"><strong>Fecha publicación</strong>: <?php echo $libro->get_fecha_publicacion();?></li>
        <li class="list-group-item"><strong>Formato</strong>: <span class="<?php echo $libro->get_formato_icon();?>"></span> <?php echo $libro->get_formato_texto();?></li>
        <li class="list-group-item"><strong>Páginas</strong>: <?php echo $libro->get_paginas();?></li>
        <li class="list-group-item"><strong>Idioma</strong>: <span class="flag-icon flag-icon-<?php echo $libro->get_idioma();?>"></span></li>
        <li class="list-group-item"><i class="fab fa-goodreads"></i><a href="<?php echo $libro->get_goodreads_url();?>" target="blank" rel="noopener noreferrer"> Ficha Goodreads</a></li>
    </ul>
    
    <?php 
    if ( ! empty( $libro->get_reviews() ) ) {
        ?>
        <h2>Reviews <span class="badge badge-danger"><i class="fas fa-clipboard-list mr-1"></i><span class="badge badge-danger"><?php echo count($libro->get_reviews());?></span></span></h2>
        <ul class="list-unstyled">
            <?php
            foreach ( $libro->get_reviews() as $review ) { 
                $idA = $review[ 'ID' ];
                $urlReview = esc_url( get_permalink( $idA ) );
                $nombreReview = get_the_title( $idA );
                ?>
                <li>
                    <span class="badge badge-pill btn-secondary"><i class="fas fa-clock" aria-hidden="true"></i> <?php echo date('d-m-y', strtotime($review['post_date']));?></span>
                    <i class="fas fa-clipboard-list"><a href="<?php echo $urlReview;?>" data-toggle="tooltip" title="Esto es una reseña del libro <?php echo $libro->get_titulo();?>"></i> <?php echo $nombreReview;?></a>
                </li>
                <?php
            } 
            ?>
        </ul>
        <?php
    } 
    ?>


    <?php 
    if ( ! empty( $libro->get_notas() ) ) { ?>
        <h2>Notas <span class="badge badge-warning"> <i class="fas fa-pencil-alt mr-1"></i><span class="badge badge-danger"><?php echo count($libro->get_notas());?></span></span></h2>
        <ul class="list-unstyled">
            <?php
            foreach ( $libro->get_notas() as $nota ) { 
                $idA = $nota[ 'ID' ];
                $urlNota = esc_url( get_permalink( $idA ) );
                $nombreNota = get_the_title( $idA );
                ?>
                <li>
                    <span class="badge badge-pill btn-secondary"><i class="fas fa-clock" aria-hidden="true"></i> <?php echo date('d-m-y', strtotime($nota['post_date']));?></span>
                    <i class="fas fa-pencil-alt"></i> <a href="<?php echo $urlNota;?>" data-toggle="tooltip" title="Esto es una nota del libro <?php echo $libro->get_titulo();?>"><?php echo $nombreNota;?></a>
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
        <?php echo do_shortcode('[amazon box="'.$libro->get_asin().'"]');?>
    </div>
    <hr />

    <h2>Similares</h2>
    <div class="text-center p-2">
        <?php echo do_shortcode('[amazon bestseller="'.	get_post_meta($libro->get_id(),'titulo')[0].'"]');?>
    </div>

</div>	





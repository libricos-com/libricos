<?php 
/*
The template for displaying content in the tpl/libros.php template
@see: https://developer.wordpress.org/themes/template-files-section/taxonomy-templates/
*/
use App\Entity\Quote;

$tamano_grid = 4;
$posts = get_posts(
    array(
        'post_type'      => array('cita'),
        'post_status'    => 'publish',
        'posts_per_page' => 3,
        'order'          => 'DESC',
        'orderby'        => 'date'
    )
);
?>

<div id="citas" class="row pl-3 pr-3 jei-amz-grd">
    <?php
    foreach( $posts as $post ){
        $Quote      = new Quote($post);
        $cita       = $Quote->getCita();
        $citatags   = $Quote->getCitatags();
        $book       = $Quote->getBook();
        $longTitle  = $Quote->getLibroLongTitle();
        $shortTitle = $Quote->getLibroShortTitle();
        $autorName  = $Quote->getAutorName();
        $asin       = $Quote->getAsin();
        $libroUrl   = esc_url( get_permalink( $book['ID'] ) );
        $autorUrl   = esc_url( get_permalink( $Quote->getAutorId() ) );
    
        echo view('../partials/quote-sell', [
            'cita'        => $cita, 
            'autorName'   => $autorName,
            'tituloLibro' => $longTitle,
            'shortTitle'  => $shortTitle,
            'citatags'    => $citatags,
            'asin'        => $asin,
            'libroUrl'    => $libroUrl,
            'autorUrl'    => $autorUrl
            ]
        );
    } 
    ?>
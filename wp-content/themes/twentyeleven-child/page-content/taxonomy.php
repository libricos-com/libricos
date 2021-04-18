<?php 
/*
The template for displaying content in the tpl/libros.php template
@see: https://developer.wordpress.org/themes/template-files-section/taxonomy-templates/
*/
use App\Entity\Quote;

$tamano_grid = 4;
$asins = $ids = '';
$term = get_queried_object();
?>

<h2>Citas sobre <span class="font-italic">"<?php echo $term->name;?>"</span></h2>
<div id="citas" class="row pl-3 pr-3 jei-amz-grd">
    <?php
    while ( have_posts() ) : the_post();
        $post       = get_post();
        $Quote      = new Quote($post);
        $cita       = $Quote->getCita();
        $citatags   = $Quote->getCitatags();
        $book       = $Quote->getBook();
        $longTitle  = $Quote->getLibroLongTitle();
        $shortTitle = $Quote->getLibroShortTitle();
        $autorName  = $Quote->getAutorName();
        $asin       = $Quote->getAsin();

        echo view('../partials/quote-sell', [
            'cita'        => $cita, 
            'autorName'   => $autorName,
            'tituloLibro' => $longTitle,
            'shortTitle'  => $shortTitle,
            'citatags'    => $citatags,
            'asin'        => $asin
            ]
        );
    endwhile; 
    ?>

    <h2>Otros libros de <span class="font-italic">"<?php echo $term->name;?>"</span></h2>

    <h2>Novedades Amazon de <span class="font-italic">"<?php echo $term->name;?>"</span></h2>
    <?php echo do_shortcode('[amazon template="vertical" items="12" new="libros+'.$term->name.'" grid="'.$tamano_grid.'"]'); ?>
</div>


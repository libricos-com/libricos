<?php 
/*
The template for displaying content in the tpl/libros.php template
@see: https://developer.wordpress.org/themes/template-files-section/taxonomy-templates/
*/
use App\Entity\Quote;

$tamano_grid = 4;
$asins = $ids = '';
$term = get_queried_object();

$postLibro = get_posts(
    array(
        'posts_per_page' => 1,
        'post_type' => 'libro',
        'tax_query' => array(
            array(
                'taxonomy' => 'librourl',
                'field' => 'term_id',
                'terms' => $term->term_id,
            )
        )
    )
);
$tituloLibro = '-';
if(!empty($postLibro)){
    $tituloLibro = $postLibro[0]->post_title; 
}
?>

<h2>Citas del libro <span class="font-italic"><?php echo $tituloLibro;?></span></h2>
<div id="citas" class="row pl-3 pr-3 jei-amz-grd">
    <?php
    while ( have_posts() ) : the_post();
        $post       = get_post();
        $Quote      = new Quote($post);
        $cita       = $Quote->getCita();
        $citatags   = $Quote->getCitatags();
        $book       = $Quote->getBook();

        if(!empty($book)){
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
        }else{
            continue;
        }
        

        
    endwhile; 
    ?>
</div>


<div class="jei-amz-grd">
    <h2>Otros libros de <span class="font-italic">"<?php echo $term->name;?>"</span></h2>
    <?php echo do_shortcode('[amazon template="vertical" grid="4" bestseller="%libros+'.$term->name.'%"]');?>

    <hr />

    <h2>Novedades Amazon de <span class="font-italic">"<?php echo $term->name;?>"</span></h2>
    <?php echo do_shortcode('[amazon template="vertical" items="12" new="libros+'.$term->name.'" grid="'.$tamano_grid.'"]'); ?>
</div>



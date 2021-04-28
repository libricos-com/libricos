<?php 
use App\Entity\Quote;

$Quote      = new Quote($post);
$cita       = $Quote->getCita();
$citatags   = $Quote->getCitatags();
$book       = $Quote->getBook();
$longTitle  = $Quote->getLibroLongTitle();
$shortTitle = $Quote->getLibroShortTitle();
$autorName  = $Quote->getAutorName();
$asin       = $Quote->getAsin();
$comentario = $Quote->getComentario();
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
?>

<?php 
if(!empty($comentario)){
?>
<h2>Comentario</h2>
<div class="mb-3">
    <?php echo $comentario;?>
<?php
}
?>
</div>


<div class="jei-amz-grd">
    <h2>Otros libros de <span class="font-italic"><?php echo $autorName;?></span></h2>
    <?php echo do_shortcode('[amazon template="vertical" grid="4" bestseller="%libros+'.$autorName.'%"]');?>

    <hr />

    <h2>Novedades Amazon de <span class="font-italic"><?php echo $autorName;?></span></h2>
    <?php echo do_shortcode('[amazon template="vertical" items="12" new="libros+'.$autorName.'" grid="4"]'); ?>
</div>
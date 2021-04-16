<?php 
/*
The template for displaying content in the single-libro.php template
@see: https://docs.pods.io/tutorials/get-values-from-a-relationship-field/
FIXME: ejemplo de corrección o mejora que debería hacerse
BUG: ejemplo de fallo gordo o error que afecta al sistema
TEST: ejemplo tag test
*/
use App\Entity\BookWpFactory;
use App\Entity\Review;
$libro       = BookWpFactory::create($post);
$tituloLibro = $libro->getTitulo();
$shortTitle  = $libro->getShortTitle();
$reviews     = $libro->getReviews();
$autorName   = $libro->getFirstAuthorName();

if(empty($reviews[0])){
    $object = $libro;
}else{
    $firstReview = (object)$reviews[0];
    $object = new Review($firstReview);
}
$notas = $libro->getNotas();
$id = $libro->getId();
$keywords = get_post_meta($id,'titulo')[0];
if( !empty($libro->getAmazon_search_keywords() ) ){
    $keywords = $libro->getAmazon_search_keywords();
}
if($id == 12883){ 
    $keywords = 'scott hahn';
}elseif($id == 13117){ 
    $keywords = 'kibeho';
}

$paginas = '';
if(!empty($libro->getPaginas())){
    $paginas = $libro->getPaginas();    
}

$citas = $libro->getCitas();
?>

<div class="lbc-file container-fluid">

    <div class="row pl-3 pr-3">
        <h1 class="lbc-h1"><?php echo $libro->getTitulo();?></h1>

        <ul class="list-inline-bullets">
            <li class="list-inline-item">
                <?php echo view('../partials/libro-autores', ['this2' =>  $object]);?>
            </li>
            <li class="list-inline-item">ISBN <?php echo $libro->getIsbn();?></li>
            <li class="list-inline-item">ASIN <?php echo $libro->getAsin();?></li>
            <li class="list-inline-item">
                <a href="<?php echo $libro->getEditorial_url();?>" title="Editorial"><?php echo $libro->getEditorial_nombre();?></a> (<?php echo substr($libro->getFecha_publicacion(), 0, 4);?>)
            </li>

            <li class="list-inline-item"> 
                <span class="<?php echo $libro->getFormato_icon();?>"></span>
                <?php echo $libro->getFormato_texto();?>&nbsp;<span class="flag-icon flag-icon-<?php echo $libro->getIdioma();?>"></span>  
            </li>


            <li class="list-inline-item">
                <a href="<?php echo $libro->getGoodreads_url();?>" title="Ficha del libro en Goodreads"><i class="fab fa-goodreads fa-2x"></i>
                </a>
            </li>  
        </ul>

        <?php echo view('../partials/publish-info', ['this2' => $object]);?>
    
        <div class="mt-3 mb-3">
            <?php echo do_shortcode("[addthis tool='addthis_inline_share_toolbox_qzzu']");?>
        </div>

    </div>

    <div class="row">
        <div class="col-sm-4 col-md-4">
            <?php echo do_shortcode('[amazon box="'.$libro->getAsin().'" template="book-vertical" style="dark" value="thumb" image_size="large" 
                
                tpl_pages="'.$paginas.'"
            
            ] ');?>
        </div> 
        <div class="lbc-contenido2 col-sm-8 col-md-8">
            <h2>Sinopsis</h2>
            <?php echo $libro->getSinopsis();?>
        </div>  
    </div>



    <div class="row pl-3 pr-3">
        <div class="col-sm-4 col-md-4">
            <?php if ( ! empty( $libro->getMapa() ) ) { ?>
                <iframe src="https://www.google.com/maps/d/embed?mid=<?php echo $libro->getMapa();?>" width="100%" height="300"></iframe>
            <?php } ?>
        </div>
        <div class="col-sm-8 col-md-8">
            <?php 
            if ( ! empty( $libro->getTableOfContents() ) ) {
            ?>
                <h2>Índice</h2>
                <?php echo $libro->getTableOfContents();?>
            <?php 
            }
            ?>
        </div>
    </div>

    <?php 
    if ( ! empty( $notas ) ) { ?>
        <div id="notas" class="container-fluid bg-dark mt-4 rounded">
            <h2 class="pt-3">Notas</h2>
            <div class="row">
                <?php
                $i = 1;
                foreach ( $notas as $nota ) { 
                    $id = $nota[ 'ID' ];
                    $urlNota = esc_url( get_permalink( $id ) );
                    $nombreNota = get_the_title( $id );
                    $fecha = date('d-m-y', strtotime($nota['post_date']));
                    $src = get_the_post_thumbnail_url( $id, 'post_thumbnail'  );
                    ?>
                    
                    <div class="col-sm-12 col-md-4 col-lg-4 d-flex align-items-stretch mb-4">    
                        <div class="card bg-secondary border-secondary text-white">
                            <div class="card-header">
                                <i class="fas fa-bookmark text-primary"></i>
                                <a href="<?php echo $urlNota;?>" data-toggle="tooltip" title="<?php echo $nombreNota;?>" class="text-white"><?php echo $nombreNota;?></a> 
                            </div>
                            <a href="<?php echo $urlNota;?>" data-toggle="tooltip" title="<?php echo $nombreNota;?>"><img class="card-img-top rounded" src="<?php echo $src;?>" alt="<?php echo $nombreNota;?>"></a>
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <p class="card-text"><?php echo $fecha;?></p>    
                            </div>                 
                        </div>   
                    </div>
                <?php
                    
                    if($i % 3 == 0) echo '</div><div class="row">';
                    $i++;
                } 
                ?>
            
            </div>
        </div>
        <?php
    } 
    ?>

</div>

<hr />

<div class="row">
    <div class="col-sm-12 col-md-6">
    <?php 
        if ( ! empty( $libro->getGeneros() ) ) {
        ?>
            <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                    <h2>Géneros</h2>
                    <ul class="jei-tag-cloud list-unstyled"> 
                        <?php 
                        foreach ( $libro->getGeneros() as $genero ) { 
                            $idA = $genero->term_id;
                            $nombreGenero = $genero->name;
                            $urlGenero = get_term_link($genero->term_id);
                            $numPosts = $genero->count;
                        ?>
                            <li class="d-inline">
                                <a href="<?php echo $urlGenero;?>" class="btn btn-sm mb-2"><?php echo $nombreGenero;?>
                                    <span class="badge badge-light"><?php echo $numPosts;?></span>
                                </a>  
                            </li>
                        <?php 
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <?php
        } 
        ?>
    </div>
    <div class="col-sm-12 col-md-6">
        <?php 
        if ( ! empty( $libro->getTags() ) ) {
        ?>
        <div class="card text-white bg-dark">
            <div class="card-body">
                <h2>Temáticas</h2>
                <ul class="jei-tag-cloud list-unstyled">
                    <?php 
                    $tags = $libro->getTags();
                    foreach ($tags as $tag) { 
                    ?>
                        <li class="d-inline">
                            <a href="<?php echo get_tag_link($tag->term_id);?>" class="btn btn-sm mb-2"><?php echo $tag->name;?>
                                <span class="badge badge-light"><?php echo $tag->count;?></span>
                            </a>
                        </li>
                    <?php
                    }           
                    ?>
                </ul>
            </div>
        </div>
        <?php
        } 
        ?>
    </div>    
</div>



<?php 
if ( ! empty( $citas ) ) { ?>
    <div id="citas" class="row pl-3 pr-3">
        <h2 class="pt-3">Citas</h2>
        <?php
        foreach ( $citas as $cita ) { 
            $idCita = $cita['ID'];
            $cita = get_post_meta( $idCita, 'cita', true );
            $citatags = get_the_terms( $idCita, 'citatag' );
            ?>
            <div class="mb-3">
                <blockquote class="col-sm-12 blockquote mb-0">
                    <i class="fas fa-quote-left fa-2x float-left pl-0 pr-3 pt-0 pb-3"></i>
                    <p class=""><?php echo $cita;?></p>
                    <footer class="text-right blockquote-footer">
                        <?php echo $autorName;?> en <cite title="<?php echo $tituloLibro;?>"><?php echo $shortTitle;?></cite>
                    </footer>
                </blockquote>
                <?php if(!empty($citatags)){ ?>
                    <ul class="ml-3 list-unstyled">  
                        <?php 
                        foreach ( $citatags as $term ) {
                        ?>
                            <li class="d-inline">
                                <a href="<?php echo get_term_link($term->term_id);?>" class="">
                                    <?php echo $term->name;?></a>
                            </li>
                        <?php 
                        }
                        ?>
                    </ul>
                <?php } ?>
            </div>
            <?php 
        } 
        ?> 
    </div>
    <?php
} 
?>


<hr />


<h2>Libros similares a <?php echo $libro->getTitulo();?></h2>
<div class="text-center p-2">
    <?php 
    echo do_shortcode('[amazon template="vertical" grid="4" bestseller="'.$keywords.'"]');
    // echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="'.$tamano_grid.'" template="my-vertical"]');
    ?>
</div>	





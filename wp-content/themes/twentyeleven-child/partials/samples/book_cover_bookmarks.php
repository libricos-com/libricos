<!-- https://www.w3schools.com/howto/howto_css_image_text.asp -->
<div class="container text-center mt-4">
        <figure class="figure">
            <img src="<?php echo $libro->getPortada_src();?>" class="figure-img img-fluid rounded" alt="Portada del libro <?php echo $libro->getTitulo();?>">
            <figcaption class="figure-caption text-right">Portada del libro <?php echo $libro->getTitulo();?></figcaption>

            <?php 
            if ( ! empty( $notas ) ) { ?>
                <div class="d-flex flex-wrap justify-content-start top-left flex-row-reverse pr-2">
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
                <div>
                    <span class="<?php echo $libro->getFormato_icon();?>"></span>
                    <?php echo $libro->getFormato_texto();?>&nbsp;<span class="flag-icon flag-icon-<?php echo $libro->getIdioma();?>"></span>
                </div>
            </div>
        </figure>
    </div>
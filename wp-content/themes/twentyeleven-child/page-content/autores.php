<h1>Autores</h1>
<?php
$args = array(
    'post_type' => 'autor',
    'post_status' => 'publish',
    'posts_per_page' => -1
);

global $wp_query;
query_posts($args);
if ( have_posts() ) { 
    twentyeleven_content_nav( 'nav-above' );
    ?>
    <div id="autores" class="container-fluid">
        <div class="row">
            <?php
            $i = 1;
            while(have_posts()){
                the_post(); 
                // the_content();
                // get_template_part( 'content', get_post_format() ); 
                $id = get_the_ID();
                $titulo = get_the_title();
                $url = esc_url( get_permalink( $id ) );
                $pod = pods( 'autor', $id );
                $portada = $pod->field( 'portada' );
                $portada = wp_get_attachment_image_src($portada['ID'], 400)[0];
                ?>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
                        <a href="<?php echo $url;?>"><img class="rounded-circle z-depth-2 circlex" alt="Imagen del autor <?php echo $titulo;?>" src="<?php echo $portada;?>"
                        data-holder-rendered="true"></a>
                        <h1 class="h5 mt-2"><?php echo $titulo;?></h1>
                    </div>
                <?php
                $i++;
            }
            ?>    
        </div>
    </div>
    <?php
    twentyeleven_content_nav( 'nav-below' );
}
wp_reset_query();

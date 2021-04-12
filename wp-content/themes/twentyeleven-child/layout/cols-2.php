<?php
/*
Layout base 

@see: 
- https://florianbrinkmann.com/en/organizing-files-functions-wordpress-theme-4190/
- https://developer.wordpress.org/themes/basics/template-hierarchy/
- https://wordpress.org/support/topic/providing-templates-with-php/
*/

get_header(); 
?>
<div id="primary">
        
        <div id="content" role="main" class="entry-content container-fluid">

                <div class="row">
                        
                        <div class="col-sm-9 col-md-9">
                                <?php get_template_part( 'page-content/'.$page, 'page' );?>

                                <?php comments_template( '', true ); ?>                       
                        </div>

                        <div class="col-sm-3 col-md-3">
                                <?php
                                $args = array(
                                'taxonomy' => 'genero',
                                'hide_empty' => false
                                );
                                $terms = get_terms($args);
                                if($terms){
                                echo view('../partials/searchform-complete', array(
                                'this2' => (object)[
                                'terms' => $terms,
                                'placeholder' => 'Busca libricos por temática, título, autor, ...'
                                ])
                                );
                                }
                                ?>
                        </div>
                        
                </div>    
        </div>    
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

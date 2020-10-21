<?php
/**
 * Añade al this de AAWP los datos de mis libros en el POD libro
 *
 * @param mixed $this2 El this del AAWP
 * @return void
 */
function set_libro( object $this2 = null ) : object
{
    // Tratamiento constructor
    $this2 = $this2 ?? new stdClass();

    // Params generales para ambos casos
    $this2->params = array( 
        'orderby' => 'post_date DESC'
    );
    $this2->hay_reviews = false;
    $this2->post_type = get_post_type(); // page o libro

    // Fn get_id_libro();
    if( $this2->post_type == 'libro' ){
        $this2->id_libro = get_the_id(); // id page 81 o id post libro 12298
    }else{
        // Venimos de una plantilla AAWP, pasar solo estados y asin
        $this2->ids = $this2->get_template_variable( 'ids', false );
        $this2->index = $this2->item_index;
        // $variables = $this->get_template_variables();
        if( !is_array($this2->ids) ){
            $this2->ids = explode(',', $this2->ids);
        }
        if(!empty($this2->ids[ $this2->index - 1 ])){
            $index = $this2->index - 1;
            $this2->id_libro =  $this2->ids[ $index ];
        }
    }

    // 1 único POD para ambos casos
    $this2->pod = pods( 'libro', $this2->id_libro );

    // Cogemos las reviews en ambos casos
    $this2->reviews = $this2->pod->field( 'reviews', $this2->params );
    if($this2->reviews){
        $this2->hay_reviews = true;
        $this2->numReviews = count($this2->reviews);
    }else{
        $this2->numReviews = 0;
    }




    if( $this2->post_type == 'libro' ){
        // Venimos de Ficha Libro
        $this2->titulo = get_post_meta( $this2->id_libro, 'titulo', true );
        $this2->post_title = get_the_title();
        $this2->asin = get_post_meta( $this2->id_libro, 'asin', true );
        $this2->url_libro = $this2->url = esc_url( get_permalink( $this2->id_libro ) );
        $this2->puntuacion = '0.0';
        $this2->rating_percent = 0;
        $this2->estado = false;
        $txt = '';

        $colors = ['danger', 'warning', 'success', 'primary', 'info', 'secondary'];
        $icon_cls = ['danger', 'warning', 'success', 'primary', 'info', 'secondary'];

        // $this2->portada = get_post_meta($this2->id,'portada');
        $this2->portada = $this2->pod->field( 'portada' );
        $this2->src = wp_get_attachment_image_src($this2->portada['ID'], 400);
        $this2->sinopsis = $this2->pod->field( 'sinopsis' );

        $this2->autores = $this2->pod->field( 'autores' );
        $this2->generos = $this2->pod->field( 'generos_literarios' );
        $this2->notas   = $this2->pod->field( 'notas', $this2->params );

        // Venimos de la Ficha libro
        // @see: https://developer.wordpress.org/reference/functions/wp_list_categories/
        $taxonomy = 'category';
        // Get the term IDs assigned to post.
        $post_terms = wp_get_object_terms( $this2->id_libro, $taxonomy, array( 'fields' => 'ids' ) ); 
        if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
            $term_ids = implode( ',' , $post_terms );
            $args = array(
                'title_li'   => '',
                'style'      => 'list',
                'echo'       => false,
                'taxonomy'   => $taxonomy,
                'include'    => $term_ids,
                'orderby'    => 'name',
                'show_count' => true
            );
            $this2->categories = wp_list_categories( $args );
            // $this2->terms = str_replace('cat-item', 'list-group-item', $terms);
        }

        // @see: https://developer.wordpress.org/reference/functions/wp_list_categories/
        $taxonomy = 'post_tag';
        // Get the term IDs assigned to post.
        $post_terms = wp_get_object_terms( $this2->id_libro, $taxonomy, array( 'fields' => 'ids' ) ); 
        if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
            $term_ids = implode( ',' , $post_terms );
            $args = array(
                'title_li'   => '',
                'style'      => 'list',
                'echo'       => false,
                'taxonomy'   => $taxonomy,
                'include'    => $term_ids,
                'orderby'    => 'name',
                'show_count' => true
            );
            $this2->tags = wp_list_categories( $args );
            // $terms = str_replace('cat-item', 'list-group-item', $terms);
        }


        $this2->editorial = $this2->pod->field( 'editorial' );
        $this2->url_editorial = esc_url( get_permalink( $this2->editorial['ID'] ) );

        // $this2->fecha_publicacion = get_post_meta($this2->id,'fecha_publicacion')[0];
        $this2->fecha_publicacion = $this2->pod->field( 'fecha_publicacion' );
        // $this2->paginas = get_post_meta($this2->id,'paginas')[0];
        $this2->paginas = $this2->pod->field( 'paginas' );
        // $this2->idioma = get_post_meta($this2->id,'idioma')[0];
        $this2->idioma = $this2->pod->field( 'idioma' );
        // $this2->url_goodreads = get_post_meta($this2->id,'url_goodreads')[0];
        $this2->url_goodreads = $this2->pod->field( 'url_goodreads' );
        
        // $this2->formato = get_post_meta($this2->id,'formato');
        $this2->formato = $this2->pod->field( 'formato' );
        
        /*
        Formato:
        1 | Kindle
        2 | E-book
        3 | Paperback
        4 | Hardback
        5 | Audiobook
        */
        switch ($this2->formato) {
            case 1:
                $this2->icon_formato = 'fab fa-amazon';
                $this2->texto_formato = 'Kindle';
                break;
            case 2:
                $this2->icon_formato = 'fas fa-tablet-alt';
                $this2->texto_formato = 'E-book';
                break;
            case 3:
                $this2->icon_formato = 'fas fa-book-open';
                $this2->texto_formato = 'Paperback';
                break;
            case 4:
                $this2->icon_formato = 'fas fa-book';
                $this2->texto_formato = 'Hardback';
                break;
            case 5:
                $this2->icon_formato = 'fas fa-volume-up';
                $this2->texto_formato = 'Audiobook';
                break;
            default:
                $this2->icon_formato = 'fas fa-question';
                $this2->texto_formato = '-';
                break;
        }

    }else{
        // Venimos de una plantilla AAWP, pasar solo estados y asin
        $this2->url_libro  = $this2->get_product_url();
        $this2->asin = $this2->get_product_id();

        
        $this2->estado = $this2->pod->field( 'estado' );
        $this2->reviews = $this2->pod->field( 'reviews', $this2->params );
        
        $this2->url_libro = esc_url( get_permalink( $this2->id_libro ) );

        $this2->post_title = get_the_title($this2->id_libro);
        
        $this2->puntuacion = $this2->pod->field( 'mi_puntuacion');
        if(!empty( get_post_meta($this2->puntuacion ))){
            if(is_numeric($this2->puntuacion)){
                $this2->puntuacion = floatval(get_post_meta($this2->id_libro,'mi_puntuacion')[0]);
                $this2->rating_percent = $this2->puntuacion*100/5;
            }  
        }
        if(!$this2->hay_reviews){
            /*
            0 | Por leer
            1 | Siguiente
            2 | Leído
            3 | Leyendo
            4 | Cerrado
            5 | Pausado
            6 | No interesado
            7 | Cuarentena

            <a class="badge badge-success" href="<?php echo $urlReview;?>" data-toggle="tooltip" 
            title="Ficha del libro <?php echo $this2->post_title;?>">
                <i class="fas fa-check"></i>
                Reviewed
            </a> 
            */ 
            switch ($this2->estado) {
                case '0':
                    $color = 'primary';
                    $icon_cls = 'book';
                    $txt = 'Por leer';
                    $tooltip = 'Añadido a la biblioteca';
                    break;
                case '1':
                    $color = 'warning';
                    $icon_cls = 'fire-alt';
                    $txt = 'Próximamente';
                    $tooltip = 'Se leerá en las próximas semanas';
                    break;
                case '2':
                    $color = 'primary';
                    $icon_cls = 'book';
                    $txt = 'Leído';
                    $tooltip = 'Leído en espera de review';
                    break;
                case '3':
                    $color = 'info';
                    $icon_cls = 'book-reader';
                    $txt = 'Leyendo ahora';
                    $tooltip = 'Actualmente leyendo';
                    break;
                case '4':
                    $color = 'secondary';
                    $icon_cls = 'book';
                    $txt = 'Cerrado';
                    $tooltip = 'Pausado para largo tiempo';
                    break;
                case '5':
                    $color = 'secondary';
                    $icon_cls = 'check';
                    $txt = 'Pausado';
                    $tooltip = 'Pausado por corto tiempo';
                    break;
                case '6':
                    $color = 'secondary';
                    $icon_cls = 'check';
                    $txt = 'No interesado';
                    $tooltip = 'No recomendable';
                    break;
                case '7':
                    $color = 'secondary';
                    $icon_cls = 'check';
                    $txt = 'Cuarentena';
                    $tooltip = 'Argumentos puestos en duda';
                    break;
                default:
                    # code...
                    break;
            }

            $this2->estado = (object)[
                'color'     => $color,
                'url_libro' => $this2->url_libro,
                'tooltip'   => $tooltip,
                'icon_cls'  => $icon_cls,
                'txt'       => $txt,
                'value'     => $this2->estado
            ];
        }
        // echo aawp_get_field_value($asin, 'price');
        

    // @see: https://getaawp.com/docs/article/fields-single-product-data/
    $this2->is_prime = aawp_get_field_value($this2->asin, 'prime');
    // $this->is_premium = aawp_get_field_value($this->asin, 'premium');

    // $this->star_rating = aawp_get_field_value($this->asin, 'star_rating');
    // $this->star_rating = do_shortcode('[amazon fields="'.$this->asin.'" value="star_rating"]');
    // $this->star_rating = do_shortcode('[amazon box="'.$this->asin.'" rating="4.5"]');                                                                            


    }

    
    return $this2;
}



/**
 * Caja Amazon class Libros
 * Captura las últimas reviews y coge los asins y los ids del libro correspondiente 
 *
 * @param string[] $input
 * @return string[ string $asins, string $ids ]
 */
function get_libros_asins($input)
{
    $asins = $ids = '';
    $libros = get_posts($input);
    if( ! empty( $libros ) ){
        foreach ( $libros as $libro ){
            if(empty($libro->asin)){
                continue;
            }
            $asins .= $libro->asin.',';
            $ids .= $libro->ID.',';
        }
        
        // Remove duplicate ids 
        $asins = implode(',', array_unique(explode(',', $asins)));
        $ids = implode(',', array_unique(explode(',', $ids)));

        // and remove last comma
        $asins = rtrim($asins,',');
        $ids = rtrim($ids,',');
    }

    return [
        $asins, 
        $ids
    ];
}
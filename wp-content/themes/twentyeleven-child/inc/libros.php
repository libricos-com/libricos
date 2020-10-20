<?php
/**
 * Añade al this de AAWP los datos de mis libros en el POD libro
 *
 * @param mixed $this2 El this del AAWP
 * @return void
 */
function set_libro($this2)
{
    $this2->asin = $this2->get_product_id();
    $this2->ids = $this2->get_template_variable( 'ids', false );
    $this2->index = $this2->item_index;
    // $variables = $this->get_template_variables();
    if( !is_array($this2->ids) ){
        $this2->ids = explode(',', $this2->ids);
    }

    // $url1 = $this->get_product_image_link();
    $this2->url_libro  = $this2->get_product_url();

    $this2->puntuacion = '0.0';
    $this2->rating_percent = 0;
    $this2->hay_reviews = false;
    $this2->estado = false;
    $this2->url_libro = '#';
    $txt = '';

    $colors = ['danger', 'warning', 'success', 'primary', 'info', 'secondary'];
    $icon_cls = ['danger', 'warning', 'success', 'primary', 'info', 'secondary'];

    if(!empty($this2->ids[ $this2->index - 1 ])){

        $index = $this2->index - 1;
        $this2->id_libro =  $this2->ids[ $index ];
        
        $this2->post_title = get_the_title($this2->id_libro);
        $this2->url_libro = esc_url( get_permalink( $this2->id_libro ) );

        $this2->pod = pods( 'libro', $this2->id_libro );
        $this2->params = array( 
            // 'orderby' => 'post_date DESC'
        );
        
        $this2->reviews = $this2->pod->field( 'reviews', $this2->params );
        // $this->puntuacion = $this->pod->field( 'mi_puntuacion');
        if(!empty( get_post_meta($this2->id_libro,'mi_puntuacion')[0] )){
            if(is_numeric($this2->puntuacion)){
                $this2->puntuacion = floatval(get_post_meta($this2->id_libro,'mi_puntuacion')[0]);
                $this2->rating_percent = $this2->puntuacion*100/5;
            }  
        }
        if($this2->reviews){
            $this2->hay_reviews = true;
            $this2->numReviews = count($this2->reviews);
        }else{
            $this2->numReviews = 0;

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
            $this2->estado = $this2->pod->field( 'estado' );
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
    }

    // @see: https://getaawp.com/docs/article/fields-single-product-data/
    $this2->is_prime = aawp_get_field_value($this2->asin, 'prime');
    // $this->is_premium = aawp_get_field_value($this->asin, 'premium');

    // $this->star_rating = aawp_get_field_value($this->asin, 'star_rating');
    // $this->star_rating = do_shortcode('[amazon fields="'.$this->asin.'" value="star_rating"]');
    // $this->star_rating = do_shortcode('[amazon box="'.$this->asin.'" rating="4.5"]');                                                                            

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
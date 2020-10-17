<?php
/**
 * Añade al this de AAWP los datos de mis libros en el POD libro
 *
 * @param mixed $this2 El this del AAWP
 * @return void
 */
function set_review($this2)
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
    $this2->url_goodreads = '';
    $this2->texto = '';


    if(!empty($this2->ids[ $this2->index - 1 ])){

        $index = $this2->index - 1;
        $this2->id_review =  $this2->ids[ $index ];
        
        
        $this2->post_title = get_the_title($this2->id_review);
        $this2->post_date = get_fecha_larga($this2->id_review);
        // $this2->id_libro1 =  $this2->pod->field( 'libro');
        $this2->id_libro = get_post_meta($this2->id_review,'libro')[0]['ID'];
        $this2->url_libro = esc_url( get_permalink( $this2->id_libro ) );
        $this2->url_review = esc_url( get_permalink( $this2->id_review ) );
        $this2->num_comments = get_comments_number( $this2->id_review );

        $this2->pod = pods( 'libro', $this2->id_libro );
        // echo aawp_get_field_value($asin, 'price');
        $this2->autores = $this2->pod->field( 'autores' );

        if(!empty( get_post_meta($this2->id_review,'url_goodreads')[0] )){
            $this2->url_goodreads = get_post_meta($this2->id_review,'url_goodreads')[0];
        }
        if(!empty( get_post_meta($this2->id_review,'texto')[0] )){
            $this2->texto = get_post_meta($this2->id_review,'texto')[0]; 
            $this2->texto = get_first_paragraph($this2->texto);
        }

        if(!empty( get_post_meta($this2->id_review,'puntuacion')[0] )){
            if(is_numeric($this2->puntuacion)){
                $this2->puntuacion = floatval(get_post_meta($this2->id_review,'puntuacion')[0]);
                $this2->rating_percent = $this2->puntuacion*100/5;
            }  
        }
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
 * Caja Amazon class Reviews
 * Captura las últimas reviews y coge los asins y los ids del libro correspondiente 
 *
 * @param string[] $input
 * @return string[ string $asins, string $ids ]
 */
function get_reviews_asins($input)
{
    $asins = $ids = '';
    $reviews = get_posts($input);
    if( ! empty( $reviews ) ){
        foreach ( $reviews as $review ){
            $libro = get_post_meta( $review->ID, 'libro', true );
            $id = $libro['ID'];
            $asin = get_post_meta( $id, 'asin', true );
            $id_review = $review->ID;
            
            if(!empty($asin)){
                $asins .= $asin.',';
                $ids .= $id_review.',';
            }
        }

        // and remove last comma
        $asins = rtrim($asins,',');
        $ids = rtrim($ids,',');
    }

    return [
        $asins, 
        $ids
    ];
}
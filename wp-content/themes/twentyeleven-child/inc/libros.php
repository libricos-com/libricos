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

    if(!empty($this2->ids[ $this2->index - 1 ])){

        $index = $this2->index - 1;
        $this2->id_libro =  $this2->ids[ $index ];
        
        $this2->hay_reviews = false;
        $this2->post_title = get_the_title($this2->id_libro);
        $this2->url_libro = esc_url( get_permalink( $this2->id_libro ) );

        $this2->pod = pods( 'libro', $this2->id_libro );
        $this2->params = array( 
            // 'orderby' => 'post_date DESC'
        ); 
        $this2->reviews = $this2->pod->field( 'reviews', $this2->params );
        // $this->puntuacion = $this->pod->field( 'mi_puntuacion');
        $this2->puntuacion = '0.0';
        $this2->rating_percent = 0;
        if(!empty(get_post_meta($this2->id_libro,'mi_puntuacion')[0])){
            $this2->puntuacion = get_post_meta($this2->id_libro,'mi_puntuacion')[0];
            $this2->rating_percent = $this2->puntuacion*100/5;
        }
        if($this2->reviews){
            $this2->hay_reviews = true;
            $this2->numReviews = count($this2->reviews);
        }else{
            $this2->numReviews = 0;
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
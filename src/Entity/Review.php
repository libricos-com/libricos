<?php
namespace App\Entity;
/**
 * Review class
 * 
 * Tomado de inc/samples/Factory_Static.php
 * @see https://carlalexander.ca/static-factory-method-pattern-wordpress/
 * @see https://carlalexander.ca/static-keyword-wordpress/
 * @see https://stackoverflow.com/questions/1699796/best-way-to-do-multiple-constructors-in-php
 */
class Review
{
    /**
     * Id de la review en Wordpress
     *
     * @var integer
     */
    private $_reviewId; //  Libro de la reseña

    /**
     * Datos de entrada para la reseña 
     *
     * @var mixed
     */
    private $_book; //  Libro de la reseña

    /**
     * The WordPress CPT
     *
     * @var integer
     */
    private $_aawp;

    /**
     * POD correspondiente a la reseña
     *
     * @var object
     */
    private $_pod;

    /**
     * Params sql (order) para capturar datos
     *
     * @var array
     */
    private $params = array(
        'posts_per_page' => -1,
        'post_type' => 'review',
        'orderby' => 'post_date DESC'
    );

    /**
     * Goodreads url de la ficha del libro
     *
     * @var string
     */
    private $_goodreads_url;

    /**
     * Texto de la reseña
     *
     * @var object
     */
    private $_content;

    /**
     * Mi puntuación del libro basada en una reseña (Observer pattern here)
     *
     * @var double
     */
    private $_rating;

    /**
     * Mi puntuación del libro basada en una reseña (Observer pattern here)
     *
     * @var double
     */
    private $_rating_percent;

    /**
     * Mi puntuación del libro basada en una reseña (Observer pattern here)
     *
     * @var date
     */
    private $_post_date;


    /**
     * Tipo de post
     *
     * @var string
     */
    private $_post_type;

 
    /**
     * Constructor.
     *
     * Partes comunes a todo tipo de entrada
     */
    public function __construct( $object = null )
    {
        if(!is_null($object)){
            if($object instanceof \AAWP_Template_Handler){
                $this->_aawp = $object;
                $this->_reviewId = $this->getReviewId();
                $this->asin = $this->_aawp->get_product_id();
                $this->fillAawp();
            }elseif(is_object($object) || $object instanceof \WP_Post){
                $this->_post = $object;
                $this->_reviewId = $object->ID;
                
            }  
            $this->fill();
        }
        
        // Sólo para determinados listados
        return $this;
    }


    protected function getReviewId()
    {
        $this->ids = $this->_aawp->get_template_variable( 'ids', false );
        $this->index = $this->_aawp->item_index;
        
        // $variables = $this->get_template_variables();
        if( !is_array($this->ids) ){
            $this->ids = explode(',', $this->ids);
        }

        if(!empty($this->ids[ $this->index - 1 ])){
            $index = $this->index - 1;
            return $this->ids[ $index ];
        }
        return false;
    }


    public function fill()
    {
        $post_id = $this->_reviewId;
        $this->_goodreads_url = '';
        $this->texto = '';

        $this->post_title = get_the_title($post_id);
        $this->_post_date = get_fecha_larga($post_id);
        $this->_post_type = 'review';
        // $this->id_libro1 =  $this->pod->field( 'libro');
        $this->id_libro = get_post_meta($post_id,'libro', true)['ID'];
        $this->url_libro = esc_url( get_permalink( $this->id_libro ) );
        $this->url_review = esc_url( get_permalink( $post_id ) );
        $this->num_comments = get_comments_number( $post_id );
        $this->contenido = get_post_meta($post_id,'contenido', true);
        // $this->portadaLibro = get_post_meta($this->id_libro,'portada');
        // $this->src = get_the_post_thumbnail_url( $post_id, 'post_thumbnail' );
        $this->libroTitle = get_the_title($this->id_libro);

        $this->_pod = pods( 'libro', $this->id_libro );
        $this->asin = get_post_meta($this->id_libro,'asin', true);
        // echo aawp_get_field_value($asin, 'price');
        $this->autores = $this->_pod->field( 'autores' );

        if(!empty( get_post_meta($this->_reviewId,'goodreads_url', true) )){
            $this->_goodreads_url = get_post_meta($this->_reviewId,'goodreads_url', true);
        }
        if(!empty( get_post_meta($this->_reviewId,'contenido', true) )){
            $this->texto = get_post_meta($this->_reviewId,'contenido', true); 
            $this->texto = get_first_paragraph($this->texto);
        }

        $this->calculateRating($this->_reviewId);
    }

    public function fillAawp()
    {
        // $url1 = $this->get_product_image_link();
        $this->url_libro  = $this->_aawp->get_product_url();

        // @see: https://getaawp.com/docs/article/fields-single-product-data/
        $this->is_prime = aawp_get_field_value($this->asin, 'prime');
        // $this->is_premium = aawp_get_field_value($this->asin, 'premium');

        // $this->star_rating = aawp_get_field_value($this->asin, 'star_rating');
        // $this->star_rating = do_shortcode('[amazon fields="'.$this->asin.'" value="star_rating"]');
        // $this->star_rating = do_shortcode('[amazon box="'.$this->asin.'" rating="4.5"]');                   
    }


    public function calculateRating($post_id)
    {
        $this->_rating = '0.0';
        $this->_rating_percent = 0;

        if(!empty( get_post_meta($post_id,'rating', true) )){
            if(is_numeric( get_post_meta($post_id,'rating', true) )){
                $this->_rating = floatval(get_post_meta($post_id,'rating', true));
                $this->_rating_percent = $this->_rating*100/5;
            }  
        }
    }


    /**
     * Caja Amazon class Reviews
     * Captura las últimas reviews y coge los asins y los ids del libro correspondiente 
     *
     * @param string[] $input
     * @return string[ string $asins, string $ids ]
     */
    public function get_reviews_asins($input)
    {
        $asins = $ids = '';
        $posts = get_posts($input);
        if( ! empty( $posts ) ){
            foreach ( $posts as $post ){
                $post_id = $post->ID;
                $libro = get_post_meta( $post_id, 'libro', true );
                if(empty($libro['ID'])){
                    continue;
                }
                $id = $libro['ID'];
                $asin = get_post_meta( $id, 'asin', true );
                
                if(!empty($asin)){
                    $asins .= $asin.',';
                    $ids .= $post_id.',';
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

    public function getReviewIdWp()
    {
        return $this->_reviewId;
    }

    public function get_post_date()
    {
        return $this->_post_date;
    }

    public function getPostType()
    {
        return $this->_post_type;
    }

    public function getGoodreadsUrl()
    {
        return $this->_goodreads_url;
    }

    public function get_rating()
    {
        return $this->_rating;
    }

    public function get_rating_percent()
    {
        return $this->_rating_percent;
    }

    // TODO: review.getAll() pasarlo a método static
    public function get_all($params = null)
    {
        if(empty($params)){
            $params = $this->params;
        }
        return $this->get_reviews_asins($params);
    }


}


<?php
namespace Jesuserro\Entity;
/**
 * Libro class
 * 
 * Tomado de inc/samples/Factory_Static.php
 * @see https://carlalexander.ca/static-factory-method-pattern-wordpress/
 * @see https://carlalexander.ca/static-keyword-wordpress/
 * @see https://stackoverflow.com/questions/1699796/best-way-to-do-multiple-constructors-in-php
 */
class Libro
{
    /**
     * The Libro's ID, WordPress post ID.
     *
     * @var integer
     */
    private $id;
 
    /**
     * The ASIN of the product.
     *
     * @var string
     */
    private $asin;

    /**
     * The titulo del libro.
     *
     * @var string
     */
    private $titulo;
 
    /**
     * The type of the post.
     *
     * @var string
     */
    private $post_type;

    /**
     * POD correspondiente al libro
     *
     * @var object
     */
    private $pod;

    /**
     * Post's reviews
     *
     * @var array
     */
    private $reviews;


    /**
     * Params sql (order) para capturar datos
     *
     * @var array
     */
    private $params = [ 'orderby' => 'post_date DESC' ];

    /**
     * Libro url
     *
     * @var string
     */
    private $url;

    /**
     * Libro portada
     *
     * @var string
     */
    private $portada_src;

    /**
     * Descripción del libro por la editorial
     *
     * @var string
     */
    private $sinopsis;

    /**
     * Autores del libro
     *
     * @var array
     */
    private $autores;

    /**
     * Géneros del libro
     *
     * @var array
     */
    private $generos;

    /**
     * Notas del libro
     *
     * @var array
     */
    private $notas;

    /**
     * Categorías del libro
     *
     * @var array
     */
    private $categorias;

    /**
     * Tags del libro
     *
     * @var array
     */
    private $tags;

    /**
     * URL de la editorial
     *
     * @var string
     */
    private $editorial_url;

    /**
     * Nombre de la editorial
     *
     * @var string
     */
    private $editorial_nombre;

    /**
     * Fecha de publicación del libro
     *
     * @var date
     */
    private $fecha_publicacion;

    /**
     * Texto del formato del libro
     *
     * @var string
     */
    private $formato_texto;

    /**
     * Icono del formato del libro
     *
     * @var string
     */
    private $formato_icon;

    /**
     * Número de páginas del libro
     *
     * @var integer
     */
    private $paginas;

    /**
     * Idioma
     *
     * @var string
     */
    private $idioma;

    /**
     * Goodreads url de la ficha del libro
     *
     * @var string
     */
    private $goodreads_url;

 
    /**
     * Constructor.
     *
     */
    public function __construct()
    {
        $this->post_type = get_post_type(); // page (AAWP_Template_Handler) o libro (WP_POST)
    }

    /**
     * Creates a new product from a post object.
     *
     * @param \WP_Post $post
     *
     * @return Libro|null
     */
    public static function from_post( \WP_Post $post)
    {
        if ($post instanceof \WP_Post) {
            $instance = new self();
            return $instance->fill_post( $post );
        }
    }

    /**
     * Creates a new product from API data.
     *
     * @param \AAWP_Template_Handler $product
     *
     * @return Libro|null
     */
    public static function from_aawp( \AAWP_Template_Handler $product)
    {
        if ($object instanceof \AAWP_Template_Handler) {
            $instance = new self();
            return $instance->fill_aawp( $product );
        }
    }

    /**
     * Undocumented function
     * Fill all properties from an Amazon object template
     * 
     * @param \AAWP_Template_Handler $product
     * @return void
     */
    protected function fill_aawp( \AAWP_Template_Handler $product ) 
    {

    }

    /**
     * Undocumented function
     * Fill all properties from a Wordpress post
     * 
     * @param \WP_Post $post
     * @return void
     */
    protected function fill_post( \WP_Post $post ) 
    {
        $this->id  = get_the_id();
        $this->pod = pods( 'libro', $this->id );
        $this->reviews = $this->pod->field( 'reviews', $this->params );

        $this->titulo = get_post_meta( $this->id, 'titulo', true );
        $this->post_title = get_the_title();
        $this->asin = get_post_meta( $this->id, 'asin', true );
        $this->url = $this->url = esc_url( get_permalink( $this->id ) );
        $this->puntuacion = '0.0';
        $this->rating_percent = 0;

        // $this->portada = get_post_meta($this->id,'portada');
        $this->portada = $this->pod->field( 'portada' );
        $this->portada_src = wp_get_attachment_image_src($this->portada['ID'], 400)[0];
        $this->sinopsis = $this->pod->field( 'sinopsis' );

        $this->autores = $this->pod->field( 'autores' );
        $this->generos = $this->pod->field( 'generos_literarios' );
        $this->notas   = $this->pod->field( 'notas', $this->params );

        // Venimos de la Ficha libro
        // @see: https://developer.wordpress.org/reference/functions/wp_list_categories/
        $taxonomy = 'category';
        // Get the term IDs assigned to post.
        $post_terms = wp_get_object_terms( $this->id, $taxonomy, array( 'fields' => 'ids' ) ); 
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
            $this->categorias = wp_list_categories( $args );
            // $this->terms = str_replace('cat-item', 'list-group-item', $terms);
        }

        // @see: https://developer.wordpress.org/reference/functions/wp_list_categories/
        $taxonomy = 'post_tag';
        // Get the term IDs assigned to post.
        $post_terms = wp_get_object_terms( $this->id, $taxonomy, array( 'fields' => 'ids' ) ); 
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
            $this->tags = wp_list_categories( $args );
            // $terms = str_replace('cat-item', 'list-group-item', $terms);
        }


        $this->editorial = $this->pod->field( 'editorial' );
        $this->editorial_url = esc_url( get_permalink( $this->editorial['ID'] ) );
        $this->editorial_nombre = $this->editorial['post_title'];

        // $this->fecha_publicacion = get_post_meta($this->id,'fecha_publicacion')[0];
        $this->fecha_publicacion = $this->pod->field( 'fecha_publicacion' );
        // $this->paginas = get_post_meta($this->id,'paginas')[0];
        $this->paginas = $this->pod->field( 'paginas' );
        // $this->idioma = get_post_meta($this->id,'idioma')[0];
        $this->idioma = $this->pod->field( 'idioma' );
        // $this->url_goodreads = get_post_meta($this->id,'url_goodreads')[0];
        $this->goodreads_url = $this->pod->field( 'url_goodreads' );
        
        // $this->formato = get_post_meta($this->id,'formato');
        $this->formato = $this->pod->field( 'formato' );
        
        /*
        Formato:
        1 | Kindle
        2 | E-book
        3 | Paperback
        4 | Hardback
        5 | Audiobook
        */
        switch ($this->formato) {
            case 1:
                $this->formato_icon = 'fab fa-amazon';
                $this->formato_texto = 'Kindle';
                break;
            case 2:
                $this->formato_icon = 'fas fa-tablet-alt';
                $this->formato_texto = 'E-book';
                break;
            case 3:
                $this->formato_icon = 'fas fa-book-open';
                $this->formato_texto = 'Paperback';
                break;
            case 4:
                $this->formato_icon = 'fas fa-book';
                $this->formato_texto = 'Hardback';
                break;
            case 5:
                $this->formato_icon = 'fas fa-volume-up';
                $this->formato_texto = 'Audiobook';
                break;
            default:
                $this->formato_icon = 'fas fa-question';
                $this->formato_texto = '-';
                break;
        }
        return $this;
    }
 

    /**
     * Get the actions that Libro hooks to.
     * Usage: Libro::get_actions();
     *
     * @return array
     */
    public static function get_actions()
    {
        $actions = array('wp_loaded');
        return $actions;
    }


    public function get_id()
    {
        return $this->id;
    }

    public function get_asin()
    {
        return $this->asin;
    }

    public function get_url()
    {
        return $this->url;
    }

    public function get_portada_src()
    {
        return $this->portada_src;
    }

    public function get_titulo()
    {
        return $this->titulo;
    }

    public function get_sinopsis()
    {
        return $this->sinopsis;
    }

    public function get_autores()
    {
        return $this->autores;
    }

    public function get_generos()
    {
        return $this->generos;
    }

    public function get_notas()
    {
        return $this->notas;
    }

    public function get_categorias()
    {
        return $this->categorias;
    }

    public function get_tags()
    {
        return $this->tags;
    }

    public function get_editorial_url()
    {
        return $this->editorial_url;
    }

    public function get_editorial_nombre()
    {
        return $this->editorial_nombre;
    }

    public function get_fecha_publicacion()
    {
        return $this->fecha_publicacion;
    }

    public function get_formato_icon()
    {
        return $this->formato_icon;
    }

    public function get_formato_texto()
    {
        return $this->formato_texto;
    }

    public function get_paginas()
    {
        return $this->paginas;
    }

    public function get_idioma()
    {
        return $this->idioma;
    }

    public function get_goodreads_url()
    {
        return $this->goodreads_url;
    }

    public function get_reviews()
    {
        return $this->reviews;
    }

}


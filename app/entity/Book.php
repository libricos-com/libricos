<?php
namespace App\Entity;
/**
 * Book class
 * 
 * Tomado de inc/samples/Factory_Static.php
 * @see https://carlalexander.ca/static-factory-method-pattern-wordpress/
 * @see https://carlalexander.ca/static-keyword-wordpress/
 * @see https://stackoverflow.com/questions/1699796/best-way-to-do-multiple-constructors-in-php
 */
abstract class Book
{
    /**
     * Datos de entrada para el libro 
     *
     * @var mixed
     */
    private $_source; // AAWP_Template_Handler o WP_POST

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
    private $_params = [ 'orderby' => 'post_date DESC' ];

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
     * Estado del libro: por leer, leído, siguiente, cerrado, etc.
     *
     * @var object
     */
    private $estado;

    /**
     * Fecha del post Wordpress de este libro
     *
     * @var date
     */
    private $post_date;

    /**
     * Mi puntuación del libro basada en una reseña (Observer pattern here)
     *
     * @var double
     */
    private $_rating;

 
    /**
     * Constructor.
     *
     * Partes comunes a todo tipo de entrada
     */
    public function __construct( $object )
    {
        $this->_source = $object;
        $this->post_type = get_post_type(); // page (AAWP_Template_Handler) o libro (WP_POST)
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

    public function get_estado()
    {
        return $this->estado;
    }

    public function get_post_date()
    {
        return $this->post_date;
    }

    public function get_rating()
    {
        return $this->_rating;
    }

    public function get_params()
    {
        return $this->_params;
    }

    public function get_books_by_category_id($term_id)
    {
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'libro',
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'terms' => $term_id
                )
            )
        );
        return get_posts($args);
    }

    public function get_books_by_genero_id($term_id)
    {
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'libro',
            'tax_query' => array(
                array(
                    'taxonomy' => 'genero',
                    'terms' => $term_id
                )
            )
        );
        return get_posts($args);
    }

    public function get_books_by_tag_id($term_id)
    {
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'libro',
            'tax_query' => array(
                array(
                    'taxonomy' => 'post_tag',
                    'terms' => $term_id
                )
            )
        );
        return get_posts($args);
    }


    /**
     * Caja Amazon class Libros
     * Captura las últimas reviews y coge los asins y los ids del libro correspondiente 
     *
     * @param string[] $input
     * @return string[ string $asins, string $ids ]
     */
    public function get_libros_asins($libros)
    {
        $asins = $ids = '';
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

}


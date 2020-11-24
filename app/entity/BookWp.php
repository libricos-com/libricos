<?php
namespace App\Entity;
/**
 * BookWp class
 * 
 * Tomado de inc/samples/Factory_Static.php
 * @see https://carlalexander.ca/static-factory-method-pattern-wordpress/
 * @see https://carlalexander.ca/static-keyword-wordpress/
 * @see https://stackoverflow.com/questions/1699796/best-way-to-do-multiple-constructors-in-php
 */
class BookWp extends Book
{
    /**
     * Constructor.
     *
     * Partes comunes a todo tipo de entrada
     */
    public function __construct( \WP_Post $post )
    {
        // Factory method here?
        $this->id = get_the_id();
        $this->set_commom_parts_after_id();
        return $this->fill_post();
    }

    protected function set_commom_parts_after_id()
    {
        $this->pod = pods( 'libro', $this->id );
        $this->url = esc_url( get_permalink( $this->id ) );
        $this->reviews = $this->pod->field( 'reviews', $this->get_params() );
        $this->titulo = get_the_title( $this->id );
    }

    
    /**
     * Undocumented function
     * Fill all properties from a Wordpress post
     * 
     * @return void
     */
    protected function fill_post() 
    {
        $this->post_title = get_the_title();
        $this->post_date = get_the_date();
        $this->asin = get_post_meta( $this->id, 'asin', true );
        $this->puntuacion = '0.0';
        $this->rating_percent = 0;

        // $this->portada = get_post_meta($this->id,'portada');
        $this->portada = $this->pod->field( 'portada' );
        $this->portada_src = wp_get_attachment_image_src($this->portada['ID'], 400)[0];
        $this->sinopsis = $this->pod->field( 'sinopsis' );

        $this->autores = $this->pod->field( 'autores' );
        $this->generos = $this->pod->field( 'generos_literarios' );
        $this->notas   = $this->pod->field( 'notas', $this->get_params() );

        // Venimos de la Ficha libro
        // @see: https://developer.wordpress.org/reference/functions/wp_list_categories/
        $taxonomy = 'category';
        // Get the term IDs assigned to post.
        $this->categorias = wp_get_object_terms( $this->id, $taxonomy ); 

        // @see: https://developer.wordpress.org/reference/functions/wp_list_categories/
        $taxonomy = 'post_tag';
        $this->tags= wp_get_object_terms( $this->id, $taxonomy ); 


        $this->editorial = $this->pod->field( 'editorial' );
        $this->editorial_url = esc_url( get_permalink( $this->editorial['ID'] ) );
        $this->editorial_nombre = $this->editorial['post_title'];

        // $this->fecha_publicacion = get_post_meta($this->id,'fecha_publicacion')[0];
        $this->fecha_publicacion = $this->pod->field( 'fecha_publicacion' );
        // $this->paginas = get_post_meta($this->id,'paginas')[0];
        $this->paginas = $this->pod->field( 'paginas' );
        // $this->idioma = get_post_meta($this->id,'idioma')[0];
        $this->idioma = $this->pod->field( 'idioma' );
        // $this->goodreads_url = get_post_meta($this->id,'goodreads_url')[0];
        $this->goodreads_url = $this->pod->field( 'goodreads_url' );
        
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


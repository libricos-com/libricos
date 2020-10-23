<?php
namespace App\Entity;
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
     * Estado del libro: por leer, leído, siguiente, cerrado, etc.
     *
     * @var object
     */
    private $estado;

 
    /**
     * Constructor.
     *
     * Partes comunes a todo tipo de entrada
     */
    public function __construct( $object )
    {
        $this->_source = $object;
        $this->post_type = get_post_type(); // page (AAWP_Template_Handler) o libro (WP_POST)
       
        if ($this->_source instanceof \WP_Post) {
            $this->id = get_the_id();
            $this->set_commom_parts_after_id();
            return $this->fill_post();
        }else if( $this->_source instanceof \AAWP_Template_Handler ){
            $this->id = $this->get_id_from_aawp();
            $this->set_commom_parts_after_id();
            return $this->fill_aawp();
        }
    }

    protected function set_commom_parts_after_id()
    {
        $this->pod = pods( 'libro', $this->id );
        $this->url = esc_url( get_permalink( $this->id ) );
        $this->reviews = $this->pod->field( 'reviews', $this->params );
    }

    /**
     * Devuelve el id del libro puesto en los shortcodes Amazon [tpl_ids="postid1, postid2, ..."]
     *
     * @return integer 
     */
    protected function get_id_from_aawp()
    {
        $ids = $this->_source->get_template_variable( 'ids', false );
        $index = $this->_source->item_index;
        // $variables = $this->get_template_variables();
        if( !is_array($ids) ){
            $ids = explode(',', $ids);
        }
        if(!empty($ids[ $index - 1 ])){
            $index = $index - 1;
            return $ids[ $index ];
        }
        return false;
    }

    /**
     * Undocumented function
     * Fill all properties from an Amazon object template
     * 
     * @return void
     */
    protected function fill_aawp( ) 
    {
        $this->estado = $this->pod->field( 'estado' );
        $this->titulo = get_post_meta( $this->id, 'titulo', true );
        // $this->asin = $product->get_product_id();
        // $this->is_prime = aawp_get_field_value($this->asin, 'prime');

        if(!$this->reviews){
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
            switch ($this->estado) {
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

            $this->estado = (object)[
                'color'     => $color,
                'url_libro' => $this->url,
                'tooltip'   => $tooltip,
                'icon_cls'  => $icon_cls,
                'txt'       => $txt,
                'value'     => $this->estado
            ];
        }
        return $this;
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
        $this->asin = get_post_meta( $this->id, 'asin', true );
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

    public function get_estado()
    {
        return $this->estado;
    }

}


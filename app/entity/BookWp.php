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
        parent::__construct($post);
        return $this->fill_post();
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

        $this->autores=$this->pod->field( 'autores' );
        $this->generos = $this->pod->field( 'generos_literarios' );
        $this->notas = $this->pod->field( 'notas', $this->get_params() );

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

}


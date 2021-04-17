<?php
namespace App\Entity;
use App\Entity\BookWpFactory;

/**
 * Quote class
 * 
 */
class Quote
{
    /**
     * ID de la cita
     *
     * @var integer
     */
    private $_id;

    /**
     * Cita de la cita
     *
     * @var string
     */
    private $_cita;

    /**
     * Tags
     *
     * @var array
     */
    private $_citatags;

    /**
     * Pod de la cita
     *
     * @var Pod
     */
    private $_pod;

    /**
     * Libro de la cita
     *
     * @var Book
     */
    private $_book;

    /**
     * Título largo del libro
     *
     * @var string
     */
    private $_libroLongTitle;

    /**
     * Título corto del libro
     *
     * @var string
     */
    private $_libroShortTitle;

    /**
     * Nombre del primer autor del libro
     *
     * @var string
     */
    private $_autorName;


    /**
     * Constructor.
     *
     * Partes comunes a todo tipo de entrada
     */
    public function __construct( \WP_Post $post )
    {
        $this->id              = $post->ID;
        $this->cita            = get_post_meta( $this->id, 'cita', true );
        $this->citatags        = get_the_terms( $this->id, 'citatag' );
        $this->pod             = pods( 'cita', $this->id );
        $this->book            = $this->pod->field( 'libro' );
        $this->libroId         = $this->book['ID'];
        $this->libroPost       = get_post($this->libroId);
        $this->libroPod        = pods('libro', $this->libroId);
        $this->libroLongTitle  = $this->book['post_title'];
        $this->libroShortTitle = $this->libroPod->field( 'titulo' );

        $this->jeiBook         = BookWpFactory::create( $this->libroPost );
        $this->autorName       = $this->jeiBook->getFirstAuthorName();
    }


    function __call($method, $params) 
    {
        $var = lcfirst(substr($method, 3));
   
        if (strncasecmp($method, "get", 3) === 0) {
            return $this->$var;
        }
        if (strncasecmp($method, "set", 3) === 0) {
            $this->$var = $params[0];
        }
    }

}


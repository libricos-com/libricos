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
class BookWpFactory extends BookFactory
{

    public function __construct( $object )
    {
        if ($object instanceof \WP_Post) {
            $this->_wp = new BookWp($object);
        }

        $this->createBook($object);
    }

    protected function createBook($object)
    {
        $this->pod = pods( 'libro', $this->id );
        $this->url = esc_url( get_permalink( $this->id ) );
        $this->reviews = $this->pod->field( 'reviews', $this->params );
        $this->titulo = get_the_title( $this->id );
    }

}


<?php
namespace App\Entity;
/**
 * Book class
 * 
 * @see https://stackoverflow.com/questions/53895044/clarifying-uml-class-diagram-of-factory-method-design-pattern
 */
abstract class BookFactory
{
    // The abstract factory method that the inheritor has to implement.
    // protected abstract Vehicle CreateVehicle();
    protected abstract function createBook();

    protected function set_common()
    {
        $this->pod = pods( 'libro', $this->id );
        $this->url = esc_url( get_permalink( $this->id ) );
        $this->reviews = $this->pod->field( 'reviews', $this->params );
        $this->titulo = get_the_title( $this->id );
    }

}


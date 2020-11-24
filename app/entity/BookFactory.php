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
    abstract public static function create($post);

    public static function set_common($post): void
    {
        $post->pod = pods( 'libro', $post->id );
        $post->url = esc_url( get_permalink( $post->id ) );
        $post->reviews = $post->pod->field( 'reviews', [] );
        $post->titulo = get_the_title( $post->id );
    }
}


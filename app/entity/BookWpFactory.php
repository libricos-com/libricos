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
    public static function create($post): BookWp
    {
        parent::set_common($post);
        return new BookWp($post);
    }

}


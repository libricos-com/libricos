<?php
namespace App\Entity;
/**
 * BookAmazonFactory class
 * 
 * Tomado de inc/samples/Factory_Static.php
 * @see https://carlalexander.ca/static-factory-method-pattern-wordpress/
 * @see https://carlalexander.ca/static-keyword-wordpress/
 * @see https://stackoverflow.com/questions/1699796/best-way-to-do-multiple-constructors-in-php
 */
class BookAmazonFactory extends BookFactory
{
    public static function create($aawp = null): BookAmazon
    {
        // parent::set_common($aawp);
        return new BookAmazon($aawp);
    }

}


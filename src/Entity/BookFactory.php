<?php
namespace App\Entity;
/**
 * Book class
 * 
 * @see https://stackoverflow.com/questions/53895044/clarifying-uml-class-diagram-of-factory-method-design-pattern
 */
abstract class BookFactory
{
    abstract public static function create($object);

    abstract public static function getPostId($object):int;

}


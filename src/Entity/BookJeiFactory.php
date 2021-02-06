<?php
namespace App\Entity;
/**
 * BookJei class
 * 
 */
class BookJeiFactory // extends BookFactory
{

    public static function create($pdo): BookJei
    {
        return new BookJei($pdo);
    }

    public static function insert($data): bool
    {
        // return $post->ID;
    }

    public static function update($data): bool
    {
        // return $post->ID;
    }

}


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
    public static function create($aawp): BookAmazon
    {
        $aawp->jeiPostId = self::getPostId($aawp);
        return new BookAmazon($aawp);
    }

    public static function getPostId($aawp): int
    {
        $ids = $aawp->get_template_variable( 'ids', false );
        $index = $aawp->item_index;
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

}


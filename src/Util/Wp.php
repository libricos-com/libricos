<?php
namespace App\Util;
/**
 * Wp class
 * 
 */
abstract class Wp
{
 
    public static function get_books_by_category_id($term_id, $limit = -1)
    {
        $args = array(
            'posts_per_page' => $limit,
            'post_type' => 'libro',
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'terms' => $term_id
                )
            )
        );
        return get_posts($args);
    }

    public static function get_books_by_genero_id($term_id, $limit = -1)
    {
        $args = array(
            'posts_per_page' => $limit,
            'post_type' => 'libro',
            'tax_query' => array(
                array(
                    'taxonomy' => 'genero',
                    'terms' => $term_id
                )
            )
        );
        return get_posts($args);
    }

    public static function get_books_by_tag_id($term_id, $limit = -1)
    {
        $args = array(
            'posts_per_page' => $limit,
            'post_type' => 'libro',
            'tax_query' => array(
                array(
                    'taxonomy' => 'post_tag',
                    'terms' => $term_id
                )
            )
        );
        return get_posts($args);
    }


    /**
     * Caja Amazon class Libros
     * Captura las últimas reviews y coge los asins y los ids del libro correspondiente 
     *
     * @param string[] $input
     * @return string[ string $asins, string $ids ]
     */
    public static function get_libros_asins($libros)
    {
        $asins = $ids = '';
        if( ! empty( $libros ) ){
            foreach ( $libros as $libro ){
                if(empty($libro->asin)){
                    continue;
                }
                $asins .= $libro->asin.',';
                $ids .= $libro->ID.',';
            }
            
            // Remove duplicate ids 
            $asins = implode(',', array_unique(explode(',', $asins)));
            $ids = implode(',', array_unique(explode(',', $ids)));

            // and remove last comma
            $asins = rtrim($asins,',');
            $ids = rtrim($ids,',');
        }

        return [
            $asins, 
            $ids
        ];
    }

}


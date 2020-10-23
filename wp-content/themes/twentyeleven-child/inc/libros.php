<?php
/**
 * Caja Amazon class Libros
 * Captura las últimas reviews y coge los asins y los ids del libro correspondiente 
 *
 * @param string[] $input
 * @return string[ string $asins, string $ids ]
 */
function get_libros_asins($input)
{
    $asins = $ids = '';
    $libros = get_posts($input);
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
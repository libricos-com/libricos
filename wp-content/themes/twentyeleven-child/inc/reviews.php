<?php
/**
 * Captura las últimas reviews y coge los asins y los ids del libro correspondiente 
 *
 * @param string[] $input
 * @return string[ string $asins, string $ids ]
 */
function get_asins($input)
{
    $asins = $ids = '';
    $reviews = get_posts($input);
    if( ! empty( $reviews ) ){
        foreach ( $reviews as $review ){
            $libro = get_post_meta( $review->ID, 'libro', true );
            $id = $libro['ID'];
            $asin = get_post_meta( $id, 'asin', true );
            if(!empty($asin)){
                $asins .= $asin.',';
                $ids .= $id.',';
            }
        }
        // Remove duplicate ids and remove last comma
        $asins = rtrim(implode(',', array_unique(explode(',', $asins))),',');
        $ids = rtrim(implode(',', array_unique(explode(',', $ids))),',');
    }

    return [
        $asins, 
        $ids
    ];
}
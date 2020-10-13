<?php
/**
 * Caja Amazon class Reviews
 * Captura las últimas reviews y coge los asins y los ids del libro correspondiente 
 *
 * @param string[] $input
 * @return string[ string $asins, string $ids ]
 */
function get_reviews_asins($input)
{
    $asins = $ids = '';
    $reviews = get_posts($input);
    if( ! empty( $reviews ) ){
        foreach ( $reviews as $review ){
            $libro = get_post_meta( $review->ID, 'libro', true );
            $id = $libro['ID'];
            $asin = get_post_meta( $id, 'asin', true );
            $id_review = $review->ID;
            
            if(!empty($asin)){
                $asins .= $asin.',';
                $ids .= $id_review.',';
            }
        }

        // and remove last comma
        $asins = rtrim($asins,',');
        $ids = rtrim($ids,',');
    }

    return [
        $asins, 
        $ids
    ];
}
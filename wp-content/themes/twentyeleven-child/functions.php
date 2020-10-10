<?php
/*
@see: https://florianbrinkmann.com/en/organizing-files-functions-wordpress-theme-4190/
*/
if(WP_DEBUG){
    require_once('inc/debug.php'); 
}
require_once('inc/filters.php');
require_once('inc/actions.php');
require_once('inc/template.php');
require_once('inc/shortcodes.php');

/**
 * Shortcode from Wordpress plugin Five-Star Ratings Shortcode
 *
 * @access  public
 * @since   1.0.0
 * @return  void
 * @see https://es.wordpress.org/plugins/five-star-ratings-shortcode/
 */

define( 'FSRS_BASE', 'fsrs_' );
function rating_func( $atts )
{
    $atts = shortcode_atts( array(
        'stars' => '',
    ), $atts );
    $arr = array();
    
    if ( get_option( FSRS_BASE . 'syntax' ) != NULL ) {
        $syntax = get_option( FSRS_BASE . 'syntax' );
    } else {
        $syntax = 'i';
    }
    
    // Default syntax.
    
    if ( get_option( FSRS_BASE . 'starsmax' ) != NULL ) {
        $starsmax = get_option( FSRS_BASE . 'starsmax' );
    } else {
        $starsmax = '5';
    }
    
    // Default value; also the only value for the FREE plugin.
    
    if ( get_option( FSRS_BASE . 'size' ) != NULL ) {
        $size = get_option( FSRS_BASE . 'size' );
    } else {
        $size = '';
    }
    
    // Get the value and if it's a float, trim it.
    $star = esc_attr( $atts['stars'] );
    $parts = explode( '.', $star );
    array_pop( $parts );
    $startrim = implode( '.', $parts );
    // Recast string to integer.
    $startrim = (double) $startrim;
    // How many whole stars?
    // $stars = str_repeat( '<' . $syntax . ' class="fsrs-fas fa-fw fa-star ' . $size . '"></' . $syntax . '>', $startrim );
    $stars =  str_repeat('<i class="fas bg-light fa-star color-yellow" aria-hidden="true"></i>', $startrim);
    // How many leftover stars if there is no half star?
    $dif = wp_kses( $starsmax, $arr ) - $startrim;
    // Output for the half star.
    // $halfstar = '<' . $syntax . ' class="fsrs-fas fa-fw fa-star-half-alt ' . $size . '"></' . $syntax . '>';
    $halfstar = '<i class="fas bg-light fa-star-half-alt color-yellow" aria-hidden="true"></i>';
    // Empty stars if there is no half star.
    // $empty = str_repeat( '<' . $syntax . ' class="fsrs-far fa-fw fa-star ' . $size . '"></' . $syntax . '>', $dif );
    $empty = str_repeat( '<i class="far bg-light fa-star"></i>', $dif);
    //  How many leftover stars if there is a half star?
    
    if ( $dif >= 1 ) {
        $dif2 = $dif - 1;
    } else {
        $dif2 = 0;
    }
    
    // Empty stars if there is a half star.
    // $emptyhalf = str_repeat( '<' . $syntax . ' class="fsrs-far fa-fw fa-star ' . $size . '"></' . $syntax . '>', $dif2 );
    $emptyhalf = str_repeat( '<i class="far bg-light fa-star"></i>', $dif2 );
    
    if ( $startrim == $star ) {
        // There is no half star. Don't use strict type checking because we're dealing with floats and integers.
        $rating = sprintf(
            wp_kses( __(
            /* translators: translate only the phrase "%3$.1F out of %4$.1F stars", where "%3$.1F" and "%4$.1F" are placeholders for numerical floats. */
            '<span class="fsrs">
                <span class="fsrs-stars">%1$s%2$s</span>
                <span class="hide fsrs-text fsrs-text__hidden" aria-hidden="false">%3$.1F out of %4$.1F stars</span>
                <span class="lining fsrs-text fsrs-text__visible" aria-hidden="true">%3$.1F</span>
            </span>',
            'fsrs'
        ), array(
            'span' => array(
            'class'       => array(),
            'aria-hidden' => array(),
        ),
        ) ),
            $stars,
            $empty,
            $star,
            wp_kses( $starsmax, $arr )
        );
        return $rating;
    } elseif ( $star < wp_kses( $starsmax, $arr ) ) {
        // There is a half star.
        $rating = sprintf(
            wp_kses( __(
            /* translators: translate only the phrase "%4$.1F out of %5$.1F stars", where "%4$.1F" and "%5$.1F" are placeholders for numerical floats. */
            '<span class="fsrs">
                <span class="fsrs-stars">%1$s%2$s%3$s</span>
                <span class="hide fsrs-text fsrs-text__hidden" aria-hidden="false">%4$.1F out of %5$.1F stars</span>
                <span class="lining fsrs-text fsrs-text__visible" aria-hidden="true">%4$.1F</span>
            </span>',
            'fsrs'
        ), array(
            'span' => array(
            'class'       => array(),
            'aria-hidden' => array(),
        ),
        ) ),
            $stars,
            $halfstar,
            $emptyhalf,
            $star,
            wp_kses( $starsmax, $arr )
        );
        return $rating;
    } else {
        // There is a half star but the number of stars exceeds the maximum. Don't ouput a half star.
        $rating = sprintf(
            wp_kses( __(
            /* translators: translate only the phrase "%3$.1F out of %4$.1F stars", where "%3$.1F" and "%4$.1F" are placeholders for numerical floats. */
            '<span class="fsrs">
                <span class="fsrs-stars">%1$s%2$s</span>
                <span class="hide fsrs-text fsrs-text__hidden" aria-hidden="false">%3$.1F out of %4$.1F stars</span>
                <span class="lining fsrs-text fsrs-text__visible" aria-hidden="true">%3$.1F</span>
            </span>',
            'fsrs'
        ), array(
            'span' => array(
            'class'       => array(),
            'aria-hidden' => array(),
        ),
        ) ),
            $stars,
            $empty,
            $startrim,
            wp_kses( $starsmax, $arr )
        );
        return $rating;
    }
}


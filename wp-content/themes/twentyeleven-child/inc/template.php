<?php
/**
 * Shortcode from Wordpress plugin Five-Star Ratings Shortcode
 *
 * @access  public
 * @since   1.0.0
 * @return  void
 * @see https://es.wordpress.org/plugins/five-star-ratings-shortcode/
 */
function rating( $star = '0.0' )
{
    $arr = array();
    
    // Default syntax.
    $starsmax = '5';

    $tooltip = 'Puntuación Jesuserro.com';
    
    // Get the value and if it's a float, trim it.
    $parts = explode( '.', $star );
    array_pop( $parts );
    $startrim = implode( '.', $parts );
    // Recast string to integer.
    $startrim = (double) $startrim;
    // How many whole stars?
    $stars =  str_repeat('<i class="fas bg-light fa-star color-yellow" aria-hidden="true"></i>', $startrim);
    // How many leftover stars if there is no half star?
    $dif = wp_kses( $starsmax, $arr ) - $startrim;
    // Output for the half star.
    $halfstar = '<i class="fas bg-light fa-star-half-alt color-yellow" aria-hidden="true"></i>';
    // Empty stars if there is no half star.
    $empty = str_repeat( '<i class="far bg-light fa-star"></i>', $dif);
    //  How many leftover stars if there is a half star?
    
    if ( $dif >= 1 ) {
        $dif2 = $dif - 1;
    } else {
        $dif2 = 0;
    }
    
    // Empty stars if there is a half star.
    $emptyhalf = str_repeat( '<i class="far bg-light fa-star"></i>', $dif2 );
    
    if ( $startrim == $star ) {
        // There is no half star. Don't use strict type checking because we're dealing with floats and integers.
        $rating = sprintf(
            wp_kses( __(
            /* translators: translate only the phrase "%3$.1F out of %4$.1F stars", where "%3$.1F" and "%4$.1F" are placeholders for numerical floats. */
            '<span class="fsrs">
                <span class="fsrs-stars">%1$s%2$s</span>
                <span class="hide fsrs-text fsrs-text__hidden" aria-hidden="false"><span class="badge badge-warning" data-toggle="tooltip" title="'.$tooltip.'">%3$.1F</span></span>    
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
                <span class="hide fsrs-text fsrs-text__hidden" aria-hidden="false"><span class="badge badge-warning" data-toggle="tooltip" title="'.$tooltip.'">%4$.1F</span></span>
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
                <span class="hide fsrs-text fsrs-text__hidden" aria-hidden="false"><span class="badge badge-warning" data-toggle="tooltip" title="'.$tooltip.'">%3$.1F</span></span>
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


/**
 * Usada en el template Libros Grid de Pods
 * @see:
 * - https://www.ta-camp.de/news/howto-format-the-post_date-in-a-template 
 * - https://www.php.net/manual/en/function.date.php
*/
function my_datum($input_date) 
{
	return date_i18n('Y F d', strtotime($input_date));
}


/**
 * @param $pathtofile hacia la otra plantilla desde aquí
 * @see https://stackoverflow.com/questions/5629853/creating-a-custom-php-template
 */
function view($pathtofile, $vars) 
{
    ob_start();
    extract($vars);
    include dirname(__FILE__).'/'.$pathtofile.'.php';
    $buffer = ob_get_contents();
    ob_end_clean();
    return $buffer;
}
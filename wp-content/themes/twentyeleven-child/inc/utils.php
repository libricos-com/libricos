<?php

function get_fecha_larga($post_id)
{
    return get_the_date('d', $post_id).' de '.ucfirst(get_the_date('F', $post_id)).' de '.get_the_date('Y', $post_id);
}
function get_fecha_corta($post_id)
{
    return get_the_date('d', $post_id).'-'.get_the_date('m', $post_id).'-'.get_the_date('Y', $post_id);
}

/**
 * Get first paragraph from a WordPress post.
 * - Coge cualquier párrafo o div HTML
 * - Que tenga más de 40 caracteres
 * - Cuyo texto no empiece por < (evita párrafos tipo: <p><!-- wp:html --></p>)
 * - Al final permitimos links
 * - Probar en https://regex101.com/r/1VNrFI/1
 *
 * @return string
 */
function get_first_paragraph($content)
{
   $re = '/<(p|div)[^>]*>([^<].{40,})<\/(p|div)>/m';
   preg_match($re, $content, $matches, PREG_OFFSET_CAPTURE, 0);
   if(!empty($matches[2][0])){
       return strip_tags($matches[2][0]);
   }
   return 'No se pudo capturar el resumen.';
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
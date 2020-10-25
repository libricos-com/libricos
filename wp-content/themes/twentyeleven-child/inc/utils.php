<?php

function get_fecha_larga($post_id)
{
    return get_the_date('d', $post_id).' '.get_the_date('M', $post_id).', '.get_the_date('Y', $post_id);
}
function get_fecha_corta($post_id)
{
    return get_the_date('d', $post_id).'-'.get_the_date('m', $post_id).'-'.get_the_date('y', $post_id);
}

/**
 * Get first paragraph from a WordPress post.
 * - Coge cualquier párrafo o div HTML
 * - Que tenga más de 40 caracteres
 * - Cuyo texto no empiece por < o espacios en blanco. Evita párrafos tipo: 
 * -- <p><!-- wp:html --></p>
 * -- <div>  <div>...</div> </div>
 * - Cuyo texto pueda empezar por <p><em>La cuarta copa</em> es...</p>
 * - Al final permitimos links
 * - Probar en:
 * -- https://regex101.com/r/Ciq1Hj/2 (Peregrino ruso) 
 * -- https://regex101.com/r/Ciq1Hj/1 (Mero cristianismo)
 * -- https://regex101.com/r/Ciq1Hj/4 (La cuarta copa)
 *
 * @return string
 */
function get_first_paragraph($content)
{
   $re = '/<p[^>\s]*>(<em>|<strong>|<i>|<b>)?([^<].{40,})(<\/em>|<\/strong>|<\/i>|<\/b>)?<\/p>/m';
   preg_match($re, $content, $matches, PREG_OFFSET_CAPTURE, 0);
   if(!empty($matches[2][0])){
       return strip_tags($matches[2][0]);
   }
   return 'No se pudo capturar el resumen.';
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
<?php
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
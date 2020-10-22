<?php
/**
 * Undocumented class
 * @see https://tommcfarlin.com/singletons-in-wordpress-revisited/
 */
class Date_Formatter
{
    public static function get()
    {
        $default_format = 'm/d/Y';
        $format = get_option('yhd_directory_importer', false);if (false === $format) {return $default_format;}
        $format = $format['date'];
        $format = (isset($format) && isset($format['format'])) ? $format['format'] : $default_format;
        return $format;
    }
}

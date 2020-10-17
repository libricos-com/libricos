-- Review POD resumen completo de mero cristianismo
SELECT * FROM `wp_postmeta` 
WHERE 
    post_id = 8046 
    and meta_key IN ('texto', 'url_goodreads', 'puntuacion', 'entradilla')
ORDER BY `meta_key` ASC
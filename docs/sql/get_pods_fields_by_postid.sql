-- 8046 mero cristianismo, 13139 regreso a casa
SELECT * FROM `wp_postmeta` 
WHERE 
    post_id = 13139 
    and meta_key IN ('texto', 'goodreads_url', 'puntuacion', 'entradilla', 'estado')
ORDER BY `meta_key` ASC
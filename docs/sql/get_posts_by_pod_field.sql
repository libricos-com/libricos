-- 8046 mero cristianismo, 13139 regreso a casa
SELECT p.ID, p.post_title, pm.meta_key, pm.meta_value 
FROM wp_posts p, wp_postmeta as pm
WHERE 
    p.ID = pm.post_id
    AND pm.meta_key IN ('descripcion')
    AND pm.meta_value <> "" 
    AND p.post_type = "review"
ORDER BY p.ID DESC
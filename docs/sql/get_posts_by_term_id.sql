-- 402 es autoayuda, 400 Biografía
SELECT p.*
FROM wp_posts AS p, wp_term_relationships AS r, wp_term_taxonomy AS t
WHERE 
    p.ID = r.object_id
    AND r.term_taxonomy_id = t.term_taxonomy_id
    AND t.term_id IN (402)
GROUP BY p.ID 
LIMIT 10;
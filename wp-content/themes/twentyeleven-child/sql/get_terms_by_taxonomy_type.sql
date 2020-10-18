SELECT t.*, tt.* 
FROM wp_terms AS t INNER JOIN wp_term_taxonomy AS tt 
ON t.term_id = tt.term_id
WHERE 
    -- tt.taxonomy IN ('category', 'post_tag', 'generos') 
    tt.taxonomy IN ('generos') 
ORDER BY t.name ASC
LIMIT 100;
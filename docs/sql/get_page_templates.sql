SELECT *
FROM `wp_postmeta` p
WHERE 
p.meta_key = '_wp_page_template'
-- AND p.meta_value LIKE "%page/%"
-- p.post_id = 13544 #La HOME
-- LIMIT 2;
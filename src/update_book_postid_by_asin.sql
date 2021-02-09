UPDATE
	wp_postmeta m, wp_posts p, jei_books j
SET j.post_id = p.ID
WHERE
	p.ID = m.post_id 
	AND m.meta_value = j.asin
	AND p.post_type = "libro"
	AND j.post_id IS NULL
LIMIT 100


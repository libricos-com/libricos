SELECT p.ID, p.post_title, p.post_type, m.meta_value 
FROM libricos.wp_postmeta m, wp_posts p
where 
	p.ID = m.post_id
	AND m.meta_key = "table_of_contents"
    -- AND m.meta_value = ""
order by m.meta_id desc;
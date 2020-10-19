-- 4 es el menú principal
select * from 
    (select d.*,e.name,e.slug from
        (SELECT p.id,txr.term_taxonomy_id, p.post_title, p.post_name, p.menu_order, n.post_name as n_name, 
        n.post_title as n_title, pp.meta_value as menu_parent,pt.meta_value as type
        FROM wp_term_relationships as txr 
            INNER JOIN wp_posts as p ON txr.object_id = p.ID 
            LEFT JOIN wp_postmeta as m ON p.ID = m.post_id 
            LEFT JOIN wp_postmeta as pl ON p.ID = pl.post_id AND pl.meta_key = '_menu_item_object_id' 
            LEFT JOIN wp_postmeta as pp ON p.ID = pp.post_id AND pp.meta_key = '_menu_item_menu_item_parent'
            LEFT JOIN wp_postmeta as pt ON p.ID = pt.post_id AND pt.meta_key = '_menu_item_object'
            LEFT JOIN wp_posts as n ON pl.meta_value = n.ID 
        WHERE 
            p.post_status='publish' 
            AND p.post_type = 'nav_menu_item' AND m.meta_key = '_menu_item_url' 
        ORDER BY pp.meta_value) d
    LEFT JOIN wp_terms as e on d.term_taxonomy_id=e.term_id) i 
where i.term_taxonomy_id = 4
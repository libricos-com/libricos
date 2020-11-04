SELECT * 
FROM `wp_options` 
WHERE `option_name` IN ('siteurl','home') 
ORDER BY `option_id` DESC
SET sql_mode = '';
ALTER TABLE wp_links MODIFY link_name VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;


-- SELECT * FROM wp_options WHERE option_name IN ('siteurl','home');
-- SELECT * FROM wp_posts WHERE post_content LIKE '%192.168.1.47%';

/*
SELECT p.post_author, u.user_login, u.user_nicename, u.user_email, count(p.post_author) AS num_posts
FROM wp_posts p, wp_users u
WHERE u.ID = p.post_author
GROUP BY p.post_author
*/

-- select * from wp_posts where post_author = 0

-- UPDATE wp_posts SET post_author='4' WHERE post_author='5'

UPDATE wp_links SET link_owner='4434212' WHERE link_owner='1'

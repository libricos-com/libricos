-- https://wtools.io/generate-sql-create-table
CREATE TABLE `jei_reviews` (
    `id` BIGINT(12) unsigned NOT NULL AUTO_INCREMENT,
    `jei_book_id` BIGINT(12) unsigned DEFAULT NULL COMMENT 'jei id del libro reseñado',
    `gr_id` BIGINT(12) unsigned DEFAULT NULL UNIQUE COMMENT 'Valor único para evitar duplicados',
    `post_id` BIGINT(12) unsigned DEFAULT NULL COMMENT 'Artículo Wordpress correspondiente a la reseña',
    `rating` FLOAT(3,2) unsigned DEFAULT NULL,
    `votes` MEDIUMINT(7) unsigned DEFAULT NULL,
    `url` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `link` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `body` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `recommended_for` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `recommended_by` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `spoiler_flag` BOOLEAN DEFAULT NULL,
    `owned` BOOLEAN DEFAULT NULL,
    `read_count` MEDIUMINT(7) unsigned DEFAULT NULL,
    `comments_count` MEDIUMINT(7) unsigned DEFAULT NULL,
    `started_at` DATETIME DEFAULT NULL,
    `read_at` DATETIME DEFAULT NULL,
    `date_updated` DATETIME DEFAULT NULL,
    `date_added` DATETIME DEFAULT NULL,
    `last_mod` DATETIME DEFAULT NULL,
    `last_user` VARCHAR(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Book Id,Title,Author,Author l-f,Additional Authors,ISBN,ISBN13,My Rating,Average Rating,Publisher,Binding,Number of Pages,Year Published,Original Publication Year,Date Read,Date Added,Bookshelves,Bookshelves with positions,Exclusive Shelf,My Review,Spoiler,Private Notes,Read Count,Recommended For,Recommended By,Owned Copies,Original Purchase Date,Original Purchase Location,Condition,Condition Description,BCID
CREATE TABLE `jei_books` (
    `id` BIGINT(12) unsigned NOT NULL AUTO_INCREMENT,
    `gr_id` BIGINT(12) unsigned DEFAULT NULL UNIQUE COMMENT 'Valor único para evitar duplicados',
    `post_id` BIGINT(12) unsigned DEFAULT NULL UNIQUE COMMENT 'Artículo Wordpress correspondiente al libro',
    `title` VARCHAR(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `isbn` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `isbn13` VARCHAR(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `asin` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `kindle_asin` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `language_code` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `is_ebook` BOOLEAN DEFAULT NULL,
    `text_reviews_count` MEDIUMINT(7) unsigned DEFAULT NULL,
    `uri` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `title_without_series` VARCHAR(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `edition_information` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `image_url` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `small_image_url` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `large_image_url` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `link` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `num_pages` SMALLINT(5) unsigned DEFAULT NULL,
    `average_rating` FLOAT(3,2) unsigned DEFAULT NULL,
    `ratings_count` INT(10) unsigned DEFAULT NULL,
    `format` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `publisher` VARCHAR(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `publication_day` TINYINT(2) unsigned DEFAULT NULL,
    `publication_year` YEAR(4) DEFAULT NULL,
    `publication_month` TINYINT(2) unsigned DEFAULT NULL,
    `table_contents` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `published` YEAR(4) DEFAULT NULL,
    `date_added` DATETIME DEFAULT NULL,
    `last_mod` DATETIME DEFAULT NULL,
    `last_user` VARCHAR(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

                                        
CREATE TABLE `jei_shelves` (
    `id` BIGINT(12) unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL UNIQUE,
    `date_added` DATETIME DEFAULT NULL,
    `last_mod` DATETIME DEFAULT NULL,
    `last_user` VARCHAR(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
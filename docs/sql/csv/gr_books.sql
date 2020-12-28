-- https://wtools.io/generate-sql-create-table

-- Book Id,Title,Author,Author l-f,Additional Authors,ISBN,ISBN13,My Rating,Average Rating,Publisher,Binding,Number of Pages,Year Published,Original Publication Year,Date Read,Date Added,Bookshelves,Bookshelves with positions,Exclusive Shelf,My Review,Spoiler,Private Notes,Read Count,Recommended For,Recommended By,Owned Copies,Original Purchase Date,Original Purchase Location,Condition,Condition Description,BCID

CREATE TABLE `gr_books` (
	-- `id` BIGINT(12) unsigned NOT NULL AUTO_INCREMENT,
	`gr_id` BIGINT(12) unsigned NOT NULL,
	`title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
	`author` VARCHAR(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
	`author_lf` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
	`additional_authors` VARCHAR(255) DEFAULT '',
	`isbn` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`isbn13` VARCHAR(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`my_rating` FLOAT(4) unsigned DEFAULT NULL,
	`average_rating` FLOAT(4) unsigned DEFAULT NULL,
	`publisher` VARCHAR(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
	`binding` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Formato del libro',
	`pages` TINYINT(5) unsigned DEFAULT NULL,
	`year_published` YEAR(4) DEFAULT NULL,
	`original_publication_year` TINYINT(4) unsigned DEFAULT NULL,
	`date_read` DATE DEFAULT NULL,
	`date_added` DATE DEFAULT NULL,
	`bookshelves` VARCHAR(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`bookshelves_with_positions` VARCHAR(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`exclusive_shelf` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`my_review` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`spoiler` VARCHAR(600) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`private_notes` VARCHAR(600) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`read_count` TINYINT(3) unsigned DEFAULT '0' COMMENT 'Número de veces de lectura del libro',
	`recommended_for` VARCHAR(600) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`recommended_by` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`owned_copies` TINYINT(3) unsigned DEFAULT '0' COMMENT 'Número de copias de este libro que tengo',
	`original_purchase_date` DATE DEFAULT NULL,
	`original_purchase_location` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`condition` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`condition_description` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`BCID` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
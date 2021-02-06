-- https://wtools.io/generate-sql-create-table

-- Book Id,Title,Author,Author l-f,Additional Authors,ISBN,ISBN13,My Rating,Average Rating,Publisher,Binding,Number of Pages,Year Published,Original Publication Year,Date Read,Date Added,Bookshelves,Bookshelves with positions,Exclusive Shelf,My Review,Spoiler,Private Notes,Read Count,Recommended For,Recommended By,Owned Copies,Original Purchase Date,Original Purchase Location,Condition,Condition Description,BCID

CREATE TABLE `jei_reviews` (
    `id` BIGINT(12) unsigned NOT NULL AUTO_INCREMENT,
    `jei_book_id` BIGINT(12) unsigned NOT NULL UNIQUE COMMENT 'ID de la tabla jei_books',
    `rating` FLOAT(3,2) unsigned DEFAULT NULL COMMENT 'Mi rating',
    `date_added` DATETIME DEFAULT NULL,
    `last_mod` DATETIME DEFAULT NULL,
    `last_user` VARCHAR(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
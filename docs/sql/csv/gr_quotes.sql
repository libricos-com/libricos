-- Goodreads Quote Id,Author,Book,ISBN,Quote,Tags,Quote Popularity,Order

CREATE TABLE `gr_quotes` (
	-- `id` BIGINT(12) unsigned NOT NULL AUTO_INCREMENT,
	`gr_quote_id` BIGINT(12) unsigned NOT NULL,
	`author` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`book` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`isbn` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`quote` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`tags` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
	`quote_popularity` INT(10) unsigned DEFAULT NULL,
	`order` SMALLINT(5) unsigned DEFAULT NULL,
	PRIMARY KEY (`gr_quote_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
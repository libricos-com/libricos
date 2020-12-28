LOAD DATA INFILE '\//mnt\/c\/Users\/Jesús\/Downloads\/goodreads_library_export.csv'
INTO TABLE libricos.gr_books
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;
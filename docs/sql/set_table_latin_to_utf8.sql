-- Ejecutar desde el panel de phpMyAdmin
-- Tabla Comments en utf8mb4_unicode_ci pero con datos en latin traidos de la tbla de prod
-- Convierte el contenido de los campos de la tabla a utf8
-- Tras ejecutarla, la tabla mantiene como utf8mb4_unicode_ci los campos
-- see https://stackoverflow.com/questions/9407834/convert-latin1-characters-on-a-utf8-table-into-utf8
UPDATE wp_comments SET 
    comment_author=convert(cast(convert(comment_author using latin1) as binary) using utf8),
    comment_content=convert(cast(convert(comment_content using latin1) as binary) using utf8) 
WHERE 1
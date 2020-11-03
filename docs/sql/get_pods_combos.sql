-- Encuentro "pick_custom" haciendo búsqueda en la bbdd del término "7 | Cuarentena".
SELECT * 
FROM wp_postmeta
WHERE meta_key = "pick_custom"
ORDER BY meta_id DESC
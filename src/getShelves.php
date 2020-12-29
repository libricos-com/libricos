<?php
require_once __DIR__.'../../api/config.php';
require_once __DIR__.'../../api/goodreads/GoodReads.php';

$dbconnect = mysqli_connect("127.0.0.1", "root", "root", "libricos");

if (!$dbconnect) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$api = new GoodReads(JEI_GOODREADS_KEY, '/var/www/html/api/cache');

$sql = "
    SELECT id, gr_id, title, isbn, isbn13
    FROM libricos.gr_books 
    WHERE 
        isbn IS NULL 
        and isbn13 IS NULL
    LIMIT 20 
";
// $sql .= ' and gr_id = 20513179';

$query = mysqli_query($dbconnect, $sql)
   or die (mysqli_error($dbconnect));

while ($row = mysqli_fetch_array($query)) {
    echo $row['id'].' -> '.$row['title'].'<br />';
    $data = $api->getBook($row['gr_id']);
    sleep(0.5);
    $asin = $data['book']['asin'];
    if(!empty($asin)){
        var_dump($asin);
        $sqlUpdate = "UPDATE table_name
        SET column1=value, column2=value2,...
        WHERE some_column=some_value";
    }
}




mysqli_close($dbconnect);
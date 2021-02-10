<?php
/* 
@see: https://www.goodreads.com/api/index
*/
include 'config.php';
include './goodreads/GoodReads.php';

$api = new GoodReads(JEI_GOODREADS_KEY, __DIR__.'/cache');

// $data = $api->getAuthor(JEI_GOODREADS_AUTHOR_ID);
// $data = $api->getBook(20513179);
// $data = $api->getLatestReads(JEI_GOODREADS_USER_1);
// $data = $api->getUser(JEI_GOODREADS_USER_1);

// https://www.goodreads.com/user_status/show/JEI_GOODREADS_USER_1?format=xml&key=JEI_GOODREADS_KEY
// $data = $api->getUserStatus(JEI_GOODREADS_USER_1);
// $data = $api->getUserStatuses(JEI_GOODREADS_USER_1);

// https://www.goodreads.com/review/show/2312483779
// $data = $api->getReview(2312483779);

// $data = $api->getReview(2775579008); // Diario Faustina
// print("<pre>".print_r($data, true)."</pre>");
// die;

// $data = $api->getShelf( JEI_GOODREADS_USER_1, '000-next', 'position', 10, 1 );
// $data = $api->getShelf( JEI_GOODREADS_USER_1, 'want-to-read', 'date_added', 25, 1 );
$data = $api->getShelf( JEI_GOODREADS_USER_1, 'read', 'date_added', 2, 1 );

$mbd = new PDO('mysql:host=localhost;dbname=libricos20210128', 'root', 'root');
if (!$mbd) {
    die('No pudo conectarse: ' . mysql_error());
}
echo 'Conectado satisfactoriamente<br /><br />';
$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

print("<pre>".print_r($data, true)."</pre>");





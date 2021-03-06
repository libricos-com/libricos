<?php
/* 
@see: https://www.goodreads.com/api/index
*/
require __DIR__ . '/../vendor/autoload.php';


use App\Util\Pdo;
use App\Entity\BookJeiFactory;

include '../api/config.php';
include '../api/goodreads/GoodReads.php';
$api = new GoodReads(JEI_GOODREADS_KEY, __DIR__.'/../api/cache');


$pdo = Pdo::create();
$bookClass = BookJeiFactory::create($pdo);


$books = $pdo->query('SELECT id, gr_id, title 
    FROM jei_books 
    WHERE asin IS NULL 
    ORDER BY date_added DESC
    ', \PDO::FETCH_ASSOC);


$i = 1;

// NOTE: completamos datos del primer insert llamado a la api de cada libro (getting ASIN)
foreach($books as $book){

    if(empty($book['id'])){
        continue;
    }

    $grId = $book['gr_id'];
    
    $bookApi = $api->getBook( $grId );

    sleep(0.2);

    if(empty($bookApi['book'])){
        continue;
    }
    $bookApi = $bookApi['book'];

    $is_ebook = 0;
    if($bookApi['is_ebook']){
        $is_ebook  = 1;
    }

    $asin = !empty($bookApi['asin']) ? $bookApi['asin'] : null;
    $kindle_asin = !empty($bookApi['kindle_asin']) ? $bookApi['kindle_asin'] : null;
    $language_code = !empty($bookApi['language_code']) ? $bookApi['language_code'] : null;

    $last_user = 'jesus';
    $last_mod = date("Y-m-d H:i:s");

    $data = [
        'id'            => $book['id'],
        'asin'          => $asin,
        'kindle_asin'   => $kindle_asin,
        'language_code' => $language_code,
        'is_ebook'      => $is_ebook,
        'last_user'     => $last_user,
        'last_mod'      => $last_mod
        // ,'gr_id'         => $grId
    ];

    $bookClass::update($data); 

    sleep(.2);
}


// NOTE: Rellenamos los post_id vacíos en jei_books
$bookClass::updateBookPostidsByAsin();

// NOTE: Rellenamos los post_id vacíos restantes a través de la url de goodreads
sleep(1);
$bookClass::updateBookPostidsByGoodreadsUrl();

// NOTE: Rellenar los índices de los libros
sleep(1);
$bookClass::updateBookTableContentsByPostid();

// print("<pre>".print_r($review, true)."</pre>");
// print("<pre>".print_r($bookExtended, true)."</pre>");

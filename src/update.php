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


$books = $pdo->query('SELECT gr_id, title FROM jei_books LIMIT 100', \PDO::FETCH_ASSOC);


$i = 1;

foreach($books as $book){

    if(empty($book['gr_id'])){
        continue;
    }

    $grId = $book['gr_id'];
    
    // NOTE: getting ASIN
    $bookApi = $api->getBook( $grId );

    sleep(0.2);

    if(empty($bookApi['book'])){
        return false;
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
        'asin'          => $asin,
        'kindle_asin'   => $kindle_asin,
        'language_code' => $language_code,
        'is_ebook'      => $is_ebook,
        'last_user'     => $last_user,
        'last_mod'      => $last_mod,
        'gr_id'         => $grId
    ];

    $bookClass::update($data);


    
}


// print("<pre>".print_r($review, true)."</pre>");
// print("<pre>".print_r($bookExtended, true)."</pre>");

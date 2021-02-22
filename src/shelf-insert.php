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
// $data = $api->getShelvesByUserId( JEI_GOODREADS_USER_1);


$pdo = Pdo::create();
$bookClass = BookJeiFactory::create($pdo);

$reviews = $pdo->query('SELECT id, gr_id  
    FROM jei_reviews 
    ORDER BY date_added DESC
    ', \PDO::FETCH_ASSOC);


foreach($reviews as $review){
    
    $grId = $review['gr_id'];
    
    $reviewApi = $api->getReview( $grId );
    $review = $reviewApi['review'];
    $date_added = $review['date_added'];
    
    $shelves = $review['shelves']['shelf'];
    foreach($shelves as $shelf){
        if(empty($shelf['@attributes'])){
            continue;
        }
        $shelf = $shelf['@attributes'];
        $shelf['date_added'] = date('Y-m-d H:i:s', strtotime( $date_added ) );
        
        $lastInsertId = $bookClass::insertShelf($shelf);
        sleep(.2);

    }

}


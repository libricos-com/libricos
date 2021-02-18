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
$data = $api->getShelvesByUserId( JEI_GOODREADS_USER_1);


$pdo = Pdo::create();
$bookClass = BookJeiFactory::create($pdo);


$shelves = $data['shelves'];
foreach($shelves as $shelf){
    $lastInsertId = $bookClass::insertShelf($shelf);
    sleep(.2);

    if(empty($lastInsertId)){
        continue;
    }
    // $bookClass::addReview($review);
}


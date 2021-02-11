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
$shelves = ['want-to-read', 'read'];
$data = $api->getShelf( JEI_GOODREADS_USER_1, $shelves[1], 'date_added', 100, 1 );


$pdo = Pdo::create();
$bookClass = BookJeiFactory::create($pdo);


$reviews = $data['reviews']['review'];
foreach($reviews as $review){

    $lastInsertId = $bookClass::addReview($review);
    sleep(.2);
    
}


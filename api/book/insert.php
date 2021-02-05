<?php
/* 
@see: https://www.goodreads.com/api/index
*/
include '../config.php';
include '../goodreads/GoodReads.php';

$api = new GoodReads(JEI_GOODREADS_KEY, __DIR__.'/../cache');

$shelves = ['want-to-read', 'read'];
$data = $api->getShelf( JEI_GOODREADS_USER_1, $shelves[1], 'date_added', 100, 1 );

$mbd = new PDO('mysql:host=localhost;dbname=libricos20210128', 'root', 'root');
if (!$mbd) {
    die('No pudo conectarse: ' . mysql_error());
}
echo 'Conectado satisfactoriamente<br /><br />';
$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function cleanBook($book)
{
    unset( $book['authors'] );
    unset( $book['work'] );

    $myNull = null;

    if(is_array($book['isbn'])){
        $book['isbn'] = $myNull;
    }
    if(is_array($book['isbn13'])){
        $book['isbn13'] = $myNull;
    }
    if(is_array($book['num_pages'])){
        $book['num_pages'] = $myNull;
    }
    if(is_array($book['format'])){
        $book['format'] = $myNull;
    }
    if(is_array($book['publisher'])){
        $book['publisher'] = $myNull;
    }
    if(is_array($book['publication_day'])){
        $book['publication_day'] = $myNull;
    }
    if(is_array($book['publication_month'])){
        $book['publication_month'] = $myNull;
    }
    if(is_array($book['publication_year'])){
        $book['publication_year'] = $myNull;
    }
    if(is_array($book['description'])){
        $book['description'] = $myNull;
    }
    if(is_array($book['published'])){
        $book['published'] = $myNull;
    }
    if(is_array($book['large_image_url'])){
        $book['large_image_url'] = $myNull;
    }
    if(is_array($book['edition_information'])){
        $book['edition_information'] = $myNull;
    }

    return $book;
}

/**
 * Undocumented function
 *
 * @param [type] $smt
 * @return void
 * NOTE: https://crate.io/docs/pdo/en/latest/appendices/data-types.html
 */
function cleanSmt($smt)
{
    $myNull = null;
    $smt->bindParam(':isbn', $myNull, PDO::PARAM_STR);
    $smt->bindParam(':isbn13', $myNull, PDO::PARAM_STR);
    $smt->bindParam(':num_pages', $myNull, PDO::PARAM_INT);
    $smt->bindParam(':format', $myNull, PDO::PARAM_STR);
    $smt->bindParam(':publisher', $myNull, PDO::PARAM_STR);
    $smt->bindParam(':publication_day', $myNull, PDO::PARAM_INT);
    $smt->bindParam(':publication_month', $myNull, PDO::PARAM_INT);
    $smt->bindParam(':publication_year', $myNull, PDO::PARAM_INT);
    $smt->bindParam(':description', $myNull, PDO::PARAM_TIMESTAMP);
    $smt->bindParam(':published', $myNull, PDO::PARAM_INT);
    $smt->bindParam(':date_added', $myNull, PDO::PARAM_DATE);

    return $smt;
}

$i = 1;
$reviews = $data['reviews']['review'];
foreach($reviews as $review){

    $book = $review['book'];

    $book['gr_id'] = $book['id'];
    unset($book['id']);


    
    
    $book = cleanBook($book);

    // NOTE: Pasando datos de mi review al libro
    $dateAdded = $review['date_added'];
    $dateAdded = strtotime($dateAdded);
    $book['date_added'] = date("Y-m-d H:i:s", $dateAdded);
    /*
    rating
    votes
    spoiler_flag
    recommended_for
    recommended_by
    started_at
    read_at
    date_updated
    read_count
    body
    comments_count
    url
    owned
    */

    // NOTE: datos sobre el guardado en la bbdd
    $book['last_user'] = 'jesus';
    $book['last_mod'] = date("Y-m-d H:i:s");

    // NOTE: Guardando en la BBDD
    // NOTE: https://www.php.net/manual/es/pdostatement.execute.php
    $keys = array_keys($book);
    $fields = '`'.implode('`, `',$keys).'`';
    $placeholder = substr(str_repeat('?,',count($keys)),0,-1);

    // print("<pre>".print_r($book, true)."</pre>");

    $smt = $mbd->prepare("INSERT INTO `libricos20210128`.`gr_books` ($fields) VALUES($placeholder)");

    // $smt = cleanSmt($smt);

    try{
        // print("<pre>".print_r($review, true)."</pre>");die;
        $response = $smt->execute(array_values($book));
        if($response){
            echo "Libro $i added: ".$book['title'].'<br />';
        }else{
            echo "FAIL! $i added: ".$book['title'].'<br />';
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
    // sleep(1);

    $i++;
}


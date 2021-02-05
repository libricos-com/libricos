<?php
/* 
@see: https://www.goodreads.com/api/index
*/
include '../config.php';
include '../goodreads/GoodReads.php';

$api = new GoodReads(JEI_GOODREADS_KEY, __DIR__.'/../cache');

$pdo = new PDO('mysql:host=localhost;dbname=libricos20210128', 'root', 'root');
if (!$pdo) {
    die('No pudo conectarse: ' . mysql_error());
}
echo 'Conectado satisfactoriamente<br /><br />';
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$books = $pdo->query('SELECT gr_id, title FROM gr_books LIMIT 100', PDO::FETCH_ASSOC);


$i = 1;

foreach($books as $book){

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
    $sql = "UPDATE gr_books SET 
            asin=:asin, 
            kindle_asin=:kindle_asin, 
            language_code=:language_code, 
            is_ebook=:is_ebook, 
            last_user=:last_user,
            last_mod=:last_mod 
        WHERE gr_id=:gr_id";
    $stmt= $pdo->prepare($sql);
    
    try{
        $response = $stmt->execute($data);
        if($response){
            echo "Libro $i updated: ".$book['title'].'<br />';
        }else{
            echo "FAIL! $i updated: ".$book['title'].'<br />';
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
    // sleep(1);

    $i++;
}


// print("<pre>".print_r($review, true)."</pre>");
// print("<pre>".print_r($bookExtended, true)."</pre>");

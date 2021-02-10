<?php
namespace App\Entity;
/**
 * BookJei class
 * 
 */


class BookJei extends Book
{
    protected static $_pdo;

    /**
     * Constructor.
     *
     * Partes comunes a todo tipo de entrada
     */
    public function __construct( \Pdo $pdo )
    {
        // parent::__construct($post);
        self::$_pdo = $pdo;
        // $this->insert($review);
    }

    /**
     * Undocumented function
     * Fill all properties from a Wordpress post
     * 
     * @return void
     */
    public static function insert($review) 
    {
        $book = $review['book'];

        $book['gr_id'] = $book['id'];
        unset($book['id']);

        $book = self::cleanBook($book);

        // NOTE: Pasando datos de mi review al libro
        $dateAdded = $review['date_added'];
        $dateAdded = strtotime($dateAdded);
        $book['date_added'] = date('Y-m-d H:i:s', $dateAdded);
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

        $smt = self::$_pdo->prepare("INSERT INTO jei_books ($fields) VALUES($placeholder)");


        try{
            // print("<pre>".print_r($review, true)."</pre>");die;
            self::$_pdo->beginTransaction();
            $response = $smt->execute(array_values($book));
            $lastInsertId = self::$_pdo->lastInsertId();
            self::$_pdo->commit();
            echo "Libro $lastInsertId added: ".$book['title'].'<br />';
            return $lastInsertId;
        }catch(Exception $e){
            echo $e->getMessage();
            self::$_pdo->rollback();
            return false;
        }
        
    }

    protected static function cleanBook($book)
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

    public static function update($data) 
    {
        $sql = "UPDATE jei_books SET 
            asin=:asin, 
            kindle_asin=:kindle_asin, 
            language_code=:language_code, 
            is_ebook=:is_ebook, 
            last_user=:last_user,
            last_mod=:last_mod 
        WHERE id=:id";
        $stmt= self::$_pdo->prepare($sql);
        try{
            self::$_pdo->beginTransaction();
            $response = $stmt->execute($data);
            $modified = $stmt->rowCount(); 
            self::$_pdo->commit();
            echo "$modified row modified at id: ".$data['id'].'<br />';
            return $data['id'];
        }catch(Exception $e){
            echo $e->getMessage();
            self::$_pdo->rollback();
            return false;
        }
    }


    public static function addReview($data) 
    {
        $response = false;

        $sql = "UPDATE jei_books SET 
            asin=:asin, 
            kindle_asin=:kindle_asin, 
            language_code=:language_code, 
            is_ebook=:is_ebook, 
            last_user=:last_user,
            last_mod=:last_mod 
        WHERE gr_id=:gr_id";
        $stmt= self::$_pdo->prepare($sql);
        
        try{
            $response = $stmt->execute($data);
            if($response){
                echo "Libro updated: ".$data['gr_id'].'<br />';
            }else{
                echo "FAIL! updated: ".$data['gr_id'].'<br />';
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public static function updateBookPostidsByAsin() 
    {
        $response = false;

        $sql = "UPDATE
            wp_postmeta m, wp_posts p, jei_books j
        SET j.post_id = p.ID
        WHERE
            p.ID = m.post_id 
            AND m.meta_value = j.asin
            AND p.post_type = 'libro'
            AND j.post_id IS NULL
        LIMIT 100";
        $stmt= self::$_pdo->prepare($sql);
        
        try{
            self::$_pdo->beginTransaction();
            $response = $stmt->execute();
            $modified = $stmt->rowCount(); 
            self::$_pdo->commit();
            echo "$modified row modified for updateBookPostidsByAsin()<br />";
            return $response;
        }catch(Exception $e){
            echo $e->getMessage();
            self::$_pdo->rollback();
            return false;
        }
    }


    public static function updateBookPostidsByGoodreadsUrl() 
    {
        $response = false;

        $sql = "UPDATE
            wp_postmeta m, wp_posts p, jei_books j
        SET j.post_id = p.ID
        WHERE
            p.ID = m.post_id 
            AND m.meta_value = j.link
            AND p.post_type = 'libro'
            AND j.post_id IS NULL
        LIMIT 100";
        $stmt= self::$_pdo->prepare($sql);
        
        try{
            self::$_pdo->beginTransaction();
            $response = $stmt->execute();
            $modified = $stmt->rowCount(); 
            self::$_pdo->commit();
            echo "$modified row modified for updateBookPostidsByGoodreadsUrl()<br />";
            return $response;
        }catch(Exception $e){
            echo $e->getMessage();
            self::$_pdo->rollback();
            return false;
        }
    }


    public static function updateBookTableContentsByPostid() 
    {
        $response = false;

        $sql = "UPDATE
            wp_postmeta m, wp_posts p, jei_books j
        SET j.table_contents = m.meta_value
        WHERE
            p.ID = m.post_id 
            AND m.post_id = j.post_id
            AND p.post_type = 'libro'
            AND m.meta_key IN ('table_of_contents')
        LIMIT 100";
        $stmt= self::$_pdo->prepare($sql);
        
        try{
            self::$_pdo->beginTransaction();
            $response = $stmt->execute();
            $modified = $stmt->rowCount(); 
            self::$_pdo->commit();
            echo "$modified row modified for updateBookTableContentsByPostid()<br />";
            return $response;
        }catch(Exception $e){
            echo $e->getMessage();
            self::$_pdo->rollback();
            return false;
        }
    }

}


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

        // NOTE: datos sobre el guardado en la bbdd
        if(is_array($review['date_added'])){
            $book['date_added'] = $myNull;
        }else{
            $book['date_added'] = date('Y-m-d H:i:s', strtotime( $review['date_added'] ) );
        }
        $book['last_user'] = 'jesus';
        $book['last_mod'] = date('Y-m-d H:i:s');

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
    /**
     * Undocumented function
     * Fill all properties from a Wordpress post
     * 
     * @return void
     */
    public static function insertShelf($shelf) 
    {
        // $shelf['gr_id'] = $shelf['id'];
        unset($shelf['exclusive']);
        unset($shelf['id']);
        unset($shelf['sortable']);
        unset($shelf['review_shelf_id']);

        $shelf['last_user'] = 'jesus';
        $shelf['last_mod'] = date('Y-m-d H:i:s');

        if(empty($shelf['review_shelf_id'])){
            $shelf['review_shelf_id'] = null;
        }

        // NOTE: Guardando en la BBDD
        // NOTE: https://www.php.net/manual/es/pdostatement.execute.php
        $keys = array_keys($shelf);
        $fields = '`'.implode('`, `',$keys).'`';
        $placeholder = substr(str_repeat('?,',count($keys)),0,-1);

        // print("<pre>".print_r($book, true)."</pre>");

        $smt = self::$_pdo->prepare("INSERT INTO jei_shelves ($fields) VALUES($placeholder)");

        try{
            // print("<pre>".print_r($review, true)."</pre>");die;
            self::$_pdo->beginTransaction();
            $response = $smt->execute(array_values($shelf));
            $lastInsertId = self::$_pdo->lastInsertId();
            self::$_pdo->commit();
            echo "Shelf $lastInsertId added <br />";
            return $lastInsertId;
        } catch ( \Exception $e) {
            // throw $e;
            echo $e->getCode()." aaaaa dupes here ".$e->getMessage()."<br />";
            self::$_pdo->rollback();
            if ($e->getCode() == 1062) {
               // duplicate entry, do something else
               echo "uuuuuuh dupes here<br />";
               die;
            }       
        }
        /*
        catch(Throwable $e){
            echo $e->getMessage();
            self::$_pdo->rollback();
            return false;
        }
        */
        
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


    protected static function cleanReview($review)
    {
        unset($review['book']);
        unset($review['shelves']);
        unset($review['id']);
        unset($review['spoilers_state']);

        $myNull = null;

        if(is_array($review['recommended_for'])){
            $review['recommended_for'] = $myNull;
        }
        if(is_array($review['recommended_by'])){
            $review['recommended_by'] = $myNull;
        }
        if(is_array($review['body'])){
            $review['body'] = $myNull;
        }


        if(is_array($review['date_added'])){
            $review['date_added'] = $myNull;
        }else{
            $review['date_added'] = date('Y-m-d H:i:s', strtotime( $review['date_added'] ) );
        }
        if(is_array($review['started_at'])){
            $review['started_at'] = $myNull;
        }else{
            $review['started_at'] = date('Y-m-d H:i:s', strtotime( $review['started_at'] ) );
        }
        if(is_array($review['read_at'])){
            $review['read_at'] = $myNull;
        }else{
            $review['read_at'] = date('Y-m-d H:i:s', strtotime( $review['read_at'] ) );
        }
        if(is_array($review['date_updated'])){
            $review['date_updated'] = $myNull;
        }else{
            $review['date_updated'] = date('Y-m-d H:i:s', strtotime( $review['date_updated'] ) );
        }
        return $review;
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


    public static function addReview($review) 
    {
        // print("<pre>".print_r($review, true)."</pre>");die;

        // NOTE: datos sobre el guardado en la bbdd
        $review['gr_id'] = $review['id'];
        $review['jei_book_id'] = null;

        // NOTE: preparación campos
        $spoiler_flag = 0;
        if($review['spoiler_flag']){
            $review['spoiler_flag'] = 1;
        }else{
            $review['spoiler_flag'] = 0;
        }

        $review = self::cleanReview($review);

        // NOTE: Datos finales
        $review['last_user'] = 'jesus';
        $review['last_mod'] = date("Y-m-d H:i:s");

        

        // NOTE: Guardando en la BBDD
        // NOTE: https://www.php.net/manual/es/pdostatement.execute.php
        $keys = array_keys($review);
        $fields = '`'.implode('`, `',$keys).'`';
        $placeholder = substr(str_repeat('?,',count($keys)),0,-1);

        $sql = "INSERT INTO jei_reviews ($fields) VALUES ($placeholder)";
        $smt = self::$_pdo->prepare($sql);

        // print("<pre>".print_r($review, true)."</pre>");die;
        
        try{
            self::$_pdo->beginTransaction();
            $response = $smt->execute(array_values($review));
            $lastInsertId = self::$_pdo->lastInsertId();
            self::$_pdo->commit();
            echo "Review $lastInsertId added<br />";
            return $lastInsertId;
        }catch(Exception $e){
            echo $e->getMessage();
            self::$_pdo->rollback();
            return false;
        }
    }

    public static function updateBookPostidsByAsin() 
    {
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


    public static function updateReviewPostidsByGoodreadsUrl() 
    {
        $sql = "UPDATE
            wp_postmeta m, wp_posts p, jei_reviews r
        SET r.post_id = p.ID
        WHERE
            p.ID = m.post_id 
            AND m.meta_value = r.link
            AND p.post_type = 'review'
            AND r.post_id IS NULL
        LIMIT 100";
        $stmt= self::$_pdo->prepare($sql);
        
        try{
            self::$_pdo->beginTransaction();
            $response = $stmt->execute();
            $modified = $stmt->rowCount(); 
            self::$_pdo->commit();
            echo "$modified row modified for updateReviewPostidsByGoodreadsUrl()<br />";
            return $response;
        }catch(Exception $e){
            echo $e->getMessage();
            self::$_pdo->rollback();
            return false;
        }
    }

    public static function updateReviewJeiBookIdByPodRel() 
    {
        $sql = "UPDATE
             wp_podsrel rel, jei_reviews r, jei_books b
        SET r.jei_book_id = rel.related_item_id
        WHERE
            r.post_id = rel.item_id
            AND b.post_id = rel.related_item_id
            AND r.jei_book_id IS NULL
        LIMIT 100";
        $stmt= self::$_pdo->prepare($sql);
        
        try{
            self::$_pdo->beginTransaction();
            $response = $stmt->execute();
            $modified = $stmt->rowCount(); 
            self::$_pdo->commit();
            echo "$modified row modified for updateReviewJeiBookIdByPodRel()<br />";
            return $response;
        }catch(Exception $e){
            echo $e->getMessage();
            self::$_pdo->rollback();
            return false;
        }
    }


    public static function updateBookPostidsByGoodreadsUrl() 
    {
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


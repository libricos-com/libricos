<?php
/**
 * Undocumented class
 * @see https://code.tutsplus.com/articles/design-patterns-in-wordpress-the-simple-factory-pattern--wp-31652
 */
class Reader extends User {
 
    public function __construct() {
        $this->role = "Reader";
    }
 
    public function get_role() {
        return $this->role;
    }
 
}
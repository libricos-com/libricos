<?php
/**
 * Undocumented class
 * @see https://code.tutsplus.com/articles/design-patterns-in-wordpress-the-simple-factory-pattern--wp-31652
 */ 
class Admin extends User {
 
    public function __construct() {
        $this->role = "Administrator";
    }
 
    public function get_role() {
        return $this->role;
    }
 
}
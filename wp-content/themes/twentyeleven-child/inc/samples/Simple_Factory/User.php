<?php
 /**
  * Undocumented class
  * @see https://code.tutsplus.com/articles/design-patterns-in-wordpress-the-simple-factory-pattern--wp-31652
  */
abstract class User {
 
    private $role;
 
    public function __construct( $role ) {
        $this->role = $role;
    }
 
    abstract public function get_role();
 
}
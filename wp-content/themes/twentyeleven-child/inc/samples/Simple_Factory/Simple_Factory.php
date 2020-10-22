<?php
include_once( 'users/user.php' );
include_once( 'users/admin.php' );
include_once( 'users/volunteer.php' );
include_once( 'users/reader.php' );
 
/**
 * Undocumented class
 * @see https://code.tutsplus.com/articles/design-patterns-in-wordpress-the-simple-factory-pattern--wp-31652
 */
class Simple_Factory 
{
 
    public function get_user( $permission ) 
    {
 
        switch( strtolower( $permission ) ) {
 
            case 'read-write':
                $user = new Admin();
                break;
 
            case 'help':
                $user = new Volunteer();
                break;
 
            case 'read':
                $user = new Reader();
                break;
 
            default:
                $user = null;
                break;
 
        }
 
        return $user;
 
    }
 
}
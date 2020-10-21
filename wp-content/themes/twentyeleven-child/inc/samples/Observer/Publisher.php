<?php
/**
 * Undocumented class
 * @see https://code.tutsplus.com/articles/design-patterns-in-wordpress-an-introduction--wp-31604
 */
class MyPublisher 
{
 
 /** The list of subscribers that are registered with this publisher */
 private $subscribers;

 /**
  * Responsible for initializing the class and setting up the list of subscribers.
  */
 public function __construct() 
 {
     $this->subscribers = array();
 } // end constructor

 /**
  * Adds the incoming subject to the list of registered subscribers
  *
  * @param  array  $subject  The subject to add to the list of subscribers
  */
 public function register( $subject ) 
 {
     array_push( $this->subscribers, $subject );
 } // end register_subscriber

 /**
  * Notifies all of the subscribers that something has happened by calling their `update`
  * method.
  */
 public function notify_subscribers() 
 {

     for ( $i = 0; $l < count( $this->subscribers ); $i++ ) {

         $current_subscriber = $this->subscribers[ $i ];
         $current_subscriber->update();

     } // end for

 } // end notify_subscribers

} // end class
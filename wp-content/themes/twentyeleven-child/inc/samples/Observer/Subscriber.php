<?php
/**
 * Undocumented class
 * @see https://code.tutsplus.com/articles/design-patterns-in-wordpress-an-introduction--wp-31604
 */
class MySubscriber 
{
 
    /** The publisher to which this class registers */
    private $publisher;
 
    /**
     * Responsible for initializing the class and setting up a reference to the publisher
     */
    public function __construct() 
    {
 
        $this->publisher = new MyPublisher();
        $this->publisher->register( $this );
 
    } // end constructor
 
    /**
     * This is the method that the Publisher calls when it it broadcasts its message.
     */
    public function update() 
    {
 
        /** Implementation is based purely on however you'd like. */
 
    } // end update
 
} // end class
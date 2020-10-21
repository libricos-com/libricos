<?php
namespace Jesuserro\Samples;

/**
 * Undocumented class
 * @see https://torquemag.io/2016/06/basic-php-design-patterns-developers/
 * @see https://www.smashingmagazine.com/2019/02/wordpress-modern-php/
 */
class Factory
{
    /**
     * @var WP_Post
     */
    protected $post;

    public function __construct( $post = null ) 
    {
        if( is_a( $post, 'WP_Post' ) ){
            $this->post = $post;
        }elseif ( is_numeric( $post ) || is_a( $post, 'stdClass' ) ){
            $_post = get_post( $post );
            if( is_object( $_post ) ) {
                $this->post = $_post;
            }
        }else{
            $this->post = get_post();
        }
    }

    public function get_post()
    {
        return $this->post;
    }

}
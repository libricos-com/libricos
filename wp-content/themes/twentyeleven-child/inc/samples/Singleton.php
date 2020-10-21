<?php
namespace Jesuserro\Samples;

/**
 * Undocumented class
 * @see https://torquemag.io/2016/06/basic-php-design-patterns-developers/
 * @see https://www.smashingmagazine.com/2019/02/wordpress-modern-php/
 */
class Singleton 
{
	/**
	 * Holds class instance
	 *
	 * @access private
	 *
	 * @var singleton_example
	 */
	private static $instance;
	/**
	 * Private constructor to prevent new instances.
	 */
    private function __construct()
    {
		//feel free to do stuff that should only happen once here.
	}
	/**
	 * Get class instance
	 *
	 * @return singleton_example
	 */
    public static function get_instance()
    {
		if( null === self::$instance ){
			self::$instance = new self();
		}
		return self::$instance;
	}
}

$object = Jesuserro\Samples\Singleton::get_instance();


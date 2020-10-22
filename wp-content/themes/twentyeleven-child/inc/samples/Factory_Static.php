<?php
/**
 * Undocumented class
 * @see https://carlalexander.ca/static-factory-method-pattern-wordpress/
 * @see https://carlalexander.ca/static-keyword-wordpress/
 */
class MyPlugin_Product
{
    /**
     * The Product's ID. Not the WordPress post ID.
     *
     * @var string
     */
    private $id;
 
    /**
     * The name of the product.
     *
     * @var string
     */
    private $name;
 
    /**
     * The type of the product.
     *
     * @var string
     */
    private $type;

    
 
    /**
     * Constructor.
     *
     * @param string $id
     * @param string $name
     * @param string $type
     */
    public function __construct($id, $name, $type)
    {
        $this->id   = $id;
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * Creates a new product from a post object.
     *
     * @param WP_Post $post
     *
     * @return MyPlugin_Product|null
     */
    public static function from_post(WP_Post $post)
    {
        if (!isset($post->myplugin_product_id, $post->myplugin_product_name, $post->myplugin_product_type)) {
            return;
        }
 
        return new self($post->myplugin_product_id, $post->myplugin_product_name, $post->myplugin_product_type);
    }
 
    /**
     * Creates a new product from API data.
     *
     * @param mixed $object
     *
     * @return MyPlugin_Product|null
     */
    public static function from_api($object)
    {
        if (is_string($object)) {
            $object = json_decode($object);
        }
 
        if (is_array($object) && isset($object['id'], $object['name'], $object['type'])) {
            return new self($object['id'], $object['name'], $object['type']);
        } elseif ($object instanceof stdClass && isset($object->id, $object->name, $object->type)) {
            return new self($object->id, $object->name, $object->type);
        }
    }

    /**
     * Get the actions that A_WP_Class hooks to.
     *
     * @return array
     */
    public static function get_actions()
    {
        $actions = array('wp_loaded');
        return $actions;
    }

}


MyPlugin_Product::get_actions();
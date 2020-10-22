<?php
namespace MyPlugin;
 
/**
 * Undocumented class
 * @see https://carlalexander.ca/static-keyword-wordpress/
 */
class Utilities
{
    /**
     * Flag to track if the plugin is active.
     *
     * @var bool
     */
    private $active;
    
    /**
     * Check if the plugin is active
     *
     * @return bool
     */
    public static function is_plugin_active()
    {
        // ...
    }

    /**
     * Check if the plugin is active
     *
     * @return bool
     */
    public function is_active()
    {
        return $this->active;
    }
}
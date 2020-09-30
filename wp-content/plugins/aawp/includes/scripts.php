<?php
/**
 * Scripts
 *
 * @since       1.0.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

/**
 * Load admin scripts
 *
 * @since       3.2.0
 */
function aawp_admin_scripts() {
    // Use minified libraries if SCRIPT_DEBUG and AAWP_DEBUG is turned off
    $suffix = ( ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) || ( defined( 'AAWP_DEBUG' ) && AAWP_DEBUG ) ) ? '' : '.min';

    // Dependencies
    wp_enqueue_style( 'wp-color-picker' );

    wp_enqueue_script( 'aawp-admin-script', AAWP_PLUGIN_URL . 'public/assets/js/admin' . $suffix . '.js', array( 'jquery', 'jquery-ui-sortable', 'wp-color-picker' ), AAWP_VERSION );
    wp_enqueue_style( 'aawp-admin-styles', AAWP_PLUGIN_URL . 'public/assets/css/admin' . $suffix . '.css', false, AAWP_VERSION );

    wp_localize_script( 'aawp-admin-script', 'aawp_post', array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ));
}
add_action( 'aawp_load_admin_scripts', 'aawp_admin_scripts' );

/**
 * Load frontend scripts
 *
 * @since       3.2.0
 */
function aawp_scripts() {

    // Use minified libraries if SCRIPT_DEBUG and AAWP_DEBUG is turned off
    $suffix = ( ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) || ( defined( 'AAWP_DEBUG' ) && AAWP_DEBUG ) ) ? '' : '.min';

    wp_enqueue_style( 'aawp-styles', AAWP_PLUGIN_URL . 'public/assets/css/styles' . $suffix . '.css', false, AAWP_VERSION );

    // Don't load javascript on AMP endpoints.
    if ( aawp_is_amp_endpoint() )
        return;

    wp_enqueue_script( 'aawp-script', AAWP_PLUGIN_URL . 'public/assets/js/scripts' . $suffix . '.js', array( 'jquery' ), AAWP_VERSION, true );
}
add_action( 'aawp_load_scripts', 'aawp_scripts' );


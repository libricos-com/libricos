<?php

/**
 * 1. Add autoload to plugin options
 */

$options = su_get_config( 'default-settings' );

foreach ( $options as $option => $default ) {

	if ( ! add_option( $option, $default ) ) {

		$value = get_option( $option );

		delete_option( $option );
		add_option( $option, $value );

	}

}

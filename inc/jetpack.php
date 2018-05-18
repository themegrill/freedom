<?php
/**
 * Jetpack Compatibility File
 *
 * @link       https://jetpack.com/
 *
 * @package    ThemeGrill
 * @subpackage Freedom
 * @since      Freedom 1.1.4
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/responsive-videos/
 */
function freedom_jetpack_setup() {
	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
}

add_action( 'after_setup_theme', 'freedom_jetpack_setup' );

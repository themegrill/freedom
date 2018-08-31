<?php
/**
 * Functions for configuring demo importer.
 *
 * @package Importer/Functions
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Setup demo importer config.
 *
 * @deprecated 1.5.0
 *
 * @param  array $demo_config Demo config.
 * @return array
 */
function freedom_demo_importer_packages( $packages ) {
	$new_packages = array(
		'freedom-free' => array(
			'name'    => esc_html__( 'Freedom', 'freedom' ),
			'preview' => 'https://demo.themegrill.com/freedom/',
		),
		'freedom-pro'  => array(
			'name'     => __( 'Freedom Pro', 'freedom' ),
			'preview'  => 'https://demo.themegrill.com/freedom-pro/',
			'pro_link' => 'https://themegrill.com/themes/freedom/',
		),
	);

	return array_merge( $new_packages, $packages );
}

add_filter( 'themegrill_demo_importer_packages', 'freedom_demo_importer_packages' );

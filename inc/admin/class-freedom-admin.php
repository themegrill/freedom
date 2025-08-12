<?php
/**
 * Freedom Admin Class.
 *
 * @author  ThemeGrill
 * @package freedom
 * @since   1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Freedom_Admin' ) ) :

	/**
	 * Freedom_Admin Class.
	 */
	class Freedom_Admin {

		/**
		 * Constructor.
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		/**
		 * Localize array for import button AJAX request.
		 */
		public function enqueue_scripts() {
			wp_enqueue_style( 'freedom-admin-style', get_template_directory_uri() . '/inc/admin/css/admin.css', array(), FREEDOM_THEME_VERSION );

			wp_enqueue_script( 'freedom-plugin-install-helper', get_template_directory_uri() . '/inc/admin/js/plugin-handle.js', array( 'jquery' ), FREEDOM_THEME_VERSION, true );

			$welcome_data = array(
				'uri'      => esc_url( admin_url( '/themes.php?page=demo-importer&browse=all&freedom-hide-notice=welcome' ) ),
				'btn_text' => esc_html__( 'Processing...', 'freedom' ),
			);

			// Only add nonce and ajaxurl if user has appropriate capabilities
			if ( current_user_can( 'manage_options' ) ) {
				$welcome_data['nonce']   = wp_create_nonce( 'freedom_demo_import_nonce' );
				$welcome_data['ajaxurl'] = admin_url( 'admin-ajax.php' );
			}

			wp_localize_script( 'freedom-plugin-install-helper', 'freedomRedirectDemoPage', $welcome_data );
		}
	}

endif;

return new Freedom_Admin();

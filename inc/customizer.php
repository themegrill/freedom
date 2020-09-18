<?php
/**
 * Freedom Theme Customizer
 *
 * @package    ThemeGrill
 * @subpackage Freedom
 * @since      Freedom 1.0.5
 */

function freedom_customize_register( $wp_customize ) {

	require FREEDOM_INCLUDES_DIR . '/customize-controls/class-freedom-image-radio-control.php';
	require FREEDOM_INCLUDES_DIR . '/customize-controls/class-freedom-text-area-control.php';
	require FREEDOM_INCLUDES_DIR . '/customize-controls/class-freedom-upsell-section.php';

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '#site-title a',
			'render_callback' => 'freedom_customize_partial_blogname',
		) );

		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '#site-description',
			'render_callback' => 'freedom_customize_partial_blogdescription',
		) );
	}

// Register `FREEDOM_Upsell_Section` type section.
	$wp_customize->register_section_type( 'FREEDOM_Upsell_Section' );

// Add `FREEDOM_Upsell_Section` to display pro link.
	$wp_customize->add_section(
		new FREEDOM_Upsell_Section( $wp_customize, 'freedom_upsell_section',
			array(
				'title'      => esc_html__( 'View PRO version', 'freedom' ),
				'url'        => 'https://themegrill.com/themes/freedom/?utm_source=freedom-customizer&utm_medium=view-pro-link&utm_campaign=view-pro#free-vs-pro',
				'capability' => 'edit_theme_options',
				'priority'   => 1,
			)
		)
	);

	// Start of the Header Options
	// Header Options Area
	$wp_customize->add_panel( 'freedom_header_options', array(
		'capabitity' => 'edit_theme_options',
		'priority'   => 500,
		'title'      => __( 'Header', 'freedom' ),
	) );

	// Header Logo upload option
	$wp_customize->add_section( 'freedom_header_logo', array(
		'priority' => 1,
		'title'    => __( 'Header Logo', 'freedom' ),
		'panel'    => 'freedom_header_options',
	) );

	// Header logo and text display type option
	$wp_customize->add_section( 'freedom_show_option', array(
		'priority' => 2,
		'title'    => __( 'Show', 'freedom' ),
		'panel'    => 'freedom_header_options',
	) );

	$wp_customize->add_setting( 'freedom_show_header_logo_text', array(
		'default'           => 'text_only',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'freedom_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'freedom_show_header_logo_text', array(
		'type'    => 'radio',
		'label'   => __( 'Choose the option that you want.', 'freedom' ),
		'section' => 'title_tagline',
		'choices' => array(
			'logo_only' => __( 'Header Logo Only', 'freedom' ),
			'text_only' => __( 'Header Text Only', 'freedom' ),
			'both'      => __( 'Show Both', 'freedom' ),
			'none'      => __( 'Disable', 'freedom' ),
		),
	) );

	// New Responsive Menu
	$wp_customize->add_section( 'freedom_new_menu_style', array(
		'priority' => 3,
		'title'    => esc_html__( 'Responsive Menu Style', 'freedom' ),
		'panel'    => 'freedom_header_options',
	) );
	$wp_customize->add_setting( 'freedom_new_menu', array(
		'default'           => 0,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'freedom_checkbox_sanitize',
	) );
	$wp_customize->add_control( 'freedom_new_menu', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Switch to new responsive menu', 'freedom' ),
		'section'  => 'freedom_new_menu_style',
		'settings' => 'freedom_new_menu',
	) );

	// End of Header Options

	// Start of the Design Options
	$wp_customize->add_panel( 'freedom_design_options', array(
		'capabitity' => 'edit_theme_options',
		'priority'   => 505,
		'title'      => __( 'Design', 'freedom' ),
	) );

	// site layout setting
	$wp_customize->add_section( 'freedom_site_layout_setting', array(
		'priority' => 1,
		'title'    => __( 'Site Layout', 'freedom' ),
		'panel'    => 'freedom_design_options',
	) );

	$wp_customize->add_setting( 'freedom_site_layout', array(
		'default'           => 'wide',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'freedom_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'freedom_site_layout', array(
		'type'    => 'radio',
		'label'   => __( 'Choose your site layout. The change is reflected in whole site.', 'freedom' ),
		'choices' => array(
			'box'  => __( 'Boxed layout', 'freedom' ),
			'wide' => __( 'Wide layout', 'freedom' ),
		),
		'section' => 'freedom_site_layout_setting',
	) );

	// default layout setting
	$wp_customize->add_section( 'freedom_default_layout_setting', array(
		'priority' => 2,
		'title'    => __( 'Default layout', 'freedom' ),
		'panel'    => 'freedom_design_options',
	) );

	$wp_customize->add_setting( 'freedom_default_layout', array(
		'default'           => 'no_sidebar_full_width',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'freedom_radio_select_sanitize',
	) );

	$wp_customize->add_control( new Freedom_Image_Radio_Control( $wp_customize, 'freedom_default_layout', array(
		'type'     => 'radio',
		'label'    => __( 'Select default layout. This layout will be reflected in whole site archives, categories, search page etc. The layout for a single post and page can be controlled from below options.', 'freedom' ),
		'section'  => 'freedom_default_layout_setting',
		'settings' => 'freedom_default_layout',
		'choices'  => array(
			'right_sidebar'               => FREEDOM_ADMIN_IMAGES_URL . '/right-sidebar.png',
			'left_sidebar'                => FREEDOM_ADMIN_IMAGES_URL . '/left-sidebar.png',
			'no_sidebar_full_width'       => FREEDOM_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
			'no_sidebar_content_centered' => FREEDOM_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
		),
	) ) );

	// default layout for pages
	$wp_customize->add_section( 'freedom_default_page_layout_setting', array(
		'priority' => 3,
		'title'    => __( 'Default layout for pages only', 'freedom' ),
		'panel'    => 'freedom_design_options',
	) );

	$wp_customize->add_setting( 'freedom_pages_default_layout', array(
		'default'           => 'right_sidebar',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'freedom_radio_select_sanitize',
	) );

	$wp_customize->add_control( new Freedom_Image_Radio_Control( $wp_customize, 'freedom_pages_default_layout', array(
		'type'     => 'radio',
		'label'    => __( 'Select default layout for pages. This layout will be reflected in all pages unless unique layout is set for specific page.', 'freedom' ),
		'section'  => 'freedom_default_page_layout_setting',
		'settings' => 'freedom_pages_default_layout',
		'choices'  => array(
			'right_sidebar'               => FREEDOM_ADMIN_IMAGES_URL . '/right-sidebar.png',
			'left_sidebar'                => FREEDOM_ADMIN_IMAGES_URL . '/left-sidebar.png',
			'no_sidebar_full_width'       => FREEDOM_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
			'no_sidebar_content_centered' => FREEDOM_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
		),
	) ) );

	// default layout for single posts
	$wp_customize->add_section( 'freedom_default_single_posts_layout_setting', array(
		'priority' => 4,
		'title'    => __( 'Default layout for single posts only', 'freedom' ),
		'panel'    => 'freedom_design_options',
	) );

	$wp_customize->add_setting( 'freedom_single_posts_default_layout', array(
		'default'           => 'right_sidebar',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'freedom_radio_select_sanitize',
	) );

	$wp_customize->add_control( new Freedom_Image_Radio_Control( $wp_customize, 'freedom_single_posts_default_layout', array(
		'type'     => 'radio',
		'label'    => __( 'Select default layout for single posts. This layout will be reflected in all single posts unless unique layout is set for specific post.', 'freedom' ),
		'section'  => 'freedom_default_single_posts_layout_setting',
		'settings' => 'freedom_single_posts_default_layout',
		'choices'  => array(
			'right_sidebar'               => FREEDOM_ADMIN_IMAGES_URL . '/right-sidebar.png',
			'left_sidebar'                => FREEDOM_ADMIN_IMAGES_URL . '/left-sidebar.png',
			'no_sidebar_full_width'       => FREEDOM_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
			'no_sidebar_content_centered' => FREEDOM_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
		),
	) ) );

	// Posts page listing display type setting
	$wp_customize->add_section( 'freedom_post_page_display_type_setting', array(
		'priority' => 5,
		'title'    => __( 'Posts page listing display type', 'freedom' ),
		'panel'    => 'freedom_design_options',
	) );

	$wp_customize->add_setting( 'freedom_posts_page_display_type', array(
		'default'           => 'photo_blogging_two_column',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'freedom_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'freedom_posts_page_display_type', array(
		'type'    => 'radio',
		'label'   => __( 'Choose the display type for the latest posts view or posts page view (static front page).', 'freedom' ),
		'choices' => array(
			'photo_blogging_two_column' => __( 'Photo blogging view (two column)', 'freedom' ),
			'normal_view'               => __( 'Normal view', 'freedom' ),
		),
		'section' => 'freedom_post_page_display_type_setting',
	) );

	// Archive/Category posts listing display type setting
	$wp_customize->add_section( 'freedom_archive_category_listing_display_type_setting', array(
		'priority' => 6,
		'title'    => __( 'Archive/Category posts listing display type', 'freedom' ),
		'panel'    => 'freedom_design_options',
	) );

	$wp_customize->add_setting( 'freedom_archive_display_type', array(
		'default'           => 'photo_blogging_two_column',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'freedom_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'freedom_archive_display_type', array(
		'type'    => 'radio',
		'label'   => __( 'Choose the display type for the archive/category view.', 'freedom' ),
		'choices' => array(
			'photo_blogging_two_column' => __( 'Photo blogging view (two column)', 'freedom' ),
			'normal_view'               => __( 'Normal view', 'freedom' ),
		),
		'section' => 'freedom_archive_category_listing_display_type_setting',
	) );

	// Site primary color option
	$wp_customize->add_section( 'freedom_primary_color_setting', array(
		'panel'    => 'freedom_design_options',
		'priority' => 7,
		'title'    => __( 'Primary color option', 'freedom' ),
	) );

	$wp_customize->add_setting( 'freedom_primary_color', array(
		'default'              => '#46c9be',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'freedom_color_option_hex_sanitize',
		'sanitize_js_callback' => 'freedom_color_escaping_option_sanitize',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'freedom_primary_color', array(
		'label'    => __( 'This will reflect in links, buttons and many others. Choose a color to match your site.', 'freedom' ),
		'section'  => 'freedom_primary_color_setting',
		'settings' => 'freedom_primary_color',
	) ) );

	// End of Design Options

	// Start of the Slider Options
	$wp_customize->add_panel( 'freedom_slider_options', array(
		'capabitity' => 'edit_theme_options',
		'priority'   => 515,
		'title'      => __( 'Slider', 'freedom' ),
	) );

	// slider activate option
	$wp_customize->add_section( 'freedom_slider_activate_section', array(
		'priority' => 1,
		'title'    => __( 'Activate slider', 'freedom' ),
		'panel'    => 'freedom_slider_options',
	) );

	$wp_customize->add_setting( 'freedom_activate_slider', array(
		'default'           => 0,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'freedom_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'freedom_activate_slider', array(
		'type'     => 'checkbox',
		'label'    => __( 'Check to activate slider.', 'freedom' ),
		'section'  => 'freedom_slider_activate_section',
		'settings' => 'freedom_activate_slider',
	) );

	for ( $i = 1; $i <= 4; $i ++ ) {
		// adding slider section
		$wp_customize->add_section( 'freedom_slider_number_section' . $i, array(
			'priority' => 10,
			'title'    => sprintf( __( 'Slider #%1$s', 'freedom' ), $i ),
			'panel'    => 'freedom_slider_options',
		) );

		// adding slider image url
		$wp_customize->add_setting( 'freedom_slider_image' . $i, array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'freedom_slider_image' . $i, array(
			'label'   => __( 'Upload Image', 'freedom' ),
			'section' => 'freedom_slider_number_section' . $i,
			'setting' => 'freedom_slider_image' . $i,
		) ) );

		// adding slider title
		$wp_customize->add_setting( 'freedom_slider_title' . $i, array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		) );

		$wp_customize->add_control( 'freedom_slider_title' . $i, array(
			'label'   => __( 'Enter title for this slide', 'freedom' ),
			'section' => 'freedom_slider_number_section' . $i,
			'setting' => 'freedom_slider_title' . $i,
		) );

		// adding slider description
		$wp_customize->add_setting( 'freedom_slider_text' . $i, array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'freedom_text_sanitize',
		) );

		$wp_customize->add_control( new Freedom_Text_Area_Control( $wp_customize, 'freedom_slider_text' . $i, array(
			'label'   => __( 'Enter description for this slide', 'freedom' ),
			'section' => 'freedom_slider_number_section' . $i,
			'setting' => 'freedom_slider_text' . $i,
		) ) );

		// adding button text
		$wp_customize->add_setting( 'freedom_slider_button_text' . $i, array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		) );

		$wp_customize->add_control( 'freedom_slider_button_text' . $i, array(
			'label'   => __( 'Enter the button text.', 'freedom' ),
			'section' => 'freedom_slider_number_section' . $i,
			'setting' => 'freedom_slider_button_text' . $i,
		) );

		// adding button url
		$wp_customize->add_setting( 'freedom_slider_link' . $i, array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		) );

		$wp_customize->add_control( 'freedom_slider_link' . $i, array(
			'label'   => __( 'Enter link to redirect for the slide', 'freedom' ),
			'section' => 'freedom_slider_number_section' . $i,
			'setting' => 'freedom_slider_link' . $i,
		) );
	}
	// End of Slider Options.

	// Start of Additional option.
	// Author bio option.
	$wp_customize->add_panel( 'freedom_additional_option', array(
		'capabitity' => 'edit_theme_options',
		'priority'   => 520,
		'title'      => __( 'Additional Options', 'freedom' ),
	) );

	$wp_customize->add_section( 'freedom_author_bio_section', array(
		'priority' => 7,
		'title'    => esc_html__( 'Author Bio Option', 'freedom' ),
		'panel'    => 'freedom_additional_option',
	) );

	$wp_customize->add_setting( 'freedom_author_bio_setting', array(
		'default'           => 0,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'freedom_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'freedom_author_bio_setting', array(
		'type'    => 'checkbox',
		'label'   => esc_html__( 'Check to display the author bio.', 'freedom' ),
		'setting' => 'freedom_author_bio_setting',
		'section' => 'freedom_author_bio_section',
	) );

	// Related posts display.
	$wp_customize->add_section( 'freedom_related_posts_section', array(
		'priority' => 4,
		'title'    => esc_html__( 'Related Posts', 'freedom' ),
		'panel'    => 'freedom_additional_option',
	) );

	$wp_customize->add_setting( 'freedom_related_posts_activate', array(
		'default'           => 0,
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'freedom_checkbox_sanitize',
	) );

	$wp_customize->add_control( 'freedom_related_posts_activate', array(
		'type'     => 'checkbox',
		'label'    => __( 'Check to activate the related posts', 'freedom' ),
		'section'  => 'freedom_related_posts_section',
		'settings' => 'freedom_related_posts_activate',
	) );

	$wp_customize->add_setting( 'freedom_related_posts', array(
		'default'           => 'categories',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'freedom_radio_select_sanitize',
	) );

	$wp_customize->add_control( 'freedom_related_posts', array(
		'type'     => 'radio',
		'label'    => __( 'Related Posts Must Be Shown As:', 'freedom' ),
		'section'  => 'freedom_related_posts_section',
		'settings' => 'freedom_related_posts',
		'choices'  => array(
			'categories' => __( 'Related Posts By Categories', 'freedom' ),
			'tags'       => __( 'Related Posts By Tags', 'freedom' ),
		),
	) );
	// End of additional option

	// Start of data sanitization
	function freedom_radio_select_sanitize( $input, $setting ) {
		// Ensuring that the input is a slug.
		$input = sanitize_key( $input );
		// Get the list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it, else, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	// color sanitization
	function freedom_color_option_hex_sanitize( $color ) {
		if ( $unhashed = sanitize_hex_color_no_hash( $color ) ) {
			return '#' . $unhashed;
		}

		return $color;
	}

	function freedom_color_escaping_option_sanitize( $input ) {
		$input = esc_attr( $input );

		return $input;
	}

	// text-area sanitize
	function freedom_text_sanitize( $input ) {
		return wp_kses_post( force_balance_tags( $input ) );
	}

	// checkbox sanitize
	function freedom_checkbox_sanitize( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}

	// sanitization of links
	function freedom_links_sanitize() {
		return false;
	}

}

add_action( 'customize_register', 'freedom_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function freedom_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function freedom_customize_partial_blogdescription() {
	bloginfo( 'description' );
}


/*****************************************************************************************/

/*
 * Custom Scripts
 */
add_action( 'customize_controls_print_footer_scripts', 'freedom_customizer_custom_scripts' );

function freedom_customizer_custom_scripts() { ?>
	<style>
		/* Theme Instructions Panel CSS */
		li#accordion-section-freedom_upsell_section h3.accordion-section-title {
			background-color: #46C9BE !important;
			border-left-color: #28968d !important;
		}

		#accordion-section-freedom_upsell_section h3 a:after {
			content: '\f345';
			color: #fff;
			position: absolute;
			top: 12px;
			right: 10px;
			z-index: 1;
			font: 400 20px/1 dashicons;
			speak: none;
			display: block;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			text-decoration: none !important;
		}

		li#accordion-section-freedom_upsell_section h3.accordion-section-title a {
			display: block;
			color: #fff !important;
			text-decoration: none;
		}

		li#accordion-section-freedom_upsell_section h3.accordion-section-title a:focus {
			box-shadow: none;
		}

		li#accordion-section-freedom_upsell_section h3.accordion-section-title:hover {
			background-color: #37bdb2 !important;
		}

		/* Upsell button CSS */
		.themegrill-pro-info,
		.customize-control-freedom-important-links a {
			/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#8fc800+0,8fc800+100;Green+Flat+%232 */
			background: #008EC2;
			color: #fff;
			display: block;
			margin: 15px 0 0;
			padding: 5px 0;
			text-align: center;
			font-weight: 600;
		}

		.customize-control-freedom-important-links a {
			padding: 8px 0;
		}

		.themegrill-pro-info:hover,
		.customize-control-freedom-important-links a:hover {
			color: #ffffff;
			/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#006e2e+0,006e2e+100;Green+Flat+%233 */
			background: #2380BA;
		}
	</style>
	<script>
		( function ( $, api ) {
			api.sectionConstructor['freedom-upsell-section'] = api.Section.extend( {

				// No events for this type of section.
				attachEvents : function () {
				},

				// Always make the section active.
				isContextuallyActive : function () {
					return true;
				}
			} );
		} )( jQuery, wp.customize );

	</script>

	<?php
}

?>

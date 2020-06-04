<?php

class FREEDOM_Upsell_Custom_Control extends WP_Customize_Control {

	public $type = 'freedom-upsell-control';

	public function enqueue() {
		wp_enqueue_style( 'freedom-customizer', get_template_directory_uri() . '/inc/customize-controls/assets/css/customizer-upsell.css', array(), FREEDOM_THEME_VERSION );
	}

	public function render_content() {
		?>
		<div class="freedom-upsell-wrapper">
			<ul class="upsell-features">
				<h3 class="upsell-heading"><?php esc_html_e( 'More Awesome Features', 'freedom' ); ?></h3>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( 'Flexible Menu Designs', 'freedom' ); ?>
				</li>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( 'Full Width, Grid Blog', 'freedom' ); ?>
				</li>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( 'Advanced Slider Options', 'freedom' ); ?>
				</li>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( '60+ Customizer Options', 'freedom' ); ?>
				</li>
				<li class="upsell-feature"><span
						class="dashicons dashicons-yes"></span><?php esc_html_e( 'More Addtional Options', 'freedom' ); ?>
				</li>
			</ul>

			<div class="launch-offer">
				<?php
				printf(
				/* translators: %1$s discount coupon code., %2$s discount percentage */
					esc_html__( 'Use the coupon code %1$s to get %2$s discount (limited time offer). Enjoy!', 'freedom' ),
					'<span class="coupon-code">save10</span>',
					'10%'
				);
				?>
			</div>
		</div> <!-- /.freedom-upsell-wrapper -->

		<a class="upsell-cta" target="_blank"
		   href="<?php echo esc_url( 'https://themegrill.com/freedom-pricing/?utm_source=freedom-customizer&utm_medium=view-pricing-link&utm_campaign=upgrade' ); ?>"><?php esc_html_e( 'View Pricing', 'freedom' ); ?></a>
		<?php
	}

}

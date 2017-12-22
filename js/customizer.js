/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ( $ ) {
	// Site title
	wp.customize( 'blogname', function ( value ) {
		value.bind( function ( to ) {
			$( '#site-title a' ).text( to );
		} );
	} );

	// Site description.
	wp.customize( 'blogdescription', function ( value ) {
		value.bind( function ( to ) {
			$( '#site-description' ).text( to );
		} );
	} );

	// Site layout
	wp.customize( 'freedom_site_layout', function ( value ) {
		value.bind( function ( layout ) {
			var layout_options = layout;
			if ( layout_options == 'wide' ) {
				$( 'body' ).addClass( 'wide' );
			} else if( layout == 'box' ) {
				$( 'body' ).removeClass( 'wide' );
			}
		});
	});

	// Primary color option
	wp.customize( 'freedom_primary_color', function ( value ) {
		value.bind( function ( primaryColor ) {
			// Store internal style for primary color
			var primaryColorStyle = '<style id="freedom-internal-primary-color"> .feedom-button,blockquote,button,input[type=button],input[type=reset],input[type=submit]{background-color:' + primaryColor + '}' +
			'#site-title a:hover,.next a:hover,.previous a:hover,a{color:' + primaryColor + '}' +
			'#search-form span{background-color:' + primaryColor + '}' +
			'.main-navigation a:hover,.main-navigation ul li ul li a:hover,.main-navigation ul li ul li:hover>a,' +
			'.main-navigation ul li.current-menu-ancestor a,.main-navigation ul li.current-menu-item a,' +
			'.main-navigation ul li.current-menu-item ul li a:hover,.main-navigation ul li.current_page_ancestor a,' +
			'.main-navigation ul li.current_page_item a,.main-navigation ul li:hover>a,.site-header .menu-toggle:before{color:' + primaryColor + '}' +
			'.main-small-navigation li a:hover,.main-small-navigation .current-menu-item a,.main-small-navigation .current_page_item a{background-color:' + primaryColor + '}' +
			'#featured-slider .entry-title a:hover{color:' + primaryColor + '}#featured-slider .slider-read-more-button a{background-color:' + primaryColor + '}' +
			'.slider-nav i:hover{color:' + primaryColor + '}' +
			'.format-link .entry-content a,.pagination span{background-color:' + primaryColor + '}' +
			'.pagination a span:hover{color:' + primaryColor + ';border-color:' + primaryColor + '}' +
			'#content .comments-area a.comment-edit-link:hover,#content .comments-area a.comment-permalink:hover,' +
			'#content .comments-area article header cite a:hover,.comments-area .comment-author-link a:hover{color:' + primaryColor + '}' +
			'.comments-area .comment-author-link span{background-color:' + primaryColor + '}' +
			'.comment .comment-reply-link:hover,.nav-next a,.nav-previous a{color:' + primaryColor + '}' +
			'#secondary h3.widget-title{border-bottom:2px solid ' + primaryColor + '}#wp-calendar #today{color:' + primaryColor + '}' +
			'.entry-meta .byline i,.entry-meta .cat-links i,.entry-meta a,.footer-socket-wrapper .copyright a:hover,.footer-widgets-area a:hover,' +
			'.post .entry-title a:hover,.search .entry-title a:hover,.post-box .entry-meta .cat-links a:hover,.post-box .entry-meta .posted-on a:hover,' +
			'.post.post-box .entry-title a:hover,a#scroll-up i{color:' + primaryColor + '}.entry-meta .post-format i{background-color:' + primaryColor + '}' +
			'.entry-meta .comments-link a:hover,.entry-meta .edit-link a:hover,.entry-meta .posted-on a:hover,.entry-meta .tag-links a:hover{color:' + primaryColor + '}' +
			'.more-link span{background-color:' + primaryColor + '}' +
			'.single #content .tags a:hover{color:' + primaryColor + '}' +
			'.no-post-thumbnail{background-color:' + primaryColor + '}' +
			'@media screen and (max-width:768px){.top-menu-toggle:before{color:' + primaryColor + '}' +
			'.better-responsive-menu .menu li .sub-toggle {background-color:' + primaryColor + '}}' +
			'.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,' +
			'.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,' +
			'.woocommerce span.onsale {background-color: ' + primaryColor + ';},' +
			'.woocommerce ul.products li.product .price .amount,.entry-summary .price .amount,.woocommerce .woocommerce-message::before{color: ' + primaryColor + ';}' +
			'.woocommerce .woocommerce-message { border-top-color: ' + primaryColor + ';}</style>';

			// Remove previously create internal style and add new one.
			$( 'head #freedom-internal-primary-color' ).remove();
			$( 'head' ).append( primaryColorStyle );
		}
		);
	} );
})( jQuery );
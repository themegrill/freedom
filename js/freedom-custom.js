jQuery( document ).ready( function () {
	jQuery( '#scroll-up' ).hide();
	jQuery( function () {
		jQuery( window ).scroll( function () {
			if ( jQuery( this ).scrollTop() > 1000 ) {
				jQuery( '#scroll-up' ).fadeIn();
			} else {
				jQuery( '#scroll-up' ).fadeOut();
			}
		} );
		jQuery( 'a#scroll-up' ).click( function () {
			jQuery( 'body,html' ).animate( {
				scrollTop : 0
			}, 800 );
			return false;
		} );
	} );
} );

jQuery( document ).ready( function () {
	jQuery( '.better-responsive-menu #site-navigation .menu-item-has-children' ).append( '<span class="sub-toggle"> <i class="fa fa-caret-down"></i> </span>' );
	jQuery( '.better-responsive-menu #site-navigation .sub-toggle' ).click( function () {
		jQuery( this ).parent( '.menu-item-has-children' ).children( 'ul.sub-menu' ).first().slideToggle( '1000' );
		jQuery( this ).children( '.fa-caret-right' ).first().toggleClass( 'fa-caret-down' );
		jQuery( this ).toggleClass( 'active' );
	} );

	jQuery( '.better-responsive-menu #site-navigation .menu-toggle' ).click( function () {
		jQuery( '.better-responsive-menu #site-navigation .menu-primary-container > ul,.main-navigation .menu > ul' ).slideToggle( 'slow' );
	} );

} );

/**
 * Slider Setting
 *
 * Contains all the slider settings for the featured image slider.
 */
var slides = jQuery( '.slider-rotate' ).children().length;
if ( slides <= 1 ) {
	jQuery( '.slider-nav' ).css( 'display', 'none' );
} else {
	jQuery( '.slider-nav' ).css( 'display', 'visible' );
}
jQuery( window ).load( function () {

	if ( typeof jQuery.fn.cycle !== 'undefined' ) {
		jQuery( '.slider-rotate' ).cycle( {
			fx                : 'scrollLeft',
			pager             : '#controllers',
			prev              : '.slide-prev',
			next              : '.slide-next',
			activePagerClass  : 'active',
			timeout           : 5000,
			speed             : 1000,
			pause             : 1,
			pauseOnPagerHover : 1,
			width             : '100%',
			containerResize   : 0,
			fit               : 1,
			after             : function () {
				jQuery( this ).parent().css( 'height', jQuery( this ).height() );
			},
			cleartypeNoBg     : true

		} );
	}


} );

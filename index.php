<?php

/**
 * Plugin Name: Time Remaining
 * Plugin URI:  https://github.com/aduth/wp-time-remaining/
 * Description: Displays a countdown timer in the admin toolbar.
 * Version:     1.0.0
 * Author:      Andrew Duthie
 * Author URI:  https://andrewduthie.com
 * License:     GPLv2 or later
 * Text Domain: time-remaining
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

function tr_add_admin_bar_item( $admin_bar ) {
	$end = getenv( 'TIME_REMAINING_END' );
	if ( empty( $end ) ) {
		$end = get_option( 'time-remaining-end', time() );
	}

	ob_start();
?>
<style>
#wpadminbar ul li.time-remaining {
	background-color: #0073aa;
}

#wpadminbar ul li.time-remaining.is-expired {
	background-color: #dc3232;
}

#time-remaining-counter {
	margin-left: 4px;
	font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, Courier, monospace;
}
</style>
<strong><?php esc_html_e( 'Time Remaining:', 'time-remaining' ) ?></strong>
<span id="time-remaining-counter" data-end="<?php echo esc_attr( $end ); ?>">00:00:00</span>
<script>
( function() {
	var counter, menuItem, end, interval;
	counter = document.getElementById( 'time-remaining-counter' );
	menuItem = document.getElementById( 'wp-admin-bar-time-remaining' );
	end = Number( counter.getAttribute( 'data-end' ) );

	function update() {
		var timeUntil, hours, minutes, seconds;

		timeUntil = Math.max( end - Math.round( new Date() / 1000 ), 0 );
		hours = Math.floor( timeUntil / 3600 );
		minutes = Math.floor( ( timeUntil - ( hours * 3600 ) ) / 60 );
		seconds = Math.floor( ( timeUntil - ( hours * 3600 ) - ( minutes * 60 ) ) );

		text = [ hours, minutes, seconds ]
			.map( function( segment ) {
				return ( '0' + segment ).slice( -2 );
			} )
			.join( ':' );

		counter.textContent = text;

		if ( timeUntil === 0 ) {
			menuItem.className += ' is-expired';
			clearInterval( interval );
		}
	}

	interval = setInterval( update, 1000 );
	update();
} )();
</script>
<?php
	$button = ob_get_clean();

	$admin_bar->add_menu( array(
		'id'     => 'time-remaining',
		'title'  => $button,
		'parent' => 'top-secondary',
		'meta'   => array(
			'class' => 'time-remaining',
		)
	) );
}
add_action( 'admin_bar_menu', 'tr_add_admin_bar_item' );

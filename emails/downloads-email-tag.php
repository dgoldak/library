<?php
/*
 * Plugin Name: Easy Digital Downloads - Downloads Email Tag
 * Description: Adds a {downloads} email tag for use in email templates that outputs a simple list of linked downloads without file names
 * Author: Andrew Munro, Sumobi
 * Author URI: http://sumobi.com/
 * Version: 1.0
 */

/**
 * Add a {downloads} tag for use in either the purchase receipt email or admin notification emails
 */
edd_add_email_tag( 'downloads', __( 'A linked list of downloads purchased', 'edd' ), 'sumobi_edd_email_tag_downloads' );

/**
 * The {downloads} email tag
 */
function sumobi_edd_email_tag_downloads( $payment_id ) {

	$cart_items    = edd_get_payment_meta_cart_details( $payment_id );
	$download_list = '<ul>';

	if ( $cart_items ) {

		foreach ( $cart_items as $item ) {
			$title = sprintf( '<a href="%s">%s</a>', get_permalink( $item['id'] ), get_the_title( $item['id'] ) );
			$download_list .= '<li>' . $title . '<br/>';
			$download_list .= '</li>';
		}

	}

	$download_list .= '</ul>';

	return $download_list;

}
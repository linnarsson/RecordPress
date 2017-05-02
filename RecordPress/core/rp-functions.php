<?php
/* Get current frontend-url for categories */
function current_frontend_url() {
	global $post;

	global $wpdb;
	$table_name = $wpdb->prefix . 'rp_settings';

	$sql = "SELECT frontend_category FROM $table_name";

	$results = $wpdb->get_results($sql) or die(mysql_error());

	foreach( $results as $result ) {
		echo get_page_link($result->frontend_category);
	}
}

/* Get current frontend-url for records */
function current_frontend_url_records() {
	global $post;

	global $wpdb;
	$table_name = $wpdb->prefix . 'rp_settings';

	$sql = "SELECT frontend_record FROM $table_name";

	$results = $wpdb->get_results($sql) or die(mysql_error());

	foreach( $results as $result ) {
		echo get_page_link($result->frontend_record);
	}
}

/* Get current frontend-url for search */
function current_frontend_url_search() {
	global $post;

	global $wpdb;
	$table_name = $wpdb->prefix . 'rp_settings';

	$sql = "SELECT frontend_search FROM $table_name";

	$results = $wpdb->get_results($sql) or die(mysql_error());

	foreach( $results as $result ) {
		echo get_page_link($result->frontend_search);
	}
}



/**
 * Return an ID of an attachment by searching the database with the file URL.
 *
 * Found here: http://frankiejarrett.com/get-an-attachment-id-by-url-in-wordpress/
 */
function rp_get_attachment_id_by_url( $url ) {
	// Split the $url into two parts with the wp-content directory as the separator
	$parsed_url  = explode( parse_url( WP_CONTENT_URL, PHP_URL_PATH ), $url );

	// Get the host of the current site and the host of the $url, ignoring www
	$this_host = str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
	$file_host = str_ireplace( 'www.', '', parse_url( $url, PHP_URL_HOST ) );

	// Return nothing if there aren't any $url parts or if the current host and $url host do not match
	if ( ! isset( $parsed_url[1] ) || empty( $parsed_url[1] ) || ( $this_host != $file_host ) ) {
		return;
	}

	// Now we're going to quickly search the DB for any attachment GUID with a partial path match
	// Example: /uploads/2013/05/test-image.jpg
	global $wpdb;

	$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->prefix}posts WHERE guid RLIKE %s;", $parsed_url[1] ) );

	// Returns null if no attachment is found
	return $attachment[0];
}
?>
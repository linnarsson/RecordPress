<?php
/*
	Plugin Name: RecordPress
	Plugin URI: http://www.recordpress.org
	Description: With RecordPress you can categorize music and movies with text and pictures.
	Version: 1.0
	Author: Johan Linnarsson
	Author URI: http://www.linnarsson.com
	License: GPL v2 - http://www.recordpress.org/about/license/
	Text Domain: recordpress
	Domain Path: /language
*/

ob_start();

/* Database version */
global $recordpress_db_version;
$recordpress_db_version = '0.3.2';

// Run when the plugin is deactivated.
register_deactivation_hook( __FILE__, 'rp_on_remove' );

// Function when the plugin is activated.
function rp_on_remove() {
	global $wpdb;
	$rpdb = $wpdb->prefix . 'rp_settings';
	$sql = "SELECT uninstall FROM $rpdb";

	$results = $wpdb->get_results($sql) or die(mysql_error());

	foreach( $results as $result ) {

		if ($result->uninstall == 1) {} else {
			global $wpdb;
			$rpdb_category = $wpdb->prefix . "rp_category";
			$rpdb_format = $wpdb->prefix . "rp_format";
			$rpdb_grade = $wpdb->prefix . "rp_grade";
			$rpdb_records = $wpdb->prefix . "rp_records";
			$rpdb_settings = $wpdb->prefix . "rp_settings";
			//delete_option('0.3.2');
			$wpdb->query("DROP TABLE IF EXISTS $rpdb_category") or die(mysql_error());
			$wpdb->query("DROP TABLE IF EXISTS $rpdb_format") or die(mysql_error());
			$wpdb->query("DROP TABLE IF EXISTS $rpdb_grade") or die(mysql_error());
			$wpdb->query("DROP TABLE IF EXISTS $rpdb_records") or die(mysql_error());
			$wpdb->query("DROP TABLE IF EXISTS $rpdb_settings") or die(mysql_error());
		}
	}
}

// Run when the plugin is activated.
register_activation_hook(__FILE__,'rp_on_activate'); 

// Function when the plugin is activated.
function rp_on_activate() {
	// Create database fields.

	/* Create Settings */
    global $wpdb;
	$rpdb_settings = $wpdb->prefix . "rp_settings";

	if($wpdb->get_var("show tables like '$rpdb_settings'") != $rpdb_settings) {
 
		$create_table_query = "
			CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}rp_settings` (
			`id` tinyint( 1 ) NOT NULL AUTO_INCREMENT,
			`currency` VARCHAR( 25 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
			`rpver` CHAR( 11 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
			`auctionname` VARCHAR( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
			`auctiondesc` VARCHAR( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
			`auctiontarget` VARCHAR( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
			`frontend_category` VARCHAR( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
			`frontend_record` VARCHAR( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
			`frontend_search` VARCHAR( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
			`user_role` VARCHAR( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
			`uninstall` CHAR( 1 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
			PRIMARY KEY ( `id` )
			) DEFAULT CHARSET=utf8mb4;
		";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $create_table_query );

		/* Insert values to settings */

		global $post;
		$data = array(
			'currency' => '€',
			'rpver' => '1.0',
			'user_role' => 'administrator',
			'uninstall' => '1',
		);
		$format = array(
			'%s'
		);

		$success = $wpdb->insert($rpdb_settings, $data, $format);
	}


	/* Create category */
	global $wpdb;
	$rpdb_category = $wpdb->prefix . "rp_category";

	if($wpdb->get_var("show tables like '$rpdb_category'") != $rpdb_category) {

		$create_table_query = "
			CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}rp_category` (
				`cid` BIGINT ( 20 ) NOT NULL AUTO_INCREMENT,
				`cat` VARCHAR ( 110 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
				`catd` CHAR ( 1 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
				PRIMARY KEY ( `cid` )
				) DEFAULT CHARSET=utf8mb4;
			";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $create_table_query );

		/* Insert values to settings */

		global $post;
		$data = array(
			'cat' => 'Uncategorized',
			'catd' => '1',
		);
		$format = array(
			'%s'
		);

		$success = $wpdb->insert($rpdb_category, $data, $format);

	}



	/* Create format */
	global $wpdb;
	$rpdb_format = $wpdb->prefix . "rp_format";

	if($wpdb->get_var("show tables like '$rpdb_format'") != $rpdb_format) {

		$create_table_query = "
			CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}rp_format` (
				`fid` TINYINT ( 1 ) NOT NULL AUTO_INCREMENT,
				`recordformat` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
				`recordformatd` CHAR ( 1 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
				PRIMARY KEY ( `fid` )
				) DEFAULT CHARSET=utf8mb4;
			";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $create_table_query );

		/* Insert values to settings */

		global $post;
		$data = array(
			'recordformat' => 'Vinyl',
			'recordformatd' => '1',
		);
		$format = array(
			'%s'
		);

		$success = $wpdb->insert($rpdb_format, $data, $format);

	}



	/* Create grade */
	global $wpdb;
	$rpdb_grade = $wpdb->prefix . "rp_grade";

	if($wpdb->get_var("show tables like '$rpdb_grade'") != $rpdb_grade) {

		$create_table_query = "
			CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}rp_grade` (
				`gid` INT ( 11 ) NOT NULL AUTO_INCREMENT,
				`grade` VARCHAR ( 13 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
				PRIMARY KEY ( `gid` )
				) DEFAULT CHARSET=utf8mb4;
			";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $create_table_query );

		/* Insert values to settings */

		global $post;
		$data = array('grade' => 'Mint');
		$data2 = array('grade' => 'Near mint');
		$data3 = array('grade' => 'Near mint +');
		$data4 = array('grade' => 'Near mint -');
		$data5 = array('grade' => 'Excellent');
		$data6 = array('grade' => 'Excellent +');
		$data7 = array('grade' => 'Excellent -');
		$data8 = array('grade' => 'Very good');
		$data9 = array('grade' => 'Very good +');
		$data10 = array('grade' => 'Very good -');
		$data11 = array('grade' => 'Good');
		$data12 = array('grade' => 'Good +');
		$data13 = array('grade' => 'Good -');
		$data14 = array('grade' => 'Fair');
		$data15 = array('grade' => 'Poor');
		$format = array(
			'%s'
		);

		$success = $wpdb->insert($rpdb_grade, $data, $format);
		$success = $wpdb->insert($rpdb_grade, $data2, $format);
		$success = $wpdb->insert($rpdb_grade, $data3, $format);
		$success = $wpdb->insert($rpdb_grade, $data4, $format);
		$success = $wpdb->insert($rpdb_grade, $data5, $format);
		$success = $wpdb->insert($rpdb_grade, $data6, $format);
		$success = $wpdb->insert($rpdb_grade, $data7, $format);
		$success = $wpdb->insert($rpdb_grade, $data8, $format);
		$success = $wpdb->insert($rpdb_grade, $data9, $format);
		$success = $wpdb->insert($rpdb_grade, $data10, $format);
		$success = $wpdb->insert($rpdb_grade, $data11, $format);
		$success = $wpdb->insert($rpdb_grade, $data12, $format);
		$success = $wpdb->insert($rpdb_grade, $data13, $format);
		$success = $wpdb->insert($rpdb_grade, $data14, $format);
		$success = $wpdb->insert($rpdb_grade, $data15, $format);
	}



	/* Create record */
	global $wpdb;
	$rpdb_records = $wpdb->prefix . "rp_records";

	if($wpdb->get_var("show tables like '$rpdb_records'") != $rpdb_records) {

		$create_table_query = "
			CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}rp_records` (
				`id` BIGINT ( 20 ) NOT NULL AUTO_INCREMENT,
				`artist` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`recordname` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`recordnumber` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`barcode` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`label` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`released` VARCHAR ( 50 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`genre` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`style` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`format` CHAR ( 2 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`recordgrade` CHAR ( 2 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`innersleevegrade` CHAR ( 2 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`covergrade` CHAR ( 2 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`comments` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`companies` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`credits` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`country` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`quantity` CHAR ( 3 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`tracklist` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`matrix` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`category` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`picture1` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`picture2` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`picture3` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`picture4` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`picture5` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`picture6` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`picture7` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`picture8` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`picture9` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`picture10` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`picture11` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`picture12` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`picture13` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`picture14` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`picture15` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`price` VARCHAR ( 100 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`auction` VARCHAR ( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
				`creation_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
				`modification_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
				PRIMARY KEY ( `id` )
				) DEFAULT CHARSET=utf8mb4;
			";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $create_table_query );

	}


}







// Function when the plugin is deactivated.
function rp_remove() {
	// Remove created database fields.

}


/* RecordPress plugin directory */
function rp_dir() {
	echo plugins_url('recordpress');
} 



/**
 * Register CSS- and JS-files.
 */
function rp_css_and_js() {
	wp_register_style('rp_css_and_js', plugins_url('core/assets/css/admin-style.css',__FILE__ ));
	wp_enqueue_style('rp_css_and_js');
}
add_action( 'admin_init','rp_css_and_js');



/**
 * Register CSS- and JS-files for image upload.
 */
function rp_uploader_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('rp-upload', plugins_url('core/assets/js/rp-admin-upload.js',__FILE__ ), array('jquery','media-upload','thickbox'));
	wp_enqueue_script('rp-upload');
}

function rp_uploader_styles() {
	wp_enqueue_style('thickbox');
}
add_action('admin_print_scripts', 'rp_uploader_scripts');
add_action('admin_print_styles', 'rp_uploader_styles'); 



/**
 * Localization
 */
add_action('plugins_loaded', 'rp_translation');
function rp_translation() {
load_plugin_textdomain( 'recordpress', false, dirname( plugin_basename(__FILE__) ) . '/core/language/' );
}


/**
 * Add plugin menu to administration panel
 */
function recordpress_admin_menu() {

	global $wpdb;
	$rpdb = $wpdb->prefix . 'rp_settings';
	$sql = "SELECT user_role FROM $rpdb";

	$results = $wpdb->get_results($sql) or die(mysql_error());

	foreach( $results as $result ) {

		/* Administrators and selected usergroup can administrate RecordPress. */
		if ( current_user_can($result->user_role) || current_user_can('administrator')) {

			/* Mainpage */
			add_menu_page(__('RecordPress', 'rp_admin_mainpage', 'read'), __('RecordPress', 'recordpress'), 'read', 'recordpress_start', 'rp_admin_mainpage_handler', 'dashicons-album');

			/* View records */
			add_submenu_page('recordpress_start', __('View records', 'rp_admin_view_record', 'read'), __('View records', 'recordpress'), 'read', 'rp_admin_view_record', 'rp_admin_view_record_handler');

			/* View single record */
			add_submenu_page('recordpress_start_hide', __('View single record', 'rp_admin_view_single_record', 'read'), __('View single record', 'rp_admin_view_single_record'), 'read', 'rp_admin_view_single_record', 'rp_admin_view_single_record_handler');

			/* Add record */
			add_submenu_page('recordpress_start', __('Add record', 'rp_admin_add_record', 'read'), __('Add record', 'recordpress'), 'read', 'rp_admin_add_record', 'rp_admin_add_record_handler');

			/* Edit record */
			add_submenu_page('recordpress_start_hide', __('Edit record', 'rp_admin_edit_record', 'read'), __('Edit record', 'rp_admin_edit_record'), 'read', 'rp_admin_edit_record', 'rp_admin_edit_record_handler');

			/* Add category */
			add_submenu_page('recordpress_start', __('Add category', 'rp_admin_add_category', 'read'), __('Add category', 'recordpress'), 'read', 'rp_admin_add_category', 'rp_admin_add_category_handler');

			/* Edit category */
			add_submenu_page('recordpress_start_hide', __('Edit category', 'rp_admin_edit_category', 'read'), __('Edit category', 'rp_admin_edit_category'), 'read', 'rp_admin_edit_category', 'rp_admin_edit_category_handler');

			/* Search */
			add_submenu_page('recordpress_start_hide', __('Search', 'rp_admin_search', 'read'), __('Search', 'rp_admin_search'), 'read', 'rp_admin_search', 'rp_admin_search_handler');

			/* manage formats */
			add_submenu_page('recordpress_start', __('Formats', 'rp_admin_formats', 'read'), __('Formats', 'recordpress'), 'read', 'rp_admin_formats', 'rp_admin_formats_handler');

			/* Edit format */
			add_submenu_page('recordpress_start_hide', __('Edit formats', 'rp_admin_edit_formats', 'read'), __('Edit formats', 'rp_admin_edit_formats'), 'read', 'rp_admin_edit_formats', 'rp_admin_edit_formats_handler');

			/* Delete format */
			add_submenu_page('recordpress_start_hide', __('Delete formats', 'rp_admin_edit_formats', 'read'), __('Delete formats', 'rp_admin_delete_formats'), 'read', 'rp_admin_delete_formats', 'rp_admin_delete_formats_handler');

		}

		/* Only administrators can access settings-page. */
		if (current_user_can('administrator')) {

			/* Settings */
			add_submenu_page('recordpress_start', __('Settings', 'rp_admin_settings', 'read'), __('Settings', 'recordpress'), 'read', 'rp_admin_settings', 'rp_admin_settings_handler');

		}

	}
}

add_action('admin_menu', 'recordpress_admin_menu');



/**
 * Mainpage content. Call rp-start.php
 */
function rp_admin_mainpage_handler() {
	include( plugin_dir_path( __FILE__ ) . 'core/rp-start.php');
}

/**
 * View categories and records in categories. Call rp-view-record.php
 */
function rp_admin_view_record_handler() {
	include( plugin_dir_path( __FILE__ ) . 'core/rp-view-record.php');
}

/**
 * View single record. Call rp-view-single-record.php
 */
function rp_admin_view_single_record_handler() {
	include( plugin_dir_path( __FILE__ ) . 'core/rp-view-single-record.php');
}

/**
 * Add record. Call rp-add-record.php
 */
function rp_admin_add_record_handler() {
	include( plugin_dir_path( __FILE__ ) . 'core/rp-add-record.php');
}

/**
 * Edit record. Call rp-edit-record.php
 */
function rp_admin_edit_record_handler() {
	include( plugin_dir_path( __FILE__ ) . 'core/rp-edit-record.php');
}

/**
 * Add category. Call rp-add-category.php
 */
function rp_admin_add_category_handler() {
	include( plugin_dir_path( __FILE__ ) . 'core/rp-add-category.php');
}

/**
 * Edit category. Call rp-edit-category.php
 */
function rp_admin_edit_category_handler() {
	include( plugin_dir_path( __FILE__ ) . 'core/rp-edit-category.php');
}

/**
 * Search. Call rp-search.php
 */
function rp_admin_search_handler() {
	include( plugin_dir_path( __FILE__ ) . 'core/rp-search.php');
}

/**
 * Settings. Call rp-settings.php
 */
function rp_admin_settings_handler() {
	include( plugin_dir_path( __FILE__ ) . 'core/rp-settings.php');
}

/**
 * Shortcodes. Call rp-shortcodes.php
 */

include( plugin_dir_path( __FILE__ ) . 'core/rp-shortcodes.php');

/**
 * Widgets. Call rp-widgets.php
 */

include( plugin_dir_path( __FILE__ ) . 'core/rp-widgets.php');

/**
 * Functions. Call rp-functions.php
 */

include( plugin_dir_path( __FILE__ ) . 'core/rp-functions.php');

/**
 * Theme styles. Call rp-default-wptheme-styling.php
 */

include( plugin_dir_path( __FILE__ ) . 'core/rp-default-wptheme-styling.php');

/**
 * Formats. Call rp-formats.php
 */

function rp_admin_formats_handler() {
	include( plugin_dir_path( __FILE__ ) . 'core/rp-formats.php');
}

/**
 * Edit format. Call rp-edit-formats.php
 */
function rp_admin_edit_formats_handler() {
	include( plugin_dir_path( __FILE__ ) . 'core/rp-edit-formats.php');
}

/**
 * Delete format. Call rp-delete-formats.php
 */
function rp_admin_delete_formats_handler() {
	include( plugin_dir_path( __FILE__ ) . 'core/rp-delete-formats.php');
}

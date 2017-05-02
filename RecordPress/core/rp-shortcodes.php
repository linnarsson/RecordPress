<?php
/*
TODO:
Separera kategoriväljaren.
Fixa korrekta länkar till frontend-gränssnittet.
Kolla hur man enklast löser så ?=4 blir snyggare permalänka..
Kolla hur man kan välja vilken sida som saker ska visas. Inställning? Skapa default-sidor för visning av skivor, kategorier och sökning?
Fixa så edit och delete knappar inte syns om man inte är inloggad.

TODO shortcodes:
Shortcode som visar alla kategorier.
Shortcode som visar senaste inlagda skivan.
Shortcode som visar senaste X antal inlagda skivor.


Working shortcodes:
[rp_view_single_category_selector] -> Visar bara kategoriväljaren.
[rp_view_single_category] -> Listar kategorier och skivor i dess underkategorier.
[rp_view_single_record] -> Visar specifik skiva.
[rp_search] -> Sök
*/

// [bartag foo="koala" bar="bears"]
function bartag_func( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'foo' => 'no foo',
			'bar' => 'default bar',
		), $atts, 'bartag' );

	return 'bartag: ' . $atts['foo'] . ' ' . $atts['bar'];

    ob_start();
    ?>
Example...

<?php return ob_get_clean();
}
add_shortcode( 'bartag', 'bartag_func' );





	function my_registration_form($params, $content = null) {

    extract(shortcode_atts(array(
        'type' => 'style1'
    ), $params));

    ob_start();
    ?>
Example...

<?php return ob_get_clean();
}
add_shortcode('eaxmple','my_registration_form');


/**
 * Search shortcode. Call /shortcodes/rp-shortcode-search.php
 */
include( plugin_dir_path( __FILE__ ) . 'shortcodes/rp-shortcode-search.php');

/**
 * Search field shortcode. Call /shortcodes/rp-shortcode-search-field.php
 */
include( plugin_dir_path( __FILE__ ) . 'shortcodes/rp-shortcode-search-field.php');

/**
 * Category selector shortcode. Call /shortcodes/rp-category-selector.php
 */
include( plugin_dir_path( __FILE__ ) . 'shortcodes/rp-shortcode-category-selector.php');


/**
 * Category viewer shortcode. Call /shortcodes/rp-category-viewer.php
 */
include( plugin_dir_path( __FILE__ ) . 'shortcodes/rp-shortcode-category-viewer.php');


/**
 * View single record shortcode. Call /shortcodes/rp-shortcode-record.php
 */
include( plugin_dir_path( __FILE__ ) . 'shortcodes/rp-shortcode-record.php');


/**
 * View single record shortcode. Call /shortcodes/rp-shortcode-record-by-id.php
 */
include( plugin_dir_path( __FILE__ ) . 'shortcodes/rp-shortcode-record-by-id.php');


/**
 * View latest added records shortcode. Call /shortcodes/rp-shortcode-latest-added-records.php
 */
include( plugin_dir_path( __FILE__ ) . 'shortcodes/rp-shortcode-latest-added-records.php');



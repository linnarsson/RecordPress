<?php
// Twentyfifteen is the current theme or the active theme's parent.
if( 'twentyfifteen' == get_option( 'template' ) ) {
	add_action('wp_head','rp_twentyfifteen_css');
	function rp_twentyfifteen_css() {
		wp_register_style('rp_twentyfifteen_css', plugins_url('assets/css/wp_default_themes/twentyfifteen.css', __FILE__ ));
		wp_enqueue_style('rp_twentyfifteen_css');
	}
	add_action( 'admin_init','rp_twentyfifteen_css');
}

// Twentyeleven is the current theme or the active theme's parent.
if( 'twentyeleven' == get_option( 'template' ) ) {
	add_action('wp_head','rp_twentyeleven_css');
	function rp_twentyeleven_css() {
		wp_register_style('rp_twentyeleven_css', plugins_url('assets/css/wp_default_themes/twentyeleven.css', __FILE__ ));
		wp_enqueue_style('rp_twentyeleven_css');
	}
	add_action( 'admin_init','rp_twentyeleven_css');
}
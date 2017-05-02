<?php
function rp_search_field_frontend() {

	ob_start();
?>
	<form name="rp-search-form" method="post" action="<?php echo current_frontend_url_search(); ?>">
		<input name="query" type="text" class="rp-search-field" maxlength="200" value="<?php if(isset($_POST['query'])){ echo htmlspecialchars($_POST['query']) . '"'; } else { echo __( 'Search...', 'recordpress' ); ?>" onclick="if(this.value=='<?php echo __( 'Search...', 'recordpress' ); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php echo __( 'Search...', 'recordpress' ); ?>';"<?php } ?> />
		<input type="submit" name="rp-search-submit" class="rp-search-submit" value="<?php echo __( 'Search', 'recordpress' ); ?>" />
	</form>

<?php
	return ob_get_clean();
}

add_shortcode('rp_search_field','rp_search_field_frontend');
?>

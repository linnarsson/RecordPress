<?php
/* Category selector only */
	function rp_view_category_selector_frontend() {

    ob_start();

?>

<div class="rp-category-viewer rp-category-viewer-single">
<?php

			global $wpdb;
			$rpdb = $wpdb->prefix . 'rp_category';

			$sql = "SELECT DISTINCT LEFT(cat, 1) as letter FROM $rpdb ORDER BY cat ASC";

			$results = $wpdb->get_results($sql) or die(mysql_error());

			foreach( $results as $result ) {
?>
	<a href="<?php echo current_frontend_url(); ?>?cat=<?php echo urlencode(strtolower($result->letter)); ?>" title="<?php echo __( 'Show categories sorted by', 'recordpress' ); ?> <?php echo $result->letter; ?>"><?php echo $result->letter; ?></a>
<?php
			

}

?> 
<a href="<?php echo current_frontend_url(); ?>?cat=all" title="<?php echo __( 'Show all categories.', 'recordpress' ); ?>" class="rp-category-viewer-all"><?php echo __( 'All', 'recordpress' ); ?></a>

 <?php 
	global $wpdb;
	$rpdb = $wpdb->prefix . 'rp_settings';
	$sql = "SELECT user_role FROM $rpdb";

	$results = $wpdb->get_results($sql) or die(mysql_error());

	foreach( $results as $result ) {

		/* Administrators and selected usergroup can administrate RecordPress. */
		if ( current_user_can($result->user_role) || current_user_can('administrator')) {
				$category = isset($_GET['record']);



if(!isset($_GET['record'])) {


?>
 - <a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_add_category" title="<?php echo __( 'Add category.', 'recordpress' ); ?>" class="rp-category-viewer-add-category"><?php echo __( 'Add category', 'recordpress' ); ?></a>
 <?php
	 } else {


?>
  - <a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_add_record&cat=<?php echo $_GET['record']; ?>" title="<?php echo __( 'Add record.', 'recordpress' ); ?>" class="rp-category-viewer-add-record"><?php echo __( 'Add record', 'recordpress' ); ?></a>
<?php }
}
}
?>
</div>

<?php
return ob_get_clean();
}
add_shortcode('rp_view_single_category_selector','rp_view_category_selector_frontend');
?>
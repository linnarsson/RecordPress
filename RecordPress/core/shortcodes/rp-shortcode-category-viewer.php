<?php 
/* View category */
function rp_view_category_frontend() {

	ob_start();

	if(isset($_GET['record'])) {

		$category = $_GET['record'];

		global $wpdb;
		$rpdb = $wpdb->prefix . 'rp_category';

		$sql = "SELECT * FROM $rpdb WHERE cid = '$category'";

		$results = $wpdb->get_results($sql) or die(mysql_error());

		foreach( $results as $result ) {

?>
			<h2><?php echo $result->cat; ?></h2>
<?php } } ?>

<div class="rp-category-viewer">
<?php
		global $wpdb;
		$rpdb = $wpdb->prefix . 'rp_category';

		$sql = "SELECT DISTINCT LEFT(cat, 1) as letter FROM $rpdb ORDER BY cat ASC";

		$results = $wpdb->get_results($sql) or die(mysql_error());

		foreach( $results as $result ) {
?>
			<a href="<?php echo current_frontend_url(); ?>?cat=<?php echo urlencode(strtolower($result->letter)); ?>" title="<?php echo __( 'Show categories sorted by', 'recordpress' ); ?> <?php echo $result->letter; ?>"><?php echo $result->letter; ?></a>
<?php } ?> 
			<a href="<?php echo current_frontend_url(); ?>?cat=all" title="<?php echo __( 'Show all categories.', 'recordpress' ); ?>"><?php echo __( 'ALL', 'recordpress' ); ?></a>

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
 - <a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_add_category" title="<?php echo __( 'Add category.', 'recordpress' ); ?>"><?php echo __( 'Add category', 'recordpress' ); ?></a>
 <?php
	 } else {


?>
  - <a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_add_record&cat=<?php echo $_GET['record']; ?>" title="<?php echo __( 'Add record.', 'recordpress' ); ?>"><?php echo __( 'Add record', 'recordpress' ); ?></a>
<?php } } } ?>
</div>


				<?php

				/**
				 * Display all categories.
				 */
				if (isset($_GET['cat'])) {

					if ($_GET['cat'] == 'all') {


				?>

<!-- Start .rp-category-list-wrapper -->
<div class="rp-category-list-wrapper">

	<div class="rp-category-list-name">
		<?php echo __( 'All categories:', 'recordpress' ); ?>
	</div>

<?php if ( is_user_logged_in() ) { ?>
	<div class="rp-category-list-edit">
		&nbsp;
	</div>
<?php } ?>


				<?php

			global $wpdb;
			$rpdb = $wpdb->prefix . 'rp_category';

			$sql = "SELECT * FROM $rpdb ORDER BY cat";

			$results = $wpdb->get_results($sql) or die(mysql_error());

			foreach( $results as $result ) {

				?>
				<div class="rp-category-list-single-wrapper">
					<div class="rp-category-list-name">
						<a href="<?php echo current_frontend_url(); ?>?cat=<?php echo urlencode(strtolower($result->cat[0])); ?>&record=<?php echo $result->cid; ?>" title="<?php echo __( 'View all records in this category.', 'recordpress' ); ?>"><?php echo $result->cat; ?></a>
					</div>
					<?php if ( is_user_logged_in() ) { ?>
					<div class="rp-category-list-edit">
						<a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_edit_category&id=<?php echo $result->cid; ?>" title="<?php echo __( 'Edit this category.', 'recordpress' ); ?>"><?php echo __( 'Edit', 'recordpress' ); ?></a>
					</div>
			<?php } ?>
				</div>
			<?php } ?>

			</div>
			<!-- End .rp-category-list-wrapper -->

			<?php }
				else if($_GET['cat'] && (!isset($_GET['record']))) {
				?>

<!-- Start .rp-category-list-wrapper -->
<div class="rp-category-list-wrapper">

	<div class="rp-category-list-name">
		<?php echo __( 'Categories sorted by', 'recordpress' ); ?> "<?php echo strtoupper($_GET['cat']); ?>":
	</div>
<?php if ( is_user_logged_in() ) { ?>
	<div class="rp-category-list-edit">
		&nbsp;
	</div>

				<?php
}

				$category = $_GET['cat'];

			global $wpdb;
			$rpdb = $wpdb->prefix . 'rp_category';

			$sql = "SELECT * FROM $rpdb WHERE cat LIKE '$category%' ORDER BY cat";

			$results = $wpdb->get_results($sql) or die(mysql_error());

			foreach( $results as $result ) {
				?>
<div class="rp-category-list-single-wrapper">
					<div class="rp-category-list-name">
						<a href="<?php echo current_frontend_url(); ?>?cat=<?php echo urlencode($_GET['cat']); ?>&record=<?php echo urlencode($result->cid); ?>" title="<?php echo __( 'View all records in this category.', 'recordpress' ); ?>"><?php echo $result->cat; ?></a>
					</div>
					<?php if ( is_user_logged_in() ) { ?>
					<div class="rp-category-list-edit">
						<a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_edit_category&id=<?php echo $result->cid; ?>" title="<?php echo __( 'Edit this category.', 'recordpress' ); ?>"><?php echo __( 'Edit', 'recordpress' ); ?></a>
					</div>
					<?php }
?>
</div>
<?php
					}
?>

			</div>
			<!-- End .rp-category-list-wrapper -->

<?php
}





				/**
				 * View records in selected category
				 */
else {
	


					if (isset($_GET['record'])) {
					if ($_GET['cat'] && $_GET['record']) {
?>

<div class="rp-record-list-wrapper rp-record-list-wrapper-first">

	<div class="rp-record-list rp-record-list-artist">
		<?php echo __( 'Artist:', 'recordpress' ); ?>
	</div>

	<div class="rp-record-list rp-record-list-recordname">
		<?php echo __( 'Recordname:', 'recordpress' ); ?>
	</div>

	<div class="rp-record-list rp-record-list-label">
		<?php echo __( 'Label:', 'recordpress' ); ?>
	</div>

	<div class="rp-record-list rp-record-list-country">
		<?php echo __( 'Country:', 'recordpress' ); ?>
	</div>

	<div class="rp-record-list rp-record-list-released">
		<?php echo __( 'Released:', 'recordpress' ); ?>
	</div>

	<div class="rp-record-list rp-record-list-catalog">
		<?php echo __( 'Catalog #:', 'recordpress' ); ?>
	</div>

</div>

				<?php

			global $wpdb;
			$rpdb = $wpdb->prefix . 'rp_records';

			$sql = "SELECT * FROM $rpdb WHERE category =" . $_GET['record'];

			$results = $wpdb->get_results($sql) or die(mysql_error());



			foreach( $results as $result ) {




					?>

<div class="rp-record-list-wrapper">

	<div class="rp-record-list rp-record-list-artist-result">
						<a href='<?php echo current_frontend_url_records(); ?>?id=<?php echo $result->id; ?>'  title='<?php echo __( 'Have a closer look at this record.', 'recordpress' ); ?>'><?php echo $result->artist; ?></a>
	</div>

	<div class="rp-record-list rp-record-list-recordname-result">
		<?php if (!empty($result->recordname)) { echo $result->recordname; } else { echo "-"; } ?>
	</div>

	<div class="rp-record-list rp-record-list-label-result">
		<?php if (!empty($result->label)) { echo $result->label; } else { echo "-"; } ?>
	</div>

	<div class="rp-record-list rp-record-list-country-result">
		<?php if (!empty($result->country)) { echo $result->country; } else { echo "-"; } ?>
	</div>

	<div class="rp-record-list rp-record-list-released-result">
		<?php if (!empty($result->released)) { echo $result->released; } else { echo "-"; } ?>
	</div>

	<div class="rp-record-list rp-record-list-catalog-result">
		<?php if (!empty($result->recordnumber)) { echo $result->recordnumber; } else { echo "-"; } ?>
	</div>

	<?php if (!empty($result->picture1)) { ?>
	<div class="rp-record-list rp-record-list-picture">
		<a href="<?php echo current_frontend_url_records(); ?>?id=<?php echo $result->id; ?>" title="<?php echo __( 'Have a closer look at this record.', 'recordpress' ); ?>">
		<?php echo wp_get_attachment_image( $result->picture1, 'thumbnail' ); ?></a>
	</div>
	<?php } ?>


</div>

				<?php } ?>



<?php


					} }


}

}


return ob_get_clean();
}
add_shortcode('rp_view_single_category','rp_view_category_frontend');
?>
<!-- Start #rp-admin-wrapper -->
<div id="rp-admin-wrapper">

	<div class="rp-header-h1">
		<div class="rp-header-h1-left">
			<span class="dashicons dashicons-visibility"></span>
		</div>
		<div class="rp-header-h1-right">
			<h1><?php echo __( 'View records', 'recordpress' ); ?></h1>
		</div>
	</div>
	<div class="clear"></div>
	

	<?php if(isset($_GET['record'])) {

		$category = $_GET['record'];

		global $wpdb;
		$rpdb = $wpdb->prefix . 'rp_category';

		$sql = "SELECT * FROM $rpdb WHERE cid = '$category'";

		$results = $wpdb->get_results($sql) or die(mysql_error());

		foreach( $results as $result ) {
	?>
	<h2><?php echo $result->cat; ?></h2>
	<?php } } ?>
	<hr />

	<div id="rp-admin-content-box-wrapper">
		<div id="rp-admin-content-box-letters">
		<?php
			global $wpdb;
			$rpdb = $wpdb->prefix . 'rp_category';
			$sql = "SELECT DISTINCT LEFT(cat, 1) as letter FROM $rpdb ORDER BY cat ASC";
			$results = $wpdb->get_results($sql) or die(mysql_error());
			foreach( $results as $result ) {
		?>
			<a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_view_record&cat=<?php echo urlencode(strtolower($result->letter)); ?>" title="<?php echo __( 'Show categories sorted by', 'recordpress' ); ?> <?php echo $result->letter; ?>"><?php echo $result->letter; ?></a>
		<?php } ?> 
			<a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_view_record&cat=all" title="<?php echo __( 'Show all categories', 'recordpress' ); ?>" class="rp-admin-content-box-letters-all"><?php echo __( 'All', 'recordpress' ); ?></a>

		<?php 
				if(!isset($_GET['record'])) {
		?>
			- <a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_add_category" title="<?php echo __( 'Add category.', 'recordpress' ); ?>" class="rp-admin-content-box-letters-add-category"><?php echo __( 'Add category', 'recordpress' ); ?></a>
		<?php } else { ?>
			- <a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_add_record&cat=<?php echo $_GET['record']; ?>" title="<?php echo __( 'Add record.', 'recordpress' ); ?>" class="rp-admin-content-box-letters-add-record"><?php echo __( 'Add record', 'recordpress' ); ?></a>
		<?php } ?>
		</div>
		<div id="rp-admin-content-box-search">
			<form name="search" method="post" action="<?php echo admin_url(); ?>admin.php?page=rp_admin_search">
				<input name="query" type="text" value="" placeholder="<?php echo __( 'Search record...', 'recordpress' ); ?>" />
				<input type="submit" class="rp-search-button" name="txtid" value="<?php echo __( 'Search', 'recordpress' ); ?>" />
			</form>
		</div>

	</div>

	<hr />

	<?php
		/**
		 * Display all categories.
		 */
		if (isset($_GET['cat'])) {

			if ($_GET['cat'] == 'all') {
	?>

	<!-- Start #rp-admin-category-list-wrapper -->
	<div class="rp-admin-category-list-wrapper">

		<div class="rp-admin-category-list-name">
			<?php echo __( 'All categories:', 'recordpress' ); ?>
		</div>

		<div class="rp-admin-category-list-edit">
			&nbsp;
		</div>

		<?php

			global $wpdb;
			$rpdb = $wpdb->prefix . 'rp_category';

			$sql = "SELECT * FROM $rpdb ORDER BY cat";

			$results = $wpdb->get_results($sql) or die(mysql_error());

			foreach( $results as $result ) {

		?>

		<div class="rp-admin-category-list-single-wrapper">
			<div class="rp-admin-category-list-name">
				<a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_view_record&cat=<?php echo urlencode(strtolower($result->cat[0])); ?>&record=<?php echo $result->cid; ?>" title="<?php echo __( 'View all records in this category.', 'recordpress' ); ?>"><?php echo $result->cat; ?></a>
			</div>
			<div class="rp-admin-category-list-edit">
				<a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_edit_category&id=<?php echo $result->cid; ?>" title="<?php echo __( 'Edit this category.', 'recordpress' ); ?>"><?php echo __( 'Edit', 'recordpress' ); ?></a>
			</div>
		</div>
		<?php } ?>

	</div>
	<!-- End #rp-admin-category-list-wrapper -->

	<?php
		} else if($_GET['cat'] && (!isset($_GET['record']))) {
	?>

	<!-- Start #rp-admin-category-list-wrapper -->
	<div class="rp-admin-category-list-wrapper">

		<div class="rp-admin-category-list-name">
			<?php echo __( 'Categories sorted by', 'recordpress' ); ?> "<?php echo strtoupper($_GET['cat']); ?>":
		</div>

		<div class="rp-admin-category-list-edit">
			&nbsp;
		</div>

		<?php
			$category = $_GET['cat'];

			global $wpdb;
			$rpdb = $wpdb->prefix . 'rp_category';

			$sql = "SELECT * FROM $rpdb WHERE cat LIKE '$category%' ORDER BY cat";

			$results = $wpdb->get_results($sql) or die(mysql_error());

			foreach( $results as $result ) {
		?>

		<div class="rp-admin-category-list-single-wrapper">
			<div class="rp-admin-category-list-name">
				<a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_view_record&cat=<?php echo urlencode($_GET['cat']); ?>&record=<?php echo urlencode($result->cid); ?>" title="<?php echo __( 'View all records in this category.', 'recordpress' ); ?>"><?php echo $result->cat; ?></a>
			</div>
			<div class="rp-admin-category-list-edit">
				<a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_edit_category&id=<?php echo $result->cid; ?>" title="<?php echo __( 'Edit this category.', 'recordpress' ); ?>"><?php echo __( 'Edit', 'recordpress' ); ?></a>
			</div>
		</div>
		<?php } ?>

	</div>
	<!-- End #category-list-wrapper -->

	<?php
		} else {
			/**
			 * View records in selected category
			 */

			if (isset($_GET['record'])) {
				if ($_GET['cat'] && $_GET['record']) {
	?>


	<!-- Start #record-list-wrapper -->
	<div class="rp-admin-record-list-wrapper">

		<div class="rp-admin-record-list">
			<?php echo __( 'Artist:', 'recordpress' ); ?>
		</div>

		<div class="rp-admin-record-list">
			<?php echo __( 'Recordname:', 'recordpress' ); ?>
		</div>

		<div class="rp-admin-record-list">
			<?php echo __( 'Label:', 'recordpress' ); ?>
		</div>

		<div class="rp-admin-record-list">
			<?php echo __( 'Country:', 'recordpress' ); ?>
		</div>

		<div class="rp-admin-record-list">
			<?php echo __( 'Released:', 'recordpress' ); ?>
		</div>

		<div class="rp-admin-record-list">
			<?php echo __( 'Catalog #:', 'recordpress' ); ?>
		</div>

	</div>
	<!-- End #record-list-wrapper -->

	<?php
					global $wpdb;
					$table_name = $wpdb->prefix . 'rp_records';

					$sql = "SELECT * FROM $table_name WHERE category =" . $_GET['record'];

					$results = $wpdb->get_results($sql) or die(mysql_error());

					foreach( $results as $result ) {
	?>

	<!-- Start #record-list-wrapper -->
	<div class="rp-admin-record-list-wrapper">

		<div class="rp-admin-record-list">
			<a href='<?php echo admin_url(); ?>admin.php?page=rp_admin_view_single_record&id=<?php echo $result->id; ?>'  title='<?php echo __( 'Have a closer look at this record.', 'recordpress' ); ?>'><?php echo $result->artist; ?></a>
		</div>

		<div class="rp-admin-record-list">
			<?php if (!empty($result->recordname)) { echo $result->recordname; } else { echo "-"; } ?>
		</div>

		<div class="rp-admin-record-list">
			<?php if (!empty($result->label)) { echo $result->label; } else { echo "-"; } ?>
		</div>

		<div class="rp-admin-record-list">
			<?php if (!empty($result->country)) { echo $result->country; } else { echo "-"; } ?>
		</div>

		<div class="rp-admin-record-list">
			<?php if (!empty($result->released)) { echo $result->released; } else { echo "-"; } ?>
		</div>

		<div class="rp-admin-record-list">
			<?php if (!empty($result->recordnumber)) { echo $result->recordnumber; } else { echo "-"; } ?>
		</div>

		<?php if (!empty($result->picture1)) { ?>
		<div class="rp-admin-record-list-image">
			<a href='<?php echo admin_url(); ?>admin.php?page=rp_admin_view_single_record&id=<?php echo $result->id; ?>'  title='<?php echo __( 'Have a closer look at this record.', 'recordpress' ); ?>'>
			<?php echo wp_get_attachment_image( $result->picture1, 'thumbnail' ); ?></a>
		</div>
		<?php } ?>

	</div>
	<!-- End #record-list-wrapper -->

	<?php
					}

				}
			}

		}

	}
?>
</div>
<!-- End #rp-admin-wrapper -->


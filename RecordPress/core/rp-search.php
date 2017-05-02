
<!-- Start #rp-admin-wrapper -->
<div id="rp-admin-wrapper">

	<h1><?php echo __( 'Searchresult', 'recordpress' ); ?></h1>
	<hr />

	<div id="rp-admin-content-box-wrapper">
		<div id="rp-admin-content-box-letters">

		<?php
			global $wpdb;
			$rpdb = $wpdb->prefix . 'rp_category';

			$sql = "SELECT DISTINCT LEFT(cat, 1) as letter FROM $rpdb ORDER BY cat ASC";
			//$sql = "SELECT * FROM $table_name WHERE cat LIKE 't%' AND catd = 1 ORDER BY cat";

			$results = $wpdb->get_results($sql) or die(mysql_error());

			foreach( $results as $result ) {
		?>
			<a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_view_record&cat=<?php echo urlencode(strtolower($result->letter)); ?>" title="<?php echo __( 'Show categories sorted by', 'recordpress' ); ?> <?php echo $result->letter; ?>"><?php echo $result->letter; ?></a>
		<?php } ?> 
			<a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_view_record&cat=all" title="<?php echo __( 'Show all categories.', 'recordpress' ); ?>"><?php echo __( 'ALL', 'recordpress' ); ?></a>

		<?php

			$category = isset($_GET['record']);

				if(!isset($_GET['record'])) {
		?>
			- <a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_add_category" title="<?php echo __( 'Add category.', 'recordpress' ); ?>"><?php echo __( 'Add category', 'recordpress' ); ?></a>
		<?php } else { ?>
			- <a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_add_record&cat=<?php echo $_GET['record']; ?>" title="<?php echo __( 'Add record.', 'recordpress' ); ?>"><?php echo __( 'Add record', 'recordpress' ); ?></a>
		<?php } ?>

		</div>
		<div id="rp-admin-content-box-search">
			<form name="search" method="post" action="<?php echo admin_url(); ?>admin.php?page=rp_admin_search">
				<input name="query" type="text" value="<?php if(isset($_POST['query'])){ echo $_POST['query']; } ?>" />
				<input type="submit" class="rp-search-button" name="txtid" value="<?php echo __( 'Search', 'recordpress' ); ?>" />
			</form>
		</div>

	</div>

	<hr />

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

		if(isset($_POST['query'])){
			if($_POST['query'] == "") { } else {
			$query = $_POST['query'];

			global $wpdb;
			$rpdb = $wpdb->prefix . 'rp_records';

			$sql = "SELECT $rpdb.id, $rpdb.artist, $rpdb.recordname, $rpdb.released, $rpdb.recordnumber, $rpdb.barcode, 
			$rpdb.country, $rpdb.label, $rpdb.matrix, $rpdb.tracklist, $rpdb.picture1 
			FROM $rpdb 
			WHERE artist LIKE '%$query%' OR recordname LIKE '%$query%' OR released LIKE '%$query%' OR recordnumber LIKE '%$query%' OR barcode LIKE '%$query%' OR country LIKE '%$query%' OR label LIKE '%$query%' OR matrix LIKE '%$query%' OR tracklist LIKE '%$query%' ORDER BY artist, recordname";

			$results = $wpdb->get_results($sql) or die(mysql_error());

			foreach( $results as $result ) {
	?>



	<!-- Start #record-list-wrapper -->
	<div class="rp-admin-record-list-wrapper">

		<div class="rp-admin-record-list">
			<a href='<?php echo admin_url(); ?>admin.php?page=rp_admin_view_single_record&id=<?php echo $result->id; ?>'  title='<?php echo __( 'Have a closer look at this record.', 'recordpress' ); ?>'><?php echo $result->artist; ?></a>
		</div>

		<div class="rp-admin-record-list">
			<?php if (!empty($result->recordname)) { echo $result->recordname; } ?>
		</div>

		<div class="rp-admin-record-list">
			<?php if (!empty($result->label)) { echo $result->label; } ?>
		</div>

		<div class="rp-admin-record-list">
			<?php if (!empty($result->country)) { echo $result->country; } ?>
		</div>

		<div class="rp-admin-record-list">
			<?php if (!empty($result->released)) { echo $result->released; } ?>
		</div>

		<div class="rp-admin-record-list">
			<?php if (!empty($result->recordnumber)) { echo $result->recordnumber; } ?>
		</div>

		<?php if (!empty($result->picture1)) { ?>
		<div class="rp-admin-record-list-image">
			<a href='<?php echo admin_url(); ?>admin.php?page=rp_admin_view_single_record&id=<?php echo $result->id; ?>'  title='<?php echo __( 'Have a closer look at this record.', 'recordpress' ); ?>'>
			<?php echo wp_get_attachment_image( $result->picture1, 'thumbnail' ); ?></a>
		</div>

	</div>
	<!-- End #record-list-wrapper -->
		<?php 
		} } } }
		?>

</div>
<!-- End #rp-admin-wrapper -->
<?php
	if (isset($_GET['id'])) { 

		global $wpdb;
		// This SQL-query is (call it whatever you want)!
		$rpdb = $wpdb->prefix;
		$sql = "SELECT " . $rpdb . "rp_records.id, " . $rpdb . "rp_records.artist, " . $rpdb . "rp_records.recordname, " . $rpdb . "rp_records.genre, " . 
		$rpdb . "rp_records.recordnumber, " . $rpdb . "rp_records.barcode, " . $rpdb . "rp_records.label, " . $rpdb . "rp_records.released, " . 
		$rpdb . "rp_records.style, " . $rpdb . "rp_records.format, " . $rpdb . "rp_records.recordgrade, " . $rpdb . "rp_records.innersleevegrade, " . 
		$rpdb . "rp_records.covergrade, " . $rpdb . "rp_records.comments, " . $rpdb . "rp_records.companies, " . $rpdb . "rp_records.credits, " . $rpdb . "rp_records.country, " . $rpdb . "rp_records.quantity, " . 
		$rpdb . "rp_records.tracklist, " . $rpdb . "rp_records.matrix, " . $rpdb . "rp_records.category, " . $rpdb . "rp_records.picture1, " . 
		$rpdb . "rp_records.picture2, " . $rpdb . "rp_records.picture3, " . $rpdb . "rp_records.picture4, " . $rpdb . "rp_records.picture5, " . 
		$rpdb . "rp_records.picture6, " . $rpdb . "rp_records.picture7, " . $rpdb . "rp_records.picture8, " . $rpdb . "rp_records.picture9, " . 
		$rpdb . "rp_records.picture10, " . $rpdb . "rp_records.picture11, " . $rpdb . "rp_records.picture12, " . $rpdb . "rp_records.picture13, " . 
		$rpdb . "rp_records.picture14, " . $rpdb . "rp_records.picture15, " . $rpdb . "rp_records.price, " . $rpdb . "rp_records.auction, " . $rpdb . "rp_records.creation_time, " . $rpdb . "rp_records.modification_time, " . 
		$rpdb . "rp_settings.currency, " . $rpdb . "rp_settings.auctionname, " . $rpdb . "rp_settings.auctiondesc, " . 
		$rpdb . "rp_settings.auctiontarget, " . $rpdb . "rp_1.grade AS g1, " . 
		$rpdb . "rp_2.grade AS g2, " . $rpdb . "rp_3.grade AS g3, " . $rpdb . "rp_format.fid, " . $rpdb . "rp_format.recordformat FROM " . $rpdb . "rp_records, " . $rpdb . "rp_settings, " . 
		$rpdb . "rp_grade " . $rpdb . "rp_1, " . $rpdb . "rp_grade " . $rpdb . "rp_2, " . $rpdb . "rp_grade " . $rpdb . "rp_3, " . $rpdb . "rp_format WHERE " . $rpdb . "rp_records.id = " . $_GET['id'] . " AND " . $rpdb . "rp_records.recordgrade = " . 
		$rpdb . "rp_1.gid AND " . $rpdb . "rp_records.innersleevegrade = " . $rpdb . "rp_2.gid AND " . $rpdb . "rp_records.covergrade = " . 
		$rpdb . "rp_3.gid AND " . $rpdb . "rp_records.format = " . $rpdb . "rp_format.fid";

		$results = $wpdb->get_results($sql) or die(mysql_error());

			foreach( $results as $result ) {

?>

<!-- Start #rp-admin-wrapper -->
<div id="rp-admin-wrapper">

	<h1><?php echo $result->artist; ?></h1>

	<?php if (empty($result->recordname)) { } else { ?><h2><?php echo $result->recordname; ?></h2><?php } ?> 

	<?php echo __( 'Added', 'recordpress' ); ?> <?php echo $result->creation_time; if ($result->modification_time == "0000-00-00 00:00:00") { echo"."; } else { echo" and last modified " . $result->modification_time . "."; } ?> <?php echo __( 'Record ID:', 'recordpress' ); ?> <?php echo $result->id; ?>
	<hr />

	<div id="rp-admin-content-box-wrapper">
		<div id="rp-admin-content-box-letters">
		<?php

			global $wpdb;
			$rpdb3 = $wpdb->prefix . 'rp_category';

			$sql3 = "SELECT DISTINCT LEFT(cat, 1) as letter FROM $rpdb3 ORDER BY cat ASC";;

			$results3 = $wpdb->get_results($sql3) or die(mysql_error());

			foreach( $results3 as $result3 ) {
		?>
			<a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_view_record&cat=<?php echo urlencode(strtolower($result3->letter)); ?>" title="<?php echo __( 'Show categories sorted by', 'recordpress' ); ?> <?php echo $result3->letter; ?>"><?php echo $result3->letter; ?></a>
		<?php } ?> 
			<a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_view_record&cat=all" title="<?php echo __( 'Show all categories', 'recordpress' ); ?>"><?php echo __( 'ALL', 'recordpress' ); ?></a>
			- <a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_edit_record&id=<?php echo $_GET['id']; ?>" title="<?php echo __( 'Edit this record.', 'recordpress' ); ?>"><?php echo __( 'Edit this record', 'recordpress' ); ?></a>
		</div>
		<div id="rp-admin-content-box-search">
			<form name="search" method="post" action="<?php echo admin_url(); ?>admin.php?page=rp_admin_search">
				<input name="query" type="text" value="" placeholder="<?php echo __( 'Search record...', 'recordpress' ); ?>" />
				<input type="submit" class="rp-search-button" name="txtid" value="<?php echo __( 'Search', 'recordpress' ); ?>" />
			</form>
		</div>
	</div>

	<hr />


	<!-- Start #rp-admin-record-wrapper -->
	<div class="rp-admin-record-wrapper">

		<?php if (empty($result->recordnumber)) { } else { ?>
		<div class="rp-admin-record-list">
				<strong><?php echo __( 'Catalog #:', 'recordpress' ); ?></strong><br />
				<?php echo $result->recordnumber; ?>
		</div>
		<?php } ?>

		<?php if (empty($result->label)) { } else { ?>
		<div class="rp-admin-record-list">
			<strong><?php echo __( 'Label:', 'recordpress' ); ?></strong><br />
			<?php echo $result->label; ?>
		</div>
		<?php } ?>

		<?php if (empty($result->released)) { } else { ?>
		<div class="rp-admin-record-list">
			<strong><?php echo __( 'Released:', 'recordpress' ); ?></strong><br />
			<?php echo $result->released; ?>
		</div>
		<?php } ?>

		<?php if (empty($result->genre)) { } else { ?>
		<div class="rp-admin-record-list">
			<strong><?php echo __( 'Genre:', 'recordpress' ); ?></strong><br />
			<?php echo $result->genre; ?>
		</div>
		<?php } ?>

		<?php if (empty($result->style)) { } else { ?>
		<div class="rp-admin-record-list">
			<strong><?php echo __( 'Style:', 'recordpress' ); ?></strong><br />
			<?php echo $result->style; ?>
		</div>
		<?php } ?>

		<?php if (empty($result->recordformat)) { } else { ?>
		<div class="rp-admin-record-list">
			<strong><?php echo __( 'Format:', 'recordpress' ); ?></strong><br />
			<?php echo stripslashes($result->recordformat); ?>
		</div>
		<?php } ?>

		<?php if (empty($result->g1)) { } else { ?>
		<div class="rp-admin-record-list">
			<strong><?php echo __( 'Grade record(s):', 'recordpress' ); ?></strong><br />
			<?php echo $result->g1; ?>
		</div>
		<?php } ?>

		<?php if (empty($result->g2)) { } else { ?>
		<div class="rp-admin-record-list">
			<strong><?php echo __( 'Grade innersleeve(s):', 'recordpress' ); ?></strong><br />
			<?php echo $result->g2; ?>
		</div>
		<?php } ?>

		<?php if (empty($result->g3)) { } else { ?>
		<div class="rp-admin-record-list">
			<strong><?php echo __( 'Cover grade:', 'recordpress' ); ?></strong><br />
			<?php echo $result->g3; ?>
		</div>
		<?php } ?>

		<?php if (empty($result->matrix)) { } else { ?>
		<div class="rp-admin-record-list">
			<strong><?php echo __( 'Barcode, matrix and other identifiers:', 'recordpress' ); ?></strong><br />
			<?php echo $result->matrix; ?>
		</div>
		<?php } ?>

		<?php if (empty($result->country)) { } else { ?>
		<div class="rp-admin-record-list">
			<strong><?php echo __( 'Country:', 'recordpress' ); ?></strong><br />
			<?php echo $result->country; ?>
		</div>
		<?php } ?>

		<?php if (empty($result->quantity)) { } else { ?>
		<div class="rp-admin-record-list">
			<strong><?php echo __( 'Quantity:', 'recordpress' ); ?></strong><br />
			<?php echo $result->quantity; ?>
		</div>
		<?php } ?>

		<?php if (empty($result->price)) { } else { ?>
		<div class="rp-admin-record-list">
			<strong><?php echo __( 'Price:', 'recordpress' ); ?></strong><br />
			<?php echo $result->price; ?> <?php echo $result->currency; ?>
		</div>
		<?php } ?>

		<?php if (empty($result->auction)) { } else { ?>
		<div class="rp-admin-record-list">
			<strong><?php echo __( 'Auction:', 'recordpress' ); ?></strong><br />
			<a href="<?php echo $result->auction; ?>" title="<?php echo __( 'Visit page', 'recordpress' ); ?>"><?php echo __( 'Visit page', 'recordpress' ); ?></a>
		</div>
		<?php } ?>

		<div class="rp-admin-record-list">
			<strong><?php echo __( 'Category:', 'recordpress' ); ?></strong><br />
			<?php 

				$category = $result->category;

				global $wpdb;
				$rpdb2 = $wpdb->prefix . 'rp_category';

				$sql2 = "SELECT * FROM $rpdb2 WHERE cid = '$category%'";

				$results2 = $wpdb->get_results($sql2) or die(mysql_error());

				foreach( $results2 as $result2 ) {

					echo $result2->cat; } ?>
		</div>

		<?php if (empty($result->barcode)) { } else { ?>
		<div class="rp-admin-record-list-single">
			<strong><?php echo __( 'Barcode, matrix and other identifiers:', 'recordpress' ); ?></strong><br />
			<?php echo nl2br(stripslashes($result->barcode)); ?>
		</div>
		<?php } ?>

		<?php if (empty($result->tracklist)) { } else { ?>
		<div class="rp-admin-record-list-single">
			<strong><?php echo __( 'Tracklist:', 'recordpress' ); ?></strong><br />
			<?php echo nl2br(stripslashes($result->tracklist)); ?>
		</div>
		<?php } ?>

		<?php if (empty($result->comments)) { } else { ?>
		<div class="rp-admin-record-list-single">
			<strong><?php echo __( 'Comments:', 'recordpress' ); ?></strong><br />
			<?php echo nl2br(stripslashes($result->comments)); ?>
		</div>
		<?php } 

		if (empty($result->companies)) { } else { ?>
		<div class="rp-admin-record-list-single">
			<strong><?php echo __( 'Companies:', 'recordpress' ); ?></strong><br />
			<?php echo nl2br(stripslashes($result->companies)); ?>
		</div>
		<?php } 

		if (empty($result->credits)) { } else { ?>
		<div class="rp-admin-record-list-single">
			<strong><?php echo __( 'Credits:', 'recordpress' ); ?></strong><br />
			<?php echo nl2br(stripslashes($result->credits)); ?>
		</div>
		<?php } 

			if (empty($result->picture1) && empty($result->picture2) && empty($result->picture3) && empty($result->picture4) && empty($result->picture5) &&
				empty($result->picture6) && empty($result->picture7) && empty($result->picture8) && empty($result->picture9) && empty($result->picture10) &&
				empty($result->picture11) && empty($result->picture12) && empty($result->picture13) && empty($result->picture14) && empty($result->picture15)) { } else { ?>

		<div class="rp-admin-record-list-single">
			<strong><?php echo __( 'Picture(s):', 'recordpress' ); ?></strong><br />
			<?php echo wp_get_attachment_image( $result->picture1, 'full' ); ?>
			<?php echo wp_get_attachment_image( $result->picture2, 'full' ); ?>
			<?php echo wp_get_attachment_image( $result->picture3, 'full' ); ?>
			<?php echo wp_get_attachment_image( $result->picture4, 'full' ); ?>
			<?php echo wp_get_attachment_image( $result->picture5, 'full' ); ?>
			<?php echo wp_get_attachment_image( $result->picture6, 'full' ); ?>
			<?php echo wp_get_attachment_image( $result->picture7, 'full' ); ?>
			<?php echo wp_get_attachment_image( $result->picture8, 'full' ); ?>
			<?php echo wp_get_attachment_image( $result->picture9, 'full' ); ?>
			<?php echo wp_get_attachment_image( $result->picture10, 'full' ); ?>
			<?php echo wp_get_attachment_image( $result->picture11, 'full' ); ?>
			<?php echo wp_get_attachment_image( $result->picture12, 'full' ); ?>
			<?php echo wp_get_attachment_image( $result->picture13, 'full' ); ?>
			<?php echo wp_get_attachment_image( $result->picture14, 'full' ); ?>
			<?php echo wp_get_attachment_image( $result->picture15, 'full' ); ?>
		</div>
		<?php } ?>

	</div>

<?php } } else { echo __( 'No record to display.', 'recordpress' ); } ?>
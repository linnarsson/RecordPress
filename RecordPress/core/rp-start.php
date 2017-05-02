		<div id="rp-admin-wrapper">

			<div id="rp-admin-header">
				<div id="rp-admin-header-logo">
					<img height="60" width="307" src="<?php rp_dir(); ?>/core/assets/images/logo.svg" onerror="this.src='<?php plugins_url(); ?>/core/assets/images/logo.png'; this.onerror=null;" class="size-full" />
				</div>
				<div id="rp-admin-header-text">
					<span><?php echo __( 'Thank you for using RecordPress. Our homepage can be found at:', 'recordpress' ); ?> <a href="http://www.recordpress.org/" title="<?php echo __( 'Visit the official homepage.', 'recordpress' ); ?>">http://www.recordpress.org/</a><br />

<?php

					global $wpdb;
					$table_name = $wpdb->prefix . 'rp_records';
					$table_name2 = $wpdb->prefix . 'rp_settings';

					$sql = "SELECT currency, COUNT(quantity) as quantity, SUM(price) as total FROM $table_name, $table_name2";

					$results = $wpdb->get_results($sql) or die(mysql_error());

					foreach( $results as $result ) {

						//echo "You have " . $result->quantity . " inserted records"; if(isset($result->total)) { echo " with a total value of " . $result->total . " " . $result->currency; } echo ".";
						echo sprintf( __('You have %d inserted records', 'recordpress'), $result->quantity ) . " ";
						if(isset($result->total)) {
							echo sprintf( __( 'with a total value of %d %s', 'recordpress'), $result->total, $result->currency . '.');
						}
					}
?>

					</span>
				</div>
				<div id="rp-admin-header-clear"></div>
			</div>

<h1><?php echo __( 'View records', 'recordpress' ); ?></h1>
<hr />
	<div id="rp-admin-content-box-wrapper">
		<div id="rp-admin-content-box-letters">
		<?php
			global $wpdb;
			$rpdb = $wpdb->prefix . 'rp_category';
			//$sql = "SELECT DISTINCT SUBSTRING(cat FROM 1 FOR 1) AS letter FROM $rpdb ORDER BY cat ASC";
			$sql = "SELECT DISTINCT LEFT(cat, 1) as letter FROM $rpdb ORDER BY cat ASC";
			$results = $wpdb->get_results($sql) or die(mysql_error());
			foreach( $results as $result ) {
		?>
			<a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_view_record&cat=<?php echo urlencode(strtolower($result->letter)); ?>" title="<?php echo __( 'Show categories sorted by', 'recordpress' ); ?> <?php echo $result->letter; ?>"><?php echo $result->letter; ?></a>
		<?php } ?> 
			<a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_view_record&cat=all" title="<?php echo __( 'Show all categories.', 'recordpress' ); ?>"><?php echo __( 'ALL', 'recordpress' ); ?></a> - 
			<a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_add_category" title="<?php echo __( 'Add category.', 'recordpress' ); ?>"><?php echo __( 'Add category', 'recordpress' ); ?></a> -
			<a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_add_record" title="<?php echo __( 'Add record.', 'recordpress' ); ?>"><?php echo __( 'Add record', 'recordpress' ); ?></a>

		</div>
		<div id="rp-admin-content-box-search">
			<form name="search" method="post" action="<?php echo admin_url(); ?>admin.php?page=rp_admin_search">
				<input name="query" type="text" value="" placeholder="<?php echo __( 'Search record...', 'recordpress' ); ?>" />
				<input type="submit" class="rp-search-button" name="txtid" value="<?php echo __( 'Search', 'recordpress' ); ?>" />
			</form>
		</div>

	</div>

	<hr />

	<h2 class="h2-start"><?php echo __( 'Latest added records', 'recordpress' ); ?></h2>

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

		$sql = "SELECT * FROM $table_name ORDER BY id DESC LIMIT 10";

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


?>
		</div>

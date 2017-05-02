<?php
	function rp_search_frontend() {

    ob_start();

	if(isset($_POST['query'])){
	if($_POST['query'] !== ""){
	$query = $_POST['query'];
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

			$sql = "SELECT $rpdb.id, $rpdb.artist, $rpdb.recordname, $rpdb.released, $rpdb.recordnumber, $rpdb.barcode, 
			$rpdb.country, $rpdb.label, $rpdb.matrix, $rpdb.tracklist, $rpdb.picture1 
			FROM $rpdb 
			WHERE artist LIKE '%$query%' OR recordname LIKE '%$query%' OR released LIKE '%$query%' OR recordnumber LIKE '%$query%' OR barcode LIKE '%$query%' OR country LIKE '%$query%' OR label LIKE '%$query%' OR matrix LIKE '%$query%' OR tracklist LIKE '%$query%' ORDER BY artist, recordname";

			//$results = $wpdb->get_results($sql) or die(mysql_error());
			$results = $wpdb->get_results($sql);

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

<?php } 
} else { ?>

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

<?php }
}  else { echo do_shortcode('[rp_search_field]');  }
return ob_get_clean();
} 
add_shortcode('rp_search','rp_search_frontend');
?>
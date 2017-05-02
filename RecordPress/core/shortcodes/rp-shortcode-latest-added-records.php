<?php
/* View category */
function rp_view_latest_added_record_frontend($atts) {

	ob_start();

	$atts = shortcode_atts( 
		array(
			'view' => 1,
		),
	$atts);

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
		$attsnumber = $atts['view'];
		$sql = "SELECT * FROM $rpdb ORDER BY id DESC LIMIT $attsnumber";

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

	<?php

	} 
	return ob_get_clean();
}
add_shortcode('rp_view_latest_added_record','rp_view_latest_added_record_frontend');

?>
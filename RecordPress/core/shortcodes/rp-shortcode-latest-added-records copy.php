<?php
/* View category */
	function rp_view_latest_added_record_frontend($atts) {

  $atts = shortcode_atts( 
    array(
      'view' => 1,
    ), 
    $atts);

//return "hej";


$ful = '
<!-- Start #record-list-wrapper -->
<div class="record-list-wrapper">

	<div class="record-list">
		Artist:
	</div>

	<div class="record-list">
		Recordname:
	</div>

	<div class="record-list">
		Label:
	</div>

	<div class="record-list">
		Country:
	</div>

	<div class="record-list">
		Year:
	</div>

	<div class="record-list">
		Catalog #:
	</div>

</div>
<!-- End #record-list-wrapper -->
';
?>

				<?php

			global $wpdb;
			$table_name = $wpdb->prefix . 'rp_records';
			$attsnumber = $atts['view'];
			$sql = "SELECT * FROM $table_name ORDER BY id DESC LIMIT $attsnumber";

			$results = $wpdb->get_results($sql) or die(mysql_error());



			foreach( $results as $result ) {

$ful2 = '


';

					?>

<!-- Start #record-list-wrapper -->
<div class="record-list-wrapper">

	<div class="record-list">
						<a href='<?php echo current_frontend_url_records(); ?>?id=<?php echo $result->id; ?>'  title='Have a closer look at this record!'><?php echo $result->artist; ?></a>
	</div>

	<div class="record-list">
		<?php if (!empty($result->recordname)) { echo $result->recordname; } ?>
	</div>

	<div class="record-list">
		<?php if (!empty($result->label)) { echo $result->label; } ?>
	</div>

	<div class="record-list">
		<?php if (!empty($result->country)) { echo $result->country; } ?>
	</div>

	<div class="record-list">
		<?php if (!empty($result->year)) { echo $result->year; } ?>
	</div>

	<div class="record-list">
		<?php if (!empty($result->recordnumber)) { echo $result->recordnumber; } ?>
	</div>

	<div class="record-list">
		<?php if (!empty($result->picture1)) { ?>
		<a href="<?php echo current_frontend_url_records(); ?>?id=<?php echo $result->id; ?>" title="Have a closer look at this record!">
		<img src="<?php echo $result->picture1; ?>" alt="Have a closer look at this record!" width="100" height="75" border="0" /></a>
		<?php } ?>
	</div>

	<div class="record-list">
		&nbsp;
	</div>


	<div class="record-list-goback">
		<span><a href="javascript: history.go(-1)" title="Go to previous page!">Prev</a> | <a href="#top" title="Go to top of page!">Top</a></span>
	</div>
	
</div>
<!-- End #record-list-wrapper -->
<?php 
return $ful;
 }     

} 
add_shortcode('rp_view_latest_added_record','rp_view_latest_added_record_frontend');

?>
<?php
	function rp_view_single_record_frontend($atts) {

  $atts = shortcode_atts( 
    array(
      'artist' => '',
      'recordname' => '',
      'catalog' => '',
      'label' => '',
      'released' => '',
      'genre' => '',
      'style' => '',
      'format' => '',
      'graderecord' => '',
      'gradeinnersleeve' => '',
      'gradecover' => '',
      'country' => '',
      'quantity' => '',
      'category' => '',
      'barcode' => '',
      'tracklist' => '',
      'comments' => '',
      'companies' => '',
      'credits' => '',
      'price' => '',
      'auction' => '',
      'pictures' => '',
      'previous' => '',
      'artistonly' => '',
      'recordnameonly' => '',
    ), 
    $atts);

    ob_start();

	if (isset($_GET['id'])) { 

		global $wpdb;

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

			if ($atts['artistonly'] == 'yes') {
				echo $result->artist;
			} else if ($atts['recordnameonly'] == 'yes') {
				echo $result->recordname;
			} else {

?>



<!-- Start .rp-record-wrapper -->
<div class="rp-record-wrapper">
	<?php 
		if ($atts['artist'] == 'no') {} else {
		if (empty($result->artist)) { } else { ?>
	<div class="rp-single-record-list rp-single-record-artist">
		<span class="rp-single-record-list-span-1 rp-single-record-artist-span-1"><?php echo __( 'Artist:', 'recordpress' ); ?></span>
		<span class="rp-single-record-list-span-2 rp-single-record-artist-span-2"><?php echo $result->artist; ?></span>
	</div>
	<?php } } ?>


	<?php 
		if ($atts['recordname'] == 'no') {} else {
		if (empty($result->recordname)) { } else { ?>
	<div class="rp-single-record-list rp-single-record-recordname">
		<span class="rp-single-record-list-span-1 rp-single-record-recordname-span-1"><?php echo __( 'Recordname:', 'recordpress' ); ?></span>
		<span class="rp-single-record-list-span-2 rp-single-record-recordname-span-2"><?php echo $result->recordname; ?></span>
	</div>
	<?php } } ?>

	<?php 
		if ($atts['catalog'] == 'no') {} else {
		if (empty($result->recordnumber)) { } else { ?>
	<div class="rp-single-record-list rp-single-record-catalog">
			<span class="rp-single-record-list-span-1 rp-single-record-catalog-span-1"><?php echo __( 'Catalog #:', 'recordpress' ); ?></span>
			<span class="rp-single-record-list-span-2 rp-single-record-catalog-span-2"><?php echo $result->recordnumber; ?></span>
	</div>
	<?php } } ?>

<?php 
	if ($atts['label'] == 'no') {} else {
	if (empty($result->label)) { } else { ?>
	<div class="rp-single-record-list rp-single-record-label">
		<span class="rp-single-record-list-span-1 rp-single-record-label-span-1"><?php echo __( 'Label:', 'recordpress' ); ?></span>
		<span class="rp-single-record-list-span-2 rp-single-record-label-span-2"><?php echo $result->label; ?></span>
	</div>
	<?php } } ?>

<?php 
	if ($atts['released'] == 'no') {} else {
	if (empty($result->released)) { } else { ?>
	<div class="rp-single-record-list rp-single-record-released">
		<span class="rp-single-record-list-span-1 rp-single-record-released-span-1"><?php echo __( 'Released:', 'recordpress' ); ?></span>
		<span class="rp-single-record-list-span-2 rp-single-record-released-span-2"><?php echo $result->released; ?></span>
	</div>
	<?php } } ?>

<?php 
	if ($atts['genre'] == 'no') {} else {
	if (empty($result->genre)) { } else { ?>
	<div class="rp-single-record-list rp-single-record-genre">
		<span class="rp-single-record-list-span-1 rp-single-record-genre-span-1"><?php echo __( 'Genre:', 'recordpress' ); ?></span>
		<span class="rp-single-record-list-span-2 rp-single-record-genre-span-2"><?php echo $result->genre; ?></span>
	</div>
	<?php } } ?>

<?php 
	if ($atts['style'] == 'no') {} else {
	if (empty($result->style)) { } else { ?>
	<div class="rp-single-record-list rp-single-record-style">
		<span class="rp-single-record-list-span-1 rp-single-record-style-span-1"><?php echo __( 'Style:', 'recordpress' ); ?></span>
		<span class="rp-single-record-list-span-2 rp-single-record-style-span-2"><?php echo $result->style; ?></span>
	</div>
	<?php } } ?>

<?php 
	if ($atts['format'] == 'no') {} else {
	if (empty($result->recordformat)) { } else { ?>
	<div class="rp-single-record-list rp-single-record-format">
		<span class="rp-single-record-list-span-1 rp-single-record-format-span-1"><?php echo __( 'Format:', 'recordpress' ); ?></span>
		<span class="rp-single-record-list-span-2 rp-single-record-format-span-2"><?php echo stripslashes($result->recordformat); ?></span>
	</div>
	<?php } } ?>

<?php 
	if ($atts['graderecord'] == 'no') {} else {
	if (empty($result->g1)) { } else { ?>
	<div class="rp-single-record-list rp-single-record-graderecord">
		<span class="rp-single-record-list-span-1 rp-single-record-graderecord-span-1"><?php echo __( 'Grade record(s):', 'recordpress' ); ?></span>
		<span class="rp-single-record-list-span-2 rp-single-record-graderecord-span-2"><?php echo $result->g1; ?></span>
	</div>
	<?php } } ?>

<?php 
	if ($atts['gradeinnersleeve'] == 'no') {} else {
	if (empty($result->g2)) { } else { ?>
	<div class="rp-single-record-list rp-single-record-gradeinnersleeve">
		<span class="rp-single-record-list-span-1 rp-single-record-gradeinnersleeve-span-1"><?php echo __( 'Grade innersleeve(s):', 'recordpress' ); ?></span>
		<span class="rp-single-record-list-span-2 rp-single-record-gradeinnersleeve-span-2"><?php echo $result->g2; ?></span>
	</div>
	<?php } } ?>

<?php 
	if ($atts['gradecover'] == 'no') {} else {
	if (empty($result->g3)) { } else { ?>
	<div class="rp-single-record-list rp-single-record-gradecover">
		<span class="rp-single-record-list-span-1 rp-single-record-gradecover-span-1"><?php echo __( 'Cover grade:', 'recordpress' ); ?></span>
		<span class="rp-single-record-list-span-2 rp-single-record-gradecover-span-2"><?php echo $result->g3; ?></span>
	</div>
	<?php } } ?>

<?php 
	if ($atts['country'] == 'no') {} else {
	if (empty($result->country)) { } else { ?>
	<div class="rp-single-record-list rp-single-record-country">
		<span class="rp-single-record-list-span-1 rp-single-record-country-span-1"><?php echo __( 'Country:', 'recordpress' ); ?></span>
		<span class="rp-single-record-list-span-2 rp-single-record-country-span-2"><?php echo $result->country; ?></span>
	</div>
	<?php } } ?>

<?php 
	if ($atts['quantity'] == 'no') {} else {
	if (empty($result->quantity)) { } else { ?>
	<div class="rp-single-record-list rp-single-record-quantity">
		<span class="rp-single-record-list-span-1 rp-single-record-quantity-span-1"><?php echo __( 'Quantity:', 'recordpress' ); ?></span>
		<span class="rp-single-record-list-span-2 rp-single-record-quantity-span-2"><?php echo $result->quantity; ?></span>
	</div>
	<?php } } ?>

<?php if ($atts['category'] == 'no') {} else { ?>
	<div class="rp-single-record-list rp-single-record-category">
		<span class="rp-single-record-list-span-1 rp-single-record-category-span-1"><?php echo __( 'Category:', 'recordpress' ); ?></span>
		<span class="rp-single-record-list-span-2 rp-single-record-category-span-2">
			<?php 

				$category = $result->category;

			global $wpdb;
			$rpdb2 = $wpdb->prefix . 'rp_category';

			$sql2 = "SELECT * FROM $rpdb2 WHERE cid = '$category%'";

			$results2 = $wpdb->get_results($sql2) or die(mysql_error());

			foreach( $results2 as $result2 ) {

echo $result2->cat; } ?>
		</span>
</div>
<?php } ?>

<?php 
	if ($atts['barcode'] == 'no') {} else {
	if (empty($result->barcode)) { } else { ?>
	<div class="rp-single-record-list-single rp-single-record-barcode">
		<span class="rp-single-record-list-single-span-1 rp-single-record-barcode-span-1"><?php echo __( 'Barcode, matrix and other identifiers:', 'recordpress' ); ?></span>
		<span class="rp-single-record-list-single-span-2 rp-single-record-barcode-span-2"><?php echo nl2br(stripslashes($result->barcode)); ?></span>
	</div>
	<?php } } ?>

<?php 
	if ($atts['tracklist'] == 'no') {} else {
	if (empty($result->tracklist)) { } else { ?>
	<div class="rp-single-record-list-single rp-single-record-tracklist">
		<span class="rp-single-record-list-single-span-1 rp-single-record-tracklist-span-1"><?php echo __( 'Tracklist:', 'recordpress' ); ?></span>
		<span class="rp-single-record-list-single-span-2 rp-single-record-tracklist-span-2"><?php echo nl2br(stripslashes($result->tracklist)); ?></span>
</div>
	<?php } } ?>

<?php 
	if ($atts['comments'] == 'no') {} else {
	if (empty($result->comments)) { } else { ?>
	<div class="rp-single-record-list-single rp-single-record-comments">
		<span class="rp-single-record-list-single-span-1 rp-single-record-comments-span-1"><?php echo __( 'Comments:', 'recordpress' ); ?></span>
		<span class="rp-single-record-list-single-span-2 rp-single-record-comments-span-2"><?php echo nl2br(stripslashes($result->comments)); ?></span>
</div>
	<?php } }

if ($atts['companies'] == 'no') {} else {
if (empty($result->companies)) { } else { ?>
	<div class="rp-single-record-list-single rp-single-record-companies">
		<span class="rp-single-record-list-single-span-1 rp-single-record-companies-span-1"><?php echo __( 'Companies:', 'recordpress' ); ?></span>
		<span class="rp-single-record-list-single-span-2 rp-single-record-companies-span-2"><?php echo nl2br(stripslashes($result->companies)); ?></span>
</div>
	<?php } }

if ($atts['credits'] == 'no') {} else {
if (empty($result->credits)) { } else { ?>
	<div class="rp-single-record-list-single rp-single-record-credits">
		<span class="rp-single-record-list-single-span-1 rp-single-record-credits-span-1"><?php echo __( 'Credits:', 'recordpress' ); ?></span>
		<span class="rp-single-record-list-single-span-2 rp-single-record-credits-span-2"><?php echo nl2br(stripslashes($result->credits)); ?></span>
</div>
	<?php } }


	if ($atts['price'] == 'no') {} else {
	if (empty($result->price)) { } else { ?>
	<div class="rp-single-record-list-single rp-single-record-price">
		<span class="rp-single-record-list-single-span-1 rp-single-record-price-span-1"><?php echo __( 'Price:', 'recordpress' ); ?></span>
		<span class="rp-single-record-list-single-span-2 rp-single-record-price-span-2"><?php echo $result->price; ?> <?php echo $result->currency; ?></span>
</div>
	<?php } }


	if ($atts['auction'] == 'no') {} else {
	if (empty($result->auction)) { } else { ?>
	<div class="rp-single-record-list-single rp-single-record-auction">
		<span class="rp-single-record-list-single-span-1 rp-single-record-auction-span-1"><?php echo __( 'Auction:', 'recordpress' ); ?></span>
		<span class="rp-single-record-list-single-span-2 rp-single-record-auction-span-2"><a href="<?php echo $result->auction; ?>" title="<?php echo __( 'Visit auction', 'recordpress' ); ?>"><?php echo __( 'Visit auction', 'recordpress' ); ?></a></span>
</div>
	<?php } }


if ($atts['pictures'] == 'no') {} else {
 if (empty($result->picture1) && empty($result->picture2) && empty($result->picture3) && empty($result->picture4) && empty($result->picture5) &&
	empty($result->picture6) && empty($result->picture7) && empty($result->picture8) && empty($result->picture9) && empty($result->picture10) &&
	empty($result->picture11) && empty($result->picture12) && empty($result->picture13) && empty($result->picture14) && empty($result->picture15)) { } else { ?>
<div class="rp-single-record-list-single rp-single-record-pictures">
			<span class="rp-single-record-list-single-span-1 rp-single-record-pictures-span-1"><?php echo __( 'Picture(s):', 'recordpress' ); ?></span>
			<span class="rp-single-record-list-single-span-2 rp-single-record-pictures-span-2"><?php echo wp_get_attachment_image( $result->picture1, 'full' ); ?>
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
			</span>
</div>
	<?php } } 

	global $wpdb;
	$rpdb = $wpdb->prefix . 'rp_settings';
	$sql = "SELECT user_role FROM $rpdb";

	$results = $wpdb->get_results($sql) or die(mysql_error());

	foreach( $results as $result ) {

		/* Administrators and selected usergroup can administrate RecordPress. */
		if ( current_user_can($result->user_role) || current_user_can('administrator')) {
?>
<div class="rp-single-record-list-single rp-single-record-list-single-edit">
<a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_edit_record&id=<?php echo $_GET['id']; ?>" title="<?php echo __( 'Edit this record.', 'recordpress' ); ?>"><?php echo __( 'Edit this record', 'recordpress' ); ?></a>
</div>
<?php } }
if ($atts['previous'] == 'no') {} else {
	?>
		<div class="rp-nav-goback rp-single-record-previous"><a href="javascript: history.go(-1)" title="<?php echo __( 'Go to previous page.', 'recordpress' ); ?>"><?php echo __( '&laquo; Previous', 'recordpress' ); ?></a></div>

<?php }
			}
}
	} else { echo __( 'No record to display.', 'recordpress' ); }


return ob_get_clean();
}
add_shortcode('rp_view_single_record','rp_view_single_record_frontend');
?>
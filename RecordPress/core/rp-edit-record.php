<?php
/**
 * Edit.
 **/

if (isset($_GET['id'])) { 

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

/* Insert format */
if (isset($_POST['submitformat_val'])) {
	$errorcat = false;

	global $wpdb;
	$rpdb = $wpdb->prefix . 'rp_format';

	$sql = "SELECT * FROM $rpdb";

	$results = $wpdb->get_results($sql) or die(mysql_error());

	foreach($results as $result) {

		foreach ( $_POST['rp-add-format-fields'] as $key=>$value ) {
			if(strtolower(htmlspecialchars($value)) == strtolower(htmlspecialchars($result->recordformat))) {
				$empty_format = __( 'Format already exists.', 'recordpress' );
				$errorformat = true;
			}

		}

		if (empty(htmlspecialchars($value))) {
			$empty_format = __( 'You better type in a name for your new format!', 'recordpress' );
			$errorformat = true;
		}
	}

	if(!$errorformat){



if ($_POST['rp-add-format-fields']) {

foreach ( $_POST['rp-add-format-fields'] as $key=>$value ) {

		global $wpdb;
		global $post;

		$table = $wpdb->prefix . "rp_format";
		$data = array(
			'recordformat' => stripslashes($value),
			'recordformatd' => '2',
		);
		$format = array(
			'%s'
		);

		$success = $wpdb->insert($table, $data, $format);

}

}


$formatadded = "<i>" . count($_POST['rp-add-format-fields']) . " format(s) added</i>";
} }
/* End insert format */


/* Insert category */
if (isset($_POST['submitcategory_val'])) {
	$errorcat = false;

	global $wpdb;
	$rpdb = $wpdb->prefix . 'rp_category';

	$sql = "SELECT * FROM $rpdb";

	$results = $wpdb->get_results($sql) or die(mysql_error());

	foreach($results as $result) {

		foreach ( $_POST['rp-add-category-fields'] as $key=>$value ) {
			if(strtolower(htmlspecialchars($value)) == strtolower(htmlspecialchars($result->cat))) {
				$empty_cat = __( 'Category already exists.', 'recordpress' );
				$errorcat = true;
			}

		}

		if (empty(htmlspecialchars($value))) {
			$empty_cat = __( 'You better type in an categoryname!', 'recordpress' );
			$errorcat = true;
		}
	}

	if(!$errorcat){



if ($_POST['rp-add-category-fields']) {

foreach ( $_POST['rp-add-category-fields'] as $key=>$value ) {

 		global $wpdb;
		global $post;

		$table = $wpdb->prefix . "rp_category";
		$data = array(
			'cat' => stripslashes($value),
			'catd' => '2',
		);
		$format = array(
			'%s',
			'%s'
		);

		$success = $wpdb->insert($table, $data, $format);

}

}


$categoryadded = "<i>" . count($_POST['rp-add-category-fields']) . " categories added</i>";
} }
/* End insert category */

		if(isset($_POST['deleterecord'])) {
			global $wpdb;
			$rpdb55 = $wpdb->prefix . 'rp_records';

			$query = "SELECT * FROM $rpdb55 WHERE $rpdb55.id = '" . $_GET['id'] . "'";
			$results55 = $wpdb->get_results($query);

			foreach( $results55 as $result55 ) {
				/*$image_path = wp_upload_dir();
				
				$picture1 = substr($result55->picture1, strripos($result55->picture1,'http://localhost/recordpress_dev/wp-content/uploads/')+strlen('http://localhost/recordpress_dev/wp-content/uploads/'));
				$picture2 = substr($result55->picture2, strripos($result55->picture2,'http://localhost/recordpress_dev/wp-content/uploads/')+strlen('http://localhost/recordpress_dev/wp-content/uploads/'));
				$picture3 = substr($result55->picture3, strripos($result55->picture3,'http://localhost/recordpress_dev/wp-content/uploads/')+strlen('http://localhost/recordpress_dev/wp-content/uploads/'));
				$picture4 = substr($result55->picture4, strripos($result55->picture4,'http://localhost/recordpress_dev/wp-content/uploads/')+strlen('http://localhost/recordpress_dev/wp-content/uploads/'));
				$picture5 = substr($result55->picture5, strripos($result55->picture5,'http://localhost/recordpress_dev/wp-content/uploads/')+strlen('http://localhost/recordpress_dev/wp-content/uploads/'));
				$picture6 = substr($result55->picture6, strripos($result55->picture6,'http://localhost/recordpress_dev/wp-content/uploads/')+strlen('http://localhost/recordpress_dev/wp-content/uploads/'));
				$picture7 = substr($result55->picture7, strripos($result55->picture7,'http://localhost/recordpress_dev/wp-content/uploads/')+strlen('http://localhost/recordpress_dev/wp-content/uploads/'));
				$picture8 = substr($result55->picture8, strripos($result55->picture8,'http://localhost/recordpress_dev/wp-content/uploads/')+strlen('http://localhost/recordpress_dev/wp-content/uploads/'));
				$picture9 = substr($result55->picture9, strripos($result55->picture9,'http://localhost/recordpress_dev/wp-content/uploads/')+strlen('http://localhost/recordpress_dev/wp-content/uploads/'));
				$picture10 = substr($result55->picture10, strripos($result55->picture10,'http://localhost/recordpress_dev/wp-content/uploads/')+strlen('http://localhost/recordpress_dev/wp-content/uploads/'));
				$picture11 = substr($result55->picture11, strripos($result55->picture11,'http://localhost/recordpress_dev/wp-content/uploads/')+strlen('http://localhost/recordpress_dev/wp-content/uploads/'));
				$picture12 = substr($result55->picture12, strripos($result55->picture12,'http://localhost/recordpress_dev/wp-content/uploads/')+strlen('http://localhost/recordpress_dev/wp-content/uploads/'));
				$picture13 = substr($result55->picture13, strripos($result55->picture13,'http://localhost/recordpress_dev/wp-content/uploads/')+strlen('http://localhost/recordpress_dev/wp-content/uploads/'));
				$picture14 = substr($result55->picture14, strripos($result55->picture14,'http://localhost/recordpress_dev/wp-content/uploads/')+strlen('http://localhost/recordpress_dev/wp-content/uploads/'));
				$picture15 = substr($result55->picture15, strripos($result55->picture15,'http://localhost/recordpress_dev/wp-content/uploads/')+strlen('http://localhost/recordpress_dev/wp-content/uploads/'));*/

				/*global $wpdb;
				$rpdb66 = $wpdb->prefix . 'postmeta';
				$query = "SELECT * FROM $rpdb66 WHERE meta_value IN ('" . $picture1 . "','" . $picture2 . "','" . $picture3 . "','" . $picture4 . "','" . $picture5 . "',
				'" . $picture6 . "','" . $picture7 . "','" . $picture8 . "','" . $picture9 . "','" . $picture10 . "','" . $picture11 . "','" . $picture12 . "',
				'" . $picture13 . "','" . $picture14 . "','" . $picture15 . "')";
				$results555 = $wpdb->get_results($query);

				foreach( $results555 as $result555 ) {*/
					if(isset($_POST['deleteimages'])) {
						//wp_delete_attachment($result55->post_id);
							wp_delete_attachment($result55->picture1);
							wp_delete_attachment($result55->picture2);
							wp_delete_attachment($result55->picture3);
							wp_delete_attachment($result55->picture4);
							wp_delete_attachment($result55->picture5);
							wp_delete_attachment($result55->picture6);
							wp_delete_attachment($result55->picture7);
							wp_delete_attachment($result55->picture8);
							wp_delete_attachment($result55->picture9);
							wp_delete_attachment($result55->picture10);
							wp_delete_attachment($result55->picture11);
							wp_delete_attachment($result55->picture12);
							wp_delete_attachment($result55->picture13);
							wp_delete_attachment($result55->picture14);
							wp_delete_attachment($result55->picture15);
							/*$arrayupload[1] = $result55['picture1'];
							$arrayupload[2] = $result55['picture2'];
							$arrayupload[3] = $result55['picture3'];
							$arrayupload[4] = $result55['picture4'];
							$arrayupload[5] = $result55['picture5'];

							wp_delete_attachment($arrayupload[1]);
							wp_delete_attachment($arrayupload[2]);
							wp_delete_attachment($arrayupload[3]);
							wp_delete_attachment($arrayupload[4]);
							wp_delete_attachment($arrayupload[5]);*/
		
							/*wp_delete_attachment( $result55['picture1'] );
							wp_delete_attachment( $result55['picture2'] );
							wp_delete_attachment( $result55['picture3'] );
							wp_delete_attachment( $result55['picture4'] );
							wp_delete_attachment( $result55['picture5'] );*/
					}
				//}

				global $wpdb;
				$rpdb222 = $wpdb->prefix . "rp_records";

				$wpdb->query("DELETE FROM $rpdb222 WHERE id = '" . $_GET['id'] . "'");

				global $wpdb;
				$rpdb777 = $wpdb->prefix . 'rp_category';

				$query777 = "SELECT * FROM $rpdb777 WHERE $rpdb777.cid = '" . $result55->category . "'";
				$results777 = $wpdb->get_results($query777);

				foreach( $results777 as $result777 ) {
					exit(header('Location: ' . get_admin_url(get_current_blog_id(), 'admin.php?page=rp_admin_view_record&cat=' . urlencode(strtolower($result777->cat[0])) . '&record=' . $result777->cid . '')));
				}
			}
		}

		$error = false;

		if(!$error){

			$getid = $_GET['id'];
			if(!is_numeric($getid)) die('You killed me! Thank you soo much!');

				global $wpdb;
				$table_name = $wpdb->prefix . "rp_records";
				$data = array(
					/*'artist' => stripslashes($_POST['f1']),
					'recordname' => stripslashes($_POST['f2']),
					'recordnumber' => stripslashes($_POST['f3']),
					'barcode' => stripslashes($_POST['f4']),
					'matrix' => stripslashes($_POST['f5']),
					'label' => stripslashes($_POST['f6']),
					'released' => stripslashes($_POST['f7']),
					'genre' => stripslashes($_POST['f81']),
					'style' => stripslashes($_POST['f8']),
					'format' => $_POST['f9'],
					'recordgrade' => $_POST['f10'],
					'innersleevegrade' => $_POST['f11'],
					'covergrade' => $_POST['f12'],
					'country' => stripslashes($_POST['f13']),
					'comments' => stripslashes($_POST['f14']),
					'tracklist' => stripslashes($_POST['f15']),
					'picture1' => rp_get_attachment_id_by_url($_POST['f16']),
					'picture2' => rp_get_attachment_id_by_url($_POST['f17']),
					'picture3' => rp_get_attachment_id_by_url($_POST['f18']),
					'picture4' => rp_get_attachment_id_by_url($_POST['f19']),
					'picture5' => rp_get_attachment_id_by_url($_POST['f20']),
					'picture6' => rp_get_attachment_id_by_url($_POST['f21']),
					'picture7' => rp_get_attachment_id_by_url($_POST['f22']),
					'picture8' => rp_get_attachment_id_by_url($_POST['f23']),
					'picture9' => rp_get_attachment_id_by_url($_POST['f24']),
					'picture10' => rp_get_attachment_id_by_url($_POST['f25']),
					'picture11' => rp_get_attachment_id_by_url($_POST['f26']),
					'picture12' => rp_get_attachment_id_by_url($_POST['f27']),
					'picture13' => rp_get_attachment_id_by_url($_POST['f28']),
					'picture14' => rp_get_attachment_id_by_url($_POST['f29']),
					'picture15' => rp_get_attachment_id_by_url($_POST['f30']),
					'quantity' => stripslashes($_POST['f31']),
					'price' => stripslashes($_POST['f32']),
					'category' => stripslashes($_POST['f33']),
					'auction' => stripslashes($_POST['f34']),
					'modification_time' => date("Y-m-d H:i:s")*/

				'artist' => stripslashes($_POST['f1']),
				'recordname' => stripslashes($_POST['f2']),
				'recordnumber' => stripslashes($_POST['f3']),
				'barcode' => stripslashes($_POST['f4']),
				'label' => stripslashes($_POST['f5']),
				'released' => stripslashes($_POST['f6']),
				'genre' => stripslashes($_POST['f7']),
				'style' => stripslashes($_POST['f8']),
				'format' => $_POST['f9'],
				'recordgrade' => $_POST['f10'],
				'innersleevegrade' => $_POST['f11'],
				'covergrade' => $_POST['f12'],
				'country' => stripslashes($_POST['f13']),
				'comments' => stripslashes($_POST['f14']),
				'companies' => stripslashes($_POST['f15']),
				'credits' => stripslashes($_POST['f16']),
				'tracklist' => stripslashes($_POST['f17']),
				'picture1' => rp_get_attachment_id_by_url($_POST['f18']),
				'picture2' => rp_get_attachment_id_by_url($_POST['f19']),
				'picture3' => rp_get_attachment_id_by_url($_POST['f20']),
				'picture4' => rp_get_attachment_id_by_url($_POST['f21']),
				'picture5' => rp_get_attachment_id_by_url($_POST['f22']),
				'picture6' => rp_get_attachment_id_by_url($_POST['f23']),
				'picture7' => rp_get_attachment_id_by_url($_POST['f24']),
				'picture8' => rp_get_attachment_id_by_url($_POST['f25']),
				'picture9' => rp_get_attachment_id_by_url($_POST['f26']),
				'picture10' => rp_get_attachment_id_by_url($_POST['f27']),
				'picture11' => rp_get_attachment_id_by_url($_POST['f28']),
				'picture12' => rp_get_attachment_id_by_url($_POST['f29']),
				'picture13' => rp_get_attachment_id_by_url($_POST['f30']),
				'picture14' => rp_get_attachment_id_by_url($_POST['f31']),
				'picture15' => rp_get_attachment_id_by_url($_POST['f32']),
				'quantity' => stripslashes($_POST['f33']),
				'price' => stripslashes($_POST['f34']),
				'category' => stripslashes($_POST['f35']),
				'auction' => stripslashes($_POST['f36']),
				'modification_time' => date("Y-m-d H:i:s")
				);

				$where = array(
					'id' => $_GET['id']
				);

				$format = array(
					'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',
					'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'
				);

				$success = $wpdb->update($table_name, $data, $where, $format);

				if ($success) {

				}

		}

	}

	$getid = $_GET['id'];

	global $wpdb;
	$rpdb = $wpdb->prefix . 'rp_records';
	$rpdb2 = $wpdb->prefix . 'rp_category';
	$rpdb3 = $wpdb->prefix . 'rp_grade';
	$rpdb4 = $wpdb->prefix . 'rp_settings';
	$rpdb5 = $wpdb->prefix . 'rp_format';

	$sql = "SELECT $rpdb.id, $rpdb.artist, $rpdb.recordname, $rpdb.recordnumber, $rpdb.barcode, $rpdb.label, $rpdb.released, 
	$rpdb.genre, $rpdb.style, $rpdb.format, $rpdb.recordgrade, $rpdb.innersleevegrade, $rpdb.covergrade, $rpdb.comments, $rpdb.companies, $rpdb.credits,
	$rpdb.country, $rpdb.quantity, $rpdb.tracklist, $rpdb.matrix, $rpdb.category, $rpdb.picture1, $rpdb.picture2, 
	$rpdb.picture3, $rpdb.picture4, $rpdb.picture5, $rpdb.picture6, $rpdb.picture7, $rpdb.picture8, $rpdb.picture9, 
	$rpdb.picture10, $rpdb.picture11, $rpdb.picture12, $rpdb.picture13, $rpdb.picture14, $rpdb.picture15, $rpdb.price, 
	$rpdb.auction, $rpdb4.currency, $rpdb2.cid, $rpdb2.cat, 
	rp_1.grade AS g1, rp_2.grade AS g2, rp_3.grade AS g3, $rpdb5.fid, $rpdb5.recordformat 
	FROM $rpdb, $rpdb4, $rpdb3 rp_1, $rpdb3 rp_2, $rpdb3 rp_3, $rpdb2, $rpdb5 
	WHERE $rpdb.id = $getid AND $rpdb.recordgrade = rp_1.gid AND $rpdb.innersleevegrade = rp_2.gid 
	AND $rpdb.covergrade = rp_3.gid AND $rpdb.category = $rpdb2.cid AND $rpdb.format = $rpdb5.fid";

	$results = $wpdb->get_results($sql) or die(mysql_error());

	foreach( $results as $result ) {
?>

		<!-- Start #rp-admin-wrapper -->
		<div id="rp-admin-wrapper">

	<div class="rp-header-h1">
		<div class="rp-header-h1-left">
			<span class="dashicons dashicons-edit"></span>
		</div>
		<div class="rp-header-h1-right">
			<h1><?php echo __( 'Edit record', 'recordpress' ); ?></h1>
		</div>
	</div>
	<div class="clear"></div>
			
			<hr />

<div id="rp-admin-content-box-wrapper">
<div id="rp-admin-content-box-letters">
<?php

			global $wpdb;
			$rpdb33 = $wpdb->prefix . 'rp_category';

			$sql33 = "SELECT DISTINCT LEFT(cat, 1) as letter FROM $rpdb33 ORDER BY cat ASC";
			//$sql = "SELECT * FROM $table_name WHERE cat LIKE 't%' AND catd = 1 ORDER BY cat";

			$results33 = $wpdb->get_results($sql33) or die(mysql_error());

			foreach( $results33 as $result33 ) {
?>
	<a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_view_record&cat=<?php echo urlencode(strtolower($result33->letter)); ?>" title="<?php echo __( 'Show categories by letter', 'recordpress' ); ?> <?php echo $result33->letter; ?>"><?php echo $result33->letter; ?></a>
<?php
			

}

?> 
<a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_view_record&cat=all" title="<?php echo __( 'Show all categories', 'recordpress' ); ?>"><?php echo __( 'ALL', 'recordpress' ); ?></a>
- <a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_view_single_record&id=<?php echo $_GET['id']; ?>" title="<?php echo __( 'View this record.', 'recordpress' ); ?>"><?php echo __( 'View this record', 'recordpress' ); ?></a>
</div>
		<div id="rp-admin-content-box-search">
			<form name="search" method="post" action="<?php echo admin_url(); ?>admin.php?page=rp_admin_search">
				<input name="query" type="text" value="" placeholder="<?php echo __( 'Search record...', 'recordpress' ); ?>" />
				<input type="submit" class="rp-search-button" name="txtid" value="<?php echo __( 'Search', 'recordpress' ); ?>" />
			</form>
		</div>

</div>

<hr />


		<form method="post" name="db" enctype="multipart/form-data">

			<?php echo __( 'Artist:', 'recordpress' ); ?><br />
			<input name="f1" type="text" class="rp-admin-input-field" value="<?php echo htmlspecialchars(stripslashes($result->artist)); ?>" />
			<br /><br />

			<?php echo __( 'Title:', 'recordpress' ); ?><br />
			<input name="f2" type="text" class="rp-admin-input-field" value="<?php echo htmlspecialchars(stripslashes($result->recordname)); ?>" />
			<br /><br />

			<?php echo __( 'Catalog #:', 'recordpress' ); ?><br />
			<input name="f3" type="text" class="rp-admin-input-field" value="<?php echo htmlspecialchars(stripslashes($result->recordnumber)); ?>" />
			<br /><br />

			<?php echo __( 'Barcode, matrix and other identifiers:', 'recordpress' ); ?><br />
			<textarea name="f4" id="txtcontentid" class="rp-admin-input-textfield" ><?php echo htmlspecialchars(stripslashes($result->barcode)); ?></textarea>
			<br /><br />

			<?php echo __( 'Label:', 'recordpress' ); ?><br />
			<input name="f5" type="text" class="rp-admin-input-field" value="<?php echo htmlspecialchars(stripslashes($result->label)); ?>" />
			<br /><br />

			<?php echo __( 'Released:', 'recordpress' ); ?><br />
			<input name="f6" type="text" class="rp-admin-input-field" value="<?php echo htmlspecialchars(stripslashes($result->released)); ?>" />
			<br /><br />

			<?php echo __( 'Genre:', 'recordpress' ); ?><br />
			<input name="f7" type="text" class="rp-admin-input-field" value="<?php echo htmlspecialchars(stripslashes($result->genre)); ?>" />
			<br /><br />

			<?php echo __( 'Style:', 'recordpress' ); ?><br />
			<input name="f8" type="text" class="rp-admin-input-field" value="<?php echo htmlspecialchars(stripslashes($result->style)); ?>" />
			<br /><br />

			<?php echo __( 'Format:', 'recordpress' ); ?><br />
			<select name="f9" class="rp-admin-dropdown-field">
			<option selected="selected" value="<?php echo $result->format; ?>"><?php echo __( 'Active:', 'recordpress' ); ?> <?php echo stripslashes($result->recordformat); ?></option>
				<?php

			global $wpdb;


			$sql1 = "SELECT fid, recordformat FROM $rpdb5 ORDER BY fid";
			$results1 = $wpdb->get_results($sql1) or die(mysql_error());

			foreach( $results1 as $result1 ) {

				?>

			<option value="<?php echo $result1->fid; ?>"><?php echo $result1->recordformat; ?></option>

				<?php } ?>

			</select>

			<div id="rp-add-format-container">

				<p id="rp-add-format-field"><a href="#rp-add-format-field"><span><?php echo __( 'Add format', 'recordpress' ); ?></span></a> <?php if(isset($formatadded)) { echo $formatadded; } ?><?php if (isset($empty_format)) { echo '<span class="rp-admin-error-notice">' . $empty_format . '</span>'; } ?></p>

			</div>


			<input type="submit" id="submitformat" name="submitformat_val" value="<?php echo __( 'Add format', 'recordpress' ); ?>" style="display: none;" />

			<br /><br />

			<?php echo __( 'Grade record(s):', 'recordpress' ); ?><br />
			<select name="f10" class="rp-admin-dropdown-field">
			<option selected="selected" value="<?php echo $result->recordgrade; ?>"><?php echo __( 'Active:', 'recordpress' ); ?> <?php echo $result->g1; ?></option>
				<?php


			global $wpdb;
			$sql2 = "SELECT gid, grade FROM $rpdb3 ORDER BY gid";
			$results2 = $wpdb->get_results($sql2) or die(mysql_error());

			foreach( $results2 as $result2 ) {


				?>

			<option value="<?php echo $result2->gid; ?>"><?php echo $result2->grade; ?></option>

				<?php } ?>

			</select>
			<br /><br />

			<?php echo __( 'Grade innersleeve(s):', 'recordpress' ); ?><br />
			<select name="f11" class="rp-admin-dropdown-field">
			<option selected="selected" value="<?php echo $result->innersleevegrade; ?>"><?php echo __( 'Active:', 'recordpress' ); ?> <?php echo $result->g2; ?></option>
				<?php

			global $wpdb;
			$sql3 = "SELECT gid, grade FROM $rpdb3 ORDER BY gid";
			$results3 = $wpdb->get_results($sql3) or die(mysql_error());

			foreach( $results3 as $result3 ) {


				?>

			<option value="<?php echo $result3->gid; ?>"><?php echo $result3->grade; ?></option>

				<?php } ?>

			</select>
			<br /><br />

			<?php echo __( 'Cover grade:', 'recordpress' ); ?><br />
			<select name="f12" class="rp-admin-dropdown-field">
			<option selected="selected" value="<?php echo $result->covergrade; ?>"><?php echo __( 'Active:', 'recordpress' ); ?> <?php echo $result->g3; ?></option>
				<?php

			global $wpdb;
			$sql4 = "SELECT gid, grade FROM $rpdb3 ORDER BY gid";
			$results4 = $wpdb->get_results($sql4) or die(mysql_error());

			foreach( $results4 as $result4 ) {

				?>

			<option value="<?php echo $result4->gid; ?>"><?php echo $result4->grade; ?></option>

				<?php } ?>

			</select>
			<br /><br />

			<?php echo __( 'Country:', 'recordpress' ); ?><br />
			<input name="f13" type="text" class="rp-admin-input-field" value="<?php echo htmlspecialchars(stripslashes($result->country)); ?>" />
			<br /><br />

			<?php echo __( 'Comments:', 'recordpress' ); ?><br />
			<textarea name="f14" id="txtcontentid" class="rp-admin-input-textfield" rows="20" cols="80" ><?php echo htmlspecialchars(stripslashes($result->comments)); ?></textarea>
			<br /><br />

			<?php echo __( 'Companies:', 'recordpress' ); ?><br />
			<textarea name="f15" id="txtcontentid" class="rp-admin-input-textfield" rows="20" cols="80" ><?php echo htmlspecialchars(stripslashes($result->companies)); ?></textarea>
			<br /><br />

			<?php echo __( 'Credits:', 'recordpress' ); ?><br />
			<textarea name="f16" id="txtcontentid" class="rp-admin-input-textfield" rows="20" cols="80" ><?php echo htmlspecialchars(stripslashes($result->credits)); ?></textarea>
			<br /><br />

			<?php echo __( 'Tracklist:', 'recordpress' ); ?><br />
			<textarea name="f17" id="txtcontentid" class="rp-admin-input-textfield" rows="20" cols="80" ><?php echo htmlspecialchars(stripslashes($result->tracklist)); ?></textarea>
			<br /><br />

			<?php echo __( 'Pictures:', 'recordpress' ); ?><br />
<input id="upload_image1" type="text" class="rp-admin-input-field" name="f18" value="<?php echo wp_get_attachment_url($result->picture1, 'full');?>" readonly />
<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 1', 'recordpress' ); ?>" /><span onclick="var input = upload_image1; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

<input id="upload_image2" type="text" class="rp-admin-input-field" name="f19" value="<?php echo wp_get_attachment_url($result->picture2, 'full'); ?>" readonly />
<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 2', 'recordpress' ); ?>" /><span onclick="var input = upload_image2; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

			<input id="upload_image3" class="rp-admin-input-field" type="text"  name="f20" value="<?php echo wp_get_attachment_url($result->picture3, 'full'); ?>" readonly />
			<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 3', 'recordpress' ); ?>" /><span onclick="var input = upload_image3; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

<input id="upload_image4" type="text" class="rp-admin-input-field" name="f21" value="<?php echo wp_get_attachment_url($result->picture4, 'full'); ?>" readonly />
<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 4', 'recordpress' ); ?>" /><span onclick="var input = upload_image4; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

<input id="upload_image5" type="text" class="rp-admin-input-field" name="f22" value="<?php echo wp_get_attachment_url($result->picture5, 'full'); ?>" readonly />
<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 5', 'recordpress' ); ?>" /><span onclick="var input = upload_image5; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

<input id="upload_image6" type="text" class="rp-admin-input-field" name="f23" value="<?php echo wp_get_attachment_url($result->picture6, 'full'); ?>" readonly />
<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 6', 'recordpress' ); ?>" /><span onclick="var input = upload_image6; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

<input id="upload_image7" type="text" class="rp-admin-input-field" name="f24" value="<?php echo wp_get_attachment_url($result->picture7, 'full'); ?>" readonly />
<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 7', 'recordpress' ); ?>" /><span onclick="var input = upload_image7; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

<input id="upload_image8" type="text" class="rp-admin-input-field" name="f25" value="<?php echo wp_get_attachment_url($result->picture8, 'full'); ?>" readonly />
<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 8', 'recordpress' ); ?>" /><span onclick="var input = upload_image8; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

<input id="upload_image9" type="text" class="rp-admin-input-field" name="f26" value="<?php echo wp_get_attachment_url($result->picture9, 'full'); ?>" readonly />
<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 9', 'recordpress' ); ?>" /><span onclick="var input = upload_image9; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

<input id="upload_image10" type="text" class="rp-admin-input-field" name="f27" value="<?php echo wp_get_attachment_url($result->picture10, 'full'); ?>" readonly />
<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 10', 'recordpress' ); ?>" /><span onclick="var input = upload_image10; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

<input id="upload_image11" type="text" class="rp-admin-input-field" name="f28" value="<?php echo wp_get_attachment_url($result->picture11, 'full'); ?>" readonly />
<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 11', 'recordpress' ); ?>" /><span onclick="var input = upload_image11; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

<input id="upload_image12" type="text" class="rp-admin-input-field" name="f29" value="<?php echo wp_get_attachment_url($result->picture12, 'full'); ?>" readonly />
<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 12', 'recordpress' ); ?>" /><span onclick="var input = upload_image12; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

<input id="upload_image13" type="text" class="rp-admin-input-field" name="f30" value="<?php echo wp_get_attachment_url($result->picture13, 'full'); ?>" readonly />
<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 13', 'recordpress' ); ?>" /><span onclick="var input = upload_image13; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

<input id="upload_image14" type="text" class="rp-admin-input-field" name="f31" value="<?php echo wp_get_attachment_url($result->picture14, 'full'); ?>" readonly />
<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 14', 'recordpress' ); ?>" /><span onclick="var input = upload_image14; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

<input id="upload_image15" type="text" class="rp-admin-input-field" name="f32" value="<?php echo wp_get_attachment_url($result->picture15, 'full'); ?>" readonly />
<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 15', 'recordpress' ); ?>" /><span onclick="var input = upload_image15; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

			<?php echo __( 'Quantity:', 'recordpress' ); ?><br />
			<input name="f33" type="number" class="rp-admin-input-field" value="<?php echo htmlspecialchars(stripslashes($result->quantity)); ?>" />
			<br /><br />

			<?php echo __( 'Price (in', 'recordpress' ); ?> <?php echo $result->currency; ?>):<br />
			<input name="f34" type="text" class="rp-admin-input-field" value="<?php echo htmlspecialchars(stripslashes($result->price)); ?>" />
			<br /><br />

			<?php echo __( 'Auction link:', 'recordpress' ); ?><br />
			<input name="f36" type="text" class="rp-admin-input-field" value="<?php echo htmlspecialchars(stripslashes($result->auction)); ?>" />
			<br /><br />

			<?php echo __( 'Category:', 'recordpress' ); ?><br />
			<select name="f35" class="rp-admin-dropdown-field">
			<option selected="selected" value='<?php echo $result->category; ?>'><?php echo __( 'Active:', 'recordpress' ); ?> <?php echo $result->cat; ?></option>
				<?php

			global $wpdb;
			$sql5 = "SELECT * FROM $rpdb2 ORDER BY cat";
			$results5 = $wpdb->get_results($sql5) or die(mysql_error());

			foreach( $results5 as $result5 ) {

    						
				?>

			<option value="<?php echo $result5->cid; ?>"><?php echo $result5->cat; ?></option>

				<?php } ?>

			</select>

			<div id="rp-add-category-container">

				<p id="rp-add-category-field"><a href="#rp-add-category-field"><span><?php echo __( 'Add category', 'recordpress' ); ?></span></a> <?php if(isset($categoryadded)) { echo $categoryadded; } ?><?php if (isset($empty_cat)) { echo '<span class="rp-admin-error-notice">' . $empty_cat . '</span>'; } ?></p>

			</div>


			<input type="submit" id="submitcategory" name="submitcategory_val" value="<?php echo __( 'Add category', 'recordpress' ); ?>" style="display: none;" />

			<br /><br />

			<input type="submit" name="db" value="<?php echo __( 'Update record &raquo;', 'recordpress' ); ?>" />

			</form>

			<hr />
	<div class="rp-header-h2">
		<div class="rp-header-h2-left">
			<span class="dashicons dashicons-trash"></span>
		</div>
		<div class="rp-header-h2-right">
			<h2><?php echo __( 'Delete record', 'recordpress' ); ?></h2>
		</div>
	</div>
	<div class="clear"></div>

		<form method="post" name="db" enctype="multipart/form-data">
		<input name="deleteimages" id="id" type="checkbox"><?php echo __( 'Click the checkbox to also delete images.', 'recordpress' ); ?>
		<br /><br />
			<input type="submit" name="deleterecord" value="<?php echo __( 'Delete record &raquo;', 'recordpress' ); ?>" />
		</form>

		</div>
		<!-- End #rp-admin-wrapper -->
		<?php } 
			} else { echo __( 'No record to display.', 'recordpress' ); }
		?>
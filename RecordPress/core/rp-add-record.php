

<?php

/**
 * Clean discogs entry.
 **/
function clean($string) {
	$string = str_replace(array('[', ']', 'r'), '', $string);
	return preg_replace('/["\-]/', '', $string);
}

/**
 * Insert record to databse.
 **/
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


	if(isset($_POST['updatecategoryname'])) {
		$discogsgetrecord = true;
		$url = "http://api.discogs.com/releases/" . clean($_POST['discogsid']);
	}

	if(isset($_POST['db'])) {

		$error = false;

		if (empty(htmlspecialchars($_POST['f1']))) {
			$empty_f1 = __( 'You better type in an artist name for this record.', 'recordpress' );
			$error = true;
		}

		if (empty(htmlspecialchars($_POST['f33']))) {
			$empty_f33 = __( "Quantity field can only have numbers and can't be blank.", 'recordpress' );
			$error = true;
		}

		if (!is_numeric($_POST['f33'])) {
			$empty_f33 = __( "Quantity field can only have numbers and can't be blank.", 'recordpress' );
			$error = true;
		}

		if (!empty($_POST['f34'])) {
		if (!is_numeric($_POST['f34'])) {
			$empty_f34 = __( 'Price field can only contain numbers.', 'recordpress' );
			$error = true;
		} }

		if(!$error){

			global $wpdb;
			global $post;

			$table = $wpdb->prefix . "rp_records";
			$data = array(
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
				'creation_time' => date("Y-m-d H:i:s")
			);
			$format = array(
				'%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'
			);

			$success = $wpdb->insert($table, $data, $format);

			if ($success) {

				global $wpdb;
				$rpdb = $wpdb->prefix . 'rp_records';

				$sql = "SELECT id FROM $rpdb ORDER BY id DESC LIMIT 1";

				$results = $wpdb->get_results($sql) or die(mysql_error());

				foreach( $results as $result ) {
					exit(header('Location: ' . get_admin_url(get_current_blog_id(), 'admin.php?page=rp_admin_view_single_record&id=' . $result->id . '')));
				}

			}

		}
	}
}


if (isset($discogsgetrecord)) {

	//initialize the session
	$ch = curl_init();

	//Set the User-Agent Identifier
	curl_setopt($ch, CURLOPT_USERAGENT, 'YOUR_APP_NAME_HERE/0.1 +http://your-site-here.com');

	//Set the URL of the page or file to download.
	curl_setopt($ch, CURLOPT_URL, $url);

	//Ask cURL to return the contents in a variable instead of simply echoing them
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	//Execute the curl session
	$output = curl_exec($ch);

	//close the session
	curl_close ($ch);

	/* For debugging purposes you can output ALL values from Discogs, by uncomment the line below. */
	// print_r( json_decode($output) );

	// Output from Discogs
	$discogsoutput = json_decode($output, true);
	foreach($discogsoutput as $key => $value) {

		// Artist
		if ($key == 'artists') {
			$discogsartist = $value[0]['name'];
		}

		// Recordname
		if ($key == 'title') {
			$discogstitle = $value;
		}

		// Recordnumber / catalog#
		if ($key == 'labels') {
			$discogscatalog = $value[0]['catno'];
		}

		// Label
		if ($key == 'labels') {
			$discogslabel = $value[0]['name'];
		}

		// released
		if ($key == 'released') {
			$discogsreleased = $value;
		}

		// Genres
		if ($key == 'genres') {
			$discogsgenre = $value[0];
		}

		// Style
		if ($key == 'styles') {
			$discogsstyles = join(', ', $value);
		}

		// Country - UK
		if ($key == 'country') {
			$discogscountry = $value;
		}

		// Notes
		if ($key == 'notes') {
			$discogsnotes = $value;
		}

		if ($key == 'companies') {
			//$discogsextraartists = $value;
			$len=count($value);
			for ($i=0;$i<$len;$i++) {
				//$discogsextraartists[] = $value[$i]['role'] . " " . $value[$i]['name'] . " " . $value[$i]['tracks'];
				//$discogscompanies[] = $value[$i]['name'] . " " . $value[$i]['entity_type'] . " " . $value[$i]['catno'] . " " . $value[$i]['entity_type_name'];
				$discogscompanies[] = $value[$i]['entity_type_name'] . ": " . $value[$i]['name'];
			}
		}

		if ($key == 'extraartists') {
			//$discogsextraartists = $value;
			$len=count($value);
			for ($i=0;$i<$len;$i++) {
				//$discogsextraartists[] = $value[$i]['role'] . " " . $value[$i]['name'] . " " . $value[$i]['tracks'];
				//if (isset($value[$i]['tracks'])) { $blaha[1] = "(tracks: " . $value[$i]['tracks'] . ")"; }
				$discogsextraartists[] = $value[$i]['role'] . ": " . $value[$i]['name'] . " " . $value[$i]['tracks'];
			}
		}

		// Tracklist
		if ($key == 'tracklist') {
			$len=count($value);
			for ($i=0;$i<$len;$i++) {
				$discogstracklist[] = $value[$i]['position'] . " " .  $value[$i]['title'];
			}
		}

		// Identifiers
		if ($key == 'identifiers') {
			$len=count($value);
			for ($i=0;$i<$len;$i++) {
				$identifiers[] = $value[$i]['type'] . " (" . $value[$i]['description'] . "): " . $value[$i]['value'];
			}
		}

	}
}
?>

<!-- START #rp_wrapper -->
<div id="rp-admin-wrapper">






	<h1><?php echo __( 'Add record', 'recordpress' ); ?></h1>
	<hr />

	<?php echo __( 'Add from Discogs (PRE-ALPHA):', 'recordpress' ); ?>

	<form method="post" name="db" enctype="multipart/form-data">

		<label><input name="discogsid" type="text" class="rp-admin-input-field" value="" /></label>
		<i style="color: red;"><?php echo __( 'Notice: This feature is marked as pre-alpha and may not work properly. To import a record from Discogs, insert the release-code. Example: [r5727135]. Some data like images is not imported. Please consult', 'recordpress' ); ?> <a href="http://www.recordpress.org/codex/discogs-integration/" title="<?php echo __( 'Recordpress Codex.', 'recordpress' ); ?>"><?php echo __( 'codex', 'recordpress' ); ?></a> <?php echo __( 'for further information.', 'recordpress' ); ?></i>

		<br /><br />
		<input type="submit" name="updatecategoryname" value="<?php echo __( 'Insert record &raquo;', 'recordpress' ); ?>" style="height:35px; font-size:20px;" /></label>

	</form>

	<br />
	<hr />

	<form method="post" id="campaignform" enctype="multipart/form-data" name="campaignform">

		<?php echo __( 'Artist:', 'recordpress' ); ?> <?php if (isset($empty_f1)) { echo '<span class="rp-admin-error-notice">' . $empty_f1 . '</span>'; } ?><br />
		<input name="f1" type="text" class="rp-admin-input-field" value="<?php if (isset($discogsartist)) { print_r(stripslashes($discogsartist)); } else { if (isset($_POST['f1'])) { echo stripslashes($_POST['f1']); } } ?>" />
		<br /><br />

		<?php echo __( 'Title:', 'recordpress' ); ?><br />
		<input name="f2" type="text" class="rp-admin-input-field" value="<?php if (isset($discogstitle)) { print_r(stripslashes($discogstitle)); } else { if (isset($_POST['f2'])) { echo stripslashes($_POST['f2']); } } ?>" />
		<br /><br />

		<?php echo __( 'Catalog #:', 'recordpress' ); ?><br />
		<input name="f3" type="text" class="rp-admin-input-field" value="<?php if (isset($discogscatalog)) { print_r(stripslashes($discogscatalog)); } else { if (isset($_POST['f3'])) { echo stripslashes($_POST['f3']); } } ?>" />
		<br /><br />

		<?php echo __( 'Barcode, matrix and other identifiers:', 'recordpress' ); ?><br />
		<textarea name="f4" id="txtcontentid" class="rp-admin-input-textfield" ><?php if (isset($identifiers)) { foreach($identifiers as $identifiers1) { echo stripslashes($identifiers1 . "\n"); } } else { if (isset($_POST['f4'])) { echo stripslashes($_POST['f4']); } } ?></textarea>
		<br /><br />

		<?php echo __( 'Label:', 'recordpress' ); ?><br />
		<input name="f5" type="text" class="rp-admin-input-field" value="<?php if (isset($discogslabel)) { print_r(stripslashes($discogslabel)); } else { if (isset($_POST['f5'])) { echo stripslashes($_POST['f5']); } } ?>" />
		<br /><br />

		<?php echo __( 'Released:', 'recordpress' ); ?><br />
		<input name="f6" type="text" class="rp-admin-input-field" value="<?php if (isset($discogsreleased)) { print_r(stripslashes($discogsreleased)); } else { if (isset($_POST['f6'])) { echo stripslashes($_POST['f6']); } } ?>" />
		<br /><br />

		<?php echo __( 'Genre:', 'recordpress' ); ?><br />
		<input name="f7" type="text" class="rp-admin-input-field" value="<?php if (isset($discogsgenre)) { print_r(stripslashes($discogsgenre)); } else { if (isset($_POST['f7'])) { echo stripslashes($_POST['f7']); } } ?>" />
		<br /><br />

		<?php echo __( 'Style:', 'recordpress' ); ?><br />
		<input name="f8" type="text" class="rp-admin-input-field" value="<?php if (isset($discogsstyles)) { print_r(stripslashes($discogsstyles)); } else { if (isset($_POST['f8'])) { echo stripslashes($_POST['f8']); } } ?>" />
		<br /><br />

		<?php echo __( 'Format:', 'recordpress' ); ?><br />
		<select name="f9" class="rp-admin-dropdown-field">

		<?php
			global $wpdb;
			$sql = "SELECT fid, recordformat FROM " . $wpdb->prefix . "rp_format ORDER BY fid";
			$results = $wpdb->get_results($sql) or die(mysql_error());
			foreach( $results as $result ) {
		?>

			<option value="<?php echo $result->fid; ?>"><?php echo stripslashes($result->recordformat); ?></option>

		<?php } ?>

		</select>

			<div id="rp-add-format-container">

				<p id="rp-add-format-field"><a href="#rp-add-format-field"><span><?php echo __( 'Add format', 'recordpress' ); ?></span></a> <?php if(isset($formatadded)) { echo $formatadded; } ?><?php if (isset($empty_format)) { echo '<span class="rp-admin-error-notice">' . $empty_format . '</span>'; } ?></p>

			</div>


			<input type="submit" id="submitformat" name="submitformat_val" value="<?php echo __( 'Add format', 'recordpress' ); ?>" style="display: none;" />

		<br /><br />

		<?php echo __( 'Grade record(s):', 'recordpress' ); ?><br />
		<select name="f10" class="rp-admin-dropdown-field">

		<?php
			global $wpdb;
			$sql2 = "SELECT gid, grade FROM " . $wpdb->prefix . "rp_grade ORDER BY gid";
			$results2 = $wpdb->get_results($sql2) or die(mysql_error());
			foreach( $results2 as $result2 ) {
		?>

			<option value="<?php echo $result2->gid; ?>"><?php echo $result2->grade; ?></option>

		<?php } ?>

		</select>

		<br /><br />

		<?php echo __( 'Grade innersleeve(s):', 'recordpress' ); ?><br />
		<select name="f11" class="rp-admin-dropdown-field">

		<?php
			global $wpdb;
			$sql3 = "SELECT gid, grade FROM " . $wpdb->prefix . "rp_grade ORDER BY gid";
			$results3 = $wpdb->get_results($sql3) or die(mysql_error());
			foreach( $results3 as $result3 ) {
		?>

			<option value="<?php echo $result3->gid; ?>"><?php echo $result3->grade; ?></option>

		<?php } ?>

			</select>

			<br /><br />

			<?php echo __( 'Cover grade:', 'recordpress' ); ?><br />
			<select name="f12" class="rp-admin-dropdown-field">

		<?php
			global $wpdb;
			$sql4 = "SELECT gid, grade FROM " . $wpdb->prefix . "rp_grade ORDER BY gid";
			$results4 = $wpdb->get_results($sql4) or die(mysql_error());
			foreach( $results4 as $result4 ) {
		?>

			<option value="<?php echo $result4->gid; ?>"><?php echo $result4->grade; ?></option>

		<?php } ?>

			</select>

			<br /><br />

			<?php echo __( 'Country:', 'recordpress' ); ?><br />
			<input name="f13" type="text" class="rp-admin-input-field" value="<?php if (isset($discogscountry)) { print_r(stripslashes($discogscountry)); } else { if (isset($_POST['f13'])) { echo stripslashes($_POST['f13']); } } ?>" />
			<br /><br />

			<?php echo __( 'Comments:', 'recordpress' ); ?><br />
			<textarea name="f14" id="txtcontentid" class="rp-admin-input-textfield" ><?php if (isset($discogsnotes)) { print_r(stripslashes($discogsnotes)); } else { if (isset($_POST['f14'])) { echo stripslashes($_POST['f14']); } } ?></textarea>
			<br /><br />

			<?php echo __( 'Companies:', 'recordpress' ); ?><br />
			<textarea name="f16" id="txtcontentid" class="rp-admin-input-textfield" ><?php if (isset($discogscompanies)) { foreach($discogscompanies as $discogscompanies1) { echo $discogscompanies1 . "\n"; } } else { if (isset($_POST['f15'])) { echo $_POST['f15']; } } ?></textarea>
			<br /><br />

			<?php echo __( 'Credits:', 'recordpress' ); ?><br />
			<textarea name="f16" id="txtcontentid" class="rp-admin-input-textfield" ><?php if (isset($discogsextraartists)) { foreach($discogsextraartists as $discogsextraartists1) { echo $discogsextraartists1 . "\n"; } } else { if (isset($_POST['f16'])) { echo $_POST['f16']; } } ?></textarea>
			<br /><br />

			<?php echo __( 'Tracklist:', 'recordpress' ); ?><br />
			<textarea name="f17" id="txtcontentid" class="rp-admin-input-textfield" ><?php if (isset($discogstracklist)) { foreach($discogstracklist as $discogstracklist1) { echo $discogstracklist1 . "\n"; } } else { if (isset($_POST['f17'])) { echo $_POST['f17']; } } ?></textarea>
			<br /><br />

			<?php echo __( 'Pictures:', 'recordpress' ); ?><br />
			<input id="upload_image1" class="rp-admin-input-field" type="text"  name="f18" value="<?php echo isset($upload_image1); if (isset($_POST['f18'])) { echo $_POST['f18']; } ?>" readonly />
			<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 1', 'recordpress' ); ?>" /><span onclick="var input = upload_image1; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

			<input id="upload_image2" class="rp-admin-input-field" type="text"  name="f19" value="<?php echo isset($upload_image2);?>" readonly />
			<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 2', 'recordpress' ); ?>" /><span onclick="var input = upload_image2; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

			<input id="upload_image3" class="rp-admin-input-field" type="text"  name="f20" value="<?php echo isset($upload_image3);?>" readonly />
			<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 3', 'recordpress' ); ?>" /><span onclick="var input = upload_image3; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

			<input id="upload_image4" class="rp-admin-input-field" type="text"  name="f21" value="<?php echo isset($upload_image4);?>" readonly />
			<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 4', 'recordpress' ); ?>" /><span onclick="var input = upload_image4; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

			<input id="upload_image5" class="rp-admin-input-field" type="text"  name="f22" value="<?php echo isset($upload_image5);?>" readonly />
			<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 5', 'recordpress' ); ?>" /><span onclick="var input = upload_image5; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

			<input id="upload_image6" class="rp-admin-input-field" type="text"  name="f23" value="<?php echo isset($upload_image6);?>" readonly />
			<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 6', 'recordpress' ); ?>" /><span onclick="var input = upload_image6; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

			<input id="upload_image7" class="rp-admin-input-field" type="text"  name="f24" value="<?php echo isset($upload_image7);?>" readonly />
			<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 7', 'recordpress' ); ?>" /><span onclick="var input = upload_image7; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

			<input id="upload_image8" class="rp-admin-input-field" type="text"  name="f25" value="<?php echo isset($upload_image8);?>" readonly />
			<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 8', 'recordpress' ); ?>" /><span onclick="var input = upload_image8; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

			<input id="upload_image9" class="rp-admin-input-field" type="text"  name="f26" value="<?php echo isset($upload_image9);?>" readonly />
			<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 9', 'recordpress' ); ?>" /><span onclick="var input = upload_image9; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

			<input id="upload_image10" class="rp-admin-input-field" type="text"  name="f27" value="<?php echo isset($upload_image10);?>" readonly />
			<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 10', 'recordpress' ); ?>" /><span onclick="var input = upload_image10; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

			<input id="upload_image11" class="rp-admin-input-field" type="text"  name="f28" value="<?php echo isset($upload_image11);?>" readonly />
			<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 11', 'recordpress' ); ?>" /><span onclick="var input = upload_image11; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

			<input id="upload_image12" class="rp-admin-input-field" type="text"  name="f29" value="<?php echo isset($upload_image12);?>" readonly />
			<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 12', 'recordpress' ); ?>" /><span onclick="var input = upload_image12; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

			<input id="upload_image13" class="rp-admin-input-field" type="text"  name="f30" value="<?php echo isset($upload_image13);?>" readonly />
			<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 13', 'recordpress' ); ?>" /><span onclick="var input = upload_image13; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

			<input id="upload_image14" class="rp-admin-input-field" type="text"  name="f31" value="<?php echo isset($upload_image14);?>" readonly />
			<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 14', 'recordpress' ); ?>" /><span onclick="var input = upload_image14; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

			<input id="upload_image15" class="rp-admin-input-field" type="text"  name="f32" value="<?php echo isset($upload_image15);?>" readonly />
			<input class="upload_image_button" type="button" value="<?php echo __( 'Select image 15', 'recordpress' ); ?>" /><span onclick="var input = upload_image15; input.value = ''; input.focus();" style="cursor:pointer; padding-left: 10px;"><a><?php echo __( 'Remove', 'recordpress' ); ?></a></span>
			<br /><br />

			<?php echo __( 'Quantity:', 'recordpress' ); ?> <?php if (isset($empty_f33)) { echo '<span class="rp-admin-error-notice">' . $empty_f33 . '</span>'; } else { if (isset($_POST['f33'])) { echo stripslashes($_POST['f33']); } } ?><br />
			<input name="f33" type="text" class="rp-admin-input-field" value="1" />
			<br /><br />

			<?php
				global $wpdb;
				$sql5 = "SELECT currency FROM " . $wpdb->prefix . "rp_settings";
				$results5 = $wpdb->get_results($sql5) or die(mysql_error());
				foreach( $results5 as $result5 ) {
			?>

			<?php echo __( 'Price (in', 'recordpress' ); ?> <?php echo $result5->currency; } ?>): <?php if (isset($empty_f34)) { echo '<span class="rp-admin-error-notice">' . $empty_f34 . '</span>'; } ?><br />
			<input name="f34" type="text" class="rp-admin-input-field" value="<?php if (isset($_POST['f34'])) { echo stripslashes($_POST['f34']); }?>" />
			<br /><br />

			<?php echo __( 'Auction link:', 'recordpress' ); ?><br />
			<input name="f36" type="text" class="rp-admin-input-field" value="<?php if (isset($_POST['f36'])) { echo stripslashes($_POST['f36']); } ?>" />
			<br /><br />

			<?php echo __( 'Category:', 'recordpress' ); ?><br />
			<select name="f35" class="rp-admin-dropdown-field">

			<?php


			global $wpdb;
			$sql7 = "SELECT * FROM " . $wpdb->prefix . "rp_category ORDER BY cat";
			$results7 = $wpdb->get_results($sql7) or die(mysql_error());
			foreach( $results7 as $result7 ) {
			?>

				<option <?php if (isset($_POST['f35'])) { if ($_POST['f35'] == $result7->cid) { ?>selected="selected"<?php } } else { if (isset($_GET['cat'])) { if ($_GET['cat'] == $result7->cid ) { ?>selected="selected"<?php } } } ?> value="<?php echo $result7->cid; ?>"><?php echo $result7->cat; ?></option>


			<?php } ?>

			</select>

			<div id="rp-add-category-container">

				<p id="rp-add-category-field"><a href="#rp-add-category-field"><span><?php echo __( 'Add category', 'recordpress' ); ?></span></a> <?php if(isset($categoryadded)) { echo $categoryadded; } ?><?php if (isset($empty_cat)) { echo '<span class="rp-admin-error-notice">' . $empty_cat . '</span>'; } ?></p>

			</div>


			<input type="submit" id="submitcategory" name="submitcategory_val" value="<?php echo __( 'Add category', 'recordpress' ); ?>" style="display: none;" />


			<br /><br />
			<input type="submit" name="db" value="<?php echo __( 'Add record &raquo;', 'recordpress' ); ?>" />

	</form>

</div>
<!-- END #rp_wrapper -->

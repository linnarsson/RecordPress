<?php
/**
 * Insert record to databse.
 **/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$error = false;

	global $wpdb;
	$rpdb = $wpdb->prefix . 'rp_category';

	$sql = "SELECT * FROM $rpdb";

	$results = $wpdb->get_results($sql) or die(mysql_error());

	foreach($results as $result) {

		if(strtolower(htmlspecialchars($_POST['f1'])) == strtolower(htmlspecialchars($result->cat))) {
			$categoryexists = __( 'Category already exists.', 'recordpress' );
			$error = true;
		}

	}

	if (empty(htmlspecialchars($_POST['f1']))) {
		$empty_f1 = __( 'You better type in an categoryname!', 'recordpress' );
		$error = true;
	}

	if(!$error){

		global $wpdb;
		global $post;

		$table = $wpdb->prefix . "rp_category";
		$data = array(
			'cat' => stripslashes($_POST['f1']),
			'catd' => '2',
		);
		$format = array(
			'%s',
			'%s'
		);

		$success = $wpdb->insert($table, $data, $format);

		if ($success) {

			global $wpdb;
			$rpdb = $wpdb->prefix . 'rp_category';

			$sql = "SELECT cid FROM $rpdb WHERE cat = '" . $_POST['f1'] . "'";

			$results = $wpdb->get_results($sql) or die(mysql_error());

			foreach( $results as $result ) {

				exit(header('Location: ' . get_admin_url(get_current_blog_id(), 'admin.php?page=rp_admin_view_record&cat=' . urlencode(strtolower($_POST['f1'][0])) . '&record=' . $result->cid . '')));

			}

		}

	}
}
?>

<!-- Start #rp-admin-wrapper -->
<div id="rp-admin-wrapper">

	<h1><?php echo __( 'Add category', 'recordpress' ); ?></h1>
	<hr />

	<form method="post" name="db" enctype="multipart/form-data">

		<?php echo __( 'Name your new category:', 'recordpress' ) . " "; if (isset($empty_f1)) { echo '<span class="rp-admin-error-notice">' . $empty_f1 . '</span>'; } ?><?php if (isset($categoryexists)) { echo '<span class="rp-admin-error-notice">' . $categoryexists . '</span>'; } ?><br />
		<label><input name="f1" type="text" class="rp-admin-input-field" /></label>
		<br /><br />
		<input type="submit" name="db" value="<?php echo __( 'Add category &raquo;', 'recordpress' ); ?>" style="height:35px; font-size:20px;" /></label>

	</form>

</div>
<!-- End #rp-admin-wrapper -->

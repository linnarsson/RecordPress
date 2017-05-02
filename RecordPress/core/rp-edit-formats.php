<?php
	/**
	 * Edit format.
	 **/
if (isset($_GET['id'])) { 

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$error = false;

		// Update format.
		if(isset($_POST['updateformatname'])) {

			global $wpdb;
			$rpdb = $wpdb->prefix . 'rp_format'; 

			$sql = "SELECT * FROM $rpdb";

			$results = $wpdb->get_results($sql) or die(mysql_error());

			foreach( $results as $result ) {
				if(strtolower(htmlspecialchars($_POST['f1'])) == strtolower(htmlspecialchars($result->recordformat))) {
					$formatexists = __( 'Format already exists.', 'recordpress' );
					$error = true;
				}
			}

			if (empty(htmlspecialchars($_POST['f1']))) {
				$empty_f1 = __( 'You better type in an name for the format!', 'recordpress' );
				$error = true;
			}


			if(!$error){

				global $wpdb;
				$table_name = $wpdb->prefix . "rp_format";
				$data = array(
					'recordformat' => stripslashes($_POST['f1'])
				);

				$where = array(
					'fid' => $_GET['id']
				);

				$format = array(
					'%s'
				);

				$success = $wpdb->update($table_name, $data, $where, $format);

				if ($success) {

						exit(header('Location: ' . get_admin_url(get_current_blog_id(), 'admin.php?page=rp_admin_formats')));

				}
			}

		}

		// Delete format
		if(isset($_POST['deleteformat'])) {

			global $wpdb;
			$rpdb = $wpdb->prefix . 'rp_format'; 

			$sql = "SELECT * FROM $rpdb WHERE fid = '" . $_GET['id'] . "'";

			// Issue that is temporary removed: ) or die(mysql_error()
			$results = $wpdb->get_results($sql);

			foreach( $results as $result ) {

				if($_GET['id'] == $result->format) {
					$formatexists = __( 'Format already exists.', 'recordpress' );
					$error = true;
				}
			}

			if(!$error){
				global $wpdb;
				$rpdb2 = $wpdb->prefix . "rp_format";

				$wpdb->query("DELETE FROM $rpdb2 WHERE fid = '" . $_GET['id'] . "'");
	
				header('Location: ' . get_admin_url(get_current_blog_id(), 'admin.php?page=rp_admin_view_record'));
			}

		}

	}

	global $wpdb;
	$rpdb = $wpdb->prefix . 'rp_format';

	$sql = "SELECT * FROM $rpdb WHERE fid = '" . $_GET['id'] . "'";

	$results = $wpdb->get_results($sql) or die(mysql_error());

	foreach( $results as $result ) {
?>

<!-- START #rp_wrapper -->
<div id="rp-admin-wrapper">

	<h1><?php echo __( 'Edit format', 'recordpress' ); ?></h1>
	<hr />

	<form method="post" name="db" enctype="multipart/form-data">

		<?php echo __( 'Name your new format:', 'recordpress' ); ?> <?php if (isset($empty_f1)) { echo '<span class="rp-admin-error-notice">' . $empty_f1 . '</span>'; } ?><?php if (isset($formatexists)) { echo '<span class="rp-admin-error-notice">' . $formatexists . '</span>'; } ?><br />
		<label><input name="f1" type="text" value="<?php echo htmlspecialchars(stripslashes($result->recordformat)); ?>" class="rp-admin-input-field" /></label>
		<br /><br />
		<input type="submit" name="updateformatname" value="<?php echo __( 'Update &raquo;', 'recordpress' ); ?>" style="height:35px; font-size:20px;" /></label>

	</form>
<?php } ?>
</div>
<!-- END #rp-admin-wrapper -->
<?php
	} else { echo __( 'No format to display', 'recordpress' ); }
?>
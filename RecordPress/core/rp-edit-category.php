<?php
	/**
	 * Edit category.
	 **/
if (isset($_GET['id'])) { 

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$error = false;

		// Update category.
		if(isset($_POST['updatecategoryname'])) {

			global $wpdb;
			$rpdb = $wpdb->prefix . 'rp_category'; 

			$sql = "SELECT * FROM $rpdb";

			$results = $wpdb->get_results($sql) or die(mysql_error());

			foreach( $results as $result ) {
				if(strtolower(htmlspecialchars($_POST['f1'])) == strtolower(htmlspecialchars($result->cat))) {
					$categoryexists = "Category already exists.";
					$error = true;
				}
			}

			if (empty(htmlspecialchars($_POST['f1']))) {
				$empty_f1 = "You better type in an categoryname!";
				$error = true;
			}


			if(!$error){

				global $wpdb;
				$table_name = $wpdb->prefix . "rp_category";
				$data = array(
					'cat' => stripslashes($_POST['f1'])
				);

				$where = array(
					'cid' => $_GET['id']
				);

				$format = array(
					'%s'
				);

				$success = $wpdb->update($table_name, $data, $where, $format);

				if ($success) {

					global $wpdb;
					$rpdb = $wpdb->prefix . 'rp_category';

					$sql = "SELECT * FROM $rpdb WHERE cat = '" . $_POST['f1'] . "'";

					$results = $wpdb->get_results($sql) or die(mysql_error());

					foreach( $results as $result ) {

						exit(header('Location: ' . get_admin_url(get_current_blog_id(), 'admin.php?page=rp_admin_view_record&cat=' . urlencode(strtolower($_POST['f1'][0])) . '&record=' . $result->cid . '')));

					}

				}
			}

		}

		// Delete category
		if(isset($_POST['deletecategory'])) {

			global $wpdb;
			$rpdb = $wpdb->prefix . 'rp_records'; 

			$sql = "SELECT category FROM $rpdb WHERE category = '" . $_GET['id'] . "'";

			// Issue that is temporary removed: ) or die(mysql_error()
			$results = $wpdb->get_results($sql);

			foreach( $results as $result ) {

				if($_GET['id'] == $result->category) {
					$categoryexists = "Category already exists.";
					$error = true;
				}
			}

			if(!$error){
				global $wpdb;
				$rpdb2 = $wpdb->prefix . "rp_category";

				$wpdb->query("DELETE FROM $rpdb2 WHERE cid = '" . $_GET['id'] . "'");
	
				header('Location: ' . get_admin_url(get_current_blog_id(), 'admin.php?page=rp_admin_view_record'));
			}

		}

	}

	global $wpdb;
	$rpdb = $wpdb->prefix . 'rp_category';

	$sql = "SELECT * FROM $rpdb WHERE cid = '" . $_GET['id'] . "'";

	$results = $wpdb->get_results($sql) or die(mysql_error());

	foreach( $results as $result ) {
?>

<!-- Start #rp-admin-wrapper -->
<div id="rp-admin-wrapper">

	<h1>Edit category</h1>
	<hr />

	<form method="post" name="db" enctype="multipart/form-data">

		Enter your new categoryname: <?php if (isset($empty_f1)) { echo '<span class="rp-admin-error-notice">' . $empty_f1 . '</span>'; } ?><?php if (isset($categoryexists)) { echo '<span class="rp-admin-error-notice">' . $categoryexists . '</span>'; } ?><br />
		<label><input name="f1" type="text" class="rp-admin-input-field" value="<?php echo htmlspecialchars(stripslashes($result->cat)); ?>" /></label>

		<br /><br />
		<input type="submit" name="updatecategoryname" value="Update &raquo;" style="height:35px; font-size:20px;" /></label>

	</form>
	<hr />

	<form method="post" name="db" enctype="multipart/form-data">
		<h3>Delete category <?php if (isset($categoryexists)) { echo $categoryexists; } ?></h3>

		<?php
			global $wpdb;
			$rpdb1 = $wpdb->prefix . 'rp_records'; 

			$sql1 = "SELECT category FROM $rpdb1 WHERE category = '" . $_GET['id'] . "'";

			// Issue that is temporary removed: ) or die(mysql_error()
			$results1 = $wpdb->get_results($sql1);
			$error1 = false;
			foreach( $results1 as $result1 ) {
				if($_GET['id'] === $result1->category) { $error = true;}
			}

			if(!isset($error)){

				if ($result->catd == 2) {
		?>
		<input type="submit" name="deletecategory" value="Delete &raquo;" style="height:35px; font-size:20px;" />

		<?php } else { echo "You can't delete " . htmlspecialchars(stripslashes($result->cat)) . ", only rename it."; }} else { echo "You can't delete " . htmlspecialchars(stripslashes($result->cat)) . " beacuse it has records in it."; }?>
	</form>

</div>
<!-- End #rp-admin-wrapper -->

<?php
	} } else { echo "No category to display."; }
?>
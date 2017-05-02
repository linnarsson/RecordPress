<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Change pages
	if(isset($_POST['updatedbpages'])) {

		global $wpdb;
		$table = $wpdb->prefix . "rp_settings";
		$data = array(
			'frontend_category' => $_POST['f1'],
			'frontend_record' => $_POST['f2'],
			'frontend_search' => $_POST['f3']
		);

		$where = array(
			'id' => 1
		);

		$format = array(
			'%s','%s','%s'
		);

		$success = $wpdb->update($table, $data, $where, $format);

	}

	// Update Database collation for rp_records.
	if(isset($_POST['updatedbcollation'])) {

		global $wpdb;
		$rpdb = $wpdb->prefix . "rp_category";
		$wpdb->query('ALTER TABLE '. $rpdb . ' CONVERT TO CHARACTER SET utf8mb4 COLLATE ' . $_POST['f1'] . '');

	}

	// Change currency
	if(isset($_POST['changecurrencydb'])) {

		global $wpdb;
		$table = $wpdb->prefix . "rp_settings";
		$data = array(
			'currency' => stripslashes($_POST['f1'])
		);

		$where = array(
			'id' => 1
		);

		$format = array(
			'%s'
		);

		$success = $wpdb->update($table, $data, $where, $format);

	}

	// Change userrole
	if(isset($_POST['updatedbuserrole'])) {

		global $wpdb;
		$table_name = $wpdb->prefix . "rp_settings";
		$data = array(
			'user_role' => $_POST['f1']
		);

		$where = array(
			'id' => 1
		);

		$format = array(
			'%s'
		);

		$success = $wpdb->update($table_name, $data, $where, $format);

	}

	// Change uninstall settings
	if(isset($_POST['updateduninstall'])) {

		global $wpdb;
		$table_name = $wpdb->prefix . "rp_settings";
		$data = array(
			'uninstall' => $_POST['f1']
		);

		$where = array(
			'id' => 1
		);

		$format = array(
			'%s'
		);

		$success = $wpdb->update($table_name, $data, $where, $format);

	}

}
?>

<!-- START #rp_wrapper -->
<div id="rp-admin-wrapper">

	<h1><?php echo __( 'Settings', 'recordpress' ); ?></h1>
	<hr />

	<h2><?php echo __( 'Pages', 'recordpress' ); ?></h2>

	<form method="post" name="updatedbpages" enctype="multipart/form-data">
	<?php echo __( 'Select page to display categories:', 'recordpress' ); ?>

		<select name="f1" class="rp-admin-dropdown-field">
		<?php
			global $wpdb;
			$rpdb = $wpdb->prefix . 'posts';
			$rpdb2 = $wpdb->prefix . "rp_settings";

			$sql = "SELECT t1.*, t2.* FROM $rpdb t1, $rpdb2 t2 WHERE t1.post_type = 'page'";

			$results = $wpdb->get_results($sql) or die(mysql_error());

			foreach( $results as $result ) {
		?>
			<option value="<?php echo $result->ID; ?>" <?php if ($result->ID == $result->frontend_category) { echo "selected"; } ?>><?php echo $result->post_title; ?></option>
		<?php } ?>
		</select>

		<?php echo __( 'Select page to display records:', 'recordpress' ); ?>
		<select name="f2" class="rp-admin-dropdown-field">
		<?php
			global $wpdb;
			$rpdb = $wpdb->prefix . 'posts';
			$sql = "SELECT t1.*, t2.* FROM $rpdb t1, $rpdb2 t2 WHERE t1.post_type = 'page'";

			$results = $wpdb->get_results($sql) or die(mysql_error());

			foreach( $results as $result ) {
		?>
			<option value="<?php echo $result->ID; ?>" <?php if ($result->ID == $result->frontend_record) { echo "selected"; } ?>><?php echo $result->post_title; ?></option>
		<?php } ?>
		</select>

		<?php echo __( 'Select page to search for records:', 'recordpress' ); ?>
		<select name="f3" class="rp-admin-dropdown-field">
		<?php
			global $wpdb;
			$rpdb = $wpdb->prefix . 'posts';
			$sql = "SELECT t1.*, t2.* FROM $rpdb t1, $rpdb2 t2 WHERE t1.post_type = 'page'";

			$results = $wpdb->get_results($sql) or die(mysql_error());

			foreach( $results as $result ) {
		?>
			<option value="<?php echo $result->ID; ?>" <?php if ($result->ID == $result->frontend_search) { echo "selected"; } ?>><?php echo $result->post_title; ?></option>
		<?php } ?>
		</select>

		<br /><br />
		<input type="submit" name="updatedbpages" value="<?php echo __( 'Update pages &raquo;', 'recordpress' ); ?>" style="height:35px; font-size:20px;" /></label>
	</form>

	<br />
	<hr />
	<h2><?php echo __( 'Database collation', 'recordpress' ); ?></h2>

	<?php
		global $wpdb;
		$rpdb = $wpdb->prefix . 'rp_category';
		$sql = 'SHOW FULL COLUMNS FROM ' . $rpdb . ' WHERE Field IN ("catd")';

		$results = $wpdb->get_results($sql) or die(mysql_error());

		foreach( $results as $result ) {
			echo __( 'Database collation for categories is currently set to', 'recordpress' ); echo ' <strong>' . $result->Collation . '</strong>. '; echo __( 'If you need to categorize records from a certain language, you can change it here.', 'recordpress' );
		}
	?>

	<form method="post" name="updatedbcollation" enctype="multipart/form-data">
		<select name="f1" class="rp-admin-dropdown-field">
			<option value="utf8mb4mb4_unicode_ci" <?php if ($result->Collation == "utf8mb4_general_ci") { echo "selected"; } ?>>utf8mb4 Unicode</option>
			<option value="utf8mb4_czech_ci" <?php if ($result->Collation == "utf8mb4_czech_ci") { echo "selected"; } ?>>utf8mb4 Czech</option>
			<option value="utf8mb4_danish_ci" <?php if ($result->Collation == "utf8mb4_danish_ci") { echo "selected"; } ?>>utf8mb4 Danish</option>
			<option value="utf8mb4_esperanto_ci" <?php if ($result->Collation == "utf8mb4_esperanto_ci") { echo "selected"; } ?>>utf8mb4 Esperanto</option>
			<option value="utf8mb4_estonian_ci" <?php if ($result->Collation == "utf8mb4_estonian_ci") { echo "selected"; } ?>>utf8mb4 Estonian</option>
			<option value="utf8mb4_hungarian_ci" <?php if ($result->Collation == "utf8mb4_hungarian_ci") { echo "selected"; } ?>>utf8mb4 Hungarian</option>
			<option value="utf8mb4_icelandic_ci" <?php if ($result->Collation == "utf8mb4_icelandic_ci") { echo "selected"; } ?>>utf8mb4 Icelandic</option>
			<option value="utf8mb4_latvian_ci" <?php if ($result->Collation == "utf8mb4_latvian_ci") { echo "selected"; } ?>>utf8mb4 Latvian</option>
			<option value="utf8mb4_lithuanian_ci" <?php if ($result->Collation == "utf8mb4_lithuanian_ci") { echo "selected"; } ?>>utf8mb4 Lithuanian</option>
			<option value="utf8mb4_persian_ci" <?php if ($result->Collation == "utf8mb4_persian_ci") { echo "selected"; } ?>>utf8mb4 Persian</option>
			<option value="utf8mb4_polish_ci" <?php if ($result->Collation == "utf8mb4_polish_ci") { echo "selected"; } ?>>utf8mb4 Polish</option>
			<option value="utf8mb4_roman_ci" <?php if ($result->Collation == "utf8mb4_roman_ci") { echo "selected"; } ?>>utf8mb4 Roman</option>
			<option value="utf8mb4_romanian_ci" <?php if ($result->Collation == "utf8mb4_romanian_ci") { echo "selected"; } ?>>utf8mb4 Romanian</option>
			<option value="utf8mb4_sinhala_ci" <?php if ($result->Collation == "utf8mb4_sinhala_ci") { echo "selected"; } ?>>utf8mb4 Sinhala</option>
			<option value="utf8mb4_slovak_ci" <?php if ($result->Collation == "utf8mb4_slovak_ci") { echo "selected"; } ?>>utf8mb4 Slovak</option>
			<option value="utf8mb4_slovenian_ci" <?php if ($result->Collation == "utf8mb4_slovenian_ci") { echo "selected"; } ?>>utf8mb4 Slovenian</option>
			<option value="utf8mb4_spanish_ci" <?php if ($result->Collation == "utf8mb4_spanish_ci") { echo "selected"; } ?>>utf8mb4 Spanish</option>
			<option value="utf8mb4_spanish2_ci" <?php if ($result->Collation == "utf8mb4_spanish2_ci") { echo "selected"; } ?>>utf8mb4 Spanish 2</option>
			<option value="utf8mb4_swedish_ci" <?php if ($result->Collation == "utf8mb4_swedish_ci") { echo "selected"; } ?>>utf8mb4 Swedish</option>
			<option value="utf8mb4_turkish_ci" <?php if ($result->Collation == "utf8mb4_turkish_ci") { echo "selected"; } ?>>utf8mb4 Turkish</option>
		</select>

		<br /><br />
		<input type="submit" name="updatedbcollation" value="<?php echo __( 'Update database collation &raquo;', 'recordpress' ); ?>" style="height:35px; font-size:20px;" /></label>
	</form>

	<br />
	<hr />
	<h2><?php echo __( 'Currency', 'recordpress' ); ?></h2>

	<form method="post" name="changecurrencydb" enctype="multipart/form-data">

		<?php echo __( 'Change currency:', 'recordpress' ); ?><br />
		<?php
			global $wpdb;
			$rpdb = $wpdb->prefix . 'rp_settings';
			$sql = "SELECT currency FROM $rpdb";

			$results = $wpdb->get_results($sql) or die(mysql_error());

			foreach( $results as $result ) {
		?>

		<label><input name="f1" type="text" class="rp-admin-input-field" value="<?php echo htmlspecialchars($result->currency); ?>" /></label>
		<?php } ?>

		<br /><br />
		<input type="submit" name="changecurrencydb" value="<?php echo __( 'Update currency &raquo;', 'recordpress' ); ?>" style="height:35px; font-size:20px;" /></label>

	</form>

	<br />
	<hr />
	<h2><?php echo __( 'User roles', 'recordpress' ); ?></h2>
	<?php echo __( 'Who can administrate RecordPress?', 'recordpress' ); ?>

	<?php
		global $wpdb;
		$rpdb = $wpdb->prefix . 'rp_settings';
		$sql = "SELECT * FROM $rpdb";

		$results = $wpdb->get_results($sql) or die(mysql_error());

		foreach( $results as $result ) {
	?>

	<form method="post" name="updatedbuserrole" enctype="multipart/form-data">
		<select name="f1" class="rp-admin-dropdown-field">
			<option value="subscriber" <?php if ($result->user_role == "subscriber") { echo "selected"; } ?>><?php echo __( 'Subscriber', 'recordpress' ); ?></option>
			<option value="contributor" <?php if ($result->user_role == "contributor") { echo "selected"; } ?>><?php echo __( 'Contributor', 'recordpress' ); ?></option>
			<option value="author" <?php if ($result->user_role == "author") { echo "selected"; } ?>><?php echo __( 'Author', 'recordpress' ); ?></option>
			<option value="editor" <?php if ($result->user_role == "editor") { echo "selected"; } ?>><?php echo __( 'Editor', 'recordpress' ); ?></option>
			<option value="administrator" <?php if ($result->user_role == "administrator") { echo "selected"; } ?>><?php echo __( 'Administrator', 'recordpress' ); ?></option>
		</select>
		<i><?php echo __( 'Administrators will always have access but other user roles will never have access to this settings page.', 'recordpress' ); ?></i>
		<br /><br />
		<input type="submit" name="updatedbuserrole" value="<?php echo __( 'Update user role &raquo;', 'recordpress' ); ?>" style="height:35px; font-size:20px;" /></label>
	</form>
<?php } ?>

	<br />
	<hr />
	<h2><?php echo __( 'Remove RecordPress', 'recordpress' ); ?></h2>

	<?php
		global $wpdb;
		$rpdb = $wpdb->prefix . 'rp_settings';
		$sql = "SELECT id, uninstall FROM $rpdb";

		$results = $wpdb->get_results($sql) or die(mysql_error());

		foreach( $results as $result ) {
	?>

	<form method="post" name="updateduninstall" enctype="multipart/form-data">
		<select name="f1" class="rp-admin-dropdown-field">
			<option value="1" <?php if ($result->uninstall == "1") { echo "selected"; } ?>><?php echo __( 'Keep database tables on plugin deactivation.', 'recordpress' ); ?></option>
			<option value="2" <?php if ($result->uninstall == "2") { echo "selected"; } ?>><?php echo __( 'Remove database tables on plugin deactivation.', 'recordpress' ); ?></option>
		</select>
		<i><?php echo __( 'By default RecordPress will keep database tables on plugin deactivation. If you want to completely remove RecordPress, select 
		"Remove database tables on plugin deactivation" and click on update. Then you can completely remove RecordPress from the plugin management.', 'recordpress' ); ?></i>
		<br /><br />
		<input type="submit" name="updateduninstall" value="<?php echo __( 'Update &raquo;', 'recordpress' ); ?>" style="height:35px; font-size:20px;" /></label>
	</form>
<?php } ?>

</div>
<!-- END #rp_wrapper -->

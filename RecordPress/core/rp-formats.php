<?php
/**
 * Insert record to databse.
 **/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$error = false;

	global $wpdb;
	$rpdb = $wpdb->prefix . 'rp_format';

	$sql = "SELECT * FROM $rpdb";

	$results = $wpdb->get_results($sql) or die(mysql_error());

	foreach($results as $result) {

		if(strtolower($_POST['f1']) == strtolower($result->recordformat)) {
			$categoryexists = __( 'Format already exists.', 'recordpress' );
			$error = true;
		}

	}

	if (empty(htmlspecialchars($_POST['f1']))) {
		$empty_f1 = __( 'You better type in a name for your new format!', 'recordpress' );
		$error = true;
	}

	if(!$error){

		global $wpdb;
		global $post;

		$table = $wpdb->prefix . "rp_format";
		$data = array(
			'recordformat' => stripslashes($_POST['f1']),
			'recordformatd' => '2',
		);
		$format = array(
			'%s'
		);

		$success = $wpdb->insert($table, $data, $format);

		if ($success) {

				exit(header('Location: ' . get_admin_url(get_current_blog_id(), 'admin.php?page=rp_admin_formats')));

		}

	}
}
?>

<!-- START #rp_wrapper -->
<div id="rp-admin-wrapper">

	<h1><?php echo __( 'Add format', 'recordpress' ); ?></h1>
	<hr />

	<form method="post" name="db" enctype="multipart/form-data">

		<?php echo __( 'Name your new format:', 'recordpress' ); ?> <?php if (isset($empty_f1)) { echo '<span class="rp-admin-error-notice">' . $empty_f1 . '</span>'; } ?><?php if (isset($categoryexists)) { echo '<span class="rp-admin-error-notice">' . $categoryexists . '</span>'; } ?><br />
		<label><input name="f1" type="text" class="rp-admin-input-field" /></label>
		<br /><br />
		<input type="submit" name="db" value="<?php echo __( 'Add format &raquo;', 'recordpress' ); ?>" style="height:35px; font-size:20px;" /></label>

	</form>
	<br />
	<hr />

	<h2><?php echo __( 'Manage formats', 'recordpress' ); ?></h2>
	<hr />


	<div class="rp-admin-record-wrapper">
	<?php

				global $wpdb;
				$rpdb = $wpdb->prefix . 'rp_format';
				$rpdb2 = $wpdb->prefix . 'rp_records';

$sql = "
select 
f.*, 
case  
  when r.format is not null then '1' else '2' end 
as message 
from wp_rp_format f 
left join wp_rp_records r on r.format = f.fid 
group by f.fid  ;
";

				$results = $wpdb->get_results($sql) or die(mysql_error());

				foreach( $results as $result ) {
		?>
		
			<div class="rp-admin-record-list"><?php echo stripslashes($result->recordformat); ?> - <a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_edit_formats&id=<?php echo $result->fid; ?>" title="<?php echo __( 'Rename format', 'recordpress' ); ?>"><?php echo __( 'Rename', 'recordpress' ); ?></a> <?php if ($result->message == "2") { if ($result->recordformatd == "2") { ?>- <a href="<?php echo admin_url(); ?>admin.php?page=rp_admin_delete_formats&id=<?php echo $result->fid; ?>" title="<?php echo __( 'Delete format', 'recordpress' ); ?>"><?php echo __( 'Delete', 'recordpress' ); ?></a><?php } } ?></div>
		<?php } ?>
	</div>

</div>
<!-- END #rp-admin-wrapper -->
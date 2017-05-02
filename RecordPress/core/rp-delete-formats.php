<?php
		// Delete category
		if(isset($_GET['id'])) {

				global $wpdb;
				$rpdb2 = $wpdb->prefix . "rp_format";

				$wpdb->query("DELETE FROM $rpdb2 WHERE fid = '" . $_GET['id'] . "'");
	
				header('Location: ' . get_admin_url(get_current_blog_id(), 'admin.php?page=rp_admin_formats'));


		}
?>
<?php
// Custom CSS for Admin
function add_custom_admin_styles() {

	if ( is_admin() ) {
		$file_dir=get_bloginfo('template_directory');
		wp_enqueue_style("functions", $file_dir."/functions/css/admin-styles.css", false, "1.0", "all");
	}
	
}
add_action('admin_head', 'add_custom_admin_styles');

// Custom CSS for Admin Bar on Frton End
function add_custom_adminbar_styles() {
	
	echo '<style>@import url("';
	echo  bloginfo('template_directory');
	echo '/functions/css/admin-bar-styles.css");</style>';
	
}
add_action('admin_bar_menu', 'add_custom_adminbar_styles');

?>
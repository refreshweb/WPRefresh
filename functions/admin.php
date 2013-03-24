<?php
/* Custom Admin Login Logo */
function my_custom_login_logo() { 
     echo '<style type="text/css"> h1 a { background-image:url('.get_bloginfo('template_directory').'/functions/images/custom-login-logo.jpg) !important; } </style>';}   
add_action('login_head', 'my_custom_login_logo');
// Remove Welcome to Wordpress
function hide_welcome_screen() {
    $user_id = get_current_user_id();
    if ( 1 == get_user_meta( $user_id, 'show_welcome_panel', true ) )
        update_user_meta( $user_id, 'show_welcome_panel', 0 );
}
add_action( 'load-index.php', 'hide_welcome_screen' );
// Remove the Welcome to Wordpress Checkbox
function my_custom_admin_head() {
        echo '<style>[for="wp_welcome_panel-hide"] {display: none !important;}</style>';
}
add_action('admin_head', 'my_custom_admin_head');
// Remove editor
function remove_editor_menu() {
  remove_action('admin_menu', '_add_themes_utility_last', 101);
}
add_action('_admin_menu', 'remove_editor_menu', 1);
// Remove Uneeded Dashboard Widgets
function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['acx_plugin_dashboard_widget']);
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );
// Remove "You are using wordpress %s from Right Now Widget
function remove_admin_stuff( $translated_text, $untranslated_text, $domain ) {
    $custom_field_text = 'You are using <span class="b">WordPress %s</span>.';
    if ( is_admin() && $untranslated_text === $custom_field_text ) {
        return '';
    }
    return $translated_text;
}
add_filter('gettext', 'remove_admin_stuff', 20, 3);
// Custom Admin Impact Shiznizzle Footer
function remove_footer_admin () {
	global $current_user;
    get_currentuserinfo();
    echo '&copy;';
	echo date(Y);
	echo ' | Developed by <i class="icon-repeat icon-2x impact-link" data-toggle="tooltip" title="Developed by Refresh Web Marketing"></i> Refresh Web Marketing</a> | <strong>Do You Need Support?</strong> <a href="http://refreshwebmarketing.com/website-support/?company='.get_bloginfo('name').'&website='.get_bloginfo('url').'&email='.$current_user->user_email.'&firstname='.$current_user->user_firstname.'&lastname='.$current_user->user_lastname.'" target="_blank">Click Here</a></p>';
    }
add_filter('admin_footer_text', 'remove_footer_admin'); 
// Change Admin Version Number
function my_footer_version() {
    return '<i class="icon-repeat icon-2x" data-toggle="tooltip" title="Developed by Refresh Web Marketing"></i>';
}
add_filter( 'update_footer', 'my_footer_version', 11 );
// Remove SEO Columns
add_filter( 'wpseo_use_page_analysis', '__return_false' );
// Remove the Screen Options Tab
function remove_screen_options(){
    return false;
}
add_filter('screen_options_show_screen', 'remove_screen_options');
// Remove Uneeded Links from Admin Bar
function wps_admin_bar() {
    global $wp_admin_bar;
    //$wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('about');
    $wp_admin_bar->remove_menu('wporg');
	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('themes');
	$wp_admin_bar->remove_menu('customize');
	$wp_admin_bar->remove_menu('widgets');
	$wp_admin_bar->remove_menu('menus');
    $wp_admin_bar->remove_menu('documentation');
    $wp_admin_bar->remove_menu('support-forums');
    $wp_admin_bar->remove_menu('feedback');
	//$wp_admin_bar->remove_menu('new-post');
	$wp_admin_bar->remove_menu('new-media');
	$wp_admin_bar->remove_menu('new-link');
	$wp_admin_bar->remove_menu('new-user');
    //$wp_admin_bar->remove_menu('view-site');
}
add_action( 'wp_before_admin_bar_render', 'wps_admin_bar' );
// So now let's add our own links
function my_admin_bar_link() {
	global $current_user;
    get_currentuserinfo();
	global $wp_admin_bar;
	$wp_admin_bar->add_menu( array(
	'id' => 'refresh',
	'parent' => 'wp-logo',
	'title' => __( 'Refresh Web Marketing'),
	'href' => /*admin_url*/( 'http://refreshwebmarketing.com/' )
	) );
	$wp_admin_bar->add_menu( array(
	'id' => 'refreshfeedback',
	'parent' => 'wp-logo-external',
	'title' => __( 'Feedback'),
	'href' => ( 'http://refreshwebmarketing.com/website-support/?company='.get_bloginfo('name').'&website='.get_bloginfo('url').'&email='.$current_user->user_email.'&firstname='.$current_user->user_firstname.'&lastname='.$current_user->user_lastname.'' )
	) );
	$wp_admin_bar->add_menu( array(
	'id' => 'refreshsupport',
	'parent' => 'wp-logo-external',
	'title' => __( 'Support Question'),
	'href' => ('http://refreshwebmarketing.com/website-support/?company='.get_bloginfo('name').'&website='.get_bloginfo('url').'&email='.$current_user->user_email.'&firstname='.$current_user->user_firstname.'&lastname='.$current_user->user_lastname.'')
	) );
}
add_action('admin_bar_menu', 'my_admin_bar_link');
// Replace WordPress Howdy, Per Elsie Webster
function goodbye_howdy ( $wp_admin_bar ) {
    $avatar = get_avatar( get_current_user_id(), 16 );
    if ( ! $wp_admin_bar->get_node( 'my-account' ) )
        return;
    $wp_admin_bar->add_node( array(
        'id' => 'my-account',
        'title' => sprintf( 'Logged in as, %s', wp_get_current_user()->display_name ) . $avatar,
    ) );
}
add_action( 'admin_bar_menu', 'goodbye_howdy' );
// Remove Help Tabs
function wpse50723_remove_help($old_help, $screen_id, $screen){
    $screen->remove_help_tabs();
    return $old_help;
}
add_filter( 'contextual_help', 'wpse50723_remove_help', 999, 3 );
// TinyMCE EDITOR "Biographical Info" USER PROFILE
function kpl_user_bio_visual_editor( $user ) {
	// Requires WP 3.3+ and author level capabilities
	if ( function_exists('wp_editor') && current_user_can('publish_posts') ):
	?>
	<script type="text/javascript">
	(function($){ 
		// Remove the textarea before displaying visual editor
		$('#description').parents('tr').remove();
	})(jQuery);
	</script>
 
	<table class="form-table">
		<tr>
			<th><label for="description"><?php _e('Biographical Info'); ?></label></th>
			<td>
				<?php 
				$description = get_user_meta( $user->ID, 'description', true);
				wp_editor( $description, 'description' ); 
				?>
				<p class="description"><?php _e('Share a little biographical information to fill out your profile. This may be shown publicly.'); ?></p>
			</td>
		</tr>
	</table>
	<?php
	endif;
}
add_action('show_user_profile', 'kpl_user_bio_visual_editor');
add_action('edit_user_profile', 'kpl_user_bio_visual_editor');
// Remove textarea filters from description field
function kpl_user_bio_visual_editor_unfiltered() {
	remove_all_filters('pre_user_description');
}
add_action('admin_init','kpl_user_bio_visual_editor_unfiltered');
?>
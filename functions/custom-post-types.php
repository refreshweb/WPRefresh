<?php
// * Function Reference/register post type
//   Wordpress Codex - http://codex.wordpress.org/Post_Types & http://codex.wordpress.org/Function_Reference/register_post_type
//   Custom Post Type Snippets to make you smile - http://yoast.com/custom-post-type-snippets/


// Company Info
function codex_custom_init() {
  $companylabels = array(
    'name' => 'Company Info',
    'singular_name' => 'Location',
    'add_new' => 'Add New Location',
    'add_new_item' => 'Add New Location',
    'edit_item' => 'Edit Location',
    'new_item' => 'New Location',
    'all_items' => 'Company Info',
    'view_item' => 'View Location',
    'search_items' => 'Search Locations',
    'not_found' =>  'No Locations found',
    'not_found_in_trash' => 'No Locations found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'Company Info'
  );

  $companyargs = array(
    'labels' => $companylabels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
	'show_in_menu' => 'index.php',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'company-info' ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title' )
  ); 

  register_post_type( 'company', $companyargs );
}
add_action( 'init', 'codex_custom_init' );

// Company Info Admin Columns
add_filter('manage_edit-company_columns', 'add_new_company_columns');
function add_new_company_columns($company_columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
	$new_columns['title'] = _x('Company Name');
	$new_columns['address'] = _x('Address');
	$new_columns['phone'] = _x('Phone');
	$new_columns['tollfree'] = _x('Toll Free Phone');
	$new_columns['fax'] = _x('Fax'); 
    return $new_columns;
}
// Add Column Data 
function manage_company_columns($column_name, $id) {
    global $post;
    switch ($column_name) {
	case 'address':
		echo get_post_meta( $post->ID, '_cmb_contact_address1', true );
		echo '&nbsp;';
		echo get_post_meta( $post->ID, '_cmb_contact_address2', true );
		echo '<br/>';
		echo get_post_meta( $post->ID, '_cmb_contact_city', true );
		echo ', &nbsp;';
		echo get_post_meta( $post->ID, '_cmb_contact_state', true );
		echo '&nbsp;';
		echo get_post_meta( $post->ID, '_cmb_contact_zip', true );
        break;
    case 'phone':
		echo get_post_meta( $post->ID, '_cmb_contact_phone', true );
        break;
    case 'tollfree':
		echo get_post_meta( $post->ID, '_cmb_contact_phonetf', true );
        break;
    case 'fax':
		echo get_post_meta( $post->ID, '_cmb_contact_fax', true );
        break;
    default:
        break;
    } // end switch
}  
add_action('manage_company_posts_custom_column', 'manage_company_columns', 10, 2);
 
?>
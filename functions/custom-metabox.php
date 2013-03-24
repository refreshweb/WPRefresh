<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

	// Company Information
	$meta_boxes[] = array(
		'id'         => 'contact_metabox',
		'title'      => 'Contact Information',
		'pages'      => array( 'company' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
//			array(
//				'name' => 'Address',
//				'desc' => 'Address Line 1',
//				'id'   => $prefix . 'contact_address',
//				'type' => 'address',
//			),
			array(
				'name' => 'Address',
				'desc' => 'Address Line 1',
				'id'   => $prefix . 'contact_address1',
				'type' => 'text',
			),
			array(
				'name' => '',
				'desc' => 'Address Line 2',
				'id'   => $prefix . 'contact_address2',
				'type' => 'text',
			),
			array(
				'name' => 'City',
				'desc' => 'City',
				'id'   => $prefix . 'contact_city',
				'type' => 'text_medium',
			),
			array(
				'name' => 'State',
				'desc' => 'State',
				'id'   => $prefix . 'contact_state',
				'type' => 'text_small',
			),
			array(
				'name' => 'Zip Code',
				'desc' => 'Zip Code',
				'id'   => $prefix . 'contact_zip',
				'type' => 'text_small',
			),
			array(
				'name' => 'Phone',
				'desc' => '(xxx) xxx-xxxx',
				'id'   => $prefix . 'contact_phone',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Toll Free Phone',
				'desc' => '(xxx) xxx-xxxx',
				'id'   => $prefix . 'contact_phonetf',
				'type' => 'text_medium',
			),
			array(
				'name' => 'Fax Number',
				'desc' => '(xxx) xxx-xxxx',
				'id'   => $prefix . 'contact_fax',
				'type' => 'text_medium',
			),

		),
	);
	
	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );

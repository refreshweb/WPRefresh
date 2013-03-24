<?php
// * Custom Profile Fields

// Remove Default Fields
function hide_profile_fields( $contactmethods ) {
		unset($contactmethods['aim']);
		unset($contactmethods['jabber']);
		unset($contactmethods['yim']);
		return $contactmethods;
	}
add_filter('user_contactmethods','hide_profile_fields',10,1);

// Add Fields
function add_profile_fields( $user_contactmethods ) {
		$user_contactmethods['twitter'] = 'Twitter URL';  
  		$user_contactmethods['facebook'] = 'Facebook URL';
  		$user_contactmethods['linkedin'] = 'LinkedIn URL';
		$user_contactmethods['google+'] = 'Google+ URL';
		return $user_contactmethods;
	}
	
add_filter('user_contactmethods','add_profile_fields',10,1);

?>
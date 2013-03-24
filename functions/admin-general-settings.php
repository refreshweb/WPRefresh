<?php
// Add Additional Settings to General Settings Page
$new_general_setting = new new_general_setting();
 
class new_general_setting {
    function new_general_setting( ) {
        add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
    }
    function register_fields() {
        register_setting( 'general', 'anal_code', 'esc_attr' );
        add_settings_field('anal_code', '<label for="anal_code">'.__('Google Analytics' , 'anal_code' ).'</label>' , array(&$this, 'fields_html') , 'general' );
    }
    function fields_html() {
        $value = get_option( 'anal_code', '' );
        echo '<input type="text" id="anal_code" name="anal_code" class="regular-text ltr" value="' . $value . '" placeholder="e.g. UA-XXXXXXXX-X" /><p class="description">Enter ';
		echo bloginfo('sitename');
		echo ' Google Analytics Code; <a href="https://www.google.com/analytics/" target="_blank">Visit Google Analytics</a></p>';
    }
}
?>
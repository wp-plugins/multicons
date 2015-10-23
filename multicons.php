<?php
/*
Plugin Name: Multicons
Plugin URI: http://www.doc4design.com/plugins/multicons
Description: Auto generates code for both a favicon and an apple favicon into the header of your website
Version: 4.0
Author: Doc4
Author URI: http://www.doc4design.com
*/


add_action('plugins_loaded', 'multicons_init');
 

// install the options pages
function multicons_menu_page() {
	add_options_page( __( 'Multicons', 'multicons-mulitple-favicons' ), __( 'Multicons', 'multicons-mulitple-favicons' ), 'manage_options', 'mmf', 'mmf_options_page' );
}
add_action( 'admin_menu', 'multicons_menu_page' );


// admin 
function mmf_admin_init() {
	add_settings_section( 'mmf-section', __( 'Website Favicon', 'multicons-mulitple-favicons' ), 'mmf_section_callback', 'mmf' );
	add_settings_field( 'mmf-field', __( 'Your Website Favicon', 'multicons-mulitple-favicons' ), 'mmf_field_callback', 'mmf', 'mmf-section' );
	register_setting( 'mmf-options', 'mmf-setting', 'sanitize_text_field' );
	
	add_settings_section( 'mmf-section_admin', __( 'Dashboard Favicon', 'multicons-mulitple-favicons' ), 'mmf_section_callback_admin', 'mmf' );
	add_settings_field( 'mmf-field_admin', __( 'Dashboard Favicon', 'multicons-mulitple-favicons' ), 'mmf_field_callback_admin', 'mmf', 'mmf-section_admin' );
	register_setting( 'mmf-options', 'mmf-setting-admin', 'sanitize_text_field' );

	add_settings_section( 'mmf-section-ios', __( 'Apple Touch Original Icon', 'multicons-mulitple-favicons' ), 'mmf_section_callback_ios', 'mmf' );
	add_settings_field( 'mmf-field-ios', __( 'Apple Touch Favicon', 'multicons-mulitple-favicons' ), 'mmf_field_callback_ios', 'mmf', 'mmf-section-ios' );
	register_setting( 'mmf-options', 'mmf-setting-ios', 'sanitize_text_field' );
	
	add_settings_section( 'mmf-section-iosflat', __( 'Apple Touch Precomposed Icon', 'multicons-mulitple-favicons' ), 'mmf_section_callback_iosflat', 'mmf' );
	add_settings_field( 'mmf-field-iosflat', __( 'Apple Precomposed Favicon', 'multicons-mulitple-favicons' ), 'mmf_field_callback_iosflat', 'mmf', 'mmf-section-iosflat' );
	register_setting( 'mmf-options', 'mmf-setting-iosflat', 'sanitize_text_field' );
}
add_action( 'admin_init', 'mmf_admin_init' );


function mmf_section_callback() {
    echo __( '• Upload your favicon file in .ico format to the media library and paste the link below.<br/>• Dimensions: 16 x 16 pixels or Multi-Size', 'multicons-mulitple-favicons' ); 
}

function mmf_section_callback_admin() {
    echo __( '• Upload your favicon file in .ico format to the media library and paste the link below.<br/>• Dimensions: 16 x 16 pixels or Multi-Size', 'multicons-mulitple-favicons' ); 
}

function mmf_section_callback_ios() {
    echo __( '• Upload your icon in .png format to the media library and paste the link below.<br/>• <strong>Only use one Apple Touch Icon link (Do not add a url to both Original and Precomposed)</strong><br/>• Name your Apple Touch Original Icon [apple-touch-icon.png]<br/>• Dimensions: 180 x 180 pixels', 'multicons-mulitple-favicons' ); 
}

function mmf_section_callback_iosflat() {
    echo __( '• Upload your icon in .png format to the media library and paste the link below.<br/>• <strong>Only use one Apple Touch Icon link (Do not add a url to both Original and Precomposed)</strong><br/>• Name your Apple Touch Precomposed Icon [apple-touch-icon-precomposed.png]<br/>• Dimensions: 180 x 180 pixels', 'multicons-mulitple-favicons' ); 
}


// fields
function mmf_field_callback() {
	$mmf_setting = esc_url( get_option( 'mmf-setting' ) );
	echo "<input type='text' size='60' maxlength='150' name='mmf-setting' value='$mmf_setting' /><br/><br/><br/>";
}

function mmf_field_callback_admin() {
	$mmf_setting_admin = esc_url( get_option( 'mmf-setting-admin' ) );
	echo "<input type='text' size='60' maxlength='150' name='mmf-setting-admin' value='$mmf_setting_admin' /><br/><br/><br/>";
}

function mmf_field_callback_ios() {
	$mmf_setting_ios = esc_url( get_option( 'mmf-setting-ios' ) );
	echo "<input type='text' size='60' maxlength='150' name='mmf-setting-ios' value='$mmf_setting_ios' /><br/><br/><br/>";
}

function mmf_field_callback_iosflat() {
	$mmf_setting_iosflat = esc_url( get_option( 'mmf-setting-iosflat' ) );
	echo "<input type='text' size='60' maxlength='150' name='mmf-setting-iosflat' value='$mmf_setting_iosflat' /><br/><br/><br/>";
}


// display
function mmf_options_page() {
?>
<div class="wrap"> 
	<div class="icon32"></div> 
	<h1><?php _e( 'Multicons [ Multiple Favicons ]', 'multicons-mulitple-favicons' ); ?></h1> 
	<hr>
	<form action="options.php" method="POST">
	<?php settings_fields( 'mmf-options' ); ?>
	<?php do_settings_sections( 'mmf' ); ?>
	<?php submit_button(__('Save Changes', 'multicons-mulitple-favicons')); ?>
	</form>
	<hr>
	<p><?php _e( 'Note: When no link is provided, a default favicon will be used.', 'multicons-mulitple-favicons' ); ?></p>

</div>
<?php
}


// add to the website header
function mmf_display_favicon() {
	$mmf_custom_favicon = esc_url( get_option( 'mmf-setting' ) );
	$mmf_default_favicon = plugins_url( 'images/favicon.ico', __FILE__ ); 

	if (empty( $mmf_custom_favicon )) {
		echo '<link rel="shortcut icon" href="'.$mmf_default_favicon.'" />'."\n";
	}
	else {
		echo '<link rel="shortcut icon" href="'.$mmf_custom_favicon.'" />'."\n";
	}
}
add_action( 'wp_head', 'mmf_display_favicon' );


// add to the website admin header
function mmf_display_favicon_admin() {
	$mmf_custom_favicon_admin = esc_url( get_option( 'mmf-setting-admin' ) );
	$mmf_default_favicon_admin = plugins_url( 'images/favicon.ico', __FILE__ ); 

	if (empty( $mmf_custom_favicon_admin )) {
		echo '<link rel="shortcut icon" href="'.$mmf_default_favicon_admin.'" />'."\n";
	}
	else {
		echo '<link rel="shortcut icon" href="'.$mmf_custom_favicon_admin.'" />'."\n";
	}
}
add_action( 'admin_head', 'mmf_display_favicon_admin' );


// add apple original icon to website header
function mmf_display_icon_ios() {
	$mmf_custom_icon_ios = esc_url( get_option( 'mmf-setting-ios' ) );
	$mmf_default_icon_ios = plugins_url( 'images/apple-touch-icon.png', __FILE__ ); 

	if (empty( $mmf_custom_icon_ios )) {
		echo '';
	}
	else {
		echo '<link rel="apple-touch-icon" href="'.$mmf_custom_icon_ios.'" />'."\n";
	}
}
add_action( 'wp_head', 'mmf_display_icon_ios' );


// add apple precomposed icon to website header
function mmf_display_icon_iosflat() {
	$mmf_custom_icon_iosflat = esc_url( get_option( 'mmf-setting-iosflat' ) );
	$mmf_default_icon_iosflat = plugins_url( 'images/apple-touch-icon.png', __FILE__ ); 

	if (empty( $mmf_custom_icon_iosflat )) {
		echo '<link rel="apple-touch-icon" href="'.$mmf_default_icon_iosflat.'" />'."\n";
	}
	else {
		echo '<link rel="apple-touch-icon" href="'.$mmf_custom_icon_iosflat.'" />'."\n";
	}
}
add_action( 'wp_head', 'mmf_display_icon_iosflat' );

?>
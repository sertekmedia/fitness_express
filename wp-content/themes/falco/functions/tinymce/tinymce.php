<?php

/* ----------------------------------------------------------------------------------- *
 *	WordPress uses TinyMCE version since 3.9
 * ----------------------------------------------------------------------------------- */
$wp_version = floatval( get_bloginfo( 'version' ) );
if( $wp_version < 3.9 ){
	// TinyMCE version 3 ----------------------------------
	define( 'PLUGIN_URI', LIBS_URI . '/tinymce/tinymce-3/' );
} else {
	// TinyMCE version 4 ----------------------------------
	define( 'PLUGIN_URI', LIBS_URI . '/tinymce/' );
}	
/* ----------------------------------------------------------------------------------- */

function mfn_mce_init() {
	global $page_handle;
	if ( ! current_user_can ( 'edit_posts' ) || ! current_user_can ( 'edit_pages' )) return false;
	
	if (get_user_option ( 'rich_editing' ) == 'true') {
		add_filter ( "mce_external_plugins", 'mfn_mce_plugin' );
		add_filter ( 'mce_buttons', 'mfn_mce_buttons' );
	}
}
add_action ( 'init', 'mfn_mce_init' );

function mfn_mce_plugin( $array ){
	$array ['mfnsc'] = PLUGIN_URI . 'plugin.js';
	return $array;
}

function mfn_mce_buttons( $buttons ){
	array_push ( $buttons, 'mfnsc' );	
	return $buttons;
}
?>
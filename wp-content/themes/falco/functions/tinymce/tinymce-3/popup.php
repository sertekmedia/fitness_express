<?php
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp . '/wp-load.php' );

if ( ! current_user_can('edit_pages') && ! current_user_can('edit_posts') ) 
{
	wp_die(__("You don't have permissions","mfn-opts"));
}
	
global $wpdb;
?>
<html>
<head>
<title><?php _e("Shortcode Panel","mfn-opts"); ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php echo get_option( 'blog_charset' ); ?>" />
	<script type="text/javascript" src="<?php echo get_option( 'siteurl' ) ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script type="text/javascript" src="<?php echo get_option( 'siteurl' ) ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script type="text/javascript" src="<?php echo get_option( 'siteurl' ) ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script type="text/javascript" src="<?php echo PLUGIN_URI ?>tinymce.js"></script>
	<base target="_self" />
	<style>
		body, select { font-size:12px;}
	</style>
</head>

<body onLoad="tinyMCEPopup.executeOnLoad('init();'); document.body.style.display='';">

	<form name="shortcodes" action="#" >

		<div style="height:100px;">
			<p>Insert content shortcodes.<br />For more advanced shortcodes please use <b>Muffin Builder</b>.</p>
			<?php _e("Shortcode","mfn-opts"); ?>
			<select id="shortcode" name="shortcode" style="width: 200px">
                <option value="0">-- <?php _e("select","mfn-opts"); ?> --</option>
				<?php
				
					$mfn_shortcodes = array();
				
					$mfn_shortcodes['column'] = array(
						'one' 			=> 'One Column',
						'one_second' 	=> 'One Second',
						'one_third' 	=> 'One Third',
						'two_third' 	=> 'Two Third',
						'one_fourth' 	=> 'One Fourth',
						'two_fourth' 	=> 'Two Fourth',
						'three_fourth'	=> 'Three Fourth',
					);

					$mfn_shortcodes['content'] = array(
						'blockquote' 	=> 'Blockquote',
						'button' 		=> 'Button',
						'code' 			=> 'Code',
						'divider' 		=> 'Divider',
						'highlight'		=> 'Highlight',
						'ico' 			=> 'Ico',
						'icon_list'		=> 'Icon List',
						'image' 		=> 'Image',
						'table' 		=> 'Table',
						'vimeo' 		=> 'Vimeo',
						'youtube' 		=> 'YouTube',
					);
					
					foreach( $mfn_shortcodes as $k_sc_group => $sc_group ){
						echo '<option value="0">---------- '. $k_sc_group .' shortcodes ----------</option>';
						
						foreach( $sc_group as $key => $value ) {
							echo '<option value="'. $key .'" >'. $value .'</option>'."\n";
						}
					
					}
						
				?>
            </select>
		</div>

		<div class="mceActionPanel">
			<div style="float: left">
				<input type="button" id="cancel" name="cancel" value="<?php _e("Cancel","mfn-opts"); ?>" onClick="tinyMCEPopup.close();" />
			</div>
	
			<div style="float: right">
				<input type="submit" id="insert" name="insert" value="<?php _e("Insert","mfn-opts"); ?>" onClick="mfn_mce_submit();" />
			</div>
		</div>
	
	</form>
</body>
</html>
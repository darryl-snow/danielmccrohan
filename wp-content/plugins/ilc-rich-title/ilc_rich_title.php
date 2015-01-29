<?php
/*
Plugin Name: ILC Rich Title
Plugin URI: http://ilovecolors.com.ar/wordpress-plugin-enabling-tinymce-for-the-title/
Description: Enables Tiny MCE for the title while editing a post. Uses <a href="http://www.jquery.com" target="_blank">jQuery</a> library on admin interface.
Version: 1.0
Author: Elliot
Author URI: http://ilovecolors.com.ar/
*/
//Init plugin, enqueue jquery on admin_head and call function to add TinyMCE editor to the title
function ilc_rich_title() {
	global $editing;
	//Continue if the user has rich editing capabilities
	if ( !( $editing && user_can_richedit() ) ) return;
	//enqueue jquery script
	wp_enqueue_script('jquery');
	//let's rock n roll
	ilc_add_editor_to_title();
}
// Add the class 'mceEditor' to the title edit area in order to enable TinyMCE for the title
function ilc_add_editor_to_title() {
	?>
	<script type="text/javascript">
	/* <![CDATA[ */
		jQuery(document).ready( function () { 
			jQuery("#title").addClass("mceEditor"); 
			if ( typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function" ) {
				jQuery("#title").wrap( "<div id='editorcontainertitle'></div>" ); 
				tinyMCE.execCommand("mceAddControl", false, "title");
			}
		}); 
	/* ]]> */
	</script>
	<?php ilc_title_editor_css(); //time for a bit of style
}
//Some css so that the Title rich editing field looks like the Post editing field, without margin and padding.
function ilc_title_editor_css() {
	?>
	<style type='text/css'>
		#titlediv h3			{ margin-bottom:0; }
		#poststuff #titlewrap	{ padding:0 !important; }
	</style>
	<?php
}
//Plugin start
add_action('admin_head', 'ilc_rich_title');
//Run wpautop on the Title on edit the post to display paragraphs correctly
add_filter('edit_post_title', 'wpautop');
//Run wpautop on the Title on the rendered post to display paragraphs correctly
add_filter('the_title', 'wpautop');
?>
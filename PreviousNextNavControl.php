<?php
   /*
   Plugin Name: PreviousNextNavControl
   Plugin URI: http://blogcelerator.com
   Description: a plugin that controls 
   Version: 1.0
   Author: Joshua Jones
   Author URI: http://joshbjones.com
   License: GPL2
   */
   
   /*
   Runs during plugin activation
   */
   register_activation_hook(__FILE__,'PreviousNextNavControl.php');
   
   function Sort_Previous_Nav(){
	if(is_single()){
		global $post;
		$prev_posts = previous_post_link('<span class="prev">%link</span>', '<em class="arrow">&laquo;</em> %title', $in_same_cat, '353');
		if
	}
   }
   
   function Sort_Next_Nav(){
	if(is_single()){
		global $post;
		$next_posts = next_post_link('<span class="next">%link</span>', '<em class="arrow">&raquo;</em> %title', $in_same_cat, '353');
		if
	}
   }
   
   add_action("previous_post_link", "Sort_Previous_Nav");   
   add_action("next_post_link", "Sort_Next_Nav");

   /* 
   Runs during plugin deactivation
   */
	register_deactivation_hook( __FILE__, 'PreviousNextNaveControl.php' );
?>
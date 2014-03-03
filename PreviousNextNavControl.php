<?php
   /*
   Plugin Name: PreviousNextNavControl
   Plugin URI: http://blogcelerator.com
   Description: a plugin that controls Previous and Next Page links at the bottom of posts
   Version: 1.0
   Author: Joshua Jones
   Author URI: http://joshbjones.com
   License: GPL2
   */
   
   /*
   Runs during plugin activation
   register_activation_hook(__FILE__,'PreviousNext_Install');
   
   function PreviousNext_Install(){
   
   }
      */
	  
      /* 
   Runs during plugin deactivation

	register_deactivation_hook( __FILE__, 'PreviousNext_Uninstall' );
	
	function PreviousNext_Uninstall(){
	
	}
	   */
   function Sort_Previous_Nav(){
	/*if(is_single()){*/
		$prev_posts = previous_post_link('<span class="prev">%link</span>', '<em class="arrow">&laquo;</em> %title', $in_same_cat, '353');
	/*}*/
   }
   
   function Sort_Next_Nav(){
	/*if(is_single()){*/
		$next_posts = next_post_link('<span class="next">%link</span>', '<em class="arrow">&raquo;</em> %title', $in_same_cat, '353');
	/*}*/
   }
   
   add_action("previous_post_link", "Sort_Previous_Nav");   
   add_action("next_post_link", "Sort_Next_Nav");
?>
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

if (!class_exists("PreviousNextNavControl")) { 
    class PreviousNextNavControl { 
        function PreviousNextNavControl() { 
		//constructor 
        } 
		function addHeaderCode() { 
			<?php 
			<!-- Devlounge Was Here --> 
			?> 
		}
		function addContent($content = '') { 
            $content .= "<p>Devlounge Was Here</p>"; 
            return $content; 
        } 
    }  
} 
//End Class PreviousNextNavControl 

if (class_exists("PreviousNextNavControl")) { 
    $dl_PreviousNext = new PreviousNextNavControl(); 
} 

//Actions and Filters    
if (isset($dl_PreviousNext)) { 
    //Actions 
	add_action('wp_head', array(&$dl_PreviousNext, 'addHeaderCode'), 1);
    //Filters
	add_filter('the_content', array(&$dl_PreviousNext, 'addContent')); 	
}
?>
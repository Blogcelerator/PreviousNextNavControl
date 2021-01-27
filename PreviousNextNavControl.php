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
			?>
			<!-- Devlounge Was Here -->
			<?php
		}
		function addContent($content = '') { 
            $content .= "<p>Devlounge Was Here</p>"; 
            return $content; 
        } 
		var $adminOptionsName = "PreviousNextNavControlAdminOptions";		
		function getAdminOptions() { 
            $PreviousNextAdminOptions = array('show_header' => 'true', 
                'add_content' => 'true',  
                'comment_author' => 'true',  
                'content' => ''); 
            $PreviousNextOptions = get_option($this->adminOptionsName); 
            if (!empty($PreviousNextOptions)) { 
                foreach ($PreviousNextOptions as $key => $option)  
                    $PreviousNextAdminOptions[$key] = $option; 
            }                
            update_option($this->adminOptionsName, $PreviousNextAdminOptions); 
            return $PreviousNextAdminOptions; 
        }
		function init() { 
            $this->getAdminOptions(); 
        }
//Prints out the admin page 
        function printAdminPage() { 
                    $PreviousNextOptions = $this->getAdminOptions(); 
                                          
                    if (isset($_POST['update_PreviousNextNavControlSettings'])) {  
                        if (isset($_POST['PreviousNextHeader'])) { 
                            $PreviousNextOptions['show_header'] = $_POST['PreviousNextHeader']; 
                        }    
                        if (isset($_POST['PreviousNextAddContent'])) { 
                            $PreviousNextOptions['add_content'] = $_POST['PreviousNextAddContent']; 
                        }    
                        if (isset($_POST['PreviousNextAuthor'])) {  
                            $PreviousNextOptions['comment_author'] = $_POST['PreviousNextAuthor']; 
                        }    
                        if (isset($_POST['PreviousNextContent'])) { 
                            $PreviousNextOptions['content'] = apply_filters('content_save_pre', $_POST['PreviousNextContent']); 
                        } 
                        update_option($this->adminOptionsName, $PreviousNextOptions); 
                          
                        ?> 
<div class="updated"><p><strong><?php _e("Settings Updated.", "PreviousNextNavControl");?></strong></p></div> 
                    <?php 
                    } ?> 

						<div class=wrap> 
						<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>"> 
						<h2>Previous Next Navigation Control</h2> 
						<h3>Content to Add to the End of a Post</h3> 
						<textarea name="PreviousNextContent" style="width: 80%; height: 100px;"><?php _e(apply_filters('format_to_edit',$PreviousNextOptions['content']), 'PreviousNextNavControl') ?></textarea> 
						<h3>Allow Comment Code in the Header?</h3> 
						<p>Selecting "No" will disable the comment code inserted in the header.</p> 
						<p><label for="PreviousNextHeader_yes"><input type="radio" id="PreviousNextHeader_yes" name="PreviousNextHeader" value="true" <?php if ($PreviousNextOptions['show_header'] == "true") { _e('checked="checked"', "PreviousNextNavControl"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="PreviousNextHeader_no"><input type="radio" id="PreviousNextHeader_no" name="PreviousNextHeader" value="false" <?php if ($PreviousNextOptions['show_header'] == "false") { _e('checked="checked"', "PreviousNextNavControl"); }?>/> No</label></p> 

						<h3>Allow Content Added to the End of a Post?</h3> 
						<p>Selecting "No" will disable the content from being added into the end of a post.</p>  
						<p><label for="PreviousNextAddContent_yes"><input type="radio" id="PreviousNextAddContent_yes" name="PreviousNextAddContent" value="true" <?php if ($PreviousNextOptions['add_content'] == "true") { _e('checked="checked"', "PreviousNextNavControl"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="PreviousNextAddContent_no"><input type="radio" id="PreviousNextAddContent_no" name="PreviousNextAddContent" value="false" <?php if ($PreviousNextOptions['add_content'] == "false") { _e('checked="checked"', "PreviousNextNavControl"); }?>/> No</label></p> 
						  
						<h3>Allow Comment Authors to be Uppercase?</h3> 
						<p>Selecting "No" will leave the comment authors alone.</p>  
						<p><label for="PreviousNextAuthor_yes"><input type="radio" id="PreviousNextAuthor_yes" name="PreviousNextAuthor" value="true" <?php if ($PreviousNextOptions['comment_author'] == "true") { _e('checked="checked"', "PreviousNextNavControl"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="PreviousNextAuthor_no"><input type="radio" id="PreviousNextAuthor_no" name="PreviousNextAuthor" value="false" <?php if ($PreviousNextOptions['comment_author'] == "false") { _e('checked="checked"', "PreviousNextNavControl"); }?>/> No</label></p> 
						 
						<div class="submit"> 
						<input type="submit" name="update_PreviousNextNavControl" value="<?php _e('Update Settings', 'PreviousNextNavControl') ?>" /></div> 
						</form> 
						 </div> 
                    <?php 
                }
				//End function printAdminPage()				
	} 
}
//End Class PreviousNextNavControl 
if (class_exists("PreviousNextNavControl")) { 
	$dl_PreviousNext = new PreviousNextNavControl(); 
} 		

//Initialize the admin panel 
if (!function_exists("PreviousNextNavControl_ap")) { 
	function PreviousNextNavControl_ap() { 
		global $dl_PreviousNext; 
		if (!isset($dl_PreviousNext)) { 
			return; 
		} 
		if (function_exists('add_options_page')) { 
	add_options_page('Previous Next Navigation Control', 'Previous Next Navigation Control', 9, basename(__FILE__), array(&$dl_PreviousNext, 'printAdminPage')); 
		} 
	}    
} 

//Actions and Filters    
if (isset($dl_PreviousNext)) { 
    //Actions 
	add_action('wp_head', array(&$dl_PreviousNext, 'addHeaderCode'), 1);
	add_action('PreviousNextNavControl/PreviousNextNavControl.php',  array(&$PreviousNext, 'init'));
	add_action('admin_menu', 'PreviousNextNavControl_ap');
    //Filters
	add_filter('the_content', array(&$dl_PreviousNext, 'addContent')); 	
}
?>
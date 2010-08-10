<?php
/*
Plugin Name: Multicons
Plugin URI: http://www.doc4design.com/plugins/multicons
Description: Auto generates code for both a favicon and an apple favicon into the header of your website
Version: 1.0
Author: Doc4
Author URI: http://www.doc4design.com
*/

/******************************************************************************

Copyright 2010  Doc4 : info@doc4design.com

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
The license is also available at http://www.gnu.org/copyleft/gpl.html

*********************************************************************************/


$ver= '1.0';

$gfile = dirname(__FILE__) . '/multicons.php';
if(file_exists($gfile)){
unlink($gfile);
}

function personal_setup_menu() {
	if (function_exists('current_user_can')) {
		if (!current_user_can('manage_options')) return;
	} else {
		global $user_level;
		get_currentuserinfo();
		if ($user_level < 8) return;
	}
	if (function_exists('add_options_page')) {
		add_options_page(__('Multicons'), __('Multicons'), 1, __FILE__, 'personal_setup_page');
	}
} 

// Install the options page
add_action('admin_menu', 'personal_setup_menu');

function personal_setup_page(){
	global $wpdb;
	if (isset($_POST['update'])) {
	    $options['global_url'] = trim($_POST['global_url'],'{}');
		$options['admin_url'] = trim($_POST['admin_url'],'{}');
	    $options['iphone_url'] = trim($_POST['iphone_url'],'{}');
		
		update_option('fav_url_option', $options);
		// Show a message to indicate something has happened
		echo '<div class="updated"><p>' . __('Options saved') . '</p></div>';
	} else {
		
		$options = get_option('fav_url_option');
	}
	
	?>
		
     <!-- Favion Settings -->
     <div class="wrap">
     <div class="icon32" id="icon-options-general"><br/></div><h2><?php echo __('Multicons [ Multiple Favicons ] Quick Setup'); ?></h2>

	 <form method="post" action="">
     
     <h3><?php echo __('Website Favicon'); ?></h3>
     
     <table class="form-table"><tbody>
     
     <tr><th scope="row"><?php _e('Favicon URL') ?></th>
	 <td><label><input name="global_url" type="text" id="global_url" value="<?php echo $options['global_url']; ?>" size="60" /></label><br/>
	 <?php printf(__('Indicate the absolute path to the Favicon image.<br />
					   Example: <em>http://www.yoursite.com/favicon.ico</em>')); ?>
	 </td></tr>
     
     </tbody>
     </table>
     
     
     <h3><?php echo __('Dashboard Favicon'); ?></h3>
     
     <table class="form-table"><tbody>
     
     <tr><th scope="row"><?php _e('Dashboard Favicon URL') ?></th>
	 <td><label><input name="admin_url" type="text" id="admin_url" value="<?php echo $options['admin_url']; ?>" size="60" /></label><br/>
	 <?php printf(__('Indicate the absolute path to the Admin Favicon image.<br />
	                   Example: <em>http://www.yoursite.com/wp-content/favicon.ico</em>')); ?>
	 </td></tr>
     
     <tr><th scope="row"><?php _e('Instructions') ?></th>
	 <td>
	 <?php printf(__('1. Name your Favicon [favicon.ico]<br />
	                   2. Place the Favicon image file in the root dirctory of your website. [same location as wp-content]<br />
	                   3. Name your Admin Favicon [favicon.icon] Defaults to Favicon image if not specified.<br />
					   4. Place the Admin Favicon image file in the wp-content folder of your website.')); ?>
     
     </tbody>
     </table>
     
     
     <h3><?php echo __('Apple Touch Icon'); ?></h3>
     
     <table class="form-table"><tbody>
     
     <tr><th scope="row"><?php _e('Apple Touch Icon URL') ?></th>
	 <td><label><input name="iphone_url" type="text" id="iphone_url" value="<?php echo $options['iphone_url']; ?>" size="60" /></label><br/>
	 <?php printf(__('Indicate the absolute path to the Apple Touch Icon image.<br />
	                   Example: <em>http://www.yoursite.com/apple-touch-icon.png</em>')); ?>
	 </td></tr>
     
     <tr><th scope="row"><?php _e('Instructions') ?></th>
	 <td>
	 <?php printf(__('1. Name your Apple Touch Icon [apple-touch-icon.png]<br />
	                   2. Place the Apple Touch Icon image file in the root dirctory of your website. [same location as wp-content]<br />
					   3. Rounded corners are automatically applied by Apple devices searching for this icon.')); ?>
	 </td></tr>
     
     </tbody>
     </table>
	
     <p class="submit">
	 <input name="update" class="button-primary" value="<?php echo _e('Save Changes');?>" type="submit" />
	 </p>

     </form> 
		       		
	 </div>

	       
	 <?php }
			   
            function GlobalFavicon() {
			$options = get_option('fav_url_option');
            
			 if(empty($options['global_url'])){
			 echo "";
			 } else {
			 echo"<link rel=\"shortcut icon\" href=\"$options[global_url]\" />
			      <link rel=\"icon\" type=\"image/png\" href=\"$options[global_url]\" />";
			 }
            } 
			add_action('wp_head', 'GlobalFavicon');
			

            function Dashboardfavicon() {
            $options = get_option('fav_url_option');
			 // Decide what to do if the dashboard option is empty
			 if(empty($options['admin_url'])){
			   $options = get_option('fav_url_option');
			   echo"<link rel=\"shortcut icon\" href=\"$options[global_url]\" />";
			 } else {
			 echo"<link rel=\"shortcut icon\" href=\"$options[admin_url]\" />";
			 }
            }
            add_action('admin_head', 'Dashboardfavicon');
			
			
			function iPhonefavicon() {
            $options = get_option('fav_url_option');
			
			 if(empty($options['iphone_url'])){
			 echo "";
			 } else {
			 echo"<link rel=\"apple-touch-icon\" href=\"$options[iphone_url]\" />";
			 }
            }
            add_action('wp_head', 'iPhonefavicon');
			
			

		   
		   ?>
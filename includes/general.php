<?php

//Abstracted function for retrieving specific options inside option arrays
if(!function_exists('ctsc_get_option')){
	function ctsc_get_option($option_name = '', $option_array = 'ctsc_settings'){
		$option_list_name = $option_array;
		
		$option_list = get_option($option_list_name, false);
		
		$option_value = '';
		//If options exists and is not empty, get value
		if($option_list && isset($option_list[$option_name]) && (is_bool($option_list[$option_name]) === true || $option_list[$option_name] !== '')){
			$option_value = $option_list[$option_name];
		}
		
		//If option is empty, check whether it needs a default value
		if($option_value === '' || !isset($option_list[$option_name])){
			$options = ctsc_metadata_settings();
			//If option cannot be empty, use default value
			if(!isset($options[$option_name]['empty'])){
				if(isset($options[$option_name]['default'])){
					$option_value = $options[$option_name]['default'];
				}
			//If it can be empty but not set, use default value
			}elseif(!isset($option_list[$option_name])){
				if(isset($options[$option_name]['default'])){
					$option_value = $options[$option_name]['default'];
				}
			}
		}
		return $option_value;
	}
}

//Abstracted function for updating specific options inside arrays
if(!function_exists('ctsc_update_option')){
	function ctsc_update_option($option_name, $option_value, $option_array = 'ctsc_settings'){
		$option_list_name = $option_array;
		$option_list = get_option($option_list_name, false);
		if(!$option_list)
			$option_list = array();
		$option_list[$option_name] = $option_value;
		if(update_option($option_list_name, $option_list))
			return true;
		else
			return false;
	}
}


//Custom function to do some cleanup on nested shortcodes
//Used for columns and layout-related shortcodes
function ctsc_do_shortcode($content){ 
	$content = do_shortcode(shortcode_unautop($content)); 
	$content = preg_replace('#^<\/p>|^<br\s?\/?>|<p>$|<p>\s*(&nbsp;)?\s*<\/p>#', '', $content);
	return $content;
}


//Retrieves and returns the shortcode prefix with a trailing underscore
function ctsc_shortcode_prefix(){ 
	$prefix = ctsc_get_option('shortcode_prefix'); 
	if($prefix != '') $prefix = esc_attr($prefix).'_';
	return $prefix;
}


//Returns the appropriate URL, either from a string or a post ID
function ctsc_image_url($id, $size = 'full'){ 
	$url = '';
	if(is_numeric($id)){
		$url = wp_get_attachment_image_src($id, $size);
		$url = $url[0];
	}else{
		$url = $id;
	}
	return $url;
}


//Changes the brighness of a HEX color
if(!function_exists('ctsc_alter_brightness')){
	function ctsc_alter_brightness($colourstr, $steps) {
		$colourstr = str_replace('#','',$colourstr);
		$rhex = substr($colourstr,0,2);
		$ghex = substr($colourstr,2,2);
		$bhex = substr($colourstr,4,2);

		$r = hexdec($rhex);
		$g = hexdec($ghex);
		$b = hexdec($bhex);

		$r = max(0,min(255,$r + $steps));
		$g = max(0,min(255,$g + $steps));  
		$b = max(0,min(255,$b + $steps));
	  
		$r = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
		$g = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);  
		$b = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
		return '#'.$r.$g.$b;
	}
}

//Notice display and dismissal
if(!function_exists('ctsc_admin_notice_control')){
	add_action('admin_init', 'ctsc_admin_notice_control');
	function ctsc_admin_notice_control(){
		//Display a notice
		if(isset($_GET['ctsc-display']) && $_GET['ctsc-display'] != ''){
			ctsc_update_option(htmlentities($_GET['ctsc-display']), 'display');
			wp_redirect(remove_query_arg('ctsc-display'));
		}
		//Dismiss a notice
		if(isset($_GET['ctsc-dismiss']) && $_GET['ctsc-dismiss'] != ''){
			ctsc_update_option(htmlentities($_GET['ctsc-dismiss']), 'dismissed');
			wp_redirect(remove_query_arg('ctsc-dismiss'));
		}
	}
}
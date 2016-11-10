<?php 

//Define customizer sections
if(!function_exists('ctsc_metadata_sections')){
	function ctsc_metadata_sections(){
		$data = array();
		
		$data['ctsc_shortcodes'] = array(
		'label' => __('Shortcodes', 'ctsc'),
		'description' => __('Configure the behavior of shortcodes.', 'ctsc'));
		
		
		return apply_filters('ctsc_metadata_sections', $data);
	}
}


//Settings
if(!function_exists('ctsc_metadata_settings')){
	function ctsc_metadata_settings($std = null){
		$data = array();
		
		$data['shortcode_prefix'] = array(
		'label' => __('Shortcode Prefix', 'ctsc'),
		'description' => __('Specifies a prefix for all shortcodes, so that you may avoid possible conflicts when installing themes or other plugins. If using a prefix, an underscore (_) will be used as a separator.', 'ctsc'),
		'section' => 'ctsc_shortcodes',
		'empty' => true,
		'default' => 'ct',
		'type' => 'text');
		
		return apply_filters('ctsc_metadata_settings', $data);
	}
}
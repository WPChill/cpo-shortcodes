<?php 

/* Google Map Shortcode */
if(!function_exists('ctsc_shortcode_map')){
	function ctsc_shortcode_map($atts, $content = null){
		wp_enqueue_script('ctsc-core');
		wp_enqueue_style('ctsc-shortcodes');
		$attributes = extract(shortcode_atts(array(
		'color' => '', 
		'height' => '400', 
		'latitude' => '', 
		'longitude' => '',
		'id' => '',
		'class' => '',
		'animation' => ''
		),
		$atts));
		
		//Set values
		$element_class = ' '.$class;
		$element_id = $id != '' ? ' id="'.$id.'"' : '';
		
		//Entrace effects and delay
		if($animation != ''){
			wp_enqueue_script('ctsc-waypoints');
			wp_enqueue_script('ctsc-core');			
			$element_class .= ' ctsc-animation ctsc-animation-'.$animation;
		}
		
		wp_enqueue_script('google-map', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array(), false, true);
		$output = '<div class="ctsc-map '.$element_class.'" '.$element_id.' data-lat="'.$latitude.'" data-lng="'.$longitude.'" data-color="'.$color.'" style="height:'.$height.'px"></div>';		
		return $output;
	}
	add_shortcode(ctsc_shortcode_prefix().'map', 'ctsc_shortcode_map');
}
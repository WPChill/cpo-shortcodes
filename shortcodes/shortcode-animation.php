<?php 

/* Area/Region Shortcode */
if(!function_exists('ctsc_shortcode_area')){
	function ctsc_shortcode_area($atts, $content = null){
		wp_enqueue_script('ctsc-waypoints');
		wp_enqueue_script('ctsc-core');
		wp_enqueue_style('ctsc-shortcodes');
		
		$attributes = extract(shortcode_atts(array(
		'delay' => '', 
		'animation' => ''), $atts));		
		
		wp_enqueue_script('ctsc_waypoints');
		
		if($animation != '') $animation = ' ctsc-animation-'.$animation;
		if($delay != '') $delay = ' data-delay="'.$delay.'"';
		
		$output = '';
		$output .= '<div class="ctsc-animation ctsc-animation'.$animation.'"'.$delay.'>';
		$output .= ctsc_do_shortcode($content);
		$output .= '</div>';
		return $output;		
	}
	add_shortcode(ctsc_shortcode_prefix().'area', 'ctsc_shortcode_area');
	add_shortcode(ctsc_shortcode_prefix().'animation', 'ctsc_shortcode_area');
}
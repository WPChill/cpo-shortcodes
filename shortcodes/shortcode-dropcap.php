<?php 

/* Dropcap Shortcode */
if(!function_exists('ctsc_shortcode_dropcap')){
	function ctsc_shortcode_dropcap($atts, $content = null){
		wp_enqueue_style('ctsc-shortcodes');
		$attributes = extract(shortcode_atts(array(
		'title' => '',
		'style' => '',
		'color' => ''), $atts));
		
		$title = trim(strip_tags($title));
		$color = trim(strip_tags($color));
		$style = trim(strip_tags($style));
		$content = trim(strip_tags($content));
		
		
		$random_id = rand();

		$output = '';
		
		if($style != '') $color_property = 'background-'; else $color_property = '';
		if($color != '') 
			$output .= '<style>.ctsc-dropcap-'.$random_id.' { '.$color_property.'color:'.$color.'; }</style>';
		
		$output .= '<span class="ctsc-dropcap ctsc-dropcap-'.$random_id.' ctsc-dropcap-'.$style.'">'.$content.'</span>';
		
		return $output;
	}
	add_shortcode(ctsc_shortcode_prefix().'dropcap', 'ctsc_shortcode_dropcap');
}
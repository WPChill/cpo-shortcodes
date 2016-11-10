<?php 

/* Counter Shortcode */
if(!function_exists('ctsc_shortcode_counter')){
	function ctsc_shortcode_counter($atts, $content = null){
		wp_enqueue_style('ctsc-fontawesome');
		wp_enqueue_style('ctsc-shortcodes');
		$attributes = extract(shortcode_atts(array(
		'title' => '',
		'size' => '',
		'icon' => '',
		'color' => '',
		'number' => '',
		'id' => '',
		'class' => '',
		'animation' => ''
		), 
		$atts));
		
		//Set values
		$element_title = esc_attr($title);
		$element_icon = esc_attr($icon);
		$element_number = esc_attr($number);
		$element_size = ' ctsc-counter-'.esc_attr($size);
		$element_color = '';
		$element_class = ' '.$class;
		$element_id = $id != '' ? ' id="'.$id.'"' : '';
		
		//Has icon class
		if($icon != '')
			$element_class .= ' counter-has-icon';
		
		//Icon Color
		if($color != '') 
			$element_color = ' style = "color:'.$color.';"';
		
		//Entrace effects and delay
		if($animation != ''){
			wp_enqueue_script('ctsc-waypoints');
			wp_enqueue_script('ctsc-core');			
			$element_class .= ' ctsc-animation ctsc-animation-'.$animation;
		}
		
		//Element Styling
		$output = '<div class="ctsc-counter'.$element_size.$element_class.'"'.$element_id.'>';
		if($element_icon != '') 
			$output .= '<div class="ctsc-counter-icon icon-'.$element_icon.'"'.$element_color.'></div>';
		$output .= '<div class="ctsc-counter-body">';
		$output .= '<div class="ctsc-counter-number">'.$element_number.'</div>';
		$output .= '<div class="ctsc-counter-title">'.$element_title.'</div>';
		$output .= '</div>';		
		$output .= '</div>';		
		return $output;
	}
	add_shortcode(ctsc_shortcode_prefix().'counter', 'ctsc_shortcode_counter');
}
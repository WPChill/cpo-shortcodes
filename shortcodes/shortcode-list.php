<?php 

/* List Shortcode */
if(!function_exists('ctsc_shortcode_list')){
	function ctsc_shortcode_list($atts, $content = null){
		wp_enqueue_style('ctsc-fontawesome');
		wp_enqueue_style('ctsc-shortcodes');
		$attributes = extract(shortcode_atts(array(
		'icon' => '',
		'style' => 'square',
		'background' => 'gray',
		'gradient' => '',
		'color' => 'white',
		'id' => '',
		'class' => '',
		'animation' => ''
		), 
		$atts));
		
		//Set values
		$element_icon = esc_attr($icon);
		$element_style = ' ctsc-list-'.esc_attr($style);
		$element_color = esc_attr($color);
		$element_class = ' '.$class;
		$element_id = $id != '' ? ' id="'.$id.'"' : '';
		
		
		//Background color -- if gradient is set, add it as well
		if($background != ''){
			$element_background = ' background:'.$background.';';
			if($gradient != ''){
				$element_background .= '
				background:-moz-linear-gradient(top, '.$background.' 0%, '.$gradient.' 100%);
				background:-webkit-linear-gradient(top, '.$background.' 0%, '.$gradient.' 100%); 
				background:linear-gradient(to bottom, '.$background.' 0%, '.$gradient.' 100%);
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$background.'\', endColorstr=\''.$gradient.'\',GradientType=0);';
			}
		}
		
		//Text color
		if($color != '')
			$element_color = ' color:'.$color.';';
		
		//Entrace effects and delay
		if($animation != ''){
			wp_enqueue_script('ctsc-waypoints');
			wp_enqueue_script('ctsc-core');			
			$element_class .= ' ctsc-animation ctsc-animation-'.$animation;
		}
			
		$icon_style = ' style="'.$element_background.$element_color.'"';	
		
		$output = '<div class="ctsc-list'.$element_style.$element_class.'"'.$element_id.'>';
		if($element_icon != '') 
			$output .= '<span class="ctsc-list-icon icon-'.$element_icon.'"'.$icon_style.'></span>';
		$output .= ctsc_do_shortcode($content);
		$output .= '</div>';
				
		return $output;
	}
	add_shortcode(ctsc_shortcode_prefix().'list', 'ctsc_shortcode_list');
}
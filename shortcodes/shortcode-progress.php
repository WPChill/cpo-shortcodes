<?php 


/* Progress Bar Shortcode */
if(!function_exists('ctsc_shortcode_bar')){
	function ctsc_shortcode_bar($atts, $content = null){
		wp_enqueue_script('ctsc-waypoints');
		wp_enqueue_script('ctsc-core');
		wp_enqueue_style('ctsc-fontawesome');
		wp_enqueue_style('ctsc-shortcodes');
		
		$attributes = extract(shortcode_atts(array(
		'style' => '',
		'title' => '',
		'value' => '100',
		'size' => '',
		'icon' => '',
		'color' => 'white',
		'background' => 'green',
		'gradient' => '',
		'direction' => '',
		'id' => '',
		'class' => '',
		'animation' => ''
		), 
		$atts));
		wp_enqueue_script('ctsc_waypoints');
		
		//Set values
		$element_size = ' ctsc-progress-'.trim(strip_tags($size));
		$element_background = '';
		$element_color = '';
		$element_content = esc_attr($content);
		$element_direction = $direction != '' ? ' ctsc-progress-'.trim(strip_tags($direction)) : '';
		$element_class = ' '.$class;
		$element_id = $id != '' ? ' id="'.$id.'"' : '';
		
		//Background color -- if gradient is set, add it as well
		if($background != ''){
			$element_background = ' background:'.$background.';';
			if($gradient != ''){
				$gradient_direction = 'left';
				$gradient_direction_old = 'to right';
				if($direction == 'left'){
					$gradient_direction = 'right';
					$gradient_direction_old = 'to left';
				}
				$element_background .= '
				background:-moz-linear-gradient('.$gradient_direction.', '.$background.' 0%, '.$gradient.' 100%);
				background:-webkit-linear-gradient('.$gradient_direction.', '.$background.' 0%, '.$gradient.' 100%); 
				background:linear-gradient('.$gradient_direction_old.', '.$background.' 0%, '.$gradient.' 100%);
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
		
		//Progress bar values
		$value = htmlentities($value);
		if($value < 0) $value = 0;
		if($value > 100) $value = 100;
		
		//Bar icon
		if($icon != '') $icon = '<span class="bar-icon icon-'.htmlentities($icon).'"></span> ';
		
		$element_style = ' style="'.$element_color.'"';
		$bar_style = ' style="'.$element_background.$element_color.'"';
		
		$output = '';
		$output .= '<div class="ctsc-progress'.$element_direction.$element_size.' '.$element_class.'"'.$element_style.$element_id.'>';
		$output .= '<div class="bar-content" data-value="'.$value.'"'.$bar_style.'>';
		if($title != '') $output .= '<div class="bar-title">'.$icon.' '.$title.'</div>';
		$output .= '</div>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode(ctsc_shortcode_prefix().'progress', 'ctsc_shortcode_bar');
}
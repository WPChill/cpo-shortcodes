<?php 

/* Section Shortcode */
if(!function_exists('ctsc_shortcode_section')){
	function ctsc_shortcode_section($atts, $content = null){
		wp_enqueue_script('ctsc-core');
		wp_enqueue_style('ctsc-shortcodes');
		
		$attributes = extract(shortcode_atts(array(
		'title' => '', 
		'subtitle' => '', 
		'background' => '', 
		'gradient' => '', 
		'video' => '', 
		'image' => '', 
		'color' => '', 
		'position' => '', 
		'padding' => '',
		'id' => '',
		'class' => '',
		'animation' => ''
		), $atts));				
		
		//Set values
		$element_background = '';
		$element_gradient = '';
		$element_content = $content;
		$element_position = ' ctsc-section-'.$position;
		$element_color = ' ctsc-'.$color;
		$element_class = ' '.$class;
		$element_id = $id != '' ? ' id="'.$id.'"' : '';
		
		
		//Parallax scrolling
		/*$parallax_data = '';
		if($position == 'parallax'){
			//wp_enqueue_script('ctsc_skrollr');
			$parallax_data = ' data-bottom-top="background-position:center 100%;" data-top-bottom="background-position:center 0;"';
		}*/
		
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
		
		//Background Image
		$element_image = '';
		if($image != '') {
			$element_image = ' background-image:url('.ctsc_image_url($image).');';
		}
		
		//Section Content Styles
		if($padding != ''){
			$padding = str_replace('px', '', $padding);
			$element_padding = ' padding-top:'.$padding.'px; padding-bottom:'.$padding.'px;';
		}
		
		//Entrace effects and delay
		$anim_class = '';
		if($animation != ''){
			wp_enqueue_script('ctsc-waypoints');
			wp_enqueue_script('ctsc-core');			
			$anim_class = ' ctsc-animation ctsc-animation-'.$animation;
		}
		
		$background_style = ' style="'.$element_background.$element_image.'"';
		$element_style = ' style="'.$element_padding.'"';
		
		
		//Output section
		$output = '';
		$output .= '<div class="ctsc-section '.$element_class.$element_position.$element_color.'" '.$element_style.'>';
		//Section output
		if($video != ''){
			$output .= '<div class="ctsc-section-video">';
			$output .= '<video width="640" height="360" muted="muted" loop="loop" autoplay="autoplay">';
			$output .= '<source type="video/mp4" src="'.esc_url($video).'"></source>';
			$output .= '</video>';
			$output .= '</div>';
		} 
		$output .= '<div class="ctsc-section-background"'.$background_style.'></div>';
		$output .= '<div class="ctsc-section-content '.$anim_class.'">';
		if($title != ''){
			$output .= '<div class="ctsc-section-heading">';
			$output .= '<h2 class="ctsc-section-title">'.$title.'</h2>';
			if($subtitle != '') 
				$output .= '<div class="ctsc-section-subtitle">'.$subtitle.'</div>';
			$output .= '</div>';
		}
		$output .= ctsc_do_shortcode($element_content);
		$output .= '<div class="ctsc-clear"></div>';
		$output .= '</div>';
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode(ctsc_shortcode_prefix().'section', 'ctsc_shortcode_section');
}
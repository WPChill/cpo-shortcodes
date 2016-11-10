<?php 

/* Testimonial Shortcode */
if(!function_exists('ctsc_shortcode_testimonial')){
	function ctsc_shortcode_testimonial($atts, $content = null){
		wp_enqueue_style('ctsc-shortcodes');
		$attributes = extract(shortcode_atts(array(
		'name' => '(No Name)', 
		'image' => '', 
		'style' => 'left', 
		'title' => '',
		'id' => '',
		'class' => '',
		'animation' => ''),
		$atts));
		
		$element_class = ' '.$class;
		$element_style = ' ctsc-testimonial-'.$style;
		$element_id = $id != '' ? ' id="'.$id.'"' : '';
		$content = trim($content);
		$element_name = esc_attr($name);
		$element_title = esc_attr($title);
		$element_image = esc_url($image);
		
		if($element_style != '')
			$element_class .= $element_style;
		
		if($image == '')
			$element_class .= ' ctsc-testimonial-noimage';
		
		//Entrace effects and delay
		if($animation != ''){
			wp_enqueue_script('ctsc-waypoints');
			wp_enqueue_script('ctsc-core');			
			$element_class .= ' ctsc-animation ctsc-animation-'.$animation;
		}
		
		$output = '<div class="ctsc-testimonial'.$element_class.'"'.$element_id.'>';
		$output .= '<div class="ctsc-testimonial-content">';
		$output .= $content;
		$output .= '</div>';
		if($image != '') $output .= '<img src="'.ctsc_image_url($image, 'thumbnail').'" class="ctsc-testimonial-image">';
		$output .= '<div class="ctsc-testimonial-meta">';
		$output .= '<div class="ctsc-testimonial-name">'.$element_name.'</div>';
		if($element_title != '')
			$output .= '<span class="ctsc-testimonial-title">'.$element_title.'</span>';
		$output .= '</div>';
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode(ctsc_shortcode_prefix().'testimonial', 'ctsc_shortcode_testimonial');
}
<?php 
/* Definition Lists Shortcode */
if(!function_exists('ctsc_shortcode_definition')){
	function ctsc_shortcode_definition($atts, $content = null){
		wp_enqueue_style('ctsc-shortcodes');
		$attributes = extract(shortcode_atts(array(
		'title' => '',
		'id' => '',
		'class' => '',
		'animation' => '' 
		),
		$atts));
		
		//Set values
		$element_title = esc_attr($title);
		$element_class = $class;
		$element_id = $id != '' ? ' id="'.$id.'"' : '';
		$content = ctsc_do_shortcode($content);
		
		//Entrace effects and delay
		if($animation != ''){
			wp_enqueue_script('ctsc-waypoints');
			wp_enqueue_script('ctsc-core');			
			$element_class .= ' ctsc-animation ctsc-animation-'.$animation;
		}
		
		$output = '<dl class="ctsc-definition'.$element_class.'"'.$element_id.'>';
		$output .= '<dt class="ctsc-definition-term">'.$element_title.'</dt>';
		$output .= '<dd class="ctsc-definition-description">'.$content.'</dd>';
		$output .= '</dl>';
		
		return $output;
	}
	add_shortcode(ctsc_shortcode_prefix().'definition', 'ctsc_shortcode_definition');
}
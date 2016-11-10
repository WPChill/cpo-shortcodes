<?php 

/* Optin Shortcode */
if(!function_exists('ctsc_shortcode_optin')){
	function ctsc_shortcode_optin($atts, $content = null){
		wp_enqueue_style('ctsc-fontawesome');
		wp_enqueue_style('ctsc-shortcodes');
		
		$attributes = extract(shortcode_atts(array(
		'url' => '',
		'email' => 'Email',
		'firstname' => 'Name',
		'lastname' => '',
		'captcha' => '',
		'submit' => 'Subscribe',
		'style' => '',
		'size' => '',
		'id' => '',
		'class' => '',
		'animation' => ''
		), 
		$atts));
		
		//Set values
		$element_style = ' ctsc-optin-'.$style;
		$element_size = ' ctsc-optin-'.$size;
		$element_url = esc_url($url);
		$element_class = ' '.$class;
		$element_id = $id != '' ? ' id="'.$id.'"' : '';
		
		
		//Entrace effects and delay
		if($animation != ''){
			wp_enqueue_script('ctsc-waypoints');
			wp_enqueue_script('ctsc-core');			
			$element_class .= ' ctsc-animation ctsc-animation-'.$animation;
		}
		
		$class_field = '';
		$class_submit = '';
		if($style == 'horizontal'){
			$fields = 2;
			if($firstname != '') $fields++;
			if($lastname != '') $fields++;
			$class_field = ' ctsc-column ctsc-column-narrow ctsc-col'.$fields;
			$class_submit = ' ctsc-column ctsc-column-narrow ctsc-col-last ctsc-col'.$fields;
		}
		
		$output = '';
		$output .= '<form method="post" target="_blank" action="'.$element_url.'" class="ctsc-optin'.$element_class.$element_style.$element_size.'" '.$element_id.'>';
		$output .= '<div class="ctsc-optin-field'.$class_field.'"><input type="email" value="" name="EMAIL" placeholder="'.esc_attr($email).'" class="ctsc-optin-email"></div>';
		if($firstname != '') $output .= '<div class="ctsc-optin-field'.$class_field.'"><input type="text" value="" placeholder="'.esc_attr($firstname).'" name="FNAME" class="ctsc-optin-fname"></div>';
		if($lastname != '') $output .= '<div class="ctsc-optin-field'.$class_field.'"><input type="text" value="" placeholder="'.esc_attr($lastname).'" name="FNAME" class="ctsc-optin-field ctsc-optin-lname '.$class_field.'"></div>';
		if($captcha != '') $output .= '<div style="position:absolute; left:-5000px;"><input type="text" name="'.esc_attr($captcha).'" tabindex="-1" value=""></div>';
		$output .= '<div class="ctsc-optin-submit'.$class_submit.'"><input type="submit" value="'.esc_attr($submit).'" name="subscribe"></div>';
		$output .= '</form>';		
		return $output;
	}
	add_shortcode(ctsc_shortcode_prefix().'optin', 'ctsc_shortcode_optin');
}
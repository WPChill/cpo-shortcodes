<?php 

/* Button Shortcode */
if(!function_exists('ctsc_shortcode_login')){
	function ctsc_shortcode_login($atts, $content = null){
		wp_enqueue_style('ctsc-shortcodes');
		$attributes = extract(shortcode_atts(array(
		'redirect' => '',
		'username' => __('Username', 'ctsc'),
		'password' => __('Password', 'ctsc'),
		'remember' => __('Remember Me', 'ctsc'),
		'login' => __('Log In', 'ctsc'),
		'id' => '',
		'class' => '',
		'animation' => ''
		), 
		$atts));
		
		//Set values
		$element_content = esc_attr($content);
		$element_class = ' '.$class;
		$element_id = $id != '' ? ' id="'.$id.'"' : '';
		
		//Entrance effects and delay
		if($animation != ''){
			wp_enqueue_script('ctsc-waypoints');
			wp_enqueue_script('ctsc-core');			
			$element_class .= ' ctsc-animation ctsc-animation-'.$animation;
		}
		
		$output = '';
		$output .= '<div class="ctsc-login"'.$element_id.'>';
		
		if(!is_user_logged_in()){
			$args = array(
			'echo' => false,
			'label_username' => esc_attr($username),
			'label_password' => esc_attr($password),
			'label_remember' => esc_attr($remember),
			'label_log_in' => esc_attr($login));
			if($redirect != '') $args['redirect'] = esc_url($redirect);
			$output = wp_login_form($args);
			$output .= '<a href="'.wp_lostpassword_url().'" class="ctsc-login-lostpassword">'.__('I lost my password').'</a>';

		}else{
			$output .= '<div class="ctsc-login-content">'.ctsc_do_shortcode($content).'</div>';
		}
		
		$output .= '</div>';		
		return $output;
	}
	add_shortcode(ctsc_shortcode_prefix().'login', 'ctsc_shortcode_login');
}
<?php 

/* Button Shortcode */
if(!function_exists('ctsc_shortcode_register')){
	function ctsc_shortcode_register($atts, $content = null){
		wp_enqueue_style('ctsc-shortcodes');
		$attributes = extract(shortcode_atts(array(
		'redirect' => '',
		'firstname' => __('First Name', 'ctsc'),
		'email' => __('Email', 'ctsc'),
		'username' => __('Username', 'ctsc'),
		'password' => __('Password', 'ctsc'),
		'submit' => __('Create Account', 'ctsc'),
		'id' => '',
		'class' => '',
		'animation' => ''
		), 
		$atts));
		
		//Set values
		$element_redirect = esc_url($redirect);
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
		$output .= '<div class="ctsc-register"'.$element_id.'>';
		
		if(!is_user_logged_in()){
				
			//If form has been sent, there must be an error
			if(isset($_POST['ctsc-register-submit'])){
				$error_message = isset($_POST['ctsc-register-error']) ? esc_html($_POST['ctsc-register-error']) : false;
				if($error_message){
					wp_enqueue_style('ctsc-fontawesome');
					$output .= '<div class="ctsc-message ctsc-message-error">'.$error_message.'</div>';
				}
			}
		
			$output .= '<form method="post" name="ctsc-register-form" class="ctsc-register-form">';
			$output .= '<input type="hidden" name="ctsc-register-redirect" value="'.esc_attr($redirect).'">';
			$output .= '<input type="hidden" name="ctsc-register-check" value="">';
			
			//Username
			$field_username = isset($_POST['ctsc-register-username']) ? $_POST['ctsc-register-username'] : '';
			$output .= '<div class="ctsc-register-field">';
			$output .= '<input type="text" class="ctsc-register-username" name="ctsc-register-username" value="'.esc_attr($field_username).'" placeholder="'.esc_attr($username).'" required>';
			$output .= '</div>';
			
			//Email
			$field_email = isset($_POST['ctsc-register-email']) ? $_POST['ctsc-register-email'] : '';
			$output .= '<div class="ctsc-register-field">';
			$output .= '<input type="text" class="ctsc-register-email" name="ctsc-register-email" value="'.esc_attr($field_email).'" placeholder="'.esc_attr($email).'" required>';
			$output .= '</div>';
			
			//First Name
			if($firstname != ''){
				$field_firstname = isset($_POST['ctsc-register-firstname']) ? $_POST['ctsc-register-firstname'] : '';
				$output .= '<div class="ctsc-register-field">';
				$output .= '<input type="text" class="ctsc-register-username" name="ctsc-register-firstname" value="'.esc_attr($field_firstname).'" placeholder="'.esc_attr($firstname).'" required>';
				$output .= '</div>';
			}
			
			//Password
			$field_password = isset($_POST['ctsc-register-password']) ? $_POST['ctsc-register-password'] : '';
			$output .= '<div class="ctsc-register-field">';
			$output .= '<input type="password" class="ctsc-register-password" name="ctsc-register-password" value="'.esc_attr($field_password).'" placeholder="'.esc_attr($password).'" required>';
			$output .= '</div>';
			
			//Submit
			if($submit == '') $submit = 'Create Account';
			$output .= '<div class="ctsc-register-field">';
			$output .= '<input type="submit" class="ctsc-register-submit" name="ctsc-register-submit" value="'.esc_attr($submit).'">';
			$output .= '</div>';
			
			$output .= '</form>';

		}else{
			$output .= '<div class="ctsc-register-content">'.ctsc_do_shortcode($content).'</div>';
		}
		
		$output .= '</div>';		
		return $output;
	}
	add_shortcode(ctsc_shortcode_prefix().'register', 'ctsc_shortcode_register');
}


//Process register
add_action('init', 'ctsc_register_new_user');
function ctsc_register_new_user(){
    $error = false;
	if(isset($_POST['ctsc-register-submit'])){
		//Validate all fields
		$field_username = isset($_POST['ctsc-register-username']) ? esc_attr($_POST['ctsc-register-username']) : false;
		$field_email = isset($_POST['ctsc-register-email']) ? esc_attr($_POST['ctsc-register-email']) : false;
		$field_firstname = isset($_POST['ctsc-register-firstname']) ? esc_attr($_POST['ctsc-register-firstname']) : false;
		$field_password = isset($_POST['ctsc-register-password']) ? esc_attr($_POST['ctsc-register-password']) : false;
		$field_captcha = isset($_POST['ctsc-register-check']) ? esc_attr($_POST['ctsc-register-check']) : false;
		$field_redirect = isset($_POST['ctsc-register-redirect']) ? esc_url($_POST['ctsc-register-redirect']) : false;
		
		
		//Validate Required Fields
		if(!$field_username || !$field_email || !$field_password || $field_captcha){
			$error = __('All fields are required.', 'ctsc');
		} 
		
		//Validate Optional Fields
		elseif($field_firstname !== false && $field_firstname == ''){
			$error = __('All fields are required.', 'ctsc');
		} 
		
		//Validate email address
		elseif(!filter_var($field_email, FILTER_VALIDATE_EMAIL)){
			$error = __('Please enter a valid email address.', 'ctsc');
		} 
		
		
		//If validation is ok, attempt to register user
		if(!$error){
			$args = array(
			'user_email' => $field_email,
			'user_login' => $field_username,
			'user_pass' => $field_password);
			
			if($field_firstname !== false){
				$args['first_name'] = $field_firstname;
			}
			
			$registered_id = wp_insert_user($args);
			
			//If user has been registered, proceed to insert metadata
			if(is_wp_error($registered_id)){
				$error = $registered_id->get_error_message();
			}else{
				
				//Sign user on
				$credentials['user_login'] = $field_email;
				$credentials['user_password'] = $field_password;
				$credentials['remember'] = true;
				$user = wp_signon($credentials, false);
				wp_set_current_user($registered_id);
				wp_set_auth_cookie($registered_id, 0, 0);

				//Redirect to success page
				if($field_redirect){
					$redirect_url = add_query_arg(array('ctsc-register' => 'ok'), $field_redirect);
				}else{
					$redirect_url = add_query_arg(array('ctsc-register' => 'ok'));
				}
				wp_redirect($redirect_url);
				exit();
			}
		}
		
		if($error){
			$_POST['ctsc-register-error'] = $error;
		}
	} 
}
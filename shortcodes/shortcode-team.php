<?php 

/* Team Member Shortcode */
if(!function_exists('ctsc_shortcode_team')){
	function ctsc_shortcode_team($atts, $content = null){
		wp_enqueue_style('ctsc-shortcodes');
		$attributes = extract(shortcode_atts(array(
		'name' => '(No Name)', 
		'image' => '', 
		'title' => '', 
		'facebook' => '', 
		'twitter' => '', 
		'gplus' => '', 
		'linkedin' => '', 
		'pinterest' => '', 
		'tumblr' => '', 
		'web' => '', 
		'state' => '',
		'email' => '',
		'phone' => '',
		'cellphone' => '',
		'fax' => '',
		'id' => '',
		'class' => '',
		'animation' => ''),
		$atts));
		
		$content = ctsc_do_shortcode($content);
		$element_name = esc_attr($name);
		$element_class = ' '.$class;
		$title = esc_attr($title);
		$element_id = $id != '' ? ' id="'.$id.'"' : '';
		
		//Entrace effects and delay
		if($animation != ''){
			wp_enqueue_script('ctsc-waypoints');
			wp_enqueue_script('ctsc-core');			
			$element_class .= ' ctsc-animation ctsc-animation-'.$animation;
		}
				
		if($image == '')
			$element_class .= ' ctsc-team-noimage';
			
		$output = '<div class="ctsc-team '.$element_class.'"'.$element_id.'>';
		if($image != ''){
			$output .= '<div class="ctsc-team-image">';
			$output .= '<img src="'.ctsc_image_url($image).'">';
			$output .= '</div>';
		}
		$output .= '<div class="ctsc-team-body">';
		
		$output .= '<h4 class="ctsc-team-name">'.$element_name.'</h4>';
		if($title != '') $output .= "<span class='ctsc-team-title'>$title</span>";
		$output .= '<div class="ctsc-team-content">'.$content.'</div>';
		
		$output .= '<div class="ctsc-team-social">';
		if($web != '') $output .= "<a target='_blank' class='ctsc-team-web' href='$web'></a>";
		if($facebook != '') $output .= "<a target='_blank' class='ctsc-team-facebook' href='$facebook'></a>";
		if($twitter != '') $output .= "<a target='_blank' class='ctsc-team-twitter' href='$twitter'></a>";
		if($gplus != '') $output .= "<a target='_blank' class='ctsc-team-google-plus' href='$gplus'></a>";
		if($linkedin != '') $output .= "<a target='_blank' class='ctsc-team-linkedin' href='$linkedin'></a>";
		if($pinterest != '') $output .= "<a target='_blank' class='ctsc-team-pinterest' href='$pinterest'></a>";
		if($tumblr != '') $output .= "<a target='_blank' class='ctsc-team-tumblr' href='$tumblr'></a>";
		$output .= '</div>';
		
		$output .= '<div class="ctsc-team-meta">';
		if($email != '') $output .= "<span class='ctsc-team-link ctsc-team-email'><a href='mailto:$email'>$email</a></span>";
		if($phone != '') $output .= "<span class='ctsc-team-link ctsc-team-phone'>$phone</span>";
		if($cellphone != '') $output .= "<span class='ctsc-team-link ctsc-team-cellphone'>$cellphone</span>";
		if($fax != '') $output .= "<span class='ctsc-team-link ctsc-team-fax'>$fax</span>";
		$output .= '</div>';
		
		$output .= '</div>';
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode(ctsc_shortcode_prefix().'team', 'ctsc_shortcode_team');
}
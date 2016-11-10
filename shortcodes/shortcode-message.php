<?php 


/* Message Shortcode */
if(!function_exists('ctsc_shortcode_message')){
	function ctsc_shortcode_message($atts, $content = null){
		wp_enqueue_style('ctsc-fontawesome');
		wp_enqueue_style('ctsc-shortcodes');
		
		$attributes = extract(shortcode_atts(array(
			'type' => ''), 
			$atts));
		
		$content = trim(strip_tags($content));	
		$type = trim(strip_tags($type));
		switch($type){
			case 'ok': $type = 'ctsc-message-ok'; break;
			case 'error': $type = 'ctsc-message-error'; break;
			case 'warning': $type = 'ctsc-message-warn'; break;
			case 'info': $type = 'ctsc-message-info'; break;
			default: $type = ''; break;
		}
		
		return '<span class="ctsc-message '.$type.'">'.$content.'</span>';
	}
	add_shortcode(ctsc_shortcode_prefix().'message', 'ctsc_shortcode_message');
}
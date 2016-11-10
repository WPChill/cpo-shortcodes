<?php

/* Clearing Shortcode */
if(!function_exists('ctsc_shortcode_clear')){
	function ctsc_shortcode_clear($atts, $content = null){
		return '<div style="clear:both;width:100%;"></div>';
	}
	add_shortcode(ctsc_shortcode_prefix().'clear', 'ctsc_shortcode_clear');
}
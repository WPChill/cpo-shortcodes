<?php 

/* Tablist Shortcode */
if(!function_exists('ctsc_shortcode_tablist')){
	function ctsc_shortcode_tablist($atts, $content = null){
		//Enqueue necessary scripts
		wp_enqueue_script('ctsc-toggles');
		wp_enqueue_style('ctsc-shortcodes');
		
		$attributes = extract(shortcode_atts(array('style' => 'horizontal'), $atts));
		$content = trim($content);
		
		$output = '<div class="ctsc-tablist ctsc-tablist-'.$style.'">';
		
		//Parse individual tab contents into tabs
		preg_match_all('/tab title="([^\"]+)"/i', $content, $results, PREG_OFFSET_CAPTURE);
		$tab_titles = array();
		if(isset($results[1]))
			$tab_titles = $results[1];
		$output .= '<ul class="ctsc-tablist-nav">';
		foreach($tab_titles as $tab)
			$output .= '<li><a href="#ctsc-tab-content-'.sanitize_title($tab[0]).'">'.$tab[0].'</a></li>';
		$output .= '</ul>';
		
		if(count($tab_titles))
		    $output .= ctsc_do_shortcode($content);
		else
			$output .= do_shortcode($content);
		
		$output .= '</div>';
		return $output;
	}
	add_shortcode(ctsc_shortcode_prefix().'tabs', 'ctsc_shortcode_tablist');
}


/* Tab Shortcode */
if(!function_exists('ctsc_shortcode_tab')){
	function ctsc_shortcode_tab($atts, $content = null){
		wp_enqueue_style('ctsc-shortcodes');
		$attributes = extract(shortcode_atts(array(
		'title' => '(No Title)', 
		'icon' => '', 
		'state' => ''),
		$atts));
			
		$content = trim($content);
		if($icon != '') $icon = '<span class="icon icon-'.htmlentities($icon).'"></span> ';
		
		return '<div id="ctsc-tab-content-'.sanitize_title($title).'" class="ctsc-tab-content">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode(ctsc_shortcode_prefix().'tab', 'ctsc_shortcode_tab');
}
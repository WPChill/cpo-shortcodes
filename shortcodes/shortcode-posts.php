<?php 

/* Recent Posts Shortcode */
if(!function_exists('ctsc_shortcode_posts')){
	function ctsc_shortcode_posts($atts, $content = null){
		wp_enqueue_script('ctsc-waypoints');
		wp_enqueue_script('ctsc-core');
		wp_enqueue_style('ctsc-shortcodes');
		wp_enqueue_style('ctsc-fontawesome');
		
		$attributes = extract(shortcode_atts(array(
		'type' => 'post',
		'order' => 'DESC',
		'orderby' => 'date',
		'style' => '',
		'thumbnail' => 'thumbnail',
		'excerpt' => '',
		'date' => '',
		'author' => '',
		'comments' => '',
		'readmore' => '',
		'category' => '',
		'columns' => 3,
		'number' => 6,
		'id' => '',
		'class' => '',
		'animation' => ''
		), $atts));
		
		
		$element_class = ' '.$class;
		$post_class = '';
		$element_id = $id != '' ? ' id="'.$id.'"' : '';
		
		
		//Layout columns
		if(!is_numeric($columns)) $columns = 3; 
		elseif($columns < 1) $columns = 1; 
		elseif($columns > 5) $columns = 5;
		
		//Post number
		if(!is_numeric($number)) $number = 5; 
		elseif($number < 1) $number = 1; 
		elseif($number > 9999 ) $number = 9999;
		
		//Create the query
		$args = array(
		'post_type' => $type, 
		'order' => $order, 
		'orderby' => $orderby, 
		'posts_per_page' => $number, 
		'nopaging' => 0, 
		'post_status' => 'publish', 
		'ignore_sticky_posts' => 1);
		if($category != '') $args['category_name'] = $category;
		
		$query = new WP_Query($args);
		
		$output = '';
		if($query->have_posts()):
		
		//Entrace effects and delay
		if($animation != ''){
			wp_enqueue_script('ctsc-waypoints');
			wp_enqueue_script('ctsc-core');			
			$post_class .= ' ctsc-animation ctsc-animation-'.$animation;
		}
		
		$item_count = 0;
		$output = '<div class="ctsc-postlist ctsc-postlist-'.$style.$element_class.'"'.$element_id.'>';
			while($query->have_posts()): $query->the_post();
			if($item_count % $columns == 0 && $item_count != 0) 
				$output .= '<div class="ctsc-clear"></div>';
			$item_count++;
			if($item_count % $columns == 0 && $item_count != 0) 
				$col_last = ' ctsc-col-last'; 
			else 
				$col_last = '';
			$output .= '<div class="ctsc-column ctsc-col'.$columns.$col_last.'">';
			
			//Post Item Output
			$output .= '<div class="ctsc-post '.$post_class.'">';
			if(has_post_thumbnail() && $thumbnail != 'none')
				$output .= '<div class="ctsc-post-thumbnail"><a href="'.get_permalink(get_the_ID()).'">'.get_the_post_thumbnail(get_the_ID(), $thumbnail).'</a></div>';
			$output .= '<div class="ctsc-post-body">';
			$output .= '<h3 class="ctsc-post-title"><a href="'.get_permalink(get_the_ID()).'">'.get_the_title().'</a></h3>';
			$output .= '<div class="ctsc-post-byline">';
			if($date != 'none')
				$output .= '<div class="ctsc-post-date">'.get_the_time(get_option('date_format')).'</div>';
			if($author != 'none')
				$output .= '<div class="ctsc-post-author"><a href="'.get_author_posts_url(get_the_author_meta('ID')).'">'.__('By', 'ctsc').' '.get_the_author().'</a></div>';
			$output .= '</div>';
			if($style != 'list' && $excerpt != 'none')
				$output .= '<div class="ctsc-post-content">'.get_the_excerpt().'</div>';
			if($readmore != '')
				$output .= '<a class="ctsc-post-readmore" href="'.get_permalink(get_the_ID()).'">'.$readmore.'</a>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '<div class="ctsc-clear"></div>';
			
			$output .= '</div>';
			endwhile;
		$output .= '<div class="ctsc-clear"></div>';
		$output .= '</div>';
		
		//Finish up and return output
		wp_reset_query();
		wp_reset_postdata();
		endif;
		
		return $output;
	}
	add_shortcode(ctsc_shortcode_prefix().'posts', 'ctsc_shortcode_posts');
}
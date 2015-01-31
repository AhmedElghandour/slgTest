<?php
	// Loads child theme textdomain
	load_child_theme_textdomain( CURRENT_THEME, CHILD_DIR . '/languages' );

	// Loads custom scripts.
	require_once( 'custom-js.php' );












add_filter( 'cherry_stickmenu_selector', 'cherry_change_selector' );
 function cherry_change_selector($selector) {
  $selector = 'header.header';
  return $selector;
 }












add_filter( 'cherry_slider_params', 'child_slider_params' );
function child_slider_params( $params ) {
    $params['minHeight'] = '"100px"';
    $params['height'] = '"31.77%"';
return $params;
}
















// Content Box
if ( !function_exists( 'content_box_shortcode' ) ) {
	function content_box_shortcode( $atts, $content = null, $shortcodename = '' ) {
		extract( shortcode_atts(
			array(
				'custom_class' => '',
		), $atts ) );

		$output = '<div class="content_box ' . $custom_class . '"><div class="inner">';
			$output .= do_shortcode( $content );
			$output .= '<div class="clear"></div>';
		$output .= '</div></div><!-- .content_box (end) -->';

		$output = apply_filters( 'cherry_plugin_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode( 'content_box', 'content_box_shortcode' );
}




















//Recent Testimonials
if (!function_exists('shortcode_recenttesti')) {

	function shortcode_recenttesti( $atts, $content = null, $shortcodename = '' ) {
		extract(shortcode_atts(array(
				'num'           => '5',
				'thumb'         => 'true',
				'excerpt_count' => '30',
				'custom_class'  => '',
		), $atts));

		// WPML filter
		$suppress_filters = get_option('suppress_filters');

		$args = array(
				'post_type'        => 'testi',
				'numberposts'      => $num,
				'orderby'          => 'post_date',
				'suppress_filters' => $suppress_filters
			);
		$testi = get_posts($args);

		$itemcounter = 0;

		$output = '<div class="testimonials '.$custom_class.'">';

		global $post;
		global $my_string_limit_words;

		foreach ($testi as $k => $post) {
			//Check if WPML is activated
			if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
				global $sitepress;

				$post_lang = $sitepress->get_language_for_element($post->ID, 'post_testi');
				$curr_lang = $sitepress->get_current_language();
				// Unset not translated posts
				if ( $post_lang != $curr_lang ) {
					unset( $testi[$k] );
				}
				// Post ID is different in a second language Solution
				if ( function_exists( 'icl_object_id' ) ) {
					$post = get_post( icl_object_id( $post->ID, 'testi', true ) );
				}
			}
			setup_postdata( $post );
			$post_id = $post->ID;
			$excerpt = get_the_excerpt();

			// Get custom metabox value.
			$testiname  = get_post_meta( $post_id, 'my_testi_caption', true );
			$testiurl   = esc_url( get_post_meta( $post_id, 'my_testi_url', true ) );
			$testiinfo  = get_post_meta( $post_id, 'my_testi_info', true );
			$testiemail = sanitize_email( get_post_meta( $post_id, 'my_testi_email', true ) );

			$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
			$url            = $attachment_url['0'];
			$image          = aq_resize($url, 170, 170, true);

			$output .= '<div class="testi-item list-item-'.$itemcounter.'">';

				if ($thumb == 'true') {
					if ( has_post_thumbnail( $post_id ) ){
						$output .= '<figure class="featured-thumbnail"><a href="'.get_permalink( $post_id ).'">';
						$output .= '<img src="'.$image.'" alt="" />';
						$output .= '</a></figure>';
					}
				}

				if ( !empty( $testiname ) ) {
					$output .= '<span class="user">';
						$output .= $testiname;
					$output .= '</span>';
				}

				$output .= '<blockquote class="testi-item_blockquote">';
					$output .= '<a href="'.get_permalink( $post_id ).'">';
						$output .= my_string_limit_words($excerpt,$excerpt_count);
					$output .= '</a><div class="clear"></div>';

				$output .= '</blockquote>';

			$output .= '</div>';
			$itemcounter++;

		}
		wp_reset_postdata(); // restore the global $post variable
		$output .= '</div>';

		$output = apply_filters( 'cherry_plugin_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode('recenttesti', 'shortcode_recenttesti');

}
















/**
 * Mini Post List
 *
 */
if (!function_exists('mini_posts_list_shortcode')) {

	function mini_posts_list_shortcode( $atts, $content = null, $shortcodename = '' ) {
		extract(shortcode_atts(array(
			'type'          => 'post',
			'numb'          => '3',
			'thumbs'        => '',
			'thumb_width'   => '',
			'thumb_height'  => '',
			'meta'          => '',
			'order_by'      => '',
			'order'         => '',
			'excerpt_count' => '0',
			'custom_class'  => ''
		), $atts));

		$template_url = get_template_directory_uri();

		// check what order by method user selected
		switch ($order_by) {
			case 'date':
				$order_by = 'post_date';
				break;
			case 'title':
				$order_by = 'title';
				break;
			case 'popular':
				$order_by = 'comment_count';
				break;
			case 'random':
				$order_by = 'rand';
				break;
		}

		// check what order method user selected (DESC or ASC)
		switch ($order) {
			case 'DESC':
				$order = 'DESC';
				break;
			case 'ASC':
				$order = 'ASC';
				break;
		}

		// thumbnail size
		$thumb_x = 0;
		$thumb_y = 0;
		if (($thumb_width != '') && ($thumb_height != '')) {
			$thumbs = 'custom_thumb';
			$thumb_x = $thumb_width;
			$thumb_y = $thumb_height;
		} else {
			switch ($thumbs) {
				case 'small':
					$thumb_x = 110;
					$thumb_y = 110;
					break;
				case 'smaller':
					$thumb_x = 90;
					$thumb_y = 90;
					break;
				case 'smallest':
					$thumb_x = 60;
					$thumb_y = 60;
					break;
			}
		}

			global $post;
			global $my_string_limit_words;

			// WPML filter
			$suppress_filters = get_option('suppress_filters');

			$args = array(
				'post_type'        => $type,
				'numberposts'      => $numb,
				'orderby'          => $order_by,
				'order'            => $order,
				'suppress_filters' => $suppress_filters
			);

			$posts = get_posts($args);
			$i = 0;

			$output = '<ul class="mini-posts-list '.$custom_class.'">';

			foreach($posts as $key => $post) {
				//Check if WPML is activated
				if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
					global $sitepress;

					$post_lang = $sitepress->get_language_for_element($post->ID, 'post_' . $type);
					$curr_lang = $sitepress->get_current_language();
					// Unset not translated posts
					if ( $post_lang != $curr_lang ) {
						unset( $posts[$key] );
					}
					// Post ID is different in a second language Solution
					if ( function_exists( 'icl_object_id' ) ) {
						$post = get_post( icl_object_id( $post->ID, $type, true ) );
					}
				}
				setup_postdata($post);
				$excerpt        = get_the_excerpt();
				$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
				$url            = $attachment_url['0'];
				$image          = aq_resize($url, $thumb_x, $thumb_y, true);
				$mediaType      = get_post_meta($post->ID, 'tz_portfolio_type', true);
				$format         = get_post_format();

					//$output .= '<div class="row-fluid">';
					$output .= '<li class="mini-post-holder clearfix list-item-'.$i.'">';

					//post thumbnail
					if ($thumbs != 'none') {

						if ((has_post_thumbnail($post->ID)) && ($format == 'image' || $mediaType == 'Image')) {

							$output .= '<figure class="a featured-thumbnail thumbnail '.$thumbs.'">';
							$output .= '<a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
							$output .= '<img src="'.$image.'" alt="'.get_the_title($post->ID).'" />';
							$output .= '</a></figure>';

						} elseif ($mediaType != 'Video' && $mediaType != 'Audio') {

							$thumbid = 0;
							$thumbid = get_post_thumbnail_id($post->ID);
							$images = get_children( array(
								'orderby'        => 'menu_order',
								'order'          => 'ASC',
								'post_type'      => 'attachment',
								'post_parent'    => $post->ID,
								'post_mime_type' => 'image',
								'post_status'    => null,
								'numberposts'    => -1
							) );

							if ( $images ) {

								$k = 0;
								//looping through the images
								foreach ( $images as $attachment_id => $attachment ) {
									//$prettyType = "prettyPhoto[gallery".$i."]";
									//if( $attachment->ID == $thumbid ) continue;

									$image_attributes = wp_get_attachment_image_src( $attachment_id, 'full' ); // returns an array
									$img = aq_resize($image_attributes[0], $thumb_x, $thumb_y, true);  //resize & crop img
									$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
									$image_title = $attachment->post_title;

									if ( $k == 0 ) {
										if (has_post_thumbnail($post->ID)) {
											$output .= '<figure class="featured-thumbnail thumbnail">';
											$output .= '<a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
											$output .= '<img src="'.$image.'" alt="'.get_the_title($post->ID).'" />';
										} else {
											$output .= '<figure class="featured-thumbnail thumbnail '.$thumbs.'">';
											$output .= '<a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
											$output .= '<img  src="'.$img.'" alt="'.get_the_title($post->ID).'" />';
										}
									}
									$output .= '</a></figure>';
									$k++;
								}
							} elseif (has_post_thumbnail($post->ID)) {
								//$prettyType = 'prettyPhoto';
								$output .= '<figure class="featured-thumbnail thumbnail '.$thumbs.'">';
								$output .= '<a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
								$output .= '<img src="'.$image.'" alt="'.get_the_title($post->ID).'" />';
								$output .= '</a></figure>';
							}
							else {
								// empty_featured_thumb.gif - for post without featured thumbnail
								$output .= '<figure class="featured-thumbnail thumbnail '.$thumbs.'">';
								$output .= '<a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
								$output .= '<img src="'.$template_url.'/images/empty_thumb.gif" alt="'.get_the_title($post->ID).'" />';
								$output .= '</a></figure>';
							}
						} else {

							// for Video and Audio post format - no lightbox
							$output .= '<figure class="featured-thumbnail thumbnail '.$thumbs.'"><a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
							$output .= '<img src="'.$image.'" alt="'.get_the_title($post->ID).'" />';
							$output .= '</a></figure>';
						}
					}

						//mini post content
						$output .= '<div class="mini-post-content">';
							$output .= '<h4><a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
								$output .= get_the_title($post->ID);
							$output .= '</a></h4>';
							if ($meta == 'yes') {
								// mini post meta
								$output .= '<div class="mini-post-meta">';
									$output .= '<time datetime="'.get_the_time('Y-m-d\TH:i:s', $post->ID).'"> <span>' .get_the_date(). '</span></time>';
								$output .= '</div>';
							}
							$output .= cherry_get_post_networks(array('post_id' => $post->ID, 'display_title' => false, 'output_type' => 'return'));
							if($excerpt_count >= 1){
								$output .= '<div class="excerpt">';
									$output .= my_string_limit_words($excerpt,$excerpt_count);
								$output .= '</div>';
							}
						$output .= '</div>';
						
						$output .= '<a href="'.get_permalink($post->ID).'" class="button_link" title="'.get_the_title($post->ID).'">';
							$output .= __('More', CURRENT_THEME);
						$output .= '</a>';
						
						$output .= '</li>';
						$i++;

			} // end foreach
			wp_reset_postdata(); // restore the global $post variable

			$output .= '</ul><!-- .mini-posts-list (end) -->';

			$output = apply_filters( 'cherry_plugin_shortcode_output', $output, $atts, $shortcodename );

			return $output;
	}
	add_shortcode('mini_posts_list', 'mini_posts_list_shortcode');

}

// added by FMA 01/20/2015
// Language selector

function icl_post_languages(){
  $languages = icl_get_languages('skip_missing=1');
  if(1 < count($languages)){
    echo __('This post is also available in: ');
    foreach($languages as $l){
      if(!$l['active']) $langs[] = '<a href="'.$l['url'].'">'.$l['translated_name'].'</a>';
    }
    echo join(', ', $langs);
  }
}















?>
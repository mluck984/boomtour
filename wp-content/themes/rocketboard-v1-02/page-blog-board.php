<?php 
/**
 * Template Name: Blog Board
 */

get_header(); ?>
	<?php 
		// Check and get Sidebar Class
		$sidebar_array = gdl_get_sidebar_size( 'no-sidebar' );
	?>		
	<div class="page-wrapper blog-board-page <?php echo $sidebar_array['sidebar_class']; ?>">
		<?php

			// print title
			$page_title = get_post_meta($post->ID, 'page-option-blog-board-title', true);	
			$page_caption = get_post_meta($post->ID, 'page-option-blog-board-caption', true);			
			
			echo '<div class="board-header-wrapper">';
			gdl_get_social_icon();
			
			if( !empty($page_title) ){
				echo '<h1 class="board-header-title">' . $page_title . '</h1>';
			}
			if( !empty($page_caption) ){
				echo '<div class="board-header-caption">' . $page_caption . '</div>';
			}
			echo '<div class="clear"></div>';
			echo '</div>';
			echo '<div class="page-header-bottom-bar"></div>';
			
			echo '<div class="row gdl-page-row-wrapper">';
			echo '<div class="gdl-page-left mb0 ' . $sidebar_array['page_left_class'] . '">';
			
			echo '<div class="row">';
			echo '<div class="gdl-page-item mb20 ' . $sidebar_array['page_item_class'] . '">';

			// starting of page content section
			if( $gdl_admin_translator == 'enable' ){
				$translator_all = get_option(THEME_SHORT_NAME.'_translator_all', 'All');
			}else{
				$translator_all = __('All','gdl_front_end');
			}
			
			global $paged; 
			if(empty($paged)){ $paged = (get_query_var('page')) ? get_query_var('page') : 1; }
			
			$port_cat = get_post_meta($post->ID, 'page-option-blog-board-category', true);	
			$port_cat = ( $port_cat == 'All' )? '': $port_cat;
			$port_num_fetch = get_post_meta($post->ID, 'page-option-blog-board-num-fetch', true);				
			$enable_pagination = get_post_meta($post->ID, 'page-option-blog-board-pagination', true);				
			$enable_filter = get_post_meta($post->ID, 'page-option-blog-board-filter', true);	
			
			$default_board_width = get_option(THEME_SHORT_NAME.'_box_width', '243');
			$default_board_style = get_option(THEME_SHORT_NAME.'_board_thumbnail_type', 'Feature Image');
			$default_board_info = get_option(THEME_SHORT_NAME.'_board_item_info', 'None');

			query_posts(array('paged'=>$paged, 'category_name'=>$port_cat, 'posts_per_page'=>$port_num_fetch));
			
			// filter button
			if( $enable_filter == 'Yes' ){
				echo '<div class="rocket-board-filter-wrapper" id="rocket-board-filter-wrapper">';
				
				$category_lists = get_category_list('category', $port_cat);
				$category_check = array();
				if( empty($port_cat) ){ 
					$category_check['All'] = $translator_all;
				}else{
					$first_category = get_term_by('slug', $port_cat, 'category');
					$category_check[$port_cat] = $first_category->name; 
				}

				while( have_posts() ){ the_post();
					$post_categories = get_the_terms( get_the_ID(), 'category' );
					if(!empty($post_categories)){
						foreach( $post_categories as $category ){ 
							$category_check[$category->slug] = $category->name; 
						}
					}
				}
				rewind_posts();
				$is_first = 'active';			
				echo '<ul class="rocket-board-filter">';
				foreach($category_lists as $category){
					if( empty($category_check[$category]) ) continue;
					if( $is_first ){ 
						$cat_name = 'All';
					}else{
						$cat_name = $category;
					}
					
					echo '<li><span> / </span><a href="#" class="' . $is_first . '" data-value="' . $cat_name . '">'; 
					echo $category_check[$category];
					echo '</a></li>';
					
					$is_first  = '';
				}
				echo "</ul>";		
				
				echo '<div class="float-filter-wrapper">';
				// isotope layout
				echo '<div class="filter-layout-wrapper">';
				echo '<div class="filter-layout-title-wrapper">';
				echo '<span>' . __('Sort By', 'gdl_front_end') . '</span>';
				echo '</div>';
				
				echo '<ul class="rocket-board-layout">';
				echo '<li><a href="#" data-value="masonry" >' . __('Masonry','gdl_front_end') . '</a></li>';
				echo '<li><a href="#" data-value="fitRows" >' . __('Fit Rows','gdl_front_end') . '</a></li>';
				echo '<li><a href="#" data-value="straightDown" >' . __('Straight Down','gdl_front_end') . '</a></li>';
				echo "</ul>";
				echo '</div>'; // filter layout wrapper
				
				// isotope layout
				echo '<div class="filter-order-wrapper">';
				echo '<div class="filter-order-title-wrapper">';
				echo '<span>' . __('Order By', 'gdl_front_end') . '</span>';
				echo '</div>';
				
				echo '<ul class="rocket-board-order">';
				echo '<li><a href="#" data-value="mixed" >' . __('Mixed','gdl_front_end') . '</a></li>';
				echo '<li><a href="#" data-value="original" >' . __('Original','gdl_front_end') . '</a></li>';
				echo '<li><a href="#" data-value="alphabetical" >' . __('Alphabetical','gdl_front_end') . '</a></li>';
				echo "</ul>";	
				echo '</div>';	// filter order wrapper		
				echo '</div>'; // float-filter-wrapper
				
				echo '</div>'; // rocket board filter
			}
			
			// fetch posts
			echo '<div class="rocket-board-wrapper" id="rocket-board-wrapper">';
			while( have_posts() ){ the_post();		
				$board_class = " ";
				$post_categories = get_the_terms( get_the_ID(), 'category' );
				if(!empty($post_categories)){
					foreach( $post_categories as $category ){ 
						$board_class = $board_class . $category->slug . ' '; 
					}
				}				
				
				$board_size = get_post_meta($post->ID, 'post-option-board-thumbnail-size', true);
				if(empty($board_size)){ $board_size = '1x1'; }
				$board_class = $board_class . ' board-size' . $board_size;
				
				$thumbnail_id = get_post_thumbnail_id();
				$board_style = get_post_meta($post->ID, 'post-option-board-thumbnail-type', true);
				if( empty($thumbnail_id) || $board_style == 'Color Board' ||
					(empty($board_style) && $default_board_style == 'Color Board') ){ 
					
					$board_color = get_post_meta($post->ID, 'post-option-color-board-background', true);
					if(!empty($board_color) && $board_color != 'transparent'){
						$board_color = ' style="background-color: ' . $board_color . '" ';
					}else{
						$board_color = '';
					}
					
					$board_style = 'Color Board'; 
					$board_class = $board_class . ' color-board';
				}else{
					$board_color = '';
					$board_style = 'Feature Image'; 
					$board_class = $board_class . ' feature-image';				
				}
 				
				echo '<div class="rocket-board-item-wrapper ' . $board_class . '" data-size="' . $board_size . '" ' . $board_color . '>';
				
				if( $board_style == 'Feature Image' ){

					$thumbnail_size = gdl_get_board_thumbnail_size($board_size, $default_board_width);
					get_board_thumbnail(get_the_ID(), $thumbnail_id,  $thumbnail_size, $board_size);

				}else{
					
					echo '<div class="color-board-wrapper">';
						
					echo '<div class="color-board-text-wrapper board-size' . $board_size . '">';
					echo '<h3 class="board-item-title">';
					echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
					echo '</h3>';
					
					$thumbnail_info = get_post_meta($post->ID, 'post-option-color-board-info', true);
					if($thumbnail_info == 'Icon'){
						$icon_id = get_post_meta($post->ID, 'post-option-color-board-icon', true);
						$icon_link = get_post_meta($post->ID, 'post-option-color-board-icon-link', true);
						$icon = wp_get_attachment_image_src( $icon_id , 'full' );
						$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
						
						if( !empty($icon_id) ){
							echo '<div class="board-item-top-icon" >';
							if( empty($icon_link) ){
								echo '<img src="' . $icon[0] . '" alt="' . $alt_text . '" />';	
							}else{
								echo '<a href="' . $icon_link . '" >';
								echo '<img src="' . $icon[0] . '" alt="' . $alt_text . '" />';	
								echo '</a>';
							}		
							echo '</div>';
						}
					}else if($thumbnail_info == 'Date' || ( empty($thumbnail_info) && $default_board_info == 'Date' )){
						echo '<div class="board-item-top-date" >';
						echo '<a href="' . get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d')) . '" >';
						echo get_the_time('d M Y');
						echo '</a>';
						echo '</div>';					
					}else if($thumbnail_info == 'Tag' || ( empty($thumbnail_info) && $default_board_info == 'Tag' )){
						$portfolio_tag = get_the_term_list( get_the_ID(), 'post_tag', '', ', ', '' );					
						echo '<div class="board-item-top-tag" >';
						echo $portfolio_tag;	
						echo '</div>';						
					}
					echo '</div>'; // color board text wrapper
					
					if( !empty($thumbnail_id) ){
						echo '<div class="color-board-image-wrapper board-size' . $board_size . '">';
						$thumbnail_size = gdl_get_board_thumbnail_size($board_size, $default_board_width);
						get_board_thumbnail(get_the_ID(), $thumbnail_id,  $thumbnail_size, $board_size);
						echo '</div>'; // color board image wrapper
					}
					
					echo '</div>'; // color board wrapper
				}
				
				echo '</div>'; // rocket-board-item-wrapper
			}
			echo '<div class="clear"></div>';	
			echo '</div>'; // rocket board wrapper
			
			if( $enable_pagination == 'Yes' ){
				echo '<div class="board-pagination">';
				pagination();
				echo '</div>';				
			}
			
			wp_reset_query();
			
			if(have_posts()){
				while(have_posts()){
					the_post();
					echo "<div class='board-content'>";
						the_content();
					echo "</div>";
				}
			}
			
			echo '<div class="clear"></div>';
			echo "</div>"; // end of gdl-page-item
			
			echo '<div class="clear"></div>';			
			echo "</div>"; // row
			echo "</div>"; // gdl-page-left

			echo '<div class="clear"></div>';
			echo "</div>"; // row
		?>
		<div class="clear"></div>
	</div> <!-- page wrapper -->
<?php get_footer(); ?>
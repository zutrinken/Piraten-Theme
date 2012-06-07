<?php

	/****************************************************/
	/*                                                  */
	/* Default functions settings by Peter Amende       */
	/*                                                  */
	/****************************************************/

load_theme_textdomain('piraten', TEMPLATEPATH .'/languages');
add_theme_support('post-thumbnails');
add_editor_style();
add_custom_background();

include 'pirateWidgets.php';

	  /* ================ */
	 /* ===== MENU ===== */
	/* ================ */

add_action( 'init', 'register_my_menus' );
function register_my_menus() {
	register_nav_menus(
		array(
			'header' => __('Header'),
			'footer' => __('Footer')
		)
	);
}

	  /* ==================== */
	 /* ===== SIDEBARS ===== */
	/* ==================== */

if ( function_exists('register_sidebar') )
	register_sidebar(
	array(
		'name'=>'Sidebar Left',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	)
);
if ( function_exists('register_sidebar') )
	register_sidebar(
	array(
		'name'=>'Sidebar Right',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	)
);

	  /* =================== */
	 /* ===== CAPTION ===== */
	/* =================== */


function custom_caption($attr, $content = null) {

	// Allow plugins/themes to override the default caption template.
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' )
	return $output;
	extract(shortcode_atts(array(
		'id' => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	), $attr));
	if ( 1 > (int) $width || empty($caption) )
	return $content;
	if ( $id ) $id = 'id="' . $id . '" ';
	return '<figure ' . $id . 'class="wp-caption ' . $align . '" style="width: ' . ( /* 10 + (int) */ $width) . 'px">'
	. do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></figure>';
}
add_shortcode('wp_caption', 'custom_caption');
add_shortcode('caption', 'custom_caption');

	  /* ===================== */
	 /* ===== THUMBNAIL ===== */
	/* ===================== */


function postimage($atts, $content = null) {
	extract(shortcode_atts(array(
		"size" => 'thumbnail'
	), $atts));
	$images =& get_children( 'post_type=attachment&post_mime_type=image&post_parent=' . get_the_id() );
	foreach( $images as $imageID => $imagePost )
	$fullimage = wp_get_attachment_image($imageID, $size, false);
	$imagedata = wp_get_attachment_image_src($imageID, $size, false);
	$width = ($imagedata[1]+2);
	$height = ($imagedata[2]+2);
	echo '<figure class="postimage"><a title="' .get_the_title(). '" href="' .get_permalink(). '">'.$fullimage.'</a></figure>';
}

	  /* ======================== */
	 /* ===== CUSTOM COLOR ===== */
	/* ======================== */


add_custom_background( 'new_custom_background_cb' );

function new_custom_background_cb() {
	$background = get_background_image();
	$color = get_background_color();
	if ( ! $background && ! $color )
	return;

	$style = $color ? "background-color: #$color;" : 'background: #$color;';

	if ( $background ) {
		$image = "background-image: url('$background');";

		$repeat = get_theme_mod( 'background_repeat', 'repeat' );
		if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
		$repeat = 'repeat';
		$repeat = "background-repeat: $repeat;";

		$position = get_theme_mod( 'background_position_x', 'left' );
		if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
		$position = 'left';
		$position = "background-position: $position; top";

		$attachment = get_theme_mod( 'background_attachment', 'scroll' );
		if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
		$attachment = 'scroll';
		$attachment = "background-attachment: $attachment;";

		$style .= $image . $repeat . $position . $attachment;
	}

	?>
	<style type="text/css">
		body { <?php echo trim($style); ?> }
	</style>
	<?php
}

	  /* ================= */
	 /* ===== LOGIN ===== */
	/* ================= */


function favicon4admin() {echo '<link rel="Shortcut Icon" type="image/x-icon" href="' . get_bloginfo('template_directory') . '/favicon.ico" />';}
add_action( 'admin_head', 'favicon4admin' );

function custom_login() {echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/login.css" />';}
add_action('login_head', 'custom_login');


	  /* =================== */
	 /* ===== EXCERPT ===== */
	/* =================== */


function custom_wp_trim_excerpt($text) {
	$raw_excerpt = $text;
	if ( '' == $text ) {
		//Retrieve the post content.
		$text = get_the_content('');
 
		//Delete all shortcode tags from the content.
		$text = strip_shortcodes( $text );
 
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
 
 		// MODIFY THIS. Add the allowed HTML tags separated by a comma.
		$allowed_tags = '<a>,<p>,<h2>,<h3>,<h4>,<strong>,<blockquote>,<br>,<br />,<ul>,<ol>,<li>';
		$text = strip_tags($text, $allowed_tags);
 
 		// MODIFY THIS. change the excerpt word count to any integer you like.
		$excerpt_word_count = 60;
		$excerpt_length = apply_filters('excerpt_length', $excerpt_word_count);
 
 		// MODIFY THIS. change the excerpt endind to something else.
		$excerpt_end = '[...]';
		$excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);
 
		$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
		if ( count($words) > $excerpt_length ) {
			array_pop($words);
			$text = implode(' ', $words);
			$text = $text . $excerpt_more;
		} else {
			$text = implode(' ', $words);
		}
	}
	return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'custom_wp_trim_excerpt');


	  /* ====================== */
	 /* ===== PAGINATION ===== */
	/* ====================== */

	/**************************************************************************************/
	/*                                                                                    */
	/* <?php if( function_exists('wp_pagination_navi') ) {wp_pagination_navi();} ?>       */
	/*                                                                                    */
	/**************************************************************************************/


function wp_pagination_navi($num_page_links = 5, $min_max_offset = 2){

    global $wp_query;
   
    // Do not show paging on single pages
    if( !is_single() ){
               
        $current_page       = intval(get_query_var('paged'));
        $total_pages        = $wp_query->max_num_pages;
        $left_offset        = floor(($num_page_links - 1) / 2);
        $right_offset       = ceil(($num_page_links -1) / 2);
        if( empty($current_page) || $current_page ==  0 ) {
            $current_page = 1;
        }
        // More than one page -> render pagination
        if ( $total_pages > 1 ) {
       
            echo '<nav class="pagination_navi">';
           
            if ( $current_page > 1 ) {
  echo '<a href="' .get_pagenum_link($current_page-1) .'" title="previous">&laquo;</a>';
            }
            for ( $i = 1; $i <= $total_pages; $i++) {
                if ( $i == $current_page ){
                    // Current page
                    echo '<a href="'.get_pagenum_link($current_page).'" class="current-page" title="page '.$i.'" >'.($current_page).'</a>';
                } else {
                    // Pages before and after the current page
                    if ( ($i >= ($current_page - $left_offset)) && ($i <= ($current_page + $right_offset)) ){
                        echo '<a href="'.get_pagenum_link($i).'" title="page '.$i.'" >'.$i.'</a>';
                    } elseif ( ($i <= $min_max_offset) || ($i > ($total_pages - $min_max_offset)) ) {
                        // Start and end pages with min_max_offset
                        echo '<a href="'.get_pagenum_link($i).'" title="page '.$i.'" >'.$i.'</a>';
                    } elseif ( (($i == ($min_max_offset + 1)) && ($i < ($current_page - $left_offset + 1))) ||
                               (($i == ($total_pages - $min_max_offset)) && ($i > ($current_page + $right_offset ))) ) {
                        // Dots after/before min_max_offset
                        echo '<span class="dots">...</span>';
                    }
                }
            }
            if ( $current_page != $total_pages ) {
                echo '<a href="'.get_pagenum_link($current_page+1).'" title="next">&raquo;</a>';
            }
            echo '</nav>'; //Close pagination
        }
    }
}




	  /* ======================== */
	 /* ===== BANNERWIDGET ===== */
	/* ======================== */

class BannerWidget extends WP_Widget {
    /** constructor */
    function BannerWidget() {
        parent::WP_Widget(false, $name = 'BannerWidget');
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        ?>
              <?php echo '<aside class="widget banner">'; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
   			<a href="<?php _e($instance['link']); ?>"><img style="width:100%;display:block;" src="<?php _e($instance['picture']); ?>"></a> 
                  <?php echo '</aside>'; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['picture'] = strip_tags($new_instance['picture']);
        $instance['link'] = strip_tags($new_instance['link']);
	return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
        $title = esc_attr($instance['title']);
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <?php
        $picture = attribute_escape( $instance['picture'] );
?>
        <p><label for="<?php echo $this->get_field_id('picture'); ?>">
        <?php _e('Image url:') ?> <input class="widefat" id="<?php echo $this->get_field_id('picture'); ?>" name="<?php echo $this->get_field_name('picture'); ?>" type="text" value="<?php echo $picture ?>" /></label>
        </p>
<?php   

	$link = attribute_escape( $instance['link'] );
?>
        <p><label for="<?php echo $this->get_field_id('link'); ?>">
        <?php _e('Link url:') ?> <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link ?>" /></label>
        </p>
<?php
}

} // class BannerWidget

// register BannerWidget widget
add_action('widgets_init', create_function('', 'return register_widget("BannerWidget");'));
?>
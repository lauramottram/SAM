<?php
/**
 * Add Title Page Builder Widget.
 *
 * @package ThinkUpThemes
 */


/* ----------------------------------------------------------------------------------
	Services - Specific for Experon theme
---------------------------------------------------------------------------------- */

include_once( get_template_directory() . '/lib/widgets_builder/services/services_icons.php' );

class thinkup_builder_services extends WP_Widget {


	/* Register widget description. */
	public function __construct() {
		$widget_ops = array('classname' => 'thinkup_builder_services', 'description' => 'Add a services field to your content.' );
		parent::__construct('thinkup_builder_services', 'Services', $widget_ops);
	}

	/* Add widget structure to Admin area. */
	function form($instance) {
		$default_entries = array( 
			'title'        => '', 
			'style'        => '', 
			'image'        => '', 
			'icon'         => '', 
			'heading'      => '',
			'text'         => '', 
			'link'         => '', 
			'link_text'    => '', 
			'animate'      => '', 
			'delay'        => '' 
		);
		$instance = wp_parse_args( (array) $instance, $default_entries );

		$title        = $instance['title'];
		$style        = $instance['style'];
		$image        = $instance['image'];
		$icon         = $instance['icon'];
		$heading      = $instance['heading'];
		$text         = $instance['text'];
		$link         = $instance['link'];
		$link_text    = $instance['link_text'];
		$animate      = $instance['animate'];
		$delay        = $instance['delay'];

		// Assign global variable for icons used in icon php file
		$GLOBALS['thinkup_builder_servicesiconinput'] = $instance['icon'];

		// Assign image variable to display image attachment list
		$query_images_args = array(
			'post_type'      => 'attachment', 
			'post_mime_type' => 'image', 
			'post_status'    => 'inherit', 
			'posts_per_page' => -1,
		);
		$query_images = new WP_Query( $query_images_args );
		$images = array();

		echo '<p><label for="' . $this->get_field_id('title') . '" style="display: inline-block;width: 150px;">Module Title:</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '" style="display: inline-block;width: 200px;margin: 0;" /></p>';

		echo '<p><label for="' . $this->get_field_id('style') . '" style="display: inline-block;width: 150px;" >Style:</label>
			<select name="' . $this->get_field_name('style') . '" id="' . $this->get_field_id('style') . '" class="services-select" style="display: inline-block;width: 200px;margin: 0;" >
			<option '; ?><?php if($style == "style1") { echo "selected"; } ?><?php echo ' value="style1">Style 1</option>
			<option '; ?><?php if($style == "style2") { echo "selected"; } ?><?php echo ' value="style2">Style 2</option>
			</select>
		</p>';

		echo '<p><label for="' . $this->get_field_id('image') . '" style="display: inline-block;width: 150px;" >Choose Image:</label>
			<select name="' . $this->get_field_name('image') . '" id="' . $this->get_field_id('image') . '" style="display: inline-block;width: 200px;margin: 0;" >';

		if ( empty($query_images->posts) ) {
			echo '<option '; ?><?php if($image == "0") { echo "selected"; } ?><?php echo ' value="0">No images</option>';
		} else {
			echo '<option '; ?><?php if($image == "0") { echo "selected"; } ?><?php echo ' value="0">Select an image...</option>';
			foreach ( $query_images->posts as $images) {
				echo '<option '; ?><?php if($image == $images->ID ) { echo "selected"; } ?><?php echo ' value="' . $images->ID . '">' . get_the_title($images->ID) . '</option>';
			}
		}
		echo '</select>
			 <label style="display: inline-block;width: 250px;padding-left: 15px;"><strong>Note:</strong> Only displays with Style 1</label>
		</p>';

		echo '<p><label for="' . $this->get_field_id('icon') . '" style="display: inline-block;width: 150px;" >Choose Icon:</label>
			<select name="' . $this->get_field_name('icon') . '" id="' . $this->get_field_id('icon') . '" style="display: inline-block;width: 200px;margin: 0;" >',
			thinkup_builder_servicesicons(),
			'</select>
			 <label style="display: inline-block;width: 250px;padding-left: 15px;"><strong>Note:</strong> Only displays with Style 2</label>
		</p>';

		echo '<p><label for="' . $this->get_field_id('heading') . '" style="display: inline-block;width: 153px;">Heading:</label><input class="widefat" id="' . $this->get_field_id('heading') . '" name="' . $this->get_field_name('heading') . '" type="text" value="' . esc_attr($heading) . '" style="display: inline-block;width: 200px;margin: 0;" /></p>';

		echo '<p><label for="' . $this->get_field_id('text') . '" >Text:</label><textarea for="' . $this->get_field_id('text') . '" id="' . $this->get_field_id('text') . '" name="' . $this->get_field_name('text') . '" style="display: block; width: 100%; height: 100px;" >' . esc_attr($text) . '</textarea></p>';

		echo '<p><label for="' . $this->get_field_id('link') . '" style="display: inline-block;width: 153px;">Link:</label><input class="widefat" id="' . $this->get_field_id('link') . '" name="' . $this->get_field_name('link') . '" type="text" value="' . esc_attr($link) . '" style="display: inline-block;width: 200px;margin: 0;" /></p>';

		echo '<p><label for="' . $this->get_field_id('link_text') . '" style="display: inline-block;width: 153px;">Link Text:</label><input class="widefat" id="' . $this->get_field_id('link_text') . '" name="' . $this->get_field_name('link_text') . '" type="text" value="' . esc_attr($link_text) . '" style="display: inline-block;width: 200px;margin: 0;" /></p>';

		echo '<p><label for="' . $this->get_field_id('animate') . '" style="display: inline-block;width: 150px;">Animation:</label>
			<select name="' . $this->get_field_name('animate') . '" id="' . $this->get_field_id('animate') . '" style="display: inline-block;width: 200px;margin: 0;">
			<option '; ?><?php if($animate == "none") { echo "selected"; } ?><?php echo ' value="none">None</option>
			<option '; ?><?php if($animate == "bounceIn") { echo "selected"; } ?><?php echo ' value="bounceIn">bounceIn</option>
			<option '; ?><?php if($animate == "bounceInDown") { echo "selected"; } ?><?php echo ' value="bounceInDown">bounceInDown</option>
			<option '; ?><?php if($animate == "bounceInUp") { echo "selected"; } ?><?php echo ' value="bounceInUp">bounceInUp</option>
			<option '; ?><?php if($animate == "bounceInLeft") { echo "selected"; } ?><?php echo ' value="bounceInLeft">bounceInLeft</option>
			<option '; ?><?php if($animate == "bounceInRight") { echo "selected"; } ?><?php echo ' value="bounceInRight">bounceInRight</option>
			<option '; ?><?php if($animate == "bounceOut") { echo "selected"; } ?><?php echo ' value="bounceOut">bounceOut</option>
			<option '; ?><?php if($animate == "bounceOutDown") { echo "selected"; } ?><?php echo ' value="bounceOutDown">bounceOutDown</option>
			<option '; ?><?php if($animate == "bounceOutUp") { echo "selected"; } ?><?php echo ' value="bounceOutUp">bounceOutUp</option>
			<option '; ?><?php if($animate == "bounceOutLeft") { echo "selected"; } ?><?php echo ' value="bounceOutLeft">bounceOutLeft</option>
			<option '; ?><?php if($animate == "bounceOutRight") { echo "selected"; } ?><?php echo ' value="bounceOutRight">bounceOutRight</option>
			<option '; ?><?php if($animate == "flipInX") { echo "selected"; } ?><?php echo ' value="flipInX">flipInX</option>
			<option '; ?><?php if($animate == "flipOutX") { echo "selected"; } ?><?php echo ' value="flipOutX">flipOutX</option>
			<option '; ?><?php if($animate == "flipInY") { echo "selected"; } ?><?php echo ' value="flipInY">flipInY</option>
			<option '; ?><?php if($animate == "flipOutY") { echo "selected"; } ?><?php echo ' value="flipOutY">flipOutY</option>
			<option '; ?><?php if($animate == "fadeIn") { echo "selected"; } ?><?php echo ' value="fadeIn">fadeIn</option>
			<option '; ?><?php if($animate == "fadeInUp") { echo "selected"; } ?><?php echo ' value="fadeInUp">fadeInUp</option>
			<option '; ?><?php if($animate == "fadeInDown") { echo "selected"; } ?><?php echo ' value="fadeInDown">fadeInDown</option>
			<option '; ?><?php if($animate == "fadeInLeft") { echo "selected"; } ?><?php echo ' value="fadeInLeft">fadeInLeft</option>
			<option '; ?><?php if($animate == "fadeInRight") { echo "selected"; } ?><?php echo ' value="fadeInRight">fadeInRight</option>
			<option '; ?><?php if($animate == "fadeInUpBig") { echo "selected"; } ?><?php echo ' value="fadeInUpBig">fadeInUpBig</option>
			<option '; ?><?php if($animate == "fadeInDownBig") { echo "selected"; } ?><?php echo ' value="fadeInDownBig">fadeInDownBig</option>
			<option '; ?><?php if($animate == "fadeInLeftBig") { echo "selected"; } ?><?php echo ' value="fadeInLeftBig">fadeInLeftBig</option>
			<option '; ?><?php if($animate == "fadeInRightBig") { echo "selected"; } ?><?php echo ' value="fadeInRightBig">fadeInRightBig</option>
			<option '; ?><?php if($animate == "fadeOut") { echo "selected"; } ?><?php echo ' value="fadeOut">fadeOut</option>
			<option '; ?><?php if($animate == "fadeOutUp") { echo "selected"; } ?><?php echo ' value="fadeOutUp">fadeOutUp</option>
			<option '; ?><?php if($animate == "fadeOutDown") { echo "selected"; } ?><?php echo ' value="fadeOutDown">fadeOutDown</option>
			<option '; ?><?php if($animate == "fadeOutLeft") { echo "selected"; } ?><?php echo ' value="fadeOutLeft">fadeOutLeft</option>
			<option '; ?><?php if($animate == "fadeOutRight") { echo "selected"; } ?><?php echo ' value="fadeOutRight">fadeOutRight</option>
			<option '; ?><?php if($animate == "fadeOutUpBig") { echo "selected"; } ?><?php echo ' value="fadeOutUpBig">fadeOutUpBig</option>
			<option '; ?><?php if($animate == "fadeOutDownBig") { echo "selected"; } ?><?php echo ' value="fadeOutDownBig">fadeOutDownBig</option>
			<option '; ?><?php if($animate == "fadeOutLeftBig") { echo "selected"; } ?><?php echo ' value="fadeOutLeftBig">fadeOutLeftBig</option>
			<option '; ?><?php if($animate == "fadeOutRightBig") { echo "selected"; } ?><?php echo ' value="fadeOutRightBig">fadeOutRightBig</option>
			<option '; ?><?php if($animate == "hinge") { echo "selected"; } ?><?php echo ' value="hinge">hinge</option>
			<option '; ?><?php if($animate == "lightSpeedIn") { echo "selected"; } ?><?php echo ' value="lightSpeedIn">lightSpeedIn</option>
			<option '; ?><?php if($animate == "lightSpeedOut") { echo "selected"; } ?><?php echo ' value="lightSpeedOut">lightSpeedOut</option>
			<option '; ?><?php if($animate == "rollIn") { echo "selected"; } ?><?php echo ' value="rollIn">rollIn</option>
			<option '; ?><?php if($animate == "rollOut") { echo "selected"; } ?><?php echo ' value="rollOut">rollOut</option>
			<option '; ?><?php if($animate == "rotateIn") { echo "selected"; } ?><?php echo ' value="rotateIn">rotateIn</option>
			<option '; ?><?php if($animate == "rotateInDownLeft") { echo "selected"; } ?><?php echo ' value="rotateInDownLeft">rotateInDownLeft</option>
			<option '; ?><?php if($animate == "rotateInDownRight") { echo "selected"; } ?><?php echo ' value="rotateInDownRight">rotateInDownRight</option>
			<option '; ?><?php if($animate == "rotateInUpLeft") { echo "selected"; } ?><?php echo ' value="rotateInUpLeft">rotateInUpLeft</option>
			<option '; ?><?php if($animate == "rotateInUpRight") { echo "selected"; } ?><?php echo ' value="rotateInUpRight">rotateInUpRight</option>
			<option '; ?><?php if($animate == "rotateOut") { echo "selected"; } ?><?php echo ' value="rotateOut">rotateOut</option>
			<option '; ?><?php if($animate == "rotateOutDownLeft") { echo "selected"; } ?><?php echo ' value="rotateOutDownLeft">rotateOutDownLeft</option>
			<option '; ?><?php if($animate == "rotateOutDownRight") { echo "selected"; } ?><?php echo ' value="rotateOutDownRight">rotateOutDownRight</option>
			<option '; ?><?php if($animate == "rotateOutUpLeft") { echo "selected"; } ?><?php echo ' value="rotateOutUpLeft">rotateOutUpLeft</option>
			<option '; ?><?php if($animate == "rotateOutUpRight") { echo "selected"; } ?><?php echo ' value="rotateOutUpRight">rotateOutUpRight</option>
			<option '; ?><?php if($animate == "slideInDown") { echo "selected"; } ?><?php echo ' value="slideInDown">slideInDown</option>
			<option '; ?><?php if($animate == "slideInLeft") { echo "selected"; } ?><?php echo ' value="slideInLeft">slideInLeft</option>
			<option '; ?><?php if($animate == "slideInRight") { echo "selected"; } ?><?php echo ' value="slideInRight">slideInRight</option>
			<option '; ?><?php if($animate == "slideOutUp") { echo "selected"; } ?><?php echo ' value="slideOutUp">slideOutUp</option>
			<option '; ?><?php if($animate == "slideOutLeft") { echo "selected"; } ?><?php echo ' value="slideOutLeft">slideOutLeft</option>
			<option '; ?><?php if($animate == "slideOutRight") { echo "selected"; } ?><?php echo ' value="slideOutRight">slideOutRight</option>
			</select>
		</p>';

		echo '<p><label for="' . $this->get_field_id('delay') . '" style="display: inline-block;width: 153px;">Animation Delay (ms):</label><input class="widefat" id="' . $this->get_field_id('delay') . '" name="' . $this->get_field_name('delay') . '" type="text" value="' . esc_attr($delay) . '" style="display: inline-block;  width: 200px;margin: 0;" /></p>';	
	}

	/* Assign variable values. */
	function update($new_instance, $old_instance) {
		$instance                 = $old_instance;
		$instance['title']        = $new_instance['title'];
		$instance['style']        = $new_instance['style'];
		$instance['image']        = $new_instance['image'];
		$instance['icon']         = $new_instance['icon'];
		$instance['heading']      = $new_instance['heading'];
		$instance['text']         = $new_instance['text'];
		$instance['link']         = $new_instance['link'];
		$instance['link_text']    = $new_instance['link_text'];
		$instance['animate']      = $new_instance['animate'];
		$instance['delay']        = $new_instance['delay'];
		return $instance;
	}

	/* Output widget to front-end. */
	function widget($args, $instance) {

		$style        = $instance['style'];
		$image        = $instance['image'];		
		$icon         = $instance['icon'];
		$heading      = $instance['heading'];
		$text         = $instance['text'];
		$link         = $instance['link'];
		$link_text    = $instance['link_text'];
		$animate      = $instance['animate'];
		$delay        = $instance['delay'];

		$animate_start = NULL;
		$animate_end   = NULL;
		$output        = NULL;

		extract($args, EXTR_SKIP);
		
		if ( empty( $speed ) ) {
			$speed = '500';
		}
		if ( empty( $category ) ) {
			$category = '0';
		}

		// Assign image variable
		if ( ! empty( $image ) and $image !== '0'  ) {
			$image = wp_get_attachment_image_src( $image, 'full' );
			$image = '<img src="' . $image[0] . '" alt="' . $heading . '" />';
		} else {
			$image = NULL;
		}

		// Assign default icon variable
		if ( empty( $icon ) or $icon == 'none' ) $icon = NULL;

		// Assign icon and link variables if set
		if ( empty( $link ) ) {
		
			// Assign icon when icon is set but no url is set
			if ( ! empty( $icon ) ) {
				$icon = '<div class="iconimage"><i class="fa fa-' . $icon . ' fa-3x"></i></div>';
			}

			// Assign image when image is set but no url is set
			if ( ! empty( $image ) ) {
				$image = '<div class="iconimage">' . $image . '</div>';
			}
		} else {

			// Assign icon when icon is set and url is set
			if ( ! empty( $icon ) ) {
				$icon = '<div class="iconimage"><a href="' . $link . '"><i class="fa fa-' . $icon . ' fa-3x"></i></a></div>';
			}

			// Assign image when image is set and url is set
			if ( ! empty( $image ) ) {
				$image = '<div class="iconimage"><a href="' . $link . '">' . $image . '</a></div>';
			}

			// Assign button text or use default "Learn More"
			if ( ! empty( $link_text ) ) {
				$link = '<p class="iconurl"><a href="' . $link .'">' . $link_text . '</a></p>';
			} else {
				$link = '<p class="iconurl"><a href="' . $link .'">Learn More</a></p>';			
			}
		}

		// Assign heading variable
		if ( ! empty( $heading ) ) {
			$heading = '<h3>' . $heading . '</h3>';
		}

		// Assign main content variable
		if ( ! empty( $text ) ) {
			$text = wpautop( $text );
		}

		// Assign animation variables if set
		if ( ! empty( $animate ) and $animate !== 'none' ) {
			$animate_start = '<div class="animated start-' . $animate . '" title="' . $delay . '">';
			$animate_end   = '</div><div class="clearboth"></div>';
		}
		
		// Output services
		echo $animate_start;

			if ( empty( $style ) or $style == 'style1' ) {

				$output .= '<div class="services-builder style1">';
				$output .= $image;
				$output .= '<div class="iconmain">' . $heading . $text . $link . '</div>';
				$output .= '</div>';

			} else if ( $style == 'style2' ) {

				$output .= '<div class="services-builder style2">';
				$output .= $icon;
				$output .= '<div class="iconmain">' . $heading . $text . $link . '</div>';
				$output .= '</div>';

			}
			echo $output;

		echo $animate_end;

		// Load animation styles and scripts
		if ( ! empty( $animate ) and $animate !== 'none' ) {
			
			if ( ! wp_script_is( 'animate-js', 'enqueued' ) ) {
			// Enque styles only if widget is being used
			wp_enqueue_style( 'animate-css', plugin_dir_url(SITEORIGIN_PANELS_BASE_FILE) . 'inc/plugins/animate.css/animate.css', array(), '1.0' );
			wp_enqueue_style( 'animate-thinkup-css', plugin_dir_url(SITEORIGIN_PANELS_BASE_FILE) . 'widgets-builder/animation/css/animate-thinkup-panels.css', array(), '1.0' );

			if ( ! wp_script_is( 'waypoints', 'enqueued' ) ) {
			// Enque waypoints only if widget is being used
			wp_enqueue_script( 'waypoints', plugin_dir_url(SITEORIGIN_PANELS_BASE_FILE) . 'inc/plugins/waypoints/waypoints.min.js', array( 'jquery' ), '2.0.3', 'true'  );
			wp_enqueue_script( 'waypoints-sticky', plugin_dir_url(SITEORIGIN_PANELS_BASE_FILE) . 'inc/plugins/waypoints/waypoints-sticky.min.js', array( 'jquery' ), '2.0.3', 'true'  );
			}

			// Enque scripts only if widget is being used
			wp_enqueue_script( 'animate-js', plugin_dir_url(SITEORIGIN_PANELS_BASE_FILE) . 'widgets-builder/animation/js/animate-thinkup-panels.js', array( 'jquery' ), '1.1', true );
			}
		}

	}
}
add_action( 'widgets_init', function() { return register_widget( "thinkup_builder_services" ); } );

?>
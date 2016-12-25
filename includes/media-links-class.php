<?php

class Media_Links_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'media_links_widget',
			'description' => 'Outputs social icons linked to profiles',
		);
		parent::__construct( 'media_links_widget', 'Media_Links_Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$links = array(
		    'facebook' => esc_attr($instance['facebook_link']),
		    'twitter' => esc_attr($instance['twitter_link']),
		    'linkedin' => esc_attr($instance['linkedin_link']),
		    'google' => esc_attr($instance['google_link'])
		);
		
		
		$icons = array(
		    'facebook' => esc_attr($instance['facebook_icon']),
		    'twitter' => esc_attr($instance['twitter_icon']),
		    'linkedin' => esc_attr($instance['linkedin_icon']),
		    'google' => esc_attr($instance['google_icon'])
		);

		$icon_width = $instance['icon_width'];
		
		echo $args['before_widget'];
	
		// Call Frontend Function
		$this->getMediaLinks($links, $icons, $icon_width);

		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
	    // Call Form Function
	    $this->getForm($instance);
	}


	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = array(
		    'facebook_link' => (!empty($new_instance['facebook_link'])) ? strip_tags($new_instance['facebook_link']) : '',
		    'twitter_link' => (!empty($new_instance['twitter_link'])) ? strip_tags($new_instance['twitter_link']) : '',
		    'linkedin_link' => (!empty($new_instance['linkedin_link'])) ? strip_tags($new_instance['linkedin_link']) : '',
		    'google_link' => (!empty($new_instance['google_link'])) ? strip_tags($new_instance['google_link']) : '',
		    'facebook_icon' => (!empty($new_instance['facebook_icon'])) ? strip_tags($new_instance['facebook_icon']) : '',
		    'twitter_icon' => (!empty($new_instance['twitter_icon'])) ? strip_tags($new_instance['twitter_icon']) : '',
		    'linkedin_icon' => (!empty($new_instance['linkedin_icon'])) ? strip_tags($new_instance['linkedin_icon']) : '',
		    'google_icon' => (!empty($new_instance['google_icon'])) ? strip_tags($new_instance['google_icon']) : '',
		    'icon_width' => (!empty($new_instance['icon_width'])) ? strip_tags($new_instance['icon_width']) : ''
		);
	
		return $instance;
	}

	/**
	 * Gets and Displays Form
	 *
	 * @param array $instance The widget options
	 */
	public function getForm( $instance ) {
	    // Get Facebook Link
	    if(isset($instance['facebook_link'])){
	         $facebook_link = esc_attr($instance['facebook_link']);
	    } else {
	        $facebook_link = 'http://www.facebook.com';
	    }

	    // Get Twitter Link
	    if(isset($instance['twitter_link'])){
	         $twitter_link = esc_attr($instance['twitter_link']);
	    } else {
	        $twitter_link = 'http://www.twitter.com';
	    }

	    // Get LinkedIn Link
	    if(isset($instance['linkedin_link'])){
	         $linkedin_link = esc_attr($instance['linkedin_link']);
	    } else {
	        $linkedin_link = 'http://www.linkedin.com';
	    }

	    // Get GooglePlus Link
	    if(isset($instance['google_link'])){
	         $google_link = esc_attr($instance['google_link']);
	    } else {
	        $google_link = 'http://www.plus.google.com';
	    }
	
	    // ICONS

            // Get Facebook Icon
	    if(isset($instance['facebook_icon'])) {
		$facebook_icon = esc_attr($instance['facebook_icon']);
	    } else {
		$facebook_icon = plugins_url() . '/media-links/img/facebook.png';
	    }

            // Get Twitter Icon
	    if(isset($instance['twitter_icon'])) {
		$twitter_icon = esc_attr($instance['twitter_icon']);
	    } else {
		$twitter_icon = plugins_url() . '/media-links/img/twitter.png';
	    }

            // Get LinkedIn Icon
	    if(isset($instance['linkedin_icon'])) {
		$linkedin_icon = esc_attr($instance['linkedin_icon']);
	    } else {
		$linkedin_icon = plugins_url() . '/media-links/img/linkedin.png';
	    }

            // Get GooglePlus Icon
	    if(isset($instance['google_icon'])) {
		$google_icon = esc_attr($instance['google_icon']);
	    } else {
		$google_icon = plugins_url() . '/media-links/img/google.png';
	    }
	
 	    // Get Icon Size
	    if(isset($instance['icon_width'])) {
	       	$icon_width = esc_attr($instance['icon_width']);
	    } else {
		$icon_width = 32;
	    }

	    ?>
		
	    <h4>Facebook</h4>

		<p><label for="<?php echo $this->get_field_id('facebook_link'); ?>"><?php _e('Link:'); ?></label><input class="widefat" id="<?php echo $this->get_field_id('facebook_link'); ?>" name="<?php echo $this->get_field_name('facebook_link'); ?>" type="text" value="<?php echo esc_attr($facebook_link); ?>"></p>

	        <p><label for="<?php echo $this->get_field_id('facebook_icon'); ?>"><?php _e('Icon:'); ?><input class="widefat" id="<?php echo $this->get_field_id('facebook_icon'); ?>" name="<?php echo $this->get_field_name('facebook_icon'); ?>" type="text" value="<?php echo esc_attr($facebook_icon); ?>"></p>


	    <h4>Twitter</h4>

		<p><label for="<?php echo $this->get_field_id('twitter_link'); ?>"><?php _e('Link:'); ?></label><input class="widefat" id="<?php echo $this->get_field_id('twitter_link'); ?>" name="<?php echo $this->get_field_name('twitter_link'); ?>" type="text" value="<?php echo esc_attr($twitter_link); ?>"></p>

	        <p><label for="<?php echo $this->get_field_id('twitter_icon'); ?>"><?php _e('Icon:'); ?><input class="widefat" id="<?php echo $this->get_field_id('twitter_icon'); ?>" name="<?php echo $this->get_field_name('twitter_icon'); ?>" type="text" value="<?php echo esc_attr($twitter_icon); ?>"></p>


	    <h4>LinkedIn</h4>

		<p><label for="<?php echo $this->get_field_id('linkedin_link'); ?>"><?php _e('Link:'); ?></label><input class="widefat" id="<?php echo $this->get_field_id('linkedin_link'); ?>" name="<?php echo $this->get_field_name('linkedin_link'); ?>" type="text" value="<?php echo esc_attr($linkedin_link); ?>"></p>

	        <p><label for="<?php echo $this->get_field_id('linkedin_icon'); ?>"><?php _e('Icon:'); ?><input class="widefat" id="<?php echo $this->get_field_id('linkedin_icon'); ?>" name="<?php echo $this->get_field_name('linkedin_icon'); ?>" type="text" value="<?php echo esc_attr($linkedin_icon); ?>"></p>


	    <h4>Google+</h4>

		<p><label for="<?php echo $this->get_field_id('google_link'); ?>"><?php _e('Link: '); ?></label><input class="widefat" id="<?php echo $this->get_field_id('google_link'); ?>" name="<?php echo $this->get_field_name('google_link'); ?>" type="text" value="<?php echo esc_attr($google_link); ?>"></p>

	        <p><label for="<?php echo $this->get_field_id('google_icon'); ?>"><?php _e('Icon:'); ?><input class="widefat" id="<?php echo $this->get_field_id('google_icon'); ?>" name="<?php echo $this->get_field_name('google_icon'); ?>" type="text" value="<?php echo esc_attr($google_icon); ?>"></p>

		<p><label for="<?php echo $this->get_field_id('icon_width'); ?>"><?php _e('Icon Width:'); ?><input class="widefat" id="<?php echo $this->get_field_id('icon_width'); ?>" name="<?php echo $this->get_field_name('icon_width'); ?>" type="text" value="<?php echo esc_attr($icon_width); ?>"></p>


	    <?php
	}

	/**
	 * Gets and Displays Media Icons
	 *
	 * @param array $links Media Links
	 * @param array $icons Media Icons
	 * @param array $icon_width Width of Icons
	 */
	public function getMediaLinks( $links, $icons, $icon_width ) {
	    ?>
		<div class="media-links">
		  <a target="_blank" href="<?php echo esc_attr($links['facebook']); ?>"><img width="<?php echo ($icon_width); ?>" src="<?php echo esc_attr($icons['facebook']); ?>"></a>
		  <a target="_blank" href="<?php echo esc_attr($links['twitter']); ?>"><img width="<?php echo ($icon_width); ?>" src="<?php echo esc_attr($icons['twitter']); ?>"></a>
		  <a target="_blank" href="<?php echo esc_attr($links['linkedin']); ?>"><img width="<?php echo ($icon_width); ?>" src="<?php echo esc_attr($icons['linkedin']); ?>"></a>
		  <a target="_blank" href="<?php echo esc_attr($links['google']); ?>"><img width="<?php echo ($icon_width); ?>" src="<?php echo esc_attr($icons['google']); ?>"></a>
		</div>
      	    <?php
	}
}

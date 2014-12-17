<?php
/*
Plugin Name: MailChimp Subscribe Widget
Description: Creates an AJAX signup form to add an email (w/ geolocation data) to a MailChimp list.
Author: Josh Clark
Version: 1
Author URI: http://khameleon.org/work
*/

class MailChimpSubscribeWidget extends Widget {

	function MailChimpSubscribeWidget() {
		$widget_ops = array(
			'classname' => 'MailChimpSubscribeWidget',
			'description' => 'Displays a MailChimp signup form.'
		);

		$this->WP_Widget('MailChimpSubscribeWidget', 'MailChimp Signup Form', $widget_ops);
	}

	function form($instance) {

		$instance = wp_parse_args(
			(array) $instance,
			
			array(
				'heading' => '',
				'intro_text' => '',
				'api_key' => '',
				'list_id' => '',
				'city_fieldname' => '',
				'country_fieldname' => '',
				'button_text' => '',
				'outro_text' => ''
			)
		);

		?>

		<p><label for="<?php echo $this->get_field_id('heading'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('heading'); ?>" name="<?php echo $this->get_field_name('heading'); ?>" type="text" value="<?php echo attribute_escape($instance['heading']); ?>"></label></p>
		<p><label for="<?php echo $this->get_field_id('intro_text'); ?>">Intro Text: <textarea class="widefat" id="<?php echo $this->get_field_id('intro_text'); ?>" name="<?php echo $this->get_field_name('intro_text'); ?>"><?php echo attribute_escape($instance['intro_text']); ?></textarea></label></p>
		<p><label for="<?php echo $this->get_field_id('api_key'); ?>">API Key: <input class="widefat" id="<?php echo $this->get_field_id('api_key'); ?>" name="<?php echo $this->get_field_name('api_key'); ?>" type="text" value="<?php echo attribute_escape($instance['api_key']); ?>"></label></p>
		<p><label for="<?php echo $this->get_field_id('list_id'); ?>">List ID: <input class="widefat" id="<?php echo $this->get_field_id('list_id'); ?>" name="<?php echo $this->get_field_name('list_id'); ?>" type="url" value="<?php echo attribute_escape($instance['list_id']); ?>"></label></p>
		<p><label for="<?php echo $this->get_field_id('city_fieldname'); ?>">City Field Name: <input class="widefat" id="<?php echo $this->get_field_id('city_fieldname'); ?>" name="<?php echo $this->get_field_name('city_fieldname'); ?>" type="text" value="<?php echo attribute_escape($instance['city_fieldname']); ?>"></label></p>
		<p><label for="<?php echo $this->get_field_id('country_fieldname'); ?>">Country Field Name: <input class="widefat" id="<?php echo $this->get_field_id('country_fieldname'); ?>" name="<?php echo $this->get_field_name('country_fieldname'); ?>" type="text" value="<?php echo attribute_escape($instance['country_fieldname']); ?>"></label></p>
		<p><label for="<?php echo $this->get_field_id('button_text'); ?>">Button Text: <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo attribute_escape($instance['button_text']); ?>"></label></p>
		<p><label for="<?php echo $this->get_field_id('outro_text'); ?>">Outro Text: <textarea class="widefat" id="<?php echo $this->get_field_id('outro_text'); ?>" name="<?php echo $this->get_field_name('outro_text'); ?>"><?php echo attribute_escape($instance['outro_text']); ?></textarea></label></p>

		<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['heading'] = $new_instance['heading'];
		$instance['intro_text'] = $new_instance['intro_text'];
		$instance['api_key'] = $new_instance['api_key'];
		$instance['list_id'] = $new_instance['list_id'];
		$instance['city_fieldname'] = $new_instance['city_fieldname'];
		$instance['country_fieldname'] = $new_instance['country_fieldname'];
		$instance['button_text'] = $new_instance['button_text'];
		$instance['outro_text'] = $new_instance['outro_text'];

		return $instance;
	}

	function widget($args, $instance) {
		
		# TODO: Properly load submission JavaScript here.

		extract($args, EXTR_SKIP);

		?>

		<!-- MailChimp Subscribe Widget -->

		<div class="mailchimp-subscribe-widget">
			<h3><?php echo $heading; ?></h3>
			<p class="mailchimp-subscribe-paragraph intro"><?php echo $intro_text; ?></p>
			<input type="hidden" name="mailchimp-subscribe-api-key" value="<?php echo $api_key; ?>">
			<input type="hidden" name="mailchimp-subscribe-list-id" value="<?php echo $list_id; ?>">
			<input type="hidden" name="mailchimp-subscribe-city-{{city_filename}}" value="<?php echo $city; ?>">
			<input type="hidden" name="mailchimp-subscribe-country-{{country_fieldname}}" value="<?php echo $country; ?>">
			<button class="mailchimp-subscribe-button"><?php echo $button_text; ?></button>
			<p class="mailchimp-subscribe-paragraph outro"><?php echo $outro_text; ?></p>
		</div>

		<!-- /MailChimp Subscribe Widget -->

		<?php
	}
}
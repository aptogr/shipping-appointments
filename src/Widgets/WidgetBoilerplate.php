<?php

namespace ShippingAppointments\Widgets;

use ShippingAppointments\Interfaces\PluginInterface;
use WP_Widget;

class WidgetBoilerplate extends WP_Widget implements PluginInterface {

	function __construct() {

		parent::__construct(
			'widget_boilerplate',
			__('Shipping Appointments: Widget Boilerplate', self::PLUGIN_NAME ),
			array(
				'description' => __( 'This is a custom widget boilerplate. It\'s defined in /shipping-appointments/src/Widgets/WidgetBoilerplate.php', self::PLUGIN_NAME ),
			)
		);

	}

	// Creating widget front-end
	public function widget( $args, $instance ) {

		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];

		echo $title;

		echo $args['after_widget'];

	}


	// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'wpb_widget_domain' );
		}

		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;

	}


}

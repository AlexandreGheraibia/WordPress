
<?php

	/*
		widget use for the content menu management
	*/

	//	add the widget to the back offie

	add_action( 'widgets_init', 'register_mon_premier_widget_statique' );
	
	function register_mon_premier_widget_statique() {
		register_widget( 'mon_premier_widget_statique' );
	}
	
	//define a class for the widget content
	class mon_premier_widget_statique extends WP_Widget {
		function __construct() {
			parent::__construct(
				'1mon_premier_widget_statique',
				esc_html__( 'Mon premier widget statique', 'textdomain' ),
				array( 'description' => esc_html__( 'Affiche karac', 'textdomain' ), )
			);
		}
	
		private $widget_fields = array(
        array(
            'label' => 'Nom',
            'id' => 'nom_text',
            'type' => 'text',
        ),
        array(
            'label' => 'Adresse',
            'id' => 'adresse_text',
            'type' => 'text',
        ),
        array(
            'label' => 'Email',
            'id' => 'email_email',
            'type' => 'email',
        ),
        array(
            'label' => 'Téléphone',
            'id' => 'tlphone_tel',
            'type' => 'tel',
        ),
    );
	//display the content in the taget page
	 public function widget( $args, $instance ) {
        echo $args['before_widget'];

        // Output generated fields
        echo '<p>'.$instance['nom_text'].'</p>';
        echo '<p>'.$instance['adresse_text'].'</p>';
        echo '<p>'.$instance['email_email'].'</p>';
       // echo '<p>'.$instance['tlphone_tel'].'</p>';
        wp_nav_menu ( array ('theme_location' => 'cluq-menu', 'menu_class' => 'my-footer-menu') );
        echo $args['after_widget'];
    }
	//display the field in the background
	public function field_generator( $instance ) {
        $output = '';
       foreach ( $this->widget_fields as $widget_field ) {
            $default = '';
            if ( isset($widget_field['default']) ) {
                $default = $widget_field['default'];
            }
            $widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( $default, 'textdomain' );
            switch ( $widget_field['type'] ) {
                default:
                    $output .= '<p>';
                    $output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'textdomain' ).':</label> ';
                    $output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
                    $output .= '</p>';
            }
        }
        echo $output;
    }
	
	public function form( $instance ) {
        $this->field_generator( $instance );
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        foreach ( $this->widget_fields as $widget_field ) {
            switch ( $widget_field['type'] ) {
                default:
                    $instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
            }
        }
        return $instance;
    }
	

}
	
?>
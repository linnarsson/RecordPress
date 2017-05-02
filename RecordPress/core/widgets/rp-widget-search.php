<?php
// Search widget
// Creating the widget 
class rp_widget_search extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'rp_widget_search', 

// Widget name will appear in UI
__('RecordPress search', 'rp_widget_search_domain'), 

// Widget description
array( 'description' => __( 'Search for records.', 'rp_widget_search_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
//echo __( 'Hello, World!', 'rp_widget_search_domain' );
echo do_shortcode('[rp_search_field]');
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'Search', 'rp_widget_search_domain' );
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
} // Class rp_widget_search ends here

// Register and load the widget
function rp_load_widget_search() {
	register_widget( 'rp_widget_search' );
}
add_action( 'widgets_init', 'rp_load_widget_search' );
?>
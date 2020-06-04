<h1>Plugin Option Another</h1>

<form action="<?php echo admin_url( 'admin-post.php' ); ?>" method="post">
	<?php
	$value = get_option( 'plugin_option_another_longitude' );
	wp_nonce_field( 'plugin_option_another' );
	?>
    <label for="plugin_option_another_longitude"><?php _e( 'Longitude', 'plugin-option' ); ?>: </label>
    <input type="text" id="plugin_option_another_longitude" name="plugin_option_another_longitude"
           value="<?php echo esc_attr( $value ); ?>"/>
    <input type="hidden" name="action" value="plugin_option_page_another">
	<?php
	submit_button( __( 'Save', 'plugin-option' ) );
	?>
</form>
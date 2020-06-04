<?php

class PluginOptionAnother {
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'plugin_option_create_page' ) );
		add_action( 'admin_post_plugin_option_page_another', array( $this, 'plugin_option_another_save_form' ) );
	}

	public function plugin_option_create_page() {
		$page_title = __( 'Plugin Option Another ', 'plugin-option' );
		$menu_title = 'Plugin Option Another';
		$capability = 'manage_options';
		$slug       = 'plugin_option_page_another';
		$callback   = array( $this, 'page_content' );
		$icon       = 'dashicons-admin-site-alt2';
		add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon );
	}

	public function page_content() {
		include_once plugin_dir_path( __FILE__ ) . "/form.php";
	}

	public function plugin_option_another_save_form() {
		check_admin_referer( 'plugin_option_another' );

		if ( isset( $_POST['plugin_option_another_longitude'] ) ) {
			update_option( 'plugin_option_another_longitude', sanitize_text_field( $_POST['plugin_option_another_longitude'] ) );
		}
		wp_redirect( 'admin.php?page=plugin_option_page_another' );
	}


}


new PluginOptionAnother();















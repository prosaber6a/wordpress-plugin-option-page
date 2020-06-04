<?php
/**
 * Plugin Name: Plugin Option
 * Author: SaberHR
 * Plugin URI: http://saberhr.com
 * Author URI: http://saberhr.com
 * Description:
 * Version: 1.0.0
 * Licence: GPLv2 or later
 * Text Domain: plugin-option
 * Domain Path: /language/
 */


class PluginOption {
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		add_action( 'admin_menu', array( $this, 'create_setting' ) );
		add_action( 'admin_init', array( $this, 'setup_section' ) );
		add_action( 'admin_init', array( $this, 'setup_field' ) );
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'plugin_setting_link' ) );
	}

	public function load_textdomain() {
		load_plugin_textdomain( 'plugin-option', false, plugin_dir_url( __FILE__ ) . '/languages' );
	}

	public function create_setting() {
		$page_title = __( 'Plugin Option Demo', 'plugin-option' );
		$menu_title = 'Plugin Option Demo';
		$capability = 'manage_options';
		$slug       = 'plugin_option_page';
		$callback   = array( $this, 'setting_content' );
		$icon       = 'dashicons-admin-site-alt2';
		add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon );
	}


	public function setting_content() {
		?>
        <div class="wrap">
            <h1>Option Demo</h1>
			<?php settings_errors(); ?>
            <form action="" method="post">
				<?php
				settings_fields( 'plugin_option_group' );
				do_settings_sections( 'plugin_option_page' );
				submit_button();
				?>
            </form>
        </div>
		<?php

	}

	public function setup_section() {
		add_settings_section(
			'plugin_option_section',
			__( 'Demonstration of plugin settings page', 'plugin-option' ),
			array(),
			'plugin_option_page'
		);
	}


	public function setup_field() {
		$fields = array(
			array(
				'id'      => 'plugin_option_latitude',
				'label'   => __( 'Latitude', 'plugin-option' ),
				'type'    => 'text',
				'section' => 'plugin_option_section'
			),
			array(
				'id'      => 'plugin_option_longitude',
				'label'   => __( 'Longitude', 'plugin-option' ),
				'type'    => 'text',
				'section' => 'plugin_option_section'
			),
			array(
				'id'      => 'plugin_option_zoom',
				'label'   => __( 'Zoom Level', 'plugin-option' ),
				'type'    => 'text',
				'section' => 'plugin_option_section'
			),
			array(
				'id'      => 'plugin_option_api_key',
				'label'   => __( 'API Key', 'plugin-option' ),
				'type'    => 'text',
				'section' => 'plugin_option_section'
			),
			array(
				'id'      => 'plugin_option_ext_css',
				'label'   => __( 'External CSS', 'plugin-option' ),
				'type'    => 'textarea',
				'section' => 'plugin_option_section'
			)

		);

		foreach ( $fields as $field ) {
			add_settings_field(
				$field['id'],
				$field['label'],
				array( $this, 'field_callback' ),
				'plugin_option_page',
				$field['section'],
				$field
			);
			register_setting( 'plugin_option_group', $field['id'] );
		}


	}

	public function field_callback( $field ) {
		$value = get_option( $field['id'] );
		switch ( $field['type'] ) {
			case 'textarea':
				printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>',
					$field['id'],
					isset( $field['placeholder'] ) ? $field['placeholder'] : '',
					$value
				);
				break;
			default:
				printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />',
					$field['id'],
					$field['type'],
					isset( $field['placeholder'] ) ? $field['placeholder'] : '',
					$value
				);
		}
		if ( isset( $field['desc'] ) ) {
			if ( $desc = $field['desc'] ) {
				printf( '<p class="description">%s </p>', $desc );
			}
		}
	}


	public function plugin_setting_link( $links ) {
		$newlinks = sprintf( "<a href='%s'>%s</a>", 'admin.php?page=plugin_option_page', __( 'Setting', 'plugin-option' ) );
		$links[]  = $newlinks;

		return $links;
	}


}


new PluginOption();



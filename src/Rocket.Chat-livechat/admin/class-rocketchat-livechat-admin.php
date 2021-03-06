<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://rocket.chat
 * @since      1.0.0
 *
 * @package    Rocketchat_Livechat
 * @subpackage Rocketchat_Livechat/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rocketchat_Livechat
 * @subpackage Rocketchat_Livechat/admin
 * @author     Marko Banušić <mbanusic@gmail.com>
 */
class Rocketchat_Livechat_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	public function register_settings() {
		register_setting(
			'rocketchat-livechat-options', 'rocketchat-livechat-username', array(
			$this,
			'sanitize_text'
		)
		);
		register_setting(
			'rocketchat-livechat-options', 'rocketchat-livechat-user-id', array(
			$this,
			'sanitize_text'
		)
		);
		register_setting(
			'rocketchat-livechat-options', 'rocketchat-livechat-auth-token', array(
			$this,
			'sanitize_text'
		)
		);
		register_setting(
			'rocketchat-livechat-options', 'rocketchat-livechat-url', array(
			$this,
			'sanitize_url'
		)
		);

		add_settings_section( 'rocketchat-livechat-options-head', 'LiveChat API settings', '', 'rocketchat-livechat-options' );
		add_settings_field(
			'rocketchat-livechat-url', __( 'URL of LiveChat', 'rocketchat-livechat' ), array(
			$this,
			'settings_text'
		), 'rocketchat-livechat-options', 'rocketchat-livechat-options-head', array(
			'id'   => 'rocketchat-livechat-url',
			'desc' => __( 'Please enter the URL to your Rocket.Chat instance (e.g. https://chat.domain.tld/)', 'rocketchat-livechat' ),
			'size' => 100
		)
		);
		add_settings_field(
			'rocketchat-livechat-username', __( 'Username', 'rocketchat-livechat' ), array(
			$this,
			'settings_text'
		), 'rocketchat-livechat-options', 'rocketchat-livechat-options-head', array(
			'id'   => 'rocketchat-livechat-username',
			'desc' => __( 'Enter your username', 'rocketchat-livechat' )
		)
		);
		add_settings_field(
			'rocketchat-livechat-password', __( 'Password', 'rocketchat-livechat' ), array(
			$this,
			'settings_text'
		), 'rocketchat-livechat-options', 'rocketchat-livechat-options-head', array(
				'id'   => 'rocketchat-livechat-password',
				'desc' => __( 'Enter your password', 'rocketchat-livechat' ),
				'type' => 'password'
			)
		);


	}

	public function menu() {
		add_options_page(
			__( 'Rocket.Chat LiveChat', 'rocketchat-livechat' ), __('Rocket.Chat LiveChat', 'rocketchat-livechat' ), 'manage_options', 'rocketchat-livechat', array(
			$this,
			'options'
		)
		);
	}

	public function options() {
		?>
		<div class="wrap">
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="435.721px" height="85.242px" viewBox="62.402 -18.766 435.721 85.242" enable-background="new 62.402 -18.766 435.721 85.242" xml:space="preserve"><g>
	<path fill="#04436A" d="M205.456,22.207c0,4.297-1.603,7.119-4.681,8.465l4.425,16.803c0.192,0.771-0.192,1.154-0.898,1.154h-6.67   c-0.641,0-0.961-0.32-1.09-0.898l-4.297-16.289h-4.425v16.162c0,0.642-0.384,1.025-1.026,1.025h-6.67   c-0.641,0-1.026-0.385-1.026-1.025V-1.651c0-0.641,0.385-1.026,1.026-1.026h16.097c6.028,0,9.235,3.207,9.235,9.235V22.207   L205.456,22.207z M194.169,22.976c1.667,0,2.565-0.898,2.565-2.565V8.354c0-1.667-0.898-2.564-2.565-2.564h-6.349v17.187   L194.169,22.976L194.169,22.976z"/>
	<path fill="#04436A" d="M210.583,6.558c0-6.028,3.206-9.235,9.235-9.235h7.183c6.028,0,9.235,3.207,9.235,9.235v32.836   c0,6.027-3.207,9.234-9.235,9.234h-7.183c-6.029,0-9.235-3.207-9.235-9.234V6.558z M225.397,40.355   c1.667,0,2.565-0.834,2.565-2.565V8.162c0-1.667-0.898-2.565-2.565-2.565h-3.719c-1.667,0-2.565,0.898-2.565,2.565v29.629   c0,1.73,0.898,2.564,2.565,2.564H225.397L225.397,40.355z"/>
	<path fill="#04436A" d="M268.362,13.484c0,0.642-0.385,1.026-1.025,1.026h-6.413c-0.706,0-1.026-0.384-1.026-1.026v-5.13   c0-1.667-0.897-2.564-2.564-2.564h-3.335c-1.731,0-2.565,0.897-2.565,2.564V37.6c0,1.731,0.897,2.563,2.565,2.563h3.335   c1.667,0,2.564-0.833,2.564-2.563v-5.132c0-0.642,0.32-1.026,1.026-1.026h6.413c0.643,0,1.025,0.384,1.025,1.026v6.927   c0,6.027-3.271,9.234-9.234,9.234h-7.183c-6.028,0-9.299-3.207-9.299-9.234V6.558c0-6.028,3.271-9.235,9.299-9.235h7.183   c5.964,0,9.234,3.207,9.234,9.235V13.484z"/>
	<path fill="#04436A" d="M295.422,48.629c-0.771,0-1.218-0.32-1.476-0.961l-8.079-19.048l-2.374,4.554v14.172   c0,0.834-0.448,1.283-1.282,1.283h-6.157c-0.834,0-1.283-0.449-1.283-1.283v-48.74c0-0.833,0.449-1.283,1.283-1.283h6.157   c0.833,0,1.282,0.449,1.282,1.283v19.881l9.876-20.202c0.321-0.641,0.771-0.962,1.476-0.962h6.733c0.962,0,1.347,0.642,0.897,1.539   l-10.901,22.382l11.606,25.91c0.449,0.834,0.064,1.475-0.961,1.475H295.422z"/>
	<path fill="#04436A" d="M333.45,4.763c0,0.641-0.257,1.09-1.026,1.09h-16.033v12.826h12.249c0.643,0,1.026,0.385,1.026,1.09v6.349   c0,0.706-0.385,1.091-1.026,1.091h-12.249v12.954h16.033c0.771,0,1.026,0.321,1.026,1.026v6.414c0,0.641-0.257,1.024-1.026,1.024   h-23.6c-0.578,0-0.963-0.385-0.963-1.024V-1.651c0-0.641,0.385-1.026,0.963-1.026h23.6c0.771,0,1.026,0.385,1.026,1.026V4.763z"/>
	<path fill="#04436A" d="M363.204-2.677c0.705,0,1.026,0.385,1.026,1.026v6.414c0,0.641-0.321,1.026-1.026,1.026h-7.439v41.814   c0,0.705-0.32,1.024-1.025,1.024h-6.67c-0.643,0-1.026-0.319-1.026-1.024V5.789h-7.438c-0.643,0-1.026-0.385-1.026-1.026v-6.414   c0-0.641,0.385-1.026,1.026-1.026H363.204z"/>
	<path fill="#04436A" d="M363.585,41.445c0-0.834,0.449-1.282,1.283-1.282h5.836c0.834,0,1.282,0.448,1.282,1.282v5.899   c0,0.835-0.448,1.283-1.282,1.283h-5.836c-0.834,0-1.283-0.448-1.283-1.283V41.445z"/>
	<path fill="#04436A" d="M404.114,13.484c0,0.642-0.386,1.026-1.026,1.026h-6.413c-0.705,0-1.025-0.384-1.025-1.026v-5.13   c0-1.667-0.897-2.564-2.564-2.564h-3.335c-1.732,0-2.565,0.897-2.565,2.564V37.6c0,1.731,0.897,2.563,2.565,2.563h3.335   c1.667,0,2.564-0.833,2.564-2.563v-5.132c0-0.642,0.32-1.026,1.025-1.026h6.413c0.643,0,1.026,0.384,1.026,1.026v6.927   c0,6.027-3.271,9.234-9.235,9.234h-7.183c-6.028,0-9.299-3.207-9.299-9.234V6.558c0-6.028,3.271-9.235,9.299-9.235h7.183   c5.965,0,9.235,3.207,9.235,9.235V13.484z"/>
	<path fill="#04436A" d="M427.455-1.651c0-0.641,0.384-1.026,1.025-1.026h6.605c0.77,0,1.089,0.385,1.089,1.026v49.254   c0,0.641-0.32,1.024-1.089,1.024h-6.605c-0.643,0-1.025-0.385-1.025-1.024V27.209h-8.209v20.395c0,0.642-0.385,1.025-1.026,1.025   h-6.604c-0.771,0-1.091-0.385-1.091-1.025V-1.651c0-0.641,0.32-1.026,1.091-1.026h6.604c0.643,0,1.026,0.385,1.026,1.026v20.394   h8.209V-1.651L427.455-1.651z"/>
	<path fill="#04436A" d="M465.419,48.629c-0.577,0-0.897-0.32-1.026-0.898l-1.795-9.362h-11.416l-1.73,9.362   c-0.129,0.578-0.449,0.898-1.026,0.898h-6.861c-0.705,0-1.026-0.385-0.835-1.09l10.646-49.318c0.129-0.641,0.513-0.898,1.09-0.898   h8.915c0.577,0,0.962,0.257,1.09,0.898l10.646,49.318c0.129,0.705-0.128,1.09-0.897,1.09H465.419z M456.889,8.546l-4.104,22.382   h8.209L456.889,8.546z"/>
	<path fill="#04436A" d="M497.097-2.677c0.705,0,1.026,0.385,1.026,1.026v6.414c0,0.641-0.321,1.026-1.026,1.026h-7.438v41.814   c0,0.705-0.321,1.024-1.026,1.024h-6.67c-0.641,0-1.025-0.319-1.025-1.024V5.789h-7.438c-0.642,0-1.025-0.385-1.025-1.026v-6.414   c0-0.641,0.385-1.026,1.025-1.026H497.097z"/></g>
	<path fill="#C1272D" d="M162.586,23.788c0-5.031-1.505-9.854-4.474-14.339c-2.666-4.025-6.401-7.588-11.1-10.591  c-9.074-5.796-21-8.989-33.579-8.989c-4.202,0-8.344,0.355-12.361,1.059c-2.492-2.333-5.41-4.432-8.497-6.091  c-16.494-7.994-30.172-0.188-30.172-0.188S75.12-4.904,73.052,4.253c-5.689,5.644-8.773,12.45-8.773,19.535  c0,0.022,0.001,0.045,0.001,0.068c0,0.022-0.001,0.044-0.001,0.068c0,7.085,3.083,13.891,8.773,19.534  c2.068,9.158-10.649,19.605-10.649,19.605s13.678,7.805,30.172-0.188c3.087-1.659,6.004-3.759,8.497-6.091  c4.018,0.703,8.159,1.058,12.361,1.058c12.58,0,24.505-3.191,33.579-8.987c4.699-3.003,8.434-6.565,11.1-10.592  c2.969-4.484,4.474-9.309,4.474-14.338c0-0.023-0.001-0.045-0.001-0.068S162.586,23.81,162.586,23.788z"/>
	<path fill="#FFFFFF" d="M113.433-3.018c23.293,0,42.177,12.062,42.177,26.941c0,14.878-18.884,26.941-42.177,26.941  c-5.187,0-10.154-0.6-14.743-1.693c-4.664,5.61-14.924,13.411-24.891,10.89c3.242-3.482,8.045-9.366,7.017-19.058  c-5.974-4.648-9.56-10.597-9.56-17.08C71.255,9.043,90.139-3.018,113.433-3.018"/>
	<g><g><circle fill="#C1272D" cx="113.433" cy="24.79" r="5.603"/></g><g><circle fill="#C1272D" cx="132.913" cy="24.79" r="5.603"/></g><g><circle fill="#C1272D" cx="93.952" cy="24.79" r="5.602"/></g></g>
	<g><path fill="#CCCCCC" d="M113.433,47.319c-5.187,0-10.154-0.52-14.743-1.468c-4.118,4.294-12.6,10.066-21.39,9.854   c-1.158,1.755-2.417,3.19-3.501,4.355c9.967,2.521,20.227-5.279,24.891-10.89c4.589,1.094,9.557,1.693,14.743,1.693   c23.106,0,41.87-11.871,42.169-26.585C155.303,37.032,136.539,47.319,113.433,47.319z"/></g></svg>
		<?php
		if ( isset( $_POST['option_page'] ) && $_POST['option_page'] == 'rocketchat-livechat-options' ) {
			// we will only save URL and username, password will be asked only initially for getting auth token
			if ( isset( $_POST['rocketchat-livechat-url'] ) && $_POST['rocketchat-livechat-url'] ) {
				update_option( 'rocketchat-livechat-url', esc_url( $_POST['rocketchat-livechat-url'] ) );
			}
			if ( isset( $_POST['rocketchat-livechat-username'] ) && $_POST['rocketchat-livechat-username'] ) {
				update_option( 'rocketchat-livechat-username', sanitize_text_field( $_POST['rocketchat-livechat-username'] ) );
			}
			if ( isset( $_POST['rocketchat-livechat-password'] ) && $_POST['rocketchat-livechat-password'] ) {
				//user entered password, so we can make an auth request
				$c = new Rocketchat_Livechat_REST_API();
				$r = $c->login( $_POST['rocketchat-livechat-username'], $_POST['rocketchat-livechat-password'], $_POST['rocketchat-livechat-url'] );
				//TODO:notice of success/failure
			}
		}
		?>
		<form method="POST"><?php
			settings_fields( 'rocketchat-livechat-options' );
			do_settings_sections( 'rocketchat-livechat-options' );
			submit_button();
			?></form>

		<div>
			<p>User ID: <?php echo esc_html( get_option( 'rocketchat-livechat-user-id' ) ) ?></p>
			<p>Auth Token: <?php echo esc_html( get_option( 'rocketchat-livechat-auth-token' ) ) ?></p>
			<?php //TODO: button to clear data ?>
		</div>
		</div><?php
	}

	public function sanitize_url( $url ) {
		return esc_url_raw( sanitize_text_field( $url ) );
	}

	public function sanitize_text( $text ) {
		return sanitize_text_field( $text );
	}

	/**
	 * Custom method for generating input field
	 *
	 * @param array $args
	 */
	public function settings_text( $args ) {
		$id = $args['id'];
		if ( ! $id ) {
			return;
		}
		$default_options = array(
			'type'  => 'text',
			'size'  => 20,
			'class' => '',
			'desc'  => ''
		);
		$args            = wp_parse_args( $args, $default_options );
		$option          = '';
		if ( 'password' != $args['type'] ) {
			$option = get_option( $id );
		}
		?><input type="<?php echo esc_attr( $args['type'] ) ?>"
		         name="<?php echo esc_attr( $id ) ?>"
		         value="<?php echo esc_attr( $option ) ?>"
		         id="<?php echo esc_attr( $id ) ?>"
		         size="<?php echo esc_attr( $args['size'] ) ?>"
		         class="<?php echo esc_attr( $args['class'] ) ?>" ><?php
		if ( $args['desc'] ) {
			?><p
				class="description"><?php echo esc_html( $args['desc'] ); ?></p><?php
		}
	}
}

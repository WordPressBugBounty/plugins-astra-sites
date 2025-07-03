<?php
/**
 * Getting Started API
 *
 * @since 1.0.0
 * @package Getting Started API
 */

namespace GS\Classes;

use GS\Classes\GS_Helper;

/**
 * Class Getting Started API
 *
 * @since 1.0.0
 */
class GS_Api {

	/**
	 * Instance
	 *
	 * @access private
	 * @var object Class Instance.
	 * @since 1.0.0
	 */
	private static $instance = null;

	/**
	 * Initiator
	 *
	 * @since 1.0.0
	 * @return object initialized object of class.
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_route' ) );
	}



	/**
	 * Get api namespace
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function get_api_namespace() {
		return 'getting-started/v1';
	}

	/**
	 * Check whether a given request has permission to read notes.
	 *
	 * @param  object $request WP_REST_Request Full details about the request.
	 * @return object|boolean
	 */
	public function get_item_permissions_check( $request ) {

		if ( ! current_user_can( 'manage_options' ) ) {
			return new \WP_Error(
				'gt_rest_cannot_access',
				__( 'Sorry, you are not allowed to do that.', 'astra-sites' ),
				array( 'status' => rest_authorization_required_code() )
			);
		}
		return true;
	}

	/**
	 * Register route
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function register_route() {
		$namespace = $this->get_api_namespace();

		register_rest_route(
			$namespace,
			'/action-items/',
			array(
				array(
					'methods'             => \WP_REST_Server::CREATABLE,
					'callback'            => array( $this, 'get_action_items_content' ),
					'permission_callback' => array( $this, 'get_item_permissions_check' ),
					'args'                => array(),
				),
			)
		);

		register_rest_route(
			$namespace,
			'/dismiss-setup-wizard/',
			array(
				array(
					'methods'             => \WP_REST_Server::EDITABLE,
					'callback'            => array( $this, 'dismiss_setup_wizard' ),
					'permission_callback' => array( $this, 'get_item_permissions_check' ),
					'args'                => array(
						'dismiss' => array(
							'type'     => 'string',
							'required' => true,
						),
					),
				),
			)
		);

		register_rest_route(
			$namespace,
			'/action-items-status/',
			array(
				array(
					'methods'             => \WP_REST_Server::CREATABLE,
					'callback'            => array( $this, 'update_action_item_status' ),
					'permission_callback' => array( $this, 'get_item_permissions_check' ),
					'args'                => array(
						'id'     => array(
							'type'     => 'string',
							'required' => true,
						),
						'status' => array(
							'type'     => 'bool',
							'required' => false,
						),
					),
				),
			)
		);
	}

	/**
	 * Get items content.
	 *
	 * @param \WP_REST_Request $request Full details about the request.
	 * @return void
	 */
	public function get_action_items_content( $request ) {

		$nonce = (string) $request->get_header( 'X-WP-Nonce' );
		// Verify the nonce.
		if ( ! wp_verify_nonce( sanitize_text_field( $nonce ), 'wp_rest' ) ) {
			wp_send_json_error(
				array(
					'data'   => __( 'Nonce verification failed.', 'astra-sites' ),
					'status' => false,

				)
			);
		}

		$default_action_items = GS_Helper::get_default_action_items();

		$action_items_status = get_option( 'getting_started_action_items', array() );

		if ( is_array( $action_items_status ) ) {
			foreach ( $default_action_items as $key => $action_item ) {
				$status = $action_items_status[ $action_item['id'] ]['status'] ?? false;
				$default_action_items[ $key ]['complete_status'] = $status;
			}
		}

		if ( empty( $default_action_items ) || empty( $default_action_items[0] ) ) {
			wp_send_json_error(
				array(
					'data'   => array(),
					'status' => false,
					'error'  => __( 'Action items are empty', 'astra-sites' ),
				)
			);
		}

		wp_send_json_success(
			array(
				'data'   => $default_action_items,
				'status' => true,
			)
		);
	}

	/**
	 * Update items status.
	 *
	 * @param \WP_REST_Request $request Full details about the request.
	 * @return void
	 */
	public function update_action_item_status( $request ) {

		$nonce = (string) $request->get_header( 'X-WP-Nonce' );
		// Verify the nonce.
		if ( ! wp_verify_nonce( sanitize_text_field( $nonce ), 'wp_rest' ) ) {
			wp_send_json_error(
				array(
					'data'   => __( 'Nonce verification failed.', 'astra-sites' ),
					'status' => false,

				)
			);
		}

		$action_item_id     = $request->get_param( 'id' );
		$action_item_status = $request->get_param( 'status' );

		$action_items = get_option( 'getting_started_action_items', array() );

		// If action items are empty, initialize with default action items.
		if ( empty( $action_items ) ) {
			$default_action_items = GS_Helper::get_default_action_items();
			foreach ( $default_action_items as $action_item ) {
				$action_items[ $action_item['id'] ]['status'] = false;
			}
		}

		if ( is_array( $action_items ) ) {
			$action_items[ $action_item_id ]['status'] = $action_item_status;
			update_option( 'getting_started_action_items', $action_items );

			wp_send_json_success(
				array(
					'status' => true,
					'data'   => __( 'Action item status updated.', 'astra-sites' ),
				)
			);
		}

		wp_send_json_error(
			array(
				'status' => false,
				'error'  => __( 'Action item status not updated.', 'astra-sites' ),
			)
		);

	}

	/**
	 * Remove setup wizard.
	 *
	 * @param \WP_REST_Request $request Full details about the request.
	 * @return void
	 */
	public function dismiss_setup_wizard( $request ) {

		$nonce = (string) $request->get_header( 'X-WP-Nonce' );
		// Verify the nonce.
		if ( ! wp_verify_nonce( sanitize_text_field( $nonce ), 'wp_rest' ) ) {
			wp_send_json_error(
				array(
					'data'   => __( 'Nonce verification failed.', 'astra-sites' ),
					'status' => false,

				)
			);
		}

		if ( empty( $request['dismiss'] ) || 'no' === $request['dismiss'] ) {
			wp_send_json_error(
				array(
					'status' => false,
					'data'   => __( ' Failed to dismiss and remove the Setup wizard.', 'astra-sites' ),
				)
			);
		}

		delete_option( 'getting_started_is_setup_wizard_showing' );
		wp_send_json_success(
			array(
				'status' => true,
				'data'   => __( 'Successfully dismissed and removed the Setup wizard.', 'astra-sites' ),
			)
		);
	}

}

GS_Api::get_instance();

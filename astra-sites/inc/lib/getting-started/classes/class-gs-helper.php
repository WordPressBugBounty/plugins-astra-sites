<?php
/**
 * Getting Started Helper
 *
 * @since 1.0.0
 * @package Getting Started Helper
 */

namespace GS\Classes;

/**
 * GS Helper
 */
class GS_Helper {

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
	 * Return default action items.
	 *
	 * @since 1.0.0
	 * @return array<int, array<string, mixed>>
	 */
	public static function get_default_action_items() {

		$admin_url    = admin_url();
		$action_items = [
			[
				'id'              => 'wordpress',
				'title'           => __( 'Learn how WordPress works!', 'astra-sites' ),
				'content'         => [
					[
						'type' => 'paragraph',
						'data' => [
							'text' => __( 'Start here to understand Pages vs Posts, how to install plugins, and what powers your website behind the scenes.', 'astra-sites' ),
						],
					],
					[
						'type' => 'video',
						'data' => [
							'url'   => 'https://www.youtube.com/embed/HnV4Y3oWU-M',
							'title' => __( 'Understand WordPress', 'astra-sites' ),
						],
					],
				],
				'complete_status' => true,
				// translators: %d is minutes.
				'duration'        => sprintf( __( '%d mins', 'astra-sites' ), 3 ),
			],
		];

		if ( wp_get_theme()->get_template() === 'astra' ) {
			$action_items[] = [
				'id'              => 'astra-theme',
				'title'           => __( 'Meet Your Theme — Astra', 'astra-sites' ),
				'content'         => [
					[
						'type' => 'paragraph',
						'data' => [
							'text' => __( 'Your theme controls layout, colors, typography, and more. Let’s show you how to make it yours.', 'astra-sites' ),
						],
					],
					[
						'type' => 'video',
						'data' => [
							'url'   => 'https://www.youtube.com/embed/TBZd9oligCw',
							'title' => __( 'Design your Site’s Look', 'astra-sites' ),
						],
					],
				],
				'footer'          => [
					[
						'type' => 'button',
						'data' => [
							'type'   => 'link',
							'text'   => __( 'Go to Customizer', 'astra-sites' ),
							'url'    => esc_url( $admin_url ) . 'customize.php',
							'target' => '_blank',
						],
					],
				],
				'complete_status' => true,
				// translators: %d is minutes.
				'duration'        => sprintf( __( '%d mins', 'astra-sites' ), 5 ),
			];
		}

		if ( is_plugin_active( 'ultimate-addons-for-gutenberg/ultimate-addons-for-gutenberg.php' ) ) {
			$action_items[] = [
				'id'              => 'spectra',
				'title'           => __( 'Design Pages Visually – Spectra', 'astra-sites' ),
				'content'         => [
					[
						'type' => 'paragraph',
						'data' => [
							'text' => __( 'Spectra lets you drag and drop sections and design like a pro.', 'astra-sites' ),
						],
					],
					[
						'type' => 'video',
						'data' => [
							'url'   => 'https://www.youtube.com/embed/jSZ1M2finRE',
							'title' => __( 'Design your Site’s Look', 'astra-sites' ),
						],
					],
				],
				'footer'          => [
					[
						'type' => 'button',
						'data' => [
							'type'   => 'link',
							'text'   => __( 'Design Your First Page', 'astra-sites' ),
							'url'    => esc_url( $admin_url ) . 'admin.php?page=spectra',
							'target' => '_blank',
						],
					],
				],
				'complete_status' => true,
				// translators: %d is minutes.
				'duration'        => sprintf( __( '%d mins', 'astra-sites' ), 4 ),
			];
		}

		if ( is_plugin_active( 'sureforms/sureforms.php' ) ) {
			$action_items[] = [
				'id'              => 'sureforms',
				'title'           => __( 'Add Smart Forms — SureForms', 'astra-sites' ),
				'content'         => [
					[
						'type' => 'paragraph',
						'data' => [
							'text' => __( 'Capture leads, messages, or feedback using powerful, drag-and-drop AI forms. Let’s help you connect with visitors from Day 1.', 'astra-sites' ),
						],
					],
					[
						'type' => 'video',
						'data' => [
							'url'   => 'https://www.youtube.com/embed/7w91hnumviU',
							'title' => __( 'Design your First Form', 'astra-sites' ),
						],
					],
				],
				'footer'          => [
					[
						'type' => 'button',
						'data' => [
							'type'   => 'link',
							'text'   => __( 'Design Your First Form', 'astra-sites' ),
							'url'    => esc_url( $admin_url ) . 'admin.php?page=add-new-form',
							'target' => '_blank',
						],
					],
					[
						'type' => 'button',
						'data' => [
							'text'    => __( 'Learn More', 'astra-sites' ),
							'url'     => 'https://sureforms.com/docs/ai-forms/',
							'target'  => '_blank',
							'type'    => 'link',
							'variant' => 'outline',
						],
					],
				],
				'complete_status' => true,
				// translators: %d is minutes.
				'duration'        => sprintf( __( '%d mins', 'astra-sites' ), 4 ),
			];
		}

		if ( is_plugin_active( 'surecart/surecart.php' ) ) {
			$action_items[] = [
				'id'              => 'surecart',
				'title'           => __( 'Launch Your Store — SureCart', 'astra-sites' ),
				'content'         => [
					[
						'type' => 'paragraph',
						'data' => [
							'text' => __( 'Sell products or services with built-in payments, checkout, and order management. Let’s turn your website into a revenue-generating machine.', 'astra-sites' ),
						],
					],
					[
						'type' => 'checklist',
						'data' => [
							'items' => [
								[ 'text' => __( 'Go to SureCart → Products and click Add New Product', 'astra-sites' ) ],
								[ 'text' => __( 'Enter product name, price, and other details', 'astra-sites' ) ],
								[ 'text' => __( 'Click Save Product, then Enable Live Payments', 'astra-sites' ) ],
							],
						],
					],
				],
				'footer'          => [
					[
						'type' => 'button',
						'data' => [
							'type'   => 'link',
							'text'   => __( 'Create Your First Product', 'astra-sites' ),
							'url'    => class_exists( '\SureCart\Models\ApiToken' ) && \SureCart\Models\ApiToken::get() ? esc_url( $admin_url ) . 'admin.php?page=sc-products&action=edit' : esc_url( $admin_url ) . 'admin.php?page=sc-getting-started',
							'target' => '_blank',
						],
					],
					[
						'type' => 'button',
						'data' => [
							'text'    => __( 'Learn More', 'astra-sites' ),
							'url'     => 'https://surecart.com/docs/getting-started/',
							'target'  => '_blank',
							'type'    => 'link',
							'variant' => 'outline',
						],
					],
				],
				'complete_status' => true,
				// translators: %d is minutes.
				'duration'        => sprintf( __( '%d mins', 'astra-sites' ), 9 ),
			];
		}

		if ( is_plugin_active( 'cartflows/cartflows.php' ) ) {
			$action_items[] = [
				'id'              => 'cartflows',
				'title'           => __( 'Boost Conversions — CartFlows', 'astra-sites' ),
				'content'         => [
					[
						'type' => 'paragraph',
						'data' => [
							'text' => __( 'Guide visitors through a smooth checkout journey with landing pages and sales funnels. Turn clicks into customers with a funnel that sells for you.', 'astra-sites' ),
						],
					],
					[
						'type' => 'checklist',
						'data' => [
							'items' => [
								[ 'text' => __( 'Create your first product in WooCommerce', 'astra-sites' ) ],
								[ 'text' => __( 'Go to CartFlows → Funnels → Import New Funnel', 'astra-sites' ) ],
								[ 'text' => __( 'Open the Checkout step → Assign your Woo product', 'astra-sites' ) ],
							],
						],
					],
				],
				'footer'          => [
					[
						'type' => 'button',
						'data' => [
							'type'   => 'link',
							'text'   => __( 'Create Your First Funnel', 'astra-sites' ),
							'url'    => esc_url( $admin_url ) . 'admin.php?page=cartflows&path=flows',
							'target' => '_blank',
						],
					],
					[
						'type' => 'button',
						'data' => [
							'text'    => __( 'Learn More', 'astra-sites' ),
							'url'     => 'https://cartflows.com/docs/general-settings-overview/',
							'target'  => '_blank',
							'type'    => 'link',
							'variant' => 'outline',
						],
					],
				],
				'complete_status' => true,
				// translators: %d is minutes.
				'duration'        => sprintf( __( '%d mins', 'astra-sites' ), 18 ),
			];
		}

		if ( is_plugin_active( 'latepoint/latepoint.php' ) ) {
			$action_items[] = [
				'id'              => 'latepoint',
				'title'           => __( 'Accept Appointments — LatePoint', 'astra-sites' ),
				'content'         => [
					[
						'type' => 'paragraph',
						'data' => [
							'text' => __( 'Add a calendar so visitors can book calls, meetings, or sessions with you. Let’s turn interest into real bookings with one click.', 'astra-sites' ),
						],
					],
					[
						'type' => 'checklist',
						'data' => [
							'items' => [
								[ 'text' => __( 'Add your services and set work hours', 'astra-sites' ) ],
								[ 'text' => __( 'Enable notifications and payment options', 'astra-sites' ) ],
								[ 'text' => __( 'Embed the booking form using shortcode or block', 'astra-sites' ) ],
							],
						],
					],
				],
				'footer'          => [
					[
						'type' => 'button',
						'data' => [
							'type'   => 'link',
							'text'   => __( 'Add Your First Booking Form', 'astra-sites' ),
							'url'    => esc_url( $admin_url ) . '/admin.php?page=latepoint&route_name=bookings__index',
							'target' => '_blank',
						],
					],
					[
						'type' => 'button',
						'data' => [
							'text'    => __( 'Learn More', 'astra-sites' ),
							'url'     => 'https://wpdocs.latepoint.com/getting-started-with-latepoint/',
							'target'  => '_blank',
							'type'    => 'link',
							'variant' => 'outline',
						],
					],
				],
				'complete_status' => true,
				// translators: %d is minutes.
				'duration'        => sprintf( __( '%d mins', 'astra-sites' ), 4 ),
			];
		}

		if ( is_plugin_active( 'presto-player/presto-player.php' ) ) {
			$action_items[] = [
				'id'              => 'presto-player',
				'title'           => __( 'Add Engaging Videos — Presto Player', 'astra-sites' ),
				'content'         => [
					[
						'type' => 'paragraph',
						'data' => [
							'text' => __( 'Embed videos with modern features like chapters, overlays, and custom branding and keep people watching and make your content unforgettable.', 'astra-sites' ),
						],
					],
					[
						'type' => 'checklist',
						'data' => [
							'items' => [
								[ 'text' => __( 'Click “+” on any page → add Presto Player block', 'astra-sites' ) ],
								[ 'text' => __( 'Paste your video URL', 'astra-sites' ) ],
								[ 'text' => __( 'Customize settings and click “Publish”', 'astra-sites' ) ],
							],
						],
					],
				],
				'footer'          => [
					[
						'type' => 'button',
						'data' => [
							'type'   => 'link',
							'text'   => __( 'Embed Your First Video', 'astra-sites' ),
							'url'    => esc_url( $admin_url ) . 'post-new.php?post_type=pp_video_block',
							'target' => '_blank',
						],
					],
					[
						'type' => 'button',
						'data' => [
							'text'    => __( 'Learn More', 'astra-sites' ),
							'url'     => 'https://prestoplayer.com/docs-category/getting-started/',
							'target'  => '_blank',
							'type'    => 'link',
							'variant' => 'outline',
						],
					],
				],
				'complete_status' => true,
				// translators: %d is minutes.
				'duration'        => sprintf( __( '%d mins', 'astra-sites' ), 4 ),
			];
		}

		if ( is_plugin_active( 'suretriggers/suretriggers.php' ) ) {
			$action_items[] = [
				'id'              => 'ottokit',
				'title'           => __( 'Automate Your Work — OttoKit', 'astra-sites' ),
				'content'         => [
					[
						'type' => 'paragraph',
						'data' => [
							'text' => __( 'Connect plugins and automate routine tasks like follow-ups or form triggers without code. Let’s save you hours and keep your website running on autopilot.', 'astra-sites' ),
						],
					],
					[
						'type' => 'checklist',
						'data' => [
							'items' => [
								[ 'text' => __( 'Sign up or log in to your OttoKit account', 'astra-sites' ) ],
								[ 'text' => __( 'Click “Create New Workflow”', 'astra-sites' ) ],
								[ 'text' => __( 'Choose a Trigger and add one or more Actions', 'astra-sites' ) ],
							],
						],
					],
				],
				'footer'          => [
					[
						'type' => 'button',
						'data' => [
							'type'   => 'link',
							'text'   => __( 'Automate Your First Task', 'astra-sites' ),
							'url'    => esc_url( $admin_url ) . 'admin.php?page=suretriggers',
							'target' => '_blank',
						],
					],
					[
						'type' => 'button',
						'data' => [
							'text'    => __( 'Learn More', 'astra-sites' ),
							'url'     => 'https://ottokit.com/docs/getting-started/',
							'target'  => '_blank',
							'type'    => 'link',
							'variant' => 'outline',
						],
					],
				],
				'complete_status' => true,
				// translators: %d is minutes.
				'duration'        => sprintf( __( '%d mins', 'astra-sites' ), 11 ),
			];
		}

		if ( is_plugin_active( 'suremails/suremails.php' ) ) {
			$action_items[] = [
				'id'              => 'suremails',
				'title'           => __( 'Start Sending Emails Reliably — SureMail', 'astra-sites' ),
				'content'         => [
					[
						'type' => 'paragraph',
						'data' => [
							'text' => __( 'Ensure your contact forms, order updates, and notifications actually reach inboxes. Let’s make sure your emails never get lost again.', 'astra-sites' ),
						],
					],
					[
						'type' => 'checklist',
						'data' => [
							'items' => [
								[ 'text' => __( 'Go to Settings → SureMail → Connections', 'astra-sites' ) ],
								[ 'text' => __( 'Click Add Connection and fill in the required email details', 'astra-sites' ) ],
								[ 'text' => __( 'Use Send Test Mail to verify your connection is working', 'astra-sites' ) ],
							],
						],
					],
				],
				'footer'          => [
					[
						'type' => 'button',
						'data' => [
							'type'   => 'link',
							'text'   => __( 'Send Your First Email', 'astra-sites' ),
							'url'    => esc_url( $admin_url ) . 'options-general.php?page=suremail',
							'target' => '_blank',
						],
					],
					[
						'type' => 'button',
						'data' => [
							'text'    => __( 'Learn More', 'astra-sites' ),
							'url'     => 'https://suremails.com/docs/connections-tab/',
							'target'  => '_blank',
							'type'    => 'link',
							'variant' => 'outline',
						],
					],
				],
				'complete_status' => true,
				// translators: %d is minutes.
				'duration'        => sprintf( __( '%d mins', 'astra-sites' ), 2 ),
			];
		}

		$action_items[] = [
			'id'              => 'final-step',
			'title'           => __( 'Final Step Before Website Launch: Checklist', 'astra-sites' ),
			'content'         => [
				[
					'type' => 'paragraph',
					'data' => [
						'text' => __( 'Launching soon?', 'astra-sites' ),
					],
				],
				[
					'type' => 'paragraph',
					'data' => [
						'text' => __( 'Make sure your site is ready to go with this essential checklist. This final step will help you launch your website with confidence, not chaos.', 'astra-sites' ),
					],
				],
			],
			'footer'          => [
				[
					'type' => 'button',
					'data' => [
						'text'   => __( 'Get Website Launch Checklist', 'astra-sites' ),
						'url'    => 'https://wpastra.com/website-launch-checklist/',
						'target' => '_blank',
						'type'   => 'link',
						'icon'   => '',
					],
				],
			],
			'complete_status' => true,
			// translators: %d is minute.
			'duration'        => sprintf( __( '%d min', 'astra-sites' ), 1 ),
		];

		/**
		 * Filter to modify the default action items.
		 *
		 * @since 1.0.0
		 * @param array<int, array<string, mixed>> $action
		 * @return array<int, array<string, mixed>>
		 */
		return apply_filters( 'getting_started_action_items', $action_items );
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
GS_Helper::get_instance();

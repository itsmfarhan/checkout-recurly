<?php
/**
 * Setting Class.
 *
 * @package ckr-recurly
 */

if ( ! class_exists( 'CKR_Setting' ) ) {

	/**
	 * Class CKR_Setting.
	 */
	class CKR_Setting {


		/**
		 * Register actions.
		 */
		public function __construct() {
		    add_action( 'admin_menu', array( $this, 'register_ckr_menu' ) );
			add_action( 'admin_notices', array( $this, 'show_admin_notice' ), 99 );
		}

		/**
		 * Register Admin Menu.
		 */
		public function register_ckr_menu() {
			add_menu_page( 'Recurly Settings', 'Recurly Settings', 'administrator', 'ckr_recurly', array( $this, 'configuration_page' ), 'dashicons-admin-tools', 100 );
		}

		/**
		 * Show Admin notices.
		 */
		public function show_admin_notice() {
			if ( isset( $_POST['ckr_recurly_nonce'] ) ) {
				$nonce = sanitize_text_field( wp_unslash( $_POST['ckr_recurly_nonce'] ) );
				if ( ! wp_verify_nonce( $nonce, 'ckr_recurly_action' ) ) {
					return;
				}
			}

			$screen = get_current_screen();

			if ( 'toplevel_page_ckr_recurly' !== $screen->id ) {
				return;
			}

			if ( isset( $_POST['settings-updated'] ) ) {
				if ( 1 == $_POST['settings-updated'] ) :
					?>
					<div class="notice notice-success is-dismissible">
						<p><?php esc_attr_e( 'Setting saved.', 'ckr-recurly' ); ?></p>
					</div>
				<?php else : ?>
					<div class="notice notice-warning is-dismissible">
						<p><?php esc_attr_e( 'Sorry, I can not go through this.', 'ckr-recurly' ); ?></p>
					</div>
					<?php
	endif;
			}
		}

		/**
		 * Configuration page function.
		 */
		public function configuration_page() {
			if ( isset( $_POST['ckr_recurly_nonce'] ) ) {
				
				$nonce = sanitize_text_field( wp_unslash( $_POST['ckr_recurly_nonce'] ) );
				if ( ! wp_verify_nonce( $nonce, 'ckr_recurly_action' ) ) {
					return;
				}
			}

			if (isset($_POST['ckr']) ) {
				 
				$config =   $_POST['ckr'] ;				 
				update_option( 'ckr_recurly_config', $config );
			}

			$config = get_option(
				'ckr_recurly_config',
				array(
					'private_api_key' => '',
					'plan_name'       => '',
					'plan_code'       => '',
				)
			);
			include CKR_PLUGIN_DIR . '/templates/admin/configuration.php';
		}

	}

}

new CKR_Setting();

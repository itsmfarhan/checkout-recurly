<?php
/**
 * Reculry Class.
 *
 * @package ckr-recurly
 */

if (!class_exists('CKR_Recurly')) {
    /**
     * Class CKR_Recurly.
     */
    class CKR_Recurly
    {

        /**
         * Register actions.
         */
        public function __construct()
        {
            add_shortcode('ckr_checkout_form', array($this, 'ckr_checkout_form'));
            add_action('init', array($this, 'handle_recurly_post'));

        }

        /**
         * Handel form data.
         *
         * @access public
         */
        public function handle_recurly_post()
        {

            if (isset($_POST['recurly-token'])) {

                if (isset($_POST['ckr_recurly_nonce'])) {

                    $nonce = sanitize_text_field(wp_unslash($_POST['ckr_recurly_nonce']));

                    if (!wp_verify_nonce($nonce, 'ckr_recurly_action')) {

                        return;
                    }
                }

                global $wpdb, $form_error;

                $form_error = new WP_Error();
                $is_error = 0;
                extract($_POST);

                if (empty($first_name)) {

                    $form_error->add('First Name', 'First Name is required');

                    $is_error = 1;
                }

                if (empty($last_name)) {

                    $form_error->add('Last Name', 'Last Name is required');
                    $is_error = 1;
                }

                if (empty($email)) {

                    $form_error->add('Email', 'Email is required');
                    $is_error = 1;

                }
                if (!empty($email)) {
                    if (!is_email($email)) {

                        $form_error->add('Email', 'Valid Email is required');
                        $is_error = 1;

                    }
                }

                if (!$is_error) {
                    $recurly_info = $_POST;
                    $recurly_info['account_code'] = wp_rand();
                    $config = get_option('ckr_recurly_config');
                    $recurly_info['plan_code'] = $config['plan_code'];
                    $recurly_info['currency'] = $config['currency'];
                    $recurly_obj = new CKR_Recurly_API();

                    $subscription_id = $recurly_obj->create_subscription($recurly_info, $subscription, $rmessage);

                    if (-1 == $subscription_id) {

                        $form_error->add('Recurly', $rmessage);
                        $is_error = 1;

                    } else {
                        $url = get_permalink();
                        if (isset($_POST['thankyou_page'])) {
                            $url = sanitize_text_field(wp_unslash($_POST['thankyou_page']));
                        }
                        wp_safe_redirect($url);
                        exit;

                    }
                }
            }
        }

        /**
         * Load Form.
         *
         * @access public
         */
        public function ckr_checkout_form()
        {

            $package = '';

            ob_start();
            include CKR_PLUGIN_DIR . '/templates/front/checkout.php';

            return ob_get_clean();
        }

    }
}
new CKR_Recurly();

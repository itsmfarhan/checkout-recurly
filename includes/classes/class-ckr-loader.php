<?php
/**
 * Loader Class.
 *
 * @package ckr-recurly
 */

if (!class_exists('CKR_Loader')) {

    /**
     * Class CKR_Setting.
     */
    class CKR_Loader
    {
        /**
         * Intialize plugin.
         */
        public function __construct()
        {
            add_action('wp_enqueue_scripts', array($this, 'ckr_frontend_scripts'));
            $this->load();
        }

        /**
         * Load files.
         */
        public function load()
        {
            include_once CKR_PLUGIN_DIR . '/includes/classes/class-ckr-recurly-api.php';
            include_once CKR_PLUGIN_DIR . '/includes/classes/class-ckr-setting.php';
            include_once CKR_PLUGIN_DIR . '/includes/classes/class-ckr-recurly.php';

        }

        /**
         * Enqueue Fontend Scripts.
         */
        public function ckr_frontend_scripts()
        {
            wp_enqueue_script('ckr-recurly-script', 'https://js.recurly.com/v4/recurly.js', null, true);
            wp_enqueue_style('ckr-recurly-css', 'https://js.recurly.com/v4/recurly.css', null, true);

            wp_register_script('ckr-recurly-custom', CKR_PLUGIN_DIR_URL . '/assets/js/ckr-recurly.js', array('jquery'), true);
            wp_enqueue_style('ckr-recurly-custom-css', CKR_PLUGIN_DIR_URL . '/assets/css/ckr-recurly.css', null, true);

        }
    }
    new CKR_Loader();
}
<?php
/**
 * Plugin Name: Checkout Recurly
 * Description: Recurly Subsriptions Checkout
 * Author: Farhan Mahmood
 * Text Domain: ckr-recurly
 * Version: 1.1.1.0
 *
 * @package ckr-recurly
 */

if (!defined('ABSPATH')) {
    die;
}
if (!defined('CKR_PLUGIN_DIR')) {
    define('CKR_PLUGIN_DIR', __DIR__);
}
if (!defined('CKR_PLUGIN_DIR_URL')) {
    define('CKR_PLUGIN_DIR_URL', plugin_dir_url(__FILE__));
}

require_once CKR_PLUGIN_DIR . '/includes/functions.php';
require_once CKR_PLUGIN_DIR . '/includes/classes/class-ckr-loader.php';

if (!function_exists('init_ckr_recurly_plugin')) {

    /**
     * Initiate Plugin.
     */
    function init_ckr_recurly_plugin()
    {
        require_once 'vendor/autoload.php';
    }
}

init_ckr_recurly_plugin();

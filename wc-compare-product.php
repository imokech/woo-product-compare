<?php
/**
 * WooCommerce Compare Product Plugin.
 *
 * @author    Mohammad Keshavarz
 * @link      https://mokech.ir
 * @copyright Copyright © 2021 Mokech
 *
 * Plugin Name:       WooCommerce Compare Product
 * Plugin URI:        https://mokech.ir
 * Description:       WooCommerce Compare Product
 * Version:           1.0.0
 * Author:            Mohammad Keshavarz
 * Author URI:        https://mokech.ir
 * Text Domain:       wc-compare-product
 * License URI:       LICENSE.txt
 * Domain Path:       /languages
 * Tested up to:      5.8.2
 */

defined( 'ABSPATH' ) || exit;

function woocommerceCompareProduct ()
{
    class WoocommerceCompareProduct
    {
        public function __construct()
        {
            $this->defineConstants();
            $this->init();
        }

        public function defineConstants()
        {
            define('WCP_PLUGIN_DIR', plugin_dir_path(__FILE__));
            define('WCP_PLUGIN_URL', plugin_dir_url(__FILE__));
            define('Text_Domain', 'wc-compare-product');
        }

        public function init()
        {
            $this->loadSettings();
            $this->receiveRequest();
        }

        public function loadSettings()
        {
            include_once WCP_PLUGIN_DIR . '/panel/Management.php';
            new Management();
            include_once WCP_PLUGIN_DIR . '/includes/Settings.php';
            new Settings();
        }

        private function receiveRequest()
        {
            include_once WCP_PLUGIN_DIR . 'handlers/ManagementHandler.php';
            new ManagementHandler();
        }
    }

    $WoocommerceCompareProductInstace = new WoocommerceCompareProduct();
}

add_action('init', 'woocommerceCompareProduct');
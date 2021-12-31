<?php

defined( 'ABSPATH' ) || exit;

class Settings
{
    public function __construct()
    {
        add_filter('query_vars', [$this, 'addCustomQueryVars'], 1000, 1);
        add_filter('init', [$this, 'addCustomRewriteRules']);    
        add_filter('woocommerce_loop_add_to_cart_link', [$this, 'addCompareButton'], 10, 3);
        add_action('wp_enqueue_scripts', [$this, 'loadCompareAssets']);

        $this->loadSettings();
    }

    public function addCompareButton( $addToCartHtml, $product, $args )
    {
        $compareButton = '<button class="compare-product">'. __('Compare', Text_Domain) .'<button>';
        
        return $addToCartHtml . $compareButton;
    }
    
    public function addCustomQueryVars($vars)
    {
        $vars[] = 'product_compare_one';
        $vars[] = 'product_compare_two';
        return $vars;
    }

    public function addCustomRewriteRules()
    {
        flush_rewrite_rules();
        add_rewrite_rule(
            'compare/([^/]*)/([^/]*)/?$',
            'index.php?pagename=compare&product_compare_one=$matches[1]&product_compare_two=$matches[2]',
            'top'
        );
    }

    private function loadSettings()
    {
        include_once WCP_PLUGIN_DIR . '/includes/Shortcode.php';
        new Shortcode();
    }

    public function loadCompareAssets()
    {
        wp_register_style('compare_style', WCP_PLUGIN_URL . 'assets/css/style.css');
        wp_enqueue_style('compare_style');

        wp_register_script('compare_jquery', WCP_PLUGIN_URL . 'assets/js/jquery-3.3.1.min.js');
        wp_register_script('copmare_script', WCP_PLUGIN_URL . 'assets/js/compare.js', ['jquery']);
        wp_enqueue_script('compare_jquery');
        wp_enqueue_script('copmare_script');
    }
}
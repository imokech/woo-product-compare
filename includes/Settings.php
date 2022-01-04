<?php

defined( 'ABSPATH' ) || exit;

class Settings
{
    public function __construct()
    {
        add_filter('woocommerce_loop_add_to_cart_link', [&$this, 'addCompareButton'], 10, 3);
        add_action('wp_enqueue_scripts', [&$this, 'loadCompareAssets']);

        $this->loadSettings();
    }

    public function addCompareButton( $addToCartHtml, $product, $args )
    {
        $compareButton = '<button class="add-compare-product" data-slug="'. $product->get_slug() .'">'. __('Compare', Text_Domain) .'</button>';
        
        return $addToCartHtml . $compareButton;
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

        wp_localize_script( 'copmare_script', 'WCP_OBJ',
        array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'compare_page_url' => home_url() . '/compare',
        )
    );

    }
}
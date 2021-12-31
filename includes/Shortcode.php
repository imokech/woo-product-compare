<?php

defined( 'ABSPATH' ) || exit;

class Shortcode 
{
    public function __construct()
    {
        add_shortcode('wp_compare_product', [$this, 'compareProductHandler']);
    }
    
    public function compareProductHandler($atts, $content = null)
    {
        $tableTitle = get_option('wcp_compare_page_title', __('Default Title', Text_Domain));
        $addToCartBtn = get_option('display_add_cart_btn', '');

        include_once WCP_PLUGIN_DIR . "front/compare.php";
    }
}


<?php

defined( 'ABSPATH' ) || exit;

include_once WCP_PLUGIN_DIR . "handlers/Handler.php";

class ManagementHandler extends Handler
{
    public function __construct()
    {
        parent::__construct();
        $this->index();
    }

    public function index()
    {
        if (isset($_REQUEST['submit_settings'])) {

            $pageTitle = sanitize_text_field($_REQUEST['compare_page_title']);
            if ($pageTitle) {
                update_option('wcp_compare_page_title', $pageTitle);
            }

            $displayAddToCartBtn = $_REQUEST['display_add_cart_btn'];
            if ($displayAddToCartBtn == 'on') {
                $displayAddToCartBtn = 1;
            }else {
                $displayAddToCartBtn = 0;
            }
            update_option('display_add_cart_btn', $displayAddToCartBtn);
            
            $imageSize = sanitize_text_field($_REQUEST['compare_image_size']);
            if ($displayAddToCartBtn) {
                update_option( 'compare_image_size', $imageSize);
            }

            $attributes = wc_get_attribute_taxonomies();
            if (!empty($attributes)) {
                $attributeSetting = [];
                foreach($attributes as $attribute) {
                    $attributeValue = $_POST['display_'. $attribute->attribute_name];
                    $attributeValue = ($attributeValue == 'on') ? 1 : 0;
                    $attributeSetting[$attribute->attribute_name] = $attributeValue;
                }
               
                $result = update_option('wcp_attributes', $attributeSetting);

                if (!$result) {
                    //Display error user settings not saved try again
                }

            }
        }
    }

}
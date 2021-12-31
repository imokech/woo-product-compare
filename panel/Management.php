<?php

defined( 'ABSPATH' ) || exit;

include_once WCP_PLUGIN_DIR . "/panel/Page.php";

class Management extends Page
{
    public function __construct()
    {
        $this->pageTitle    = __('Product Compare Settings', Text_Domain);
        $this->menuTitle    = __('WCCP Settings', Text_Domain);
        $this->capability   = 'manage_options';
        $this->menuSlug     = 'woo_compare_product_simple';

        parent::__construct();
    }

    public function index()
    {
        include_once WCP_PLUGIN_DIR . DIRECTORY_SEPARATOR . "front/management.php";
    }
}

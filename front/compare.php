<?php 

$productOne = get_query_var('product_compare_one', '');
$productTwo = get_query_var('product_compare_two', '');

if (empty($productOne)){
    // Redirect  404
    wp_safe_redirect(home_url(''), 301);
}

// get product object by slug
$products = [
            get_page_by_path($productOne, OBJECT, 'product') ?? '',   // Product Object
            get_page_by_path($productTwo, OBJECT, 'product') ?? ''    // Product Object
        ];

if (!empty($products)){
    $attrsSetting = get_option('wcp_attributes');
    $table .= '<ul>';
    foreach ($products as $product) {
        if (!empty($product)) {
            $product = wc_get_product($product->ID);
            $attributes = $product->get_attributes();
            
            foreach ($attributes as $attribute){
                if ($attrsSetting[str_replace('pa_', '', $attribute['name'])]) {
                    // Html Table Template (sample)
                    $table .= '<li>' . wc_attribute_label($attribute['name']) . ': <span>'. $product->get_attribute($attribute['name']) .'</span></li>'; 
                }
            }
 
            if ($product->is_purchasable() && $addToCartBtn){
                var_dump($product);die;
                $addToCartUrl = do_shortcode('[add_to_cart_url id="'. $product->get_id() .'"]');
                $table .= "<a href=". $addToCartUrl .">Buy now</a>";
            }
            
            $table .= '<hr>';
        }
    }
    $table .= '</ul>';
}


// Display Table 
echo '<h1>' . $tableTitle . '</h1>';
echo $table;
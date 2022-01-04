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
            $imageSize = get_option('compare_image_size') ?? 'thumbnail';
            $image = get_the_post_thumbnail_url($product->ID, $imageSize);
            $table .= "<img src=". $image[0] .">";

            foreach ($attrsSetting as $attribute => $check){
                $attribute = 'pa_'.$attribute;
                if (array_key_exists($attribute, $attributes)) {
                    // Html Table Template Place (later!)
                    if ($image) {
                        $table .= '<img src="'. $image .'">';
                    }
                    $table .= '<li>' . wc_attribute_label($attribute) . ': <span>'. $product->get_attribute($attribute) .'</span></li>'; 
                } else {
                    $table .= '<li>' . wc_attribute_label($attribute) . ': <span> - </span></li>'; 
                }
            }
 
            if ($product->is_purchasable() && $addToCartBtn){
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
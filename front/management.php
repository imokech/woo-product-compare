<div class="wrap" style="padding: 20px;">
    <h1><?php echo __('Woo compare Product Plugin Setttings', Text_Domain)?></h1>
    <form action="" method="post">
        <div>
            <label for="display-add-cart-btn">نمایش دکمه خرید در جدول :</label>
            <input type="checkbox" id="display-add-cart-btn" name="display_add_cart_btn" <?php echo (get_option('display_add_cart_btn')) ? 'checked' : ''; ?>>
        </div>
        <hr>
        <div style="margin: 10px 0">
            <label for="compare-page-title">تیتر جدول مقایسه :</label>
            <input type="input" id="compare-page-title" name="compare_page_title" value="<?php echo get_option('wcp_compare_page_title', __('Default Title', Text_Domain)); ?>">
        </div>
        <hr>
        <div style="margin: 10px 0">
            <label for="compare-image-size">سایز عکس : </label>
            <input type="input" id="compare-image-size" name="compare_image_size" value="<?php echo get_option('compare_image_size', '480'); ?>">
        </div>
        <hr>
        <h3>نمایش ویژگی ها : </h3>
        <?php
            $attrSetting = get_option('wcp_attributes');
            $attributes = wc_get_attribute_taxonomies();
            if (!empty($attributes)) {
                foreach($attributes as $attribute) {
                    echo '<label for="display_'. $attribute->attribute_name.'">'. $attribute->attribute_label .'</label>';
                    echo '<input type="checkbox" id="display_'. $attribute->attribute_name.'" name="display_'. $attribute->attribute_name .'" '. (($attrSetting[$attribute->attribute_name]) ? 'checked' : '') . '>';
                } 
            } else {
                echo '<span>'. __('Not Found Any Attribute', Text_Domain) .'</span>';
            }
        ?>
        <div style="margin: 10px 0">
            <input type="submit" value="Set" name="submit_settings">
        </div>
    </form>
</div>



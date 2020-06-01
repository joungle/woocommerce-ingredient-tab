<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Add a custom tab to the products data metabox
add_filter( 'woocommerce_product_data_tabs', 'add_ingredient_custom_product_data_tab' , 99 , 1 );

function add_ingredient_custom_product_data_tab( $product_data_tabs ) {
    $product_data_tabs['ingredient-custom-tab'] = array(
        'label' => 'Zutaten',
        'target' => 'ingredient_custom_product_data',
    );
    return $product_data_tabs;
}

// Add custom fields to the added custom tab under products data metabox
add_action( 'woocommerce_product_data_panels', 'add_ingredient_custom_product_data_fields' );

function add_ingredient_custom_product_data_fields() {
  global $woocommerce, $post;
  ?>
    <!-- id below must match target registered in above add_ingredient_custom_product_data_tab function -->
    <div id="ingredient_custom_product_data" class="panel woocommerce_options_panel">
        <?php
        woocommerce_wp_textarea_input( array(
            'id'          => '_wc_ingredient_text',
            'class'       => '',
            'label'       => 'Zutaten',
            'description' => '',
            'desc_tip'    => false,
            'placeholder' => '',
        ) );
 
        ?>
    </div>
  <?php
}

// Save custom fields data of products tab:
add_action( 'woocommerce_process_product_meta', 'woocommerce_process_product_meta_fields_save_ingredient' );

function woocommerce_process_product_meta_fields_save_ingredient( $post_id ){
  update_post_meta( $post_id, '_wc_ingredient_text', $_POST['_wc_ingredient_text'] );
} 

?>
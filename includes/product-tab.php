<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Add a custom tab to single product pages
add_filter( 'woocommerce_product_tabs', 'ingredient_content_tab' );

function ingredient_content_tab( $tabs ) {
  if (get_post_meta(get_the_ID(), '_wc_ingredient_text', true) == True) {
  	$tabs['ingredient'] = array(
	  	'title' 	=> 'Zutaten',
	  	'priority' 	=> 85,
	  	'callback' 	=> 'ingredient_content_tab_display'
  	);
  }
  return $tabs;
}

function ingredient_content_tab_display() {
  echo '<h2>' . 'Zutaten' . '</h2>';
  ?>
    <p><?php echo get_post_meta(get_the_ID(), '_wc_ingredient_text', true); ?></p>
  <?php
}

?>
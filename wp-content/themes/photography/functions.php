<?php
/**
 * Photography Child Theme
 */

function photography_site_google_fonts_preconnect() {
  echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
  echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}


function photography_site_enqueue_fonts() {
  $font_url = "https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap";

  wp_enqueue_style( 'photgraphy-site-google-fonts', $font_url, array(), null);
}

add_action( 'wp_head', 'photography_site_google_fonts_preconnect');
add_action( 'wp_enqueue_scripts', 'photography_site_enqueue_fonts');
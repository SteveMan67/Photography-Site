<?php
define('CHILD_THEME_NAME', 'Photography Theme');
define('CHILD_THEME_URL', 'https://CHANGE ME.com');
define('CHILD_THEME_VERSION', '1.0.0');

// Start the engine
require_once(get_template_directory() . '/lib/init.php');

// Add standard basic support
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
add_theme_support('genesis-responsive-viewport');
add_theme_support('genesis-accessibility', array('drop-down-menu', 'search-form'));


/**
 * Photography Child Theme
 */

function photography_site_google_fonts_preconnect()
{
  echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
  echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}


function photography_site_enqueue_fonts()
{
  $font_url = "https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap";

  wp_enqueue_style('photgraphy-site-google-fonts', $font_url, array(), null);
}

add_action('wp_head', 'photography_site_google_fonts_preconnect');
add_action('wp_enqueue_scripts', 'photography_site_enqueue_fonts');
add_action('wp_enqueue_scripts', 'photography_site_enqueue_styles');

function photography_site_enqueue_styles()
{
  wp_enqueue_style('main-styles', get_stylesheet_directory_uri() . '/styles/main.css');
}

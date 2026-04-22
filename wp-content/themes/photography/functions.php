<?php

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

add_action('init', 'register_slide_cpt_and_tax');

function register_slide_cpt_and_tax()
{
  $tax_args = array(
    'labels' => array(
      'name' => 'Slide Tags',
      'singular_name' => 'Slide Tag',
    ),
    'hierarchical' => false,
    'public' => true,
    'show_admin_column' => true
  );
  register_taxonomy('slide_tag', array('slide'), $tax_args);

  $ctp_args = array(
    'labels' => array(
      'name' => 'Slides',
      'singular_name' => 'Slide',
      'add_new_item' => 'Add New Slide',
    ),
    'public' => false,
    'show_ui' => true,
    'menu_position' => 20,
    'menu_icon' => 'dashicons-images-alt2',
    'supports' => array('title', 'thumbnail'),
    'has_archive' => false,
  );
  register_post_type('slide', $ctp_args);
}

<?php

add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');

remove_action('genesis_loop', 'genesis_do_loop');
remove_action('genesis_header', 'genesis_do_header');
remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_structural_wrap-header', '__return_false');

add_action('genesis_loop', 'photography_homepage_content');
add_action('genesis_header', 'insert_header');
add_action('genesis_after_header', 'photography_slides', 20);



function insert_header()
{
?>
  <header class="photography-site-header">
    <div class="main-link">
      <a href="/">Timothy Popp Photography</a>
    </div>
    <nav class="nav">
      <a href="/" class="link">Home</a>
      <a href="/gallery" class="link">Gallery</a>
      <a href="" class="link">Contact</a>
    </nav>
  </header>
<?php
}

function photography_slides()
{
  echo do_shortcode('[metaslider id="54"]');
}


function photography_homepage_content()
{
?>
  <div class="main-text">
    <div class="text-left">
      <h1>Hi, I'm Tim.</h1>
      <h3>I take Photos.</h3>
    </div>
    <div class="see-full-gallery">
      <a href="/gallery" class="gallery-link">See Full Gallery</a>
    </div>
  </div>
<?php
}

genesis();


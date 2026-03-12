<?php

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');

remove_action( 'genesis_loop', 'genesis_do_loop');
remove_action( 'genesis_header', 'genesis_do_header');
remove_action( 'genesis_footer', 'genesis_do_footer');

add_action( 'genesis_loop', 'photography_homepage_content');
add_action( 'genesis_header', 'insert_header');



function insert_header() {
  ?>
  <header class="site-header">
    <div class="logo">
      <a href="">Timothy Popp Photography</a>
    </div>
    <nav class="main-name">
      <ul>
        <li><a href="">Home</a></li>
        <li><a href="">Gallery</a></li>
        <li><a href="">Contact</a></li>
      </ul>
    </nav>
  </header>
  <?php
}

function photography_homepage_content() {
  ?>

  <section class="hero-section">
    <h1>My Photography</h1>
    <a href="/gallery">Gallery</a>
  </section>

  <?php
}

genesis();
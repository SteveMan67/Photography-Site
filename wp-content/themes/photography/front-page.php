<?php

add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');

remove_action('genesis_loop', 'genesis_do_loop');
remove_action('genesis_header', 'genesis_do_header');
remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_structural_wrap-header', '__return_false');

add_action('genesis_loop', 'photography_homepage_content');
add_action('genesis_header', 'insert_header');
add_action('genesis_after_header', 'photography_slides', 20);
add_action('genesis_loop', 'photography_homepage_photo_wheel');


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

function photography_homepage_photo_wheel()
{
  $images = get_field("images", 'option');
  $valid_images = array();
  if ($images) :
    foreach ($images as $img) {
      $file_path = get_attached_file($img['ID']);
      if ($file_path && file_exists($file_path)) {
        $valid_images[] = $img;
      }
    }
    shuffle($valid_images);

    $half = ceil(count($valid_images) / 2);
    $chunks = array_chunk($valid_images, $half);

    $top_row = $chunks[0] ?? [];
    $bottom_row = $chunks[1] ?? [];
    $top_row = array_merge($chunks[0], $chunks[0]);
    $bottom_row = array_merge($chunks[1], $chunks[1]);
  ?>
    <div class="gallery">
      <div class="gallery-top">
        <?php foreach ($top_row as $image) : ?>
          <?php if (! empty($image['url'])) : ?>
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
      <div class="gallery-bottom">
        <?php foreach ($bottom_row as $image) : ?>
          <?php if (! empty($image['url'])) : ?>
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
          <?php endif; ?>
        <?php endforeach; ?>
      </div
        </div>
  <?php endif;
}

genesis();

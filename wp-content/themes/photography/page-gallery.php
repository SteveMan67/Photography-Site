<?php

add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');

remove_action('genesis_loop', 'genesis_do_loop');
remove_action('genesis_header', 'genesis_do_header');
remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_structural_wrap-header', '__return_false');

add_action('genesis_header', 'insert_header');
add_action('genesis_after_header', 'photography_slides', 20);
add_action('genesis_loop', 'photography_header');
add_action('genesis_loop', 'photography_gallery');

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

function photography_header()
{
  echo '<h1 class="header">Gallery</h1>';
}

function get_orientation($image)
{
  $w = $image['width'];
  $h = $image['height'];
  return ($w >= $h) ? 'H' : 'V';
}

$last_template = null;

function match_template(array &$queue): ?array
{
  $templates = [
    // needs to go from largest to smallest
    'two-h-two-v' => ['H', 'H', 'V', 'V'],
    'two-h-one-v' => ['H', 'H', 'V'],
    'two-h' => ['H', 'H'],
    'two-v' => ['V', 'V'],
    'one-h' => ['H'],
    'one-v' => ['V']
  ];


  foreach ($templates as $name => $pattern) {
    $needed = count($pattern);

    $needs = array_count_values($pattern);

    $available = array_count_values(
      array_map('get_orientation', $queue)
    );

    $satisfyable = true;
    foreach ($needs as $orientation => $count) {
      if (($available[$orientation] ?? 0) < $count) {
        $satisfyable = false;
        break;
      }
    }

    if (!$satisfyable) continue;

    $group = [];
    $remaining = [];
    $still_needs = $needs;

    foreach ($queue as $img) {
      $o = get_orientation($img);
      if (($still_needs[$o] ?? 0) > 0) {
        $group[] = $img;
        $still_needs[$o]--;
      } else {
        $remaining[] = $img;
      }
    }

    $queue = $remaining;
    return ['template' => $name, 'count' => $needed, 'images' => $group];
  };
  return [];
}



function photography_gallery()
{
  $images = get_field("images", 'option');

  $groups = [];
  while (!empty($images)):
    $match = match_template($images);
    if (!$match) break;
    $groups[] = $match;
  endwhile;

  shuffle($groups);

?> <div class="gallery-wrapper">
    <?php foreach ($groups as $group):
      $v_count = 0;
      $h_count = 0;
      $template = $group['template'];

      if ($template === 'two-h-two-v' && wp_rand(0, 1) === 1):
        $template = 'two-h-two-v-alt';
      elseif ($template === 'two-h-one-v' && wp_rand(0, 1) === 1):
        $template = 'two-h-one-v-alt';
      endif
    ?>
      <div class="<?php echo $template ?> template">
        <?php foreach ($group['images'] as $img) :
          $orentation = get_orientation($img);
          $index = $orentation === 'H' ? ++$h_count : ++$v_count;
        ?>
          <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" class="<?php echo $orentation; ?> <?php echo $orentation . '-' . $index; ?>">
        <?php endforeach; ?>
      </div>
    <?php
    endforeach;
    ?>
  </div> <?php
        }

        genesis();

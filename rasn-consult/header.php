<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); 

$header_logo = get_field('header_logo', 'option');
$header_menu_slug = get_field('header_menu', 'option');
$right_header_menu_slug = get_field('page_menu');
$header_button_style = get_field('header_button_style');

$header_button_text = get_field('header_button_text', 'option');
$header_button_link = get_field('header_button_link', 'option');

if( $header_button_link ):
    $header_button_link = $header_button_link['url'];
endif;

$right_header_menu_items = array();
if ( $right_header_menu_slug ) {
  $right_header_menu_object = wp_get_nav_menu_object( $right_header_menu_slug );
  if ( $right_header_menu_object ) {
    $right_header_menu_items = wp_get_nav_menu_items( $right_header_menu_object->term_id );
  }
}

// Per-page transparent header
$transparent_header = get_field('transparent_header');
$header_class = 'header' . ( $transparent_header ? ' header--transparent' : '' );
?>

  <!-- ====== OFF-CANVAS BACKDROP ====== -->
  <div class="drawer-backdrop" id="drawerBackdrop" onclick="closeDrawer()"></div>

  <!-- ====== OFF-CANVAS DRAWER ====== -->
  <aside class="drawer" id="drawer" aria-label="Site navigation" aria-hidden="true">

    <div class="drawer__header">
      <div class="drawer__logo is-hidden">
        <?php if ( $header_logo ) : ?>
          <img src="<?php echo esc_url( $header_logo ); ?>" alt="RASN Consult" style="height: 44px; width: auto;" />
        <?php else : ?>
          <svg class="logo__icon" viewBox="0 0 44 44" fill="none">
            <rect width="44" height="44" rx="6" fill="#0d2a4a"/>
            <path d="M8 36L14 8H22L28 26L34 8H40" stroke="white" stroke-width="3"
                  stroke-linecap="round" stroke-linejoin="round" fill="none"/>
            <path d="M6 22h10" stroke="#3b9eff" stroke-width="2.5" stroke-linecap="round"/>
          </svg>
          <div class="logo__text">
            <span class="logo__brand">RASN</span>
            <span class="logo__sub">CONSULT</span>
            <span class="logo__tagline">Make it easy</span>
          </div>
        <?php endif; ?>
      </div>
      <button class="drawer__close" onclick="closeDrawer()" aria-label="Close menu">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
          <path d="M2 2l12 12M14 2L2 14" stroke="#aac8e8" stroke-width="2" stroke-linecap="round"/>
        </svg>
      </button>
    </div>

    <nav class="drawer__nav">
      <?php
      if ( $header_menu_slug ) {
          wp_nav_menu( array(
              'menu'           => $header_menu_slug,
              'theme_location' => 'menu-1',
              'container'      => false,
              'menu_class'     => '',
              'fallback_cb'    => false,
              'link_before'    => '<span class="dot"></span>',
          ) );
      } else {
          wp_nav_menu( array(
              'theme_location' => 'menu-1',
              'container'      => false,
              'menu_class'     => '',
              'fallback_cb'    => false,
              'link_before'    => '<span class="dot"></span>',
          ) );
      }
      ?>
    </nav>

    <div class="drawer__footer">
      <p>© <?php echo date('Y'); ?> RASN Consult. All rights reserved.</p>
    </div>

  </aside>

  <!-- ====== SITE HEADER ====== -->
  <header class="<?php echo esc_attr( $header_class ); ?>">
  <div class="logo-wrapper">
      <button class="hamburger" onclick="openDrawer()" aria-label="Open menu" aria-expanded="false" id="hamburgerBtn">
          <span></span>
          <span></span>
          <span></span>
      </button>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" aria-label="RASN Consult Home">
      <?php if ( $header_logo ) : ?>
        <img src="<?php echo esc_url( $header_logo ); ?>" alt="RASN Consult" style="height: 44px; width: auto;" />
      <?php else : ?>
        <svg class="logo__icon" viewBox="0 0 44 44" fill="none">
          <rect width="44" height="44" rx="6" fill="#0d2a4a"/>
          <path d="M8 36L14 8H22L28 26L34 8H40" stroke="white" stroke-width="3"
                stroke-linecap="round" stroke-linejoin="round" fill="none"/>
          <path d="M6 22h10" stroke="#3b9eff" stroke-width="2.5" stroke-linecap="round"/>
        </svg>
        <div class="logo__text">
          <span class="logo__brand">RASN</span>
          <span class="logo__sub">CONSULT</span>
          <span class="logo__tagline">Make it easy</span>
        </div>
      <?php endif; ?>
    </a>
  </div>

    <nav class="nav" aria-label="Main navigation">
        <?php if ($right_header_menu_items) : ?>
            <?php foreach ($right_header_menu_items as $menu_item) : ?>
                <?php if ((int)$menu_item->menu_item_parent !== 0) {
                    continue;
                } ?>
                <a href="<?php echo esc_url($menu_item->url); ?>"
                   target="<?php echo esc_attr($menu_item->target ? $menu_item->target : '_self'); ?>"
                   class=""><?php echo esc_html($menu_item->title); ?></a>
            <?php endforeach; ?>
        <?php endif; ?>

        <a class="header-btn style-<?= $header_button_style ?>" href="<?= $header_button_link ?>"> <?= $header_button_text ?> </a>
    </nav>

  </header>

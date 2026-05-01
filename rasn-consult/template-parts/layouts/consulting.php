<?php
/**
 * Layout: Consulting Section
 */

$title       = get_sub_field('title');
$subtitle    = get_sub_field('subtitle');
$button_text = get_sub_field('button_text');
$button_link = get_sub_field('button_link');
if( !empty($button_link) ):
    $button_link = $button_link['url'];
endif;
$image       = get_sub_field('image');


$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>

<!-- ====== CONSULTING SECTION ====== -->
<section class="consulting-section" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?>>
  <div class="container">
    <div class="row align-items-center">

      <!-- Left: copy -->
      <div class="col-lg-6 col-md-12" data-aos="fade-right">
        <div class="consulting-copy">
          <?php if ( $title ) : ?>
            <h2 class="consulting-copy__title"><?php echo esc_html( $title ); ?></h2>
          <?php endif; ?>
          
          <?php if ( $subtitle ) : ?>
            <p class="consulting-copy__subtitle"><?php echo wp_kses_post( $subtitle ); ?></p>
          <?php endif; ?>
          
          <?php if ( $button_link && $button_text ) : ?>
            <a href="<?php echo esc_url( $button_link ); ?>" class="btn--know-more"><?php echo esc_html( $button_text ); ?></a>
          <?php endif; ?>
        </div>
      </div>

      <!-- Right: app mockup screenshot -->
      <div class="col-lg-6 col-md-12" data-aos="fade-left" >
        <div class="consulting-mockup">
          <div class="mockup-card">
            <?php if ( $image ) : ?>
              <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>" />
            <?php endif; ?>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
<!-- ====== END CONSULTING SECTION ====== -->

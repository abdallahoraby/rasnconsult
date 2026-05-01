<?php
/**
 * Hero Layout Template
 *
 * @package RASN_Consult
 */

$bg_image_url = get_sub_field('background_image');
$title        = get_sub_field('title');
$subtitle     = get_sub_field('subtitle');
$cta_text     = get_sub_field('cta_text');
$cta_link     = get_sub_field('cta_link');
if( $cta_link ){
  $cta_link = $cta_link['url'];
}

// Fallbacks if empty
//if ( ! $title ) {
//	$title = 'Empowering Your Business with<br/>Intelligent Technology Solutions';
//}
//if ( ! $subtitle ) {
//	$subtitle = 'We help companies grow, innovate, and succeed with custom software,<br/>strategic IT consulting, and digital transformation services designed to deliver measurable results.';
//}

$bg_style = $bg_image_url ? 'style="background-image: url(\'' . esc_url($bg_image_url) . '\');"' : '';

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>

<!-- ====== HERO SECTION ====== -->
<section class="hero"  id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >

    <?php
        if( !empty( $bg_image_url ) ):
    ?>
  <div class="hero__bg" <?php echo $bg_style; ?>></div>

    <?php else: ?>

            <canvas id="particleCanvas"></canvas>
            <div class="contents" style="display: none">
                <div class="controls">
                    <button id="colorBtn" class="btn">Change Colors</button>
                    <button id="speedBtn" class="btn">Toggle Speed</button>
                    <button id="resetBtn" class="btn">Reset</button>
                </div>
            </div>

    <?php endif; ?>


  <div class="hero__content">
    <h1 class="hero__title" data-aos="fade-up">
      <?php echo wp_kses_post( $title ); ?>
    </h1>
    <p class="hero__subtitle" data-aos="fade-up">
      <?php echo wp_kses_post( $subtitle ); ?>
    </p>
    <?php if ( $cta_text && $cta_link ) : ?>
      <div data-aos="fade-up">
        <a href="<?php echo esc_url( $cta_link ); ?>" class="btn--cta"><?php echo esc_html( $cta_text ); ?></a>
      </div>
    <?php endif; ?>
  </div>

</section>
<!-- ====== END HERO SECTION ====== -->

<?php
/**
 * Layout: Contact Form Section
 */

$bg_color = get_sub_field('background_color') ?: '#f8fafc';
$title    = get_sub_field('title');
$content  = get_sub_field('content');

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>

<!-- ====== CONTACT FORM SECTION ====== -->
<section class="contact-section" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> style="background-color: <?php echo esc_attr( $bg_color ); ?>;" >
  <div class="container">
    <div class="row align-items-center g-5">

      <!-- Left: Title + Intro Content -->
      <div class="col-md-12">
        <?php if ( $title ) : ?>
          <h2 class="contact-section__title" data-aos="fade-right">
            <?php echo $title; ?>
          </h2>
        <?php endif; ?>

      </div>

      <!-- Content from WYSIWYG -->
      <?php if ( $content ) : ?>
        <div class="col-md-12 contact-section__content" data-aos="fade-up" >
          <?php echo $content; ?>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>
<!-- ====== END CONTACT FORM SECTION ====== -->

<?php
/**
 * Layout: Features List (Why Choose Us)
 */

$title    = get_sub_field('title');
$content  = get_sub_field('content');
$features = get_sub_field('features');

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>

<!-- ====== FEATURES LIST SECTION ====== -->
<section class="why-section" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >
  <div class="container">
    <div class="row align-items-start">

      <!-- Left column: Title + WYSIWYG -->
      <div class="col-lg-6 col-md-6" data-aos="fade-right">
        <div class="why-left">
          <?php if ( $title ) : ?>
            <h2 class="why-left__title"><?php echo esc_html( $title ); ?></h2>
          <?php endif; ?>

          <?php if ( $content ) : ?>
            <div class="why-left__content">
              <?php echo wp_kses_post( $content ); ?>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Right column: Feature cards repeater -->
      <div class="col-lg-6 col-md-6">
        <?php if ( $features ) : ?>
          <div class="why-cards">
            <?php foreach ( $features as $idx => $feature ) :
              $icon        = $feature['icon'];
              $feat_title  = $feature['feature_title'];
              $description = $feature['description'];
            ?>
              <div class="why-card"
                   data-aos="fade-left"
                   >
                <?php if ( $icon ) : ?>
                  <div class="why-card__icon">
                    <img src="<?php echo esc_url( $icon ); ?>"
                         alt="<?php echo esc_attr( $feat_title ); ?>"
                         style="width:28px;height:28px;object-fit:contain;" />
                  </div>
                <?php endif; ?>
                <div class="why-card__body">
                  <?php if ( $feat_title ) : ?>
                    <p class="why-card__title"><?php echo esc_html( $feat_title ); ?></p>
                  <?php endif; ?>
                  <?php if ( $description ) : ?>
                    <p class="why-card__desc"><?php echo wp_kses_post( $description ); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>
<!-- ====== END FEATURES LIST SECTION ====== -->

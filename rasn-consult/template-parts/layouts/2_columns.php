<?php
/**
 * Layout: 2 Columns Section
 */

$title   = get_sub_field('title');
$image   = get_sub_field('image');
$content = get_sub_field('content');
// based on image position
$image_position = get_sub_field('image_position');
if( $image_position === true ):
    $position_class = 'flex-row';
else:
    $position_class = 'flex-row-reverse';
endif;

$background_color = get_sub_field('background_color');

?>

<!-- ====== 2 COLUMNS SECTION ====== -->
<section class="two-columns-section" style="padding: 80px 0; background-color: <?= $background_color ?>" id="<?= get_sub_field('section_id') ?? '' ?>" >
  <div class="container">
    
    <?php if ( $title ) : ?>
      <div class="row mb-5">
        <div class="col-12">
          <h2 class="two-columns-section__title" style="font-size: clamp(2rem, 4vw, 2.75rem); font-weight: 700; color: #111827; letter-spacing: -0.02em;">
            <?php echo esc_html( $title ); ?>
          </h2>
        </div>
      </div>
    <?php endif; ?>

    <div class="row align-items-center <?= $position_class ?>">
      <!-- Column: Image -->
      <div class="col-md-5 px-5" data-aos="fade-right">
        <?php if ( $image ) : ?>
          <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>" class="img-fluid rounded" style="width: 100%; height: auto; object-fit: cover;" />
        <?php endif; ?>
      </div>

      <!--  Column: WYSIWYG Content -->
      <div class="col-md-7 px-5" data-aos="fade-left">
        <div class="two-columns-section__content" style="color: #6b7280; line-height: 1.78;">
          <?php echo wp_kses_post( $content ); ?>
        </div>

        <?php if ( have_rows('buttons') ) : ?>
          <div class="two-columns-section__buttons d-flex mt-4">
            <?php while ( have_rows('buttons') ) : the_row(); 
              $link = get_sub_field('link');
              if ( $link ) :
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <a class="btn btn-primary" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                  <?php echo esc_html( $link_title ); ?>
                </a>
              <?php endif; ?>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
    
  </div>
</section>
<!-- ====== END 2 COLUMNS SECTION ====== -->

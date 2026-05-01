<?php
/**
 * Layout: About Section
 */

$tagline     = get_sub_field('tagline');
$work_title  = get_sub_field('work_title');
$work_list   = get_sub_field('work_list');
$description = get_sub_field('description');
$why_title   = get_sub_field('why_title');
$why_body    = get_sub_field('why_body');
$why_links   = get_sub_field('why_links');
$image       = get_sub_field('image');

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>

<!-- ====== ABOUT SECTION ====== -->
<section class="about-section" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >
  <div class="container">

    <!-- Top tagline -->
    <?php if ( $tagline ) : ?>
      <p class="tagline"><?php echo esc_html( $tagline ); ?></p>
    <?php endif; ?>

    <!-- We Work With + Description -->
    <div class="row align-items-start">

      <div class="col-lg-6" data-aos="fade-right">
        <div class="we-work-with">
          <?php if ( $work_title ) : ?>
            <h2 class="we-work-with__title"><?php echo esc_html( $work_title ); ?></h2>
          <?php endif; ?>

          <?php if ( $work_list ) : ?>
            <p class="we-work-with__list">
              <?php 
              $count = count( $work_list );
              foreach ( $work_list as $index => $row ) : 
                echo esc_html( $row['item'] );
                if ( $index < $count - 1 ) :
                  echo '<span class="divider">|</span>';
                endif;
              endforeach; 
              ?>
            </p>
          <?php endif; ?>
        </div>
      </div>

      <div class="col-lg-6" data-aos="fade-left" >
        <?php if ( $description ) : ?>
          <p class="about-desc">
            <?php echo wp_kses_post( $description ); ?>
          </p>
        <?php endif; ?>
      </div>

    </div>

    <!-- Why Choose + Image -->
    <div class="row why-choose">

      <div class="col-lg-6 order-lg-1 order-2" data-aos="fade-up">
        <?php if ( $why_title ) : ?>
          <h2 class="why-choose__title">
            <?php echo wp_kses_post( $why_title ); ?>
          </h2>
        <?php endif; ?>

        <?php if ( $why_body ) : ?>
          <p class="why-choose__body">
            <?php echo wp_kses_post( $why_body ); ?>
          </p>
        <?php endif; ?>

        <?php if ( $why_links ) : ?>
          <div class="why-choose__links">
            <?php foreach ( $why_links as $row ) : 
              $link = $row['link_object'];
              if ( $link ) :
                $link_url    = $link['url'];
                $link_title  = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
              <?php endif;
            endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="col-lg-6 order-lg-2 order-1 mb-4 mb-lg-0" data-aos="zoom-in" >
        <?php if ( $image ) : ?>
          <div class="about-image">
            <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( wp_strip_all_tags( $why_title ) ); ?>" />
          </div>
        <?php endif; ?>
      </div>

    </div>

  </div>
</section>
<!-- ====== END ABOUT SECTION ====== -->

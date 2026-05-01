<?php
/**
 * Layout: Testimonials Section
 */

$title       = get_sub_field('title');
$lead_text   = get_sub_field('lead_text');
$button_text = get_sub_field('button_text');
$button_link = get_sub_field('button_link');
if( !empty($button_link) ):
    $button_link = $button_link['url'];
endif;
$slides      = get_sub_field('slides');

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>

<!-- ====== TESTIMONIALS SECTION ====== -->
<section class="testimonials-section" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >
  <div class="container text-center">

    <!-- Header -->
    <?php if ( $title ) : ?>
      <h2 class="testimonials-section__title" data-aos="fade-up"><?php echo esc_html( $title ); ?></h2>
    <?php endif; ?>
    
    <?php if ( $lead_text ) : ?>
      <p class="testimonials-section__lead mx-auto" data-aos="fade-up" >
        <?php echo esc_html( $lead_text ); ?>
      </p>
    <?php endif; ?>

    <!-- Slick Slider -->
    <?php if ( $slides ) : ?>
      <div class="testimonials-slider" data-aos="fade-up" >
        <?php foreach ( $slides as $slide ) : 
          $avatar = $slide['avatar'];
          $quote  = $slide['quote'];
          $name   = $slide['name'];
        ?>
          <div class="testimonial-slide">
            <?php if ( $avatar ) : ?>
              <img class="testimonial-slide__avatar" src="<?php echo esc_url( $avatar ); ?>" alt="<?php echo esc_attr( $name ); ?>" />
            <?php endif; ?>
            
            <?php if ( $quote ) : ?>
              <p class="testimonial-slide__quote"><?php echo wp_kses_post( $quote ); ?></p>
            <?php endif; ?>
            
            <?php if ( $name ) : ?>
              <p class="testimonial-slide__name"><?php echo esc_html( $name ); ?></p>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    <!-- End Slick Slider -->

    <!-- CTA -->
    <?php if ( $button_link && $button_text ) : ?>
        <div class="row test-button">
            <a href="<?php echo esc_url( $button_link ); ?>" class="btn--success-story mt-4"><?php echo esc_html( $button_text ); ?></a>
        </div>
    <?php endif; ?>

  </div>
</section>
<!-- ====== END TESTIMONIALS SECTION ====== -->

<script>
  jQuery(document).ready(function ($) {
    if ($('.testimonials-slider').length) {
      $('.testimonials-slider').not('.slick-initialized').slick({
        dots: true,
        arrows: false,
        infinite: true,
        speed: 600,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        pauseOnHover: true,
        fade: false,
        cssEase: 'cubic-bezier(0.4, 0, 0.2, 1)',
      });
    }
  });
</script>

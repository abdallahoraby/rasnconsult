<?php
/**
 * Layout: Clients Section
 */

$title       = get_sub_field('title');
$lead_text   = get_sub_field('lead_text');
$button_text = get_sub_field('button_text');
$button_link = get_sub_field('button_link');
$stats       = get_sub_field('stats');
$logos       = get_sub_field('logos');

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>

<!-- ====== CLIENTS SECTION ====== -->
<section class="clients-section" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?>>
  <div class="container">

    <!-- Header -->
    <?php if ( $title ) : ?>
      <h2 class="clients-section__title" data-aos="fade-up"><?php echo esc_html( $title ); ?></h2>
    <?php endif; ?>
    
    <?php if ( $lead_text ) : ?>
      <p class="clients-section__lead" data-aos="fade-up" >
        <?php echo esc_html( $lead_text ); ?>
      </p>
    <?php endif; ?>

    <!-- Stats bullets -->
    <?php if ( $stats ) : ?>
      <ul class="clients-stats" data-aos="fade-up" >
        <?php foreach ( $stats as $stat ) : ?>
          <li><?php echo esc_html( $stat['stat_text'] ); ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <!-- Client logos Slider -->
    <?php if ( $logos ) : ?>
      <div class="clients-logos" data-aos="fade-up" >
        <?php foreach ( $logos as $logo_url ) : ?>
          <div class="client-logo">
            <img src="<?php echo esc_url( $logo_url ); ?>" alt="Client Logo" />
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <!-- CTA -->
    <?php if ( $button_link && $button_text ) : 
        $link_url    = isset($button_link['url']) ? $button_link['url'] : $button_link;
        $link_target = isset($button_link['target']) ? $button_link['target'] : '_self';
        $link_title  = esc_html( $button_text );
    ?>
      <div class="clients-button">
        <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="clients-section__cta">
          <?php echo $link_title; ?>
        </a>
      </div>
    <?php endif; ?>

  </div>
</section>
<!-- ====== END CLIENTS SECTION ====== -->

<script>
  jQuery(document).ready(function ($) {
    if ($('.clients-logos').length) {
      $('.clients-logos').not('.slick-initialized').slick({
        dots: false,
        arrows: false,
        infinite: true,
        speed: 800,
        slidesToShow: 5,
        slidesToScroll: 2,
        autoplay: true,
        autoplaySpeed: 3000,
        pauseOnHover: true,
        cssEase: 'linear',
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 4,
            }
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 2,
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 2,
            }
          }
        ]
      });
    }
  });
</script>

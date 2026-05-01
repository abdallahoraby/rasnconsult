<?php
/**
 * Layout: Feature Cards Section
 */

$title    = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$cards    = get_sub_field('cards');

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>

<!-- ====== FEATURE CARDS SECTION ====== -->
<section class="feature-cards-section" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >
  <div class="container-fluid">

    <?php if ( $title ) : ?>
      <h2 class="feature-cards-section__title" data-aos="fade-up">
        <?php echo esc_html( $title ); ?>
      </h2>
    <?php endif; ?>

    <?php if ( $subtitle ) : ?>
      <p class="feature-cards-section__sub" data-aos="fade-up" >
        <?php echo esc_html( $subtitle ); ?>
      </p>
    <?php endif; ?>

    <?php if ( $cards ) : ?>
      <div class="feature-cards-row">
        <?php foreach ( $cards as $idx => $card ) :
          $img   = $card['image'];
          $label = $card['title'];
          $link  = $card['link'];
          $link_url    = $link ? $link['url']    : '#';
          $link_target = $link ? ( $link['target'] ?: '_self' ) : '_self';
        ?>
          <a class="feature-card"
             href="<?php echo esc_url( $link_url ); ?>"
             target="<?php echo esc_attr( $link_target ); ?>"
             data-aos="fade-up"
             >
            <div class="feature-card__img-wrap">
              <?php if ( $img ) : ?>
                <img src="<?php echo esc_url( $img ); ?>"
                     alt="<?php echo esc_attr( $label ); ?>" />
              <?php endif; ?>
            </div>
            <span class="feature-card__label"><?php echo esc_html( $label ); ?></span>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
</section>
<!-- ====== END FEATURE CARDS SECTION ====== -->

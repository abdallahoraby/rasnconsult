<?php
/**
 * Layout: Services Section
 */

$title        = get_sub_field('title');
$service_rows = get_sub_field('service_rows');

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>

<!-- ====== SERVICES SECTION ====== -->
<section class="services-section" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >
  <div class="container">

    <?php if ( $title ) : ?>
      <h2 class="services-section__title"><?php echo esc_html( $title ); ?></h2>
    <?php endif; ?>

    <?php if ( $service_rows ) : ?>
      <div class="service-card-row">
        <?php foreach ( $service_rows as $row_index => $row_data ) : 
          
          $row_layout = $row_data['row_layout']; 
          $services   = $row_data['services'];
          
          // Fallback array checks
          if ( ! $services ) continue;

          // For styling row variation
          $row_class_num = ( $row_index % 3 ) + 1;
          ?>

          <div class="row service-row-<?php echo esc_attr( $row_class_num ); ?>">
            
            <?php foreach ( $services as $service_idx => $service ) : 
              
              $number      = $service['number'];
              $name        = $service['name'];
              $body        = $service['body'];
              $image       = $service['image'];
              $link        = isset($service['link']) ? $service['link'] : null;

              // Automatically determine column span based on row layout and index
              $is_spanning = false;
              if ( $row_layout === '1_2' && $service_idx === 1 ) {
                $is_spanning = true;
              } elseif ( $row_layout === '2_1' && $service_idx === 0 ) {
                $is_spanning = true;
              }

              if ( $is_spanning ) : ?>
                <div class="col-md-8 row">
                  <div class="service-card col-md-6" data-aos="fade-up">
                    <?php if ( $link ) : ?>
                      <a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ?: '_self' ); ?>" class="service-card__link-wrap">
                    <?php endif; ?>
                        <div class="service-card__arrow-row">
                          <svg class="service-card__arrow" width="54" height="51" viewBox="0 0 54 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 49.5L52 1.5M52 1.5H0M52 1.5V50" stroke="black" stroke-width="3"/>
                            <path d="M4 49.5L52 1.5M52 1.5H0M52 1.5V50" stroke="black" stroke-width="3"/>
                          </svg>
                          <div class="service-card__name">
                            <?php if ( $number ) : ?>
                              <p class="service-card__number"><?php echo esc_html( $number ); ?></p>
                            <?php endif; ?>
                            <?php echo esc_html( $name ); ?>
                          </div>
                        </div>
                        <?php if ( $body ) : ?>
                          <p class="service-card__body">
                            <?php echo wp_kses_post( $body ); ?>
                          </p>
                        <?php endif; ?>
                        <?php if ( $image ) : ?>
                          <div class="service-card__image">
                            <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $name ); ?>" />
                          </div>
                        <?php endif; ?>
                    <?php if ( $link ) : ?>
                      </a>
                    <?php endif; ?>
                  </div>
                </div>

              <?php else : // column_span === '4' ?>

                <div class="service-card col-md-4" data-aos="fade-up" >
                  <?php if ( $link ) : ?>
                    <a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ?: '_self' ); ?>" class="service-card__link-wrap">
                  <?php endif; ?>
                      <div class="service-card__arrow-row">
                        <svg class="service-card__arrow" width="54" height="51" viewBox="0 0 54 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M4 49.5L52 1.5M52 1.5H0M52 1.5V50" stroke="black" stroke-width="3"/>
                          <path d="M4 49.5L52 1.5M52 1.5H0M52 1.5V50" stroke="black" stroke-width="3"/>
                        </svg>
                        <div class="service-card__name">
                          <?php if ( $number ) : ?>
                            <p class="service-card__number"><?php echo esc_html( $number ); ?></p>
                          <?php endif; ?>
                          <?php echo esc_html( $name ); ?>
                        </div>
                      </div>
                      <?php if ( $body ) : ?>
                        <p class="service-card__body">
                          <?php echo wp_kses_post( $body ); ?>
                        </p>
                      <?php endif; ?>
                      <?php if ( $image ) : ?>
                        <div class="service-card__image">
                          <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $name ); ?>" />
                        </div>
                      <?php endif; ?>
                  <?php if ( $link ) : ?>
                    </a>
                  <?php endif; ?>
                </div>

              <?php endif; ?>

            <?php endforeach; ?>

          </div> <!-- /.row -->
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
</section>
<!-- ====== END SERVICES SECTION ====== -->

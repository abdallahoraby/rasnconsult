<?php

/**
 * Layout: Image Slider
 * This layout is intended to display a simple image slider with a title and description.
 * It can be used to showcase a series of images in a visually appealing way.
 * The slider functionality can be implemented using a JavaScript library like Slick Slider or Swiper.
 */

$title       = get_sub_field('title');
$sub_title = get_sub_field('sub_title');
$slider     = get_sub_field('slider');

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;

// Unique ID for the slider to avoid conflicts if multiple sliders are on the same page
$slider_id = 'slider-gallery-' . uniqid();

?>


<section class="image-slider-section" <?= $section_style ?> id="<?= get_sub_field('section_id') ?? '' ?>" >
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if( !empty($title) ): ?>
                    <h3> <?= $title ?> </h3>
                <?php endif; ?>

                <?php if( !empty($sub_title) ): ?>
                    <p> <?= $sub_title ?> </p>
                <?php endif; ?>

                <?php if( !empty($slider) ): ?>
                    <div id="<?php echo esc_attr($slider_id); ?>" class="slider-gallery-wrapper carousel slide" data-bs-ride="carousel" data-aos="fade-up" data-aos-delay="200">
                        <div class="carousel-inner">
                            <?php
                                foreach ( $slider as $index => $slide ):
                                    $slide_image = $slide;
                                    $active_class = $index === 0 ? 'active' : '';
                            ?>
                                <div class="carousel-item <?php echo esc_attr($active_class); ?>">
                                    <img src="<?= esc_url($slide['url']) ?>" alt="<?= $slide['alt'] ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="carousel-indicators">
                            <?php foreach( $slider as $index => $slide ): ?>
                                <button type="button" data-bs-target="#<?php echo esc_attr($slider_id); ?>" data-bs-slide-to="<?php echo esc_attr($index); ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>" aria-current="<?php echo $index === 0 ? 'true' : 'false'; ?>" aria-label="Slide <?php echo esc_attr($index + 1); ?>"></button>
                            <?php endforeach; ?>
                        </div>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>



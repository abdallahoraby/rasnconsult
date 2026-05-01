<?php
/**
 * Layout: Slider Gallery
 */

$title       = get_sub_field('title');
$description = get_sub_field('description');
$gallery     = get_sub_field('gallery');

// Unique ID for the slider to avoid conflicts if multiple sliders are on the same page
$slider_id = 'slider-gallery-' . uniqid();

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>

<section class="slider-gallery-section py-5" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >
    <div class="container">
        <?php if ($title || $description) : ?>
            <div class="row mb-4">
                <div class="col-lg-8 mx-auto text-center">
                    <?php if ($title) : ?>
                        <h2 class="slider-gallery-section__title mb-3" data-aos="fade-up"><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>
                    <?php if ($description) : ?>
                        <div class="slider-gallery-section__description mb-4" data-aos="fade-up" data-aos-delay="100">
                            <?php echo wp_kses_post(wpautop($description)); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($gallery) : ?>
            <div class="slider-gallery-wrapper" data-aos="fade-up" data-aos-delay="200">
                <div id="<?php echo esc_attr($slider_id); ?>" class="slider-gallery">
                    <?php foreach ($gallery as $image_url) : ?>
                        <div class="slider-gallery__item px-2">
                            <div class="slider-gallery__image-container">
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>" class="img-fluid rounded shadow-sm">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <script>
                jQuery(document).ready(function($) {
                    var $slider = $('#<?php echo $slider_id; ?>');
                    if ($slider.length) {
                        $slider.slick({
                            dots: true,
                            arrows: false,
                            infinite: true,
                            speed: 500,
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            autoplay: true,
                            autoplaySpeed: 4000,
                            responsive: [
                                {
                                    breakpoint: 992,
                                    settings: {
                                        slidesToShow: 2
                                    }
                                },
                                {
                                    breakpoint: 768,
                                    settings: {
                                        slidesToShow: 1
                                    }
                                }
                            ]
                        });
                    }
                });
            </script>
        <?php endif; ?>
    </div>
</section>

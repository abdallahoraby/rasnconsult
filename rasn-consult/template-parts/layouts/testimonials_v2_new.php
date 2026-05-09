<?php
/**
 * Layout: Testimonials V2 Section
 */

$title       = get_sub_field('title');
$slides      = get_sub_field('slides');

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>


<div class="testimonials-v2" <?= $section_style ?>>


    <?php if($title): ?>
        <h2 class="section-title" data-aos="fade-up"><?= $title ?></h2>
    <?php endif; ?>


    <?php if(!empty($slides)): ?>
        <div class="testimonials-wrapper">
        <!-- Custom arrows outside slider -->
        <button class="nav-btn nav-prev" id="prevBtn" aria-label="Previous">
            <svg width="12" height="20" viewBox="0 0 12 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.56042 1.5L1.5 9.56043L9.56042 17.6209" stroke="#3D3D3D" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        <button class="nav-btn nav-next" id="nextBtn" aria-label="Next">
            <svg width="12" height="20" viewBox="0 0 12 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.5 17.6211L9.56043 9.56067L1.5 1.50024" stroke="#3D3D3D" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>

        <div class="testimonials-slider">

            <?php foreach ( $slides as $slide ): ?>
                <div>
                    <div class="card-stack">
                        <div class="testimonial-card">
                            <div class="avatar-wrap">
                                <img src="<?= $slide['avatar'] ?>" alt="">
                            </div>
                            <div class="name"><?= $slide['name'] ?></div>
                            <p class="testimonial-text"><?= $slide['quote'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>


        </div><!-- /.testimonials-slider -->
    </div>
    <?php endif; ?>

</div>

<script>
    jQuery(function () {
        jQuery('.testimonials-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,   // using custom buttons
            dots: false,
            infinite: true,
            speed: 420,
            cssEase: 'cubic-bezier(0.4, 0, 0.2, 1)',
            adaptiveHeight: true,
        });

        jQuery('#prevBtn').on('click', function () {
            jQuery('.testimonials-slider').slick('slickPrev');
        });

        jQuery('#nextBtn').on('click', function () {
            jQuery('.testimonials-slider').slick('slickNext');
        });
    });
</script>


<?php
$align_image = get_sub_field('field_ili_align_image');
$badge_text = get_sub_field('badge_text');
$badge_bg_color = get_sub_field('badge_bg_color');
$badge_text_color = get_sub_field('badge_text_color');
$section_title = get_sub_field('section_title');
$section_subtitle = get_sub_field('section_subtitle');
$image = get_sub_field('image');
$image_width = get_sub_field('image_width');
$steps_main_title = get_sub_field('steps_main_title');
$steps_main_description = get_sub_field('steps_main_description');
$steps = get_sub_field('steps');

$badge_style = '';
$badge_styles = array();
$sanitized_badge_bg_color = sanitize_hex_color($badge_bg_color);
$sanitized_badge_text_color = sanitize_hex_color($badge_text_color);

if ($sanitized_badge_bg_color) {
    $badge_styles[] = 'background-color: ' . $sanitized_badge_bg_color . ';';
}

if ($sanitized_badge_text_color) {
    $badge_styles[] = 'color: ' . $sanitized_badge_text_color . ';';
}

if ($badge_styles) {
    $badge_style = ' style="' . esc_attr(implode(' ', $badge_styles)) . '"';
}

$img_style = '';
if ($image_width) {
    $img_style = ' style="width: ' . esc_attr($image_width) . '%;"';
}

$content_grid_class = 'content-grid';
if ('left' === $align_image) {
    $content_grid_class .= ' content-grid--image-left';
} else {
    $content_grid_class .= ' content-grid--image-right';
}

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;


$icon_style = get_sub_field('icon_style') ?? '';

$ili_tags = get_sub_field('ili_tags') ?? [];
$ili_tags_bg_color = get_sub_field('ili_tags_bg_color');
$ili_tags_text_color = get_sub_field('ili_tags_text_color');


?>
<section class="section icon-list-with-image" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >

    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <?php if ($badge_text) : ?>
                <span class="badge"<?php echo $badge_style; ?>><?php echo esc_html($badge_text); ?></span>
            <?php endif; ?>
            <?php if ($section_title) : ?>
                <h2 class="section-title"><?php echo wp_kses_post($section_title); ?></h2>
            <?php endif; ?>
            <?php if ($section_subtitle) : ?>
                <p class="section-subtitle"><?php echo wp_kses_post($section_subtitle); ?></p>
            <?php endif; ?>
        </div>


        <div class="<?php echo esc_attr($content_grid_class); ?>">

            <!-- Steps -->
            <div class="steps-list <?= $icon_style ?>">
                <?php if( !empty($ili_tags) ): ?>
                    <div class="ili-tags-data">
                        <?php foreach ($ili_tags as $ili_tag): ?>
                            <span class="ili-tag" style="background-color: <?= $ili_tags_bg_color ?>; color: <?= $ili_tags_text_color ?>"> <?= $ili_tag['ili_tag_title'] ?> </span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ($steps_main_title) : ?>
                    <h3 class="steps-main-title"><?php echo wp_kses_post($steps_main_title); ?></h3>
                <?php endif; ?>
                <?php if ($steps_main_description) : ?>
                    <p class="steps-main-description"><?php echo wp_kses_post($steps_main_description); ?></p>
                <?php endif; ?>

                <?php if ($steps) : ?>
                    <div class="steps-items">
                        <?php $delay = 0; ?>
                        <?php foreach ($steps as $step) : ?>
                            <?php
                            $step_icon_style = '';
                            $step_icon_styles = array();
                            $step_icon_bg_color = ! empty($step['icon_bg_color']) ? sanitize_hex_color($step['icon_bg_color']) : '';
                            $step_icon_color = ! empty($step['icon_color']) ? sanitize_hex_color($step['icon_color']) : '';

                            if ($step_icon_bg_color) {
                                $step_icon_styles[] = 'background: ' . $step_icon_bg_color . ';';
                            }

                            if ($step_icon_color) {
                                $step_icon_styles[] = 'color: ' . $step_icon_color . ';';
                            } else {
                                $step_icon_styles[] = 'color: #fff';
                            }

                            if ($step_icon_styles) {
                                $step_icon_style = ' style="' . esc_attr(implode(' ', $step_icon_styles)) . '"';
                            }
                            ?>


                            <div class="step-item" data-aos="fade-right" data-aos-delay="<?php echo $delay; ?>">
                                <?php $delay += 100; ?>
                                <div class="step-icon-wrapper"<?php echo $step_icon_style; ?>>
                                    <?php if ($step['icon']) echo $step['icon']; ?>
                                </div>
                                <div class="step-content">
                                    <?php if ($step['step_number']) : ?>
                                        <p class="step-number"><?php echo esc_html($step['step_number']); ?></p>
                                    <?php endif; ?>
                                    <?php if ($step['step_title']) : ?>
                                        <h3 class="step-title"><?php echo esc_html($step['step_title']); ?></h3>
                                    <?php endif; ?>
                                    <?php if ($step['step_description']) : ?>
                                        <p class="step-description"><?php echo esc_html($step['step_description']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div>

            <!-- Image -->
            <div class="image-panel" data-aos="fade-up" data-aos-delay="200">
                <?php if ($image) : ?>
                    <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($section_title); ?>" <?php echo $img_style; ?> />
                <?php else : ?>
                    <div class="image-placeholder">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        <span>Dashboard screenshot</span>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

</section>

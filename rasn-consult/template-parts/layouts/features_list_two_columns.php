<?php
$badge        = get_sub_field('badge');
$title        = get_sub_field('title');
$subtitle     = get_sub_field('subtitle');
$features     = get_sub_field('features');

$card_title   = get_sub_field('card_title') ?: 'AI Assistant in Action';
$card_rows    = get_sub_field('card_rows');

$footer_label = get_sub_field('footer_label') ?: 'Productivity Boost';
$footer_value = get_sub_field('footer_value') ?: '50%';
$footer_sub   = get_sub_field('footer_sub')   ?: 'Time saved on daily logging tasks';

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>

<section class="features-list-two-columns" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >

    <!-- Header -->
    <div class="fltc-section-header">

        <?php if ($badge) : ?>
            <span class="fltc-badge" data-aos="fade-down" data-aos-delay="0">
                <?php echo esc_html($badge); ?>
            </span>
        <?php endif; ?>

        <?php if ($title) : ?>
            <h2 class="fltc-section-title" data-aos="fade-up" data-aos-delay="100">
                <?php echo wp_kses_post($title); ?>
            </h2>
        <?php endif; ?>

        <?php if ($subtitle) : ?>
            <p class="fltc-section-subtitle" data-aos="fade-up" data-aos-delay="200">
                <?php echo wp_kses_post($subtitle); ?>
            </p>
        <?php endif; ?>

    </div>

    <!-- Content Grid -->
    <div class="fltc-content-grid container">

        <!-- LEFT: Feature Cards -->
        <?php if ($features) : ?>
            <div class="fltc-feature-cards">
                <?php foreach ($features as $index => $f) :
                    $color_class = 'fltc-icon-' . ($f['icon_color'] ?: 'green');
                    $card_delay  = 300 + ($index * 150);
                ?>
                    <div class="fltc-feature-card"
                         data-aos="fade-right"
                         data-aos-delay="<?php echo esc_attr($card_delay); ?>">

                        <div class="fltc-fc-icon <?php echo esc_attr($color_class); ?>">
                            <?php
                            if (!empty($f['icon'])) {
                                echo $f['icon']; // font-awesome field saved as element
                            } else {
                                echo '<i class="fa-solid fa-star" aria-hidden="true"></i>';
                            }
                            ?>
                        </div>

                        <div class="fltc-fc-body">
                            <?php if (!empty($f['title'])) : ?>
                                <h4><?php echo esc_html($f['title']); ?></h4>
                            <?php endif; ?>
                            <?php if (!empty($f['description'])) : ?>
                                <p><?php echo wp_kses_post($f['description']); ?></p>
                            <?php endif; ?>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- RIGHT: AI Assistant Card -->
        <div class="fltc-features-card-wrap" data-aos="fade-left" data-aos-delay="200">

            <!-- Card Header -->
            <div class="fltc-card-header" data-aos="fade-down" data-aos-delay="300">
                <div class="fltc-card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z" />
                    </svg>
                </div>
                <span><?php echo esc_html($card_title); ?></span>
            </div>

            <!-- Command / Response Rows -->
            <?php if ($card_rows) : ?>
                <div class="fltc-card-rows">
                    <?php foreach ($card_rows as $row_index => $row) : ?>

                        <!-- Command -->
                        <div class="fltc-card-row fltc-command"
                             data-aos="fade-left">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z" />
                            </svg>
                            <?php echo esc_html('"' . $row['command_text'] . '"'); ?>
                        </div>

                        <!-- Response -->
                        <div class="fltc-card-row fltc-response"
                             data-aos="fade-left"
                             data-aos-delay="<?php echo esc_attr($row_delay + 60); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                            </svg>
                            <?php echo esc_html($row['response_text']); ?>
                        </div>

                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Footer Stat -->
            <div class="fltc-card-footer" data-aos="zoom-in" data-aos-delay="600">
                <p class="fltc-prod-label"><?php echo esc_html($footer_label); ?></p>
                <p class="fltc-prod-value"><?php echo esc_html($footer_value); ?></p>
                <p class="fltc-prod-sub"><?php echo esc_html($footer_sub); ?></p>
            </div>

        </div><!-- /.fltc-features-card-wrap -->

    </div><!-- /.fltc-content-grid -->

</section><!-- /.features-list-two-columns -->

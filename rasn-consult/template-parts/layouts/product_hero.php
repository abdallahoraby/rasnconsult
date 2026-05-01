<?php
/**
 * Layout: Product Hero
 */

$pills = get_sub_field('pills');
$title = get_sub_field('title');
$description = get_sub_field('description');
$kpis = get_sub_field('kpis');
$buttons = get_sub_field('buttons');
$tiny_text = get_sub_field('tiny_text');
$main_screenshot = get_sub_field('main_screenshot');
$secondary_screenshots = get_sub_field('secondary_screenshots');

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>
<!-- HERO -->
<section class="hero-product" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >
    <div class="container section">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <?php if ($pills): ?>
                <div class="hero-pills-data d-flex align-items-center gap-2 mb-3">
                    <?php foreach ($pills as $pill): ?>
                        <span class="pill"><?php echo esc_html($pill['text']); ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <?php if ($title): ?>
                <h1 class="hero-title-1 display-5 fw-bold lh-1 mb-3">
                    <?php echo wp_kses_post($title); ?>
                </h1>
                <?php endif; ?>

                <?php if ($description): ?>
                <p class="lead muted">
                    <?php echo nl2br(esc_html($description)); ?>
                </p>
                <?php endif; ?>

                <?php if ($kpis): ?>
                <div class="row g-3 mt-4">
                    <?php foreach ($kpis as $kpi): ?>
                    <div class="col-sm-6">
                        <div class="kpi">
                            <div class="d-flex align-items-center gap-3">
                                <?php if ($kpi['icon']): ?>
                                <span class="icon"><?php echo wp_kses_post($kpi['icon']); ?></span>
                                <?php endif; ?>
                                <div>
                                    <div class="fw-bold"><?php echo esc_html($kpi['title']); ?></div>
                                    <div class="tiny muted"><?php echo esc_html($kpi['description']); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <?php if ($buttons): ?>
                <div class="d-flex flex-wrap gap-2 mt-4">
                    <?php foreach ($buttons as $btn): ?>
                        <?php 
                        $link = $btn['link'];
                        if ($link): 
                            $link_url = $link['url'];
                            $link_title = $link['title'] ? $link['title'] : $btn['text'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            $style = $btn['style'];
                        ?>
                            <a class="btn <?php echo esc_attr($style); ?> btn-lg" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                <?php echo esc_html($link_title); ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <?php if ($tiny_text): ?>
                <p class="tiny muted mt-3 mb-0">
                    <?php echo esc_html($tiny_text); ?>
                </p>
                <?php endif; ?>
            </div>

            <div class="col-lg-6">
                <?php if ($main_screenshot): ?>
                <div class="screenshot">
                    <img src="<?php echo esc_url($main_screenshot); ?>" alt="Primary Screenshot">
                </div>
                <?php endif; ?>

                <?php if ($secondary_screenshots): ?>
                <div class="row g-3 mt-3">
                    <?php foreach ($secondary_screenshots as $sec_screen): ?>
                    <div class="col-12">
                        <div class="screenshot">
                            <img src="<?php echo esc_url($sec_screen); ?>" alt="Secondary Screenshot">
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

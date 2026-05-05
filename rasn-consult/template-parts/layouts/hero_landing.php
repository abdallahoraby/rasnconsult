<?php
$eyebrow_data     = get_sub_field('eyebrow_data');
$title       = get_sub_field('title');
$description = get_sub_field('description');
$features    = get_sub_field('features');
$buttons       = get_sub_field('buttons');
$image         = get_sub_field('image');
$show_counters = get_sub_field('show_counters');
$counters      = get_sub_field('counters');
$colors_schema = get_sub_field('colors_schema') ?: 'primary';
$image_width = get_sub_field('hl_image_width');
$img_style = '';
if ($image_width) {
    $img_style = ' style="width: ' . esc_attr($image_width) . '%;"';
}

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;

$show_slider = get_sub_field('show_slider');
$hl_slider = get_sub_field('hl_slider');

$hl_show_app_download = get_sub_field('hl_show_app_download');
$hl_app_download_text = get_sub_field('hl_app_download_text');
$play_store_link = get_sub_field('play_store_link');
$app_store_link = get_sub_field('app_store_link');


?>

<main class="landing-page schema-<?php echo esc_attr($colors_schema); ?>" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >
    <section class="container landing-shell" >

        <div class="row g-0 align-items-center landing-row">
            <div class="col-12 col-lg-6 landing-copy pt-0" data-aos="fade-up">

                <?php if ($eyebrow_data) : ?>
                    <div class="eyebrow-data">
                        <?php foreach ( $eyebrow_data as $eyebrow ): ?>
                            <span class="eyebrow">
                                <span class="eyebrow-dot"></span>
                                <?php echo esc_html($eyebrow['text']); ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ($title) : ?>
                    <h1><?php echo wp_kses_post($title); ?></h1>
                <?php endif; ?>

                <?php if ($description) : ?>
                    <p class="lead"><?php echo wp_kses_post($description); ?></p>
                <?php endif; ?>

                <?php if ($features) : ?>
                    <ul class="feature-list">
                        <?php foreach ($features as $feature) : ?>
                            <li><span class="check-mark">✓</span> <?php echo wp_kses_post($feature['text']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <?php if ($buttons) : ?>
                    <div class="cta-group">
                        <?php foreach ($buttons as $button) : 
                            $btn_link = $button['link'];
                            $btn_text = $button['text'];
                            $open_popup = $button['open_popup'] ?? '';
                            $btn_style = $button['style'];
                            $btn_icon = isset($button['icon']) ? $button['icon'] : '';
                            $btn_url = isset($btn_link['url']) ? $btn_link['url'] : '#';
                            $btn_target = isset($btn_link['target']) && $btn_link['target'] ? $btn_link['target'] : '_self';
                        ?>
                            <a href="<?php echo esc_url($btn_url); ?>" target="<?php echo esc_attr($btn_target); ?>" class="btn <?php echo esc_attr($btn_style); ?> btn-lg <?= $open_popup ?>">
                                <?php echo esc_html($btn_text); ?> <?php if ($btn_icon) echo $btn_icon; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ($show_counters && $counters) : ?>
                    <div class="hero-counters mt-5 d-flex flex-wrap gap-4" data-aos="fade-up" data-aos-delay="100">
                        <?php foreach ($counters as $c) : 
                            $target_val = isset($c['target']) && $c['target'] !== '' ? $c['target'] : '0';
                            $suffix = isset($c['suffix']) ? $c['suffix'] : '';
                            $decimals = isset($c['decimals']) && $c['decimals'] !== '' ? $c['decimals'] : '0';
                            $label = isset($c['label']) ? $c['label'] : '';
                        ?>
                            <div class="counter-item">
                                <h3 class="counter-value hl-counter-value fs-2 fw-bold mb-1" data-target="<?php echo esc_attr($target_val); ?>" data-suffix="<?php echo esc_attr($suffix); ?>" data-decimals="<?php echo esc_attr($decimals); ?>">0<?php echo esc_html($suffix); ?></h3>
                                <p class="counter-label text-muted mb-0 small text-uppercase" style="letter-spacing: 0.5px;"><?php echo esc_html($label); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const containers = document.querySelectorAll('.hero-counters');
                            containers.forEach(container => {
                                if (container.dataset.initialized) return;
                                container.dataset.initialized = 'true';
                                
                                const pCounters = container.querySelectorAll('.hl-counter-value');
                                let animated = false;

                                function animateCounter(el) {
                                    const target = parseFloat(el.dataset.target);
                                    if (isNaN(target)) return;
                                    const suffix = el.dataset.suffix || '';
                                    const decimals = parseInt(el.dataset.decimals || '0', 10);
                                    const duration = 1800;
                                    const startTime = performance.now();

                                    function update(currentTime) {
                                        const elapsed = currentTime - startTime;
                                        const progress = Math.min(elapsed / duration, 1);
                                        const eased = 1 - Math.pow(1 - progress, 3);
                                        const current = eased * target;

                                        el.textContent = current.toFixed(decimals) + suffix;

                                        if (progress < 1) {
                                            requestAnimationFrame(update);
                                        } else {
                                            el.textContent = target.toFixed(decimals) + suffix;
                                        }
                                    }
                                    requestAnimationFrame(update);
                                }

                                const observer = new IntersectionObserver((entries) => {
                                    entries.forEach(entry => {
                                        if (entry.isIntersecting && !animated) {
                                            animated = true;
                                            pCounters.forEach(counter => animateCounter(counter));
                                        }
                                    });
                                }, {threshold: 0.3});

                                observer.observe(container);
                            });
                        });
                    </script>
                <?php endif; ?>

                <?php if($hl_show_app_download): ?>

                    <div class="app-download-wrapper">
                        <span><?= $hl_app_download_text ?></span>
                        <div class="app-download-links mt-3">
                            <?php if($play_store_link): ?>
                                <a href="<?= esc_url($play_store_link['url']) ?>" target="<?= esc_attr($play_store_link['target'] ?: '_self') ?>" class="app-link play-store">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/play-store-badge.png" alt="Download on Play Store" />
                                </a>
                            <?php endif; ?>
                            <?php if($app_store_link): ?>
                                <a href="<?= esc_url($app_store_link['url']) ?>" target="<?= esc_attr($app_store_link['target'] ?: '_self') ?>" class="app-link app-store">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/app-store-badge.png" alt="Download on App Store" />
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php endif; ?>
            </div>

            <div class="col-12 col-lg-6 landing-visual" data-aos="fade-up" data-aos-delay="200">
                <div class="download-frame">
                    <?php if (!$show_slider && $image) : ?>
                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(strip_tags($title)); ?>"  <?php echo $img_style; ?> />
                    <?php endif; ?>

                    <?php if( $show_slider && !empty($hl_slider) ): ?>
                        <div id="hlCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php foreach( $hl_slider as $index => $slide ):
                                    $slide_image = $slide;
                                    $active_class = $index === 0 ? 'active' : '';
                                ?>
                                    <div class="carousel-item <?php echo esc_attr($active_class); ?>">
                                        <img src="<?php echo esc_url($slide_image); ?>" class="d-block w-100" alt="<?php echo esc_attr(strip_tags($title)); ?>" />
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="carousel-indicators">
                                <?php foreach( $hl_slider as $index => $slide ): ?>
                                    <button type="button" data-bs-target="#hlCarousel" data-bs-slide-to="<?php echo esc_attr($index); ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>" aria-current="<?php echo $index === 0 ? 'true' : 'false'; ?>" aria-label="Slide <?php echo esc_attr($index + 1); ?>"></button>
                                <?php endforeach; ?>
                            </div>

                        </div>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>

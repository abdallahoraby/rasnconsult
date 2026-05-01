<?php
$badge           = get_sub_field('badge');
$title           = get_sub_field('title');
$description     = get_sub_field('description');
$features        = get_sub_field('features');

$dashboard_title = get_sub_field('dashboard_title');
$stat_tiles      = get_sub_field('stat_tiles');
$progress_items  = get_sub_field('progress_items');
$alerts          = get_sub_field('alerts');

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>
<section class="features-list-admin container" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >
    <div class="inner-wrapper">

        <!-- LEFT: Executive Dashboard -->
        <div class="dashboard-card col-md-6" data-aos="fade-right">

            <div class="dash-header">
                <span class="dash-title"><?php echo esc_html($dashboard_title ?: 'Executive Dashboard'); ?></span>
                <span class="live-badge">Live</span>
            </div>

            <?php if ($stat_tiles) : ?>
            <div class="stat-tiles">
                <?php foreach ($stat_tiles as $tile) : ?>
                    <div class="stat-tile">
                        <div class="num"><?php echo esc_html($tile['number']); ?></div>
                        <div class="label"><?php echo esc_html($tile['label']); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if ($progress_items) : ?>
            <div class="progress-section">
                <?php foreach ($progress_items as $item) : ?>
                    <div class="progress-item">
                        <div class="progress-meta">
                            <span><?php echo esc_html($item['label']); ?></span>
                            <span class="pct"><?php echo esc_attr($item['percent']); ?>%</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill" style="width: 0%;" data-percent="<?php echo esc_attr($item['percent']); ?>%"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if ($alerts) : ?>
            <div class="alert-tiles">
                <?php foreach ($alerts as $alert) : 
                    $color_class = $alert['color'] ?: 'orange';
                ?>
                    <div class="alert-tile <?php echo esc_attr($color_class); ?>">
                        <div>
                            <div class="alert-num"><?php echo esc_html($alert['number']); ?></div>
                            <div class="alert-label"><?php echo esc_html($alert['label']); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

        </div>

        <!-- RIGHT: Text + Feature List -->
        <div class="right col-md-6" data-aos="fade-left" data-aos-delay="200">
            <?php if ($badge) : ?>
                <span class="badge"><?php echo esc_html($badge); ?></span>
            <?php endif; ?>

            <?php if ($title) : ?>
                <h2 class="heading">
                    <?php echo wp_kses_post($title); ?>
                </h2>
            <?php endif; ?>

            <?php if ($description) : ?>
                <p class="subtext">
                    <?php echo wp_kses_post($description); ?>
                </p>
            <?php endif; ?>

            <?php if ($features) : ?>
                <div class="feature-list">
                    <?php foreach ($features as $index => $f) : 
                        $icon_class = $f['icon_bg_color'] ? 'icon-' . $f['icon_bg_color'] : 'icon-green';
                        $delay = 200 + ($index * 100);
                    ?>
                        <div class="feature-item" data-aos="fade-up" data-aos-delay="<?php echo esc_attr($delay); ?>">
                            <div class="feature-icon <?php echo esc_attr($icon_class); ?>">
                                <?php if ($f['icon']) echo $f['icon']; else echo '<i class="fa-solid fa-arrow-right"></i>'; ?>
                            </div>
                            <div class="feature-text">
                                <h4><?php echo esc_html($f['title']); ?></h4>
                                <p><?php echo wp_kses_post($f['description']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const bars = entry.target.querySelectorAll('.progress-fill');
                    bars.forEach(bar => {
                        const w = bar.getAttribute('data-percent');
                        bar.style.transition = 'width 1.5s cubic-bezier(0.4, 0, 0.2, 1)';
                        bar.style.width = w;
                    });
                    observer.unobserve(entry.target);
                }
            });
        }, {threshold: 0.3});

        const sections = document.querySelectorAll('.features-list-admin');
        sections.forEach(s => observer.observe(s));
    });
</script>

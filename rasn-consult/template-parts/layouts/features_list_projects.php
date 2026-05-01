<?php
$badge              = get_sub_field('badge');
$title              = get_sub_field('title');
$description        = get_sub_field('description');
$features           = get_sub_field('features');

$summary_card_title = get_sub_field('summary_card_title');
$summary_card_date  = get_sub_field('summary_card_date');
$actual_hours       = get_sub_field('actual_hours');
$expected_hours     = get_sub_field('expected_hours');
$overtime_note      = get_sub_field('overtime_note');

$projects_title     = get_sub_field('projects_title');
$projects           = get_sub_field('projects');

// Calculate percentage for progress bar
$percent = 0;
if ($expected_hours > 0 && $actual_hours > 0) {
    if ($actual_hours > $expected_hours) {
        $percent = 100;
    } else {
        $percent = ($actual_hours / $expected_hours) * 100;
    }
}

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>
<section class="features-list-projects"  id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >
    <div class="inner container">

        <!-- LEFT: Text + Feature List -->
        <div class="left" data-aos="fade-right">
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
                        $delay = 100 + ($index * 100);
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

        <!-- RIGHT: Dashboard Cards -->
        <div class="right" data-aos="fade-left" data-aos-delay="200">

            <!-- Monthly Summary -->
            <div class="dashboard-card">
                <div class="card-header">
                    <span class="card-title"><?php echo esc_html($summary_card_title ?: 'Monthly Summary'); ?></span>
                    <span class="card-date"><?php echo esc_html($summary_card_date); ?></span>
                </div>

                <div class="stat-row">
                    <span class="stat-label">Actual Hours</span>
                    <span class="stat-value"><?php echo esc_html($actual_hours ?: '0'); ?></span>
                </div>

                <div class="progress-bar-track">
                    <div class="progress-bar-fill" style="width: 0%;" data-percent="<?php echo esc_attr($percent); ?>%"></div>
                </div>

                <div class="stat-row" style="margin-bottom: 12px;">
                    <span class="stat-label">Expected Hours</span>
                    <span class="stat-value" style="font-size:18px; color:#999;"><?php echo esc_html($expected_hours ?: '0'); ?></span>
                </div>

                <?php if ($overtime_note) : ?>
                <div class="overtime-note">
                    <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                    <?php echo wp_kses_post($overtime_note); ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Active Projects -->
            <div class="dashboard-card">
                <p class="projects-title"><?php echo esc_html($projects_title ?: 'Active Projects'); ?></p>
                <?php if ($projects) : ?>
                    <?php foreach ($projects as $index => $p) : 
                        $proj_delay = 300 + ($index * 100);
                    ?>
                        <div class="project-row" data-aos="fade-up" data-aos-delay="<?php echo esc_attr($proj_delay); ?>">
                            <span class="project-name"><?php echo esc_html($p['name']); ?></span>
                            <span class="project-hours"><?php echo esc_html($p['hours']); ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>

    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const bars = entry.target.querySelectorAll('.progress-bar-fill');
                    bars.forEach(bar => {
                        const w = bar.getAttribute('data-percent');
                        bar.style.transition = 'width 1.5s cubic-bezier(0.4, 0, 0.2, 1)';
                        bar.style.width = w;
                    });
                    observer.unobserve(entry.target);
                }
            });
        }, {threshold: 0.3});

        const sections = document.querySelectorAll('.features-list-projects');
        sections.forEach(s => observer.observe(s));
    });
</script>

<?php
$badge = get_sub_field('badge');
$title = get_sub_field('title');
$description = get_sub_field('description');
$counters = get_sub_field('counters');
$btn_text = get_sub_field('btn_text');
$btn_link = get_sub_field('btn_link');
$btn_icon = get_sub_field('btn_icon');

$url = isset($btn_link['url']) ? $btn_link['url'] : '#';
$target = isset($btn_link['target']) && $btn_link['target'] ? $btn_link['target'] : '_self';

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>

<section class="cta-counters-section" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >
    <div class="cta-inner" data-aos="fade-up">

        <?php if ($badge) : ?>
            <span class="badge"><?php echo esc_html($badge); ?></span>
        <?php endif; ?>

        <?php if ($title) : ?>
            <h2 class="cta-title"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>

        <?php if ($description) : ?>
            <p class="cta-description">
                <?php echo str_replace(array("\r\n", "\r", "\n"), '<br/>', esc_html($description)); ?>
            </p>
        <?php endif; ?>

        <?php if ($counters) : ?>
            <div class="counters" data-aos="fade-up" data-aos-delay="200">
                <?php foreach ($counters as $c) : 
                    $target_val = isset($c['target']) && $c['target'] !== '' ? $c['target'] : '0';
                    $suffix = isset($c['suffix']) ? $c['suffix'] : '';
                    $decimals = isset($c['decimals']) && $c['decimals'] !== '' ? $c['decimals'] : '0';
                    $label = isset($c['label']) ? $c['label'] : '';
                ?>
                    <div class="counter-item">
                        <span class="counter-value" data-target="<?php echo esc_attr($target_val); ?>" data-suffix="<?php echo esc_attr($suffix); ?>" data-decimals="<?php echo esc_attr($decimals); ?>">0<?php echo esc_html($suffix); ?></span>
                        <p class="counter-label"><?php echo esc_html($label); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($btn_text || $btn_icon) : ?>
            <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>" class="cta-button">
                <?php echo esc_html($btn_text); ?>
                <?php if ($btn_icon) echo $btn_icon; ?>
            </a>
        <?php endif; ?>

    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function animateCounter(el) {
            const target = parseFloat(el.dataset.target);
            if (isNaN(target)) return;
            const suffix = el.dataset.suffix || '';
            const decimals = parseInt(el.dataset.decimals || '0', 10);
            const duration = 1800;
            const startTime = performance.now();

            el.classList.add('animated');

            function update(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                // Ease out cubic
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

        const countersContainer = document.querySelector('.counters');
        if (!countersContainer) return;

        const counters = document.querySelectorAll('.counter-value');
        let animated = false;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !animated) {
                    animated = true;
                    counters.forEach(counter => animateCounter(counter));
                }
            });
        }, {threshold: 0.3});

        observer.observe(countersContainer);
    });
</script>

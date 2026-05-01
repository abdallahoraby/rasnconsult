<?php
/**
 * Layout: Product Features Grid
 */

$section_title = get_sub_field('section_title');
$section_description = get_sub_field('section_description');
$features = get_sub_field('features');

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>
<!-- FEATURES -->
<section class="product-features section bg-soft anchor" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >
    <div class="container">
        
        <?php if ($section_title || $section_description): ?>
        <div class="row mb-4">
            <div class="col-lg-8">
                <?php if ($section_title): ?>
                <h2 class="features-heading fw-bold"><?php echo esc_html($section_title); ?></h2>
                <?php endif; ?>
                
                <?php if ($section_description): ?>
                <p class="muted">
                    <?php echo nl2br(esc_html($section_description)); ?>
                </p>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($features): ?>
        <div class="row g-4">
            <?php foreach ($features as $feature): ?>
            <div class="col-md-6 col-lg-4">
                <div class="feature-card-list">
                    <div class="d-flex gap-3">
                        <?php if ($feature['icon']): ?>
                        <span class="icon"><?php echo wp_kses_post($feature['icon']); ?></span>
                        <?php endif; ?>
                        <div>
                            <h5 class="fw-bold mb-1"><?php echo esc_html($feature['title']); ?></h5>
                            <p class="muted mb-0"><?php echo nl2br(esc_html($feature['description'])); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php
/**
 * Layout: Info List
 */

$title = get_sub_field('title');
$description = get_sub_field('description');
$list_items = get_sub_field('list_items');

$feature_icon = get_sub_field('feature_icon');
$feature_title = get_sub_field('feature_title');
$feature_description = get_sub_field('feature_description');

$kpis = get_sub_field('kpis');

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>
<!-- INFO LIST -->
<section class="section anchor px-5" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <?php if ($title): ?>
                <h2 class="info-list-heading fw-bold"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                
                <?php if ($description): ?>
                <p class="muted">
                    <?php echo nl2br(esc_html($description)); ?>
                </p>
                <?php endif; ?>
                
                <?php if ($list_items): ?>
                <ul class="list-unstyled list-check">
                    <?php foreach ($list_items as $item): ?>
                    <li><?php echo wp_kses_post($item['text']); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
            
            <div class="col-lg-6">
                <?php if ($feature_title || $feature_description || $feature_icon): ?>
                <div class="feature-card-list">
                    <div class="d-flex align-items-start gap-3">
                        <?php if ($feature_icon): ?>
                        <span class="icon"><?php echo wp_kses_post($feature_icon); ?></span>
                        <?php endif; ?>
                        <div>
                            <?php if ($feature_title): ?>
                            <h5 class="fw-bold mb-2"><?php echo esc_html($feature_title); ?></h5>
                            <?php endif; ?>
                            
                            <?php if ($feature_description): ?>
                            <p class="muted mb-0">
                                <?php echo nl2br(esc_html($feature_description)); ?>
                            </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($kpis): ?>
                <div class="row g-3 mt-3">
                    <?php foreach ($kpis as $kpi): ?>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="kpi">
                            <div class="fw-bold"><?php echo esc_html($kpi['title']); ?></div>
                            <div class="tiny muted"><?php echo esc_html($kpi['description']); ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

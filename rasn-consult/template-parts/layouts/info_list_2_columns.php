<?php
/**
 * Layout: Info List 2 Columns
 */

$section_title = get_sub_field('section_title');
$section_description = get_sub_field('section_description');
$columns = get_sub_field('columns');

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>
<!-- INFO LIST 2 COLUMNS -->
<section class="section bg-soft anchor px-5" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >
    <div class="container">
        
        <?php if ($section_title || $section_description): ?>
        <div class="row mb-4">
            <div class="col-lg-8">
                <?php if ($section_title): ?>
                <h2 class="info-list-heading fw-bold"><?php echo esc_html($section_title); ?></h2>
                <?php endif; ?>
                
                <?php if ($section_description): ?>
                <p class="muted">
                    <?php echo nl2br(esc_html($section_description)); ?>
                </p>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($columns): ?>
        <div class="row g-4">
            <?php foreach ($columns as $column): ?>
            <div class="col-lg-6">
                <div class="feature-card-list">
                    <?php if ($column['title']): ?>
                    <h5 class="fw-bold mb-3"><?php echo esc_html($column['title']); ?></h5>
                    <?php endif; ?>
                    
                    <?php if ($column['list_items']): ?>
                    <ul class="list-unstyled list-check mb-0">
                        <?php foreach ($column['list_items'] as $item): ?>
                        <li><?php echo wp_kses_post($item['text']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div>
</section>

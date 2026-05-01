<?php
/**
 * Layout: Info Bills
 */

$title = get_sub_field('title');
$description = get_sub_field('description');
$bills = get_sub_field('bills');

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>
<!-- TRUST / VALUE (INFO BILLS) -->
<section class="section-sm px-5" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-7">
                <?php if ($title): ?>
                <h2 class="info-bills-title fw-bold mb-2"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                
                <?php if ($description): ?>
                <p class="muted mb-0">
                    <?php echo nl2br(esc_html($description)); ?>
                </p>
                <?php endif; ?>
            </div>
            
            <?php if ($bills): ?>
            <div class="col-lg-5">
                <div class="d-flex flex-wrap gap-2 justify-content-lg-end">
                    <?php foreach ($bills as $bill): ?>
                    <span class="pill"><?php echo esc_html($bill['text']); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

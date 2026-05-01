<?php
/**
 * Layout: Icon Box
 * Description: A section with a title, description, list of items, and a feature card with an icon, title, description, and KPIs.
 */

$title = get_sub_field('title');
$description = get_sub_field('description');
$show_number = get_sub_field('show_number');
$list_items = get_sub_field('list_items');
$icon_background_color = get_sub_field('icon_background_color');
$icon_color = get_sub_field('icon_color');


$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>
<!-- Icon Box -->
<section class="section-icon-box" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-12">
                <?php if ($title): ?>
                    <h2 class="info-list-heading fw-bold text-center" data-aos="fade-down"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                
                <?php if ($description): ?>
                    <p class="muted text-center" data-aos="fade-down">
                        <?php echo nl2br(esc_html($description)); ?>
                    </p>
                <?php endif; ?>
                
                <?php if ($list_items): ?>
                    <ul class="icon-box-wrapper list-unstyled">
                        <?php foreach ($list_items as $index => $item): ?>
                            <li class="d-flex align-items-start mb-3" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
                                <?php if ($show_number): ?>
                                    <span class="number me-3">0<?= $index + 1 ?></span>
                                <?php endif; ?>

                                <?php if( !empty($item['icon']) ): ?>
                                    <div class="icon-data" style="color: <?= $icon_color ?>; background-color: <?= $icon_background_color ?>">
                                        <?= $item['icon'] ?>
                                    </div>
                                <?php endif; ?>

                                <h5 class="mb-1"><?php echo esc_html($item['title']); ?></h5>

                                <p class="mb-0 muted"><?php echo esc_html($item['description']); ?></p>

                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>

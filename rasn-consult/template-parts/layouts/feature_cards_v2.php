<?php
$badge = get_sub_field('badge');
$pre_title = get_sub_field('pre_title');
$main_title = get_sub_field('main_title');
$subtitle = get_sub_field('subtitle');
$features = get_sub_field('features');
$colors_schema = get_sub_field('colors_schema') ?: 'primary';
$features_columns = get_sub_field('features_columns') ?: 3;


$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>
<section class="section feature-cards-v2 schema-<?php echo esc_attr($colors_schema); ?>" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?>>
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <?php if ($badge) : ?>
                <span class="badge"><?php echo esc_html($badge); ?></span>
            <?php endif; ?>

            <?php if ($pre_title) : ?>
                <p class="section-title"><?php echo esc_html($pre_title); ?></p>
            <?php endif; ?>

            <?php if ($main_title) : ?>
                <h2 class="section-title-main"><?php echo esc_html($main_title); ?></h2>
            <?php endif; ?>

            <?php if ($subtitle) : ?>
                <p class="section-subtitle"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
        </div>

        <?php if ($features) : ?>
        <div class="features-grid" style="grid-template-columns: repeat(<?php echo esc_attr($features_columns); ?>, 1fr);">
            <?php $delay = 0; ?>
            <?php foreach ($features as $key=>$feature) : ?>
                <?php
                    if( $colors_schema === 'secondary' ):
                        // check if key is odd, color is green
                        // if key is even, color is orange
                        if($key % 2 == 0):
                            $icon_bg = '#D0FAE5';
                        else:
                            $icon_bg = '#FEF3C6';
                        endif;
                    elseif( $colors_schema === 'third' ):
                        $icon_bg = '#FEF2F2';
                    else:
                        $icon_bg = '';
                    endif;
                ?>
                <div class="feature-card-list" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                    <?php $icon_image_switch = $feature['icon_image_switch']; ?>
                    <?php $delay += 100; ?>
                    <div class="icon-wrapper" style="background: <?= $icon_bg ?>">
                        <?php if ($feature['icon'] && !$icon_image_switch ) : ?>
                            <?php echo $feature['icon']; ?>
                        <?php elseif ( $feature['fcv2_image'] && $icon_image_switch ): ?>
                            <img src="<?= $feature['fcv2_image'] ?>" alt="">
                        <?php endif; ?>
                    </div>
                        
                    <?php if ($feature['title']) : ?>
                        <h3 class="feature-title"><?php echo esc_html($feature['title']); ?></h3>
                    <?php endif; ?>
                    
                    <?php if ($feature['description']) : ?>
                        <p class="feature-description"><?php echo esc_html($feature['description']); ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    </div>
</section>

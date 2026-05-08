<?php
/**
 * Layout: Clients V2 Section
 */

$title = get_sub_field('title');
$description = get_sub_field('description');

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;

$inner_section_style = '';
$inner_background_color = get_sub_field('inner_background_color');
if( $inner_background_color ):
    $inner_section_style .= ' style="background: ' . esc_attr($inner_background_color) . ';"';
endif;


$logos = get_sub_field('logos');
$stats = get_sub_field('stats');

?>

<section class="our-clients py-5" <?= $section_style ?>>
    <div class="container p-0">
        <div class="our-clients__panel" <?= $inner_section_style ?> >
            <div class="text-center mb-4">
                <?php if($title): ?>
                <h2 class="our-clients__title fw-bold mb-3"><?= $title ?></h2>
                <?php endif; ?>

                <?php if($description): ?>
                <p class="our-clients__lead mb-1">
                    <?= $description ?>
                </p>
                <?php endif; ?>
            </div>

            <?php if( !empty($stats) ): ?>
                <div class="row g-3 g-md-4 mb-5">
                    <?php foreach ($stats as $stat): ?>
                        <div class="col-12 col-md-4">
                            <div class="our-clients__stat rounded-4 h-100 d-flex align-items-center justify-content-center text-center px-4 py-4">
                                <?= $stat['stat_text'] ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if( !empty($logos) ): ?>
            <div class="row align-items-center justify-content-center our-clients__logos">
                <?php foreach ( $logos as $logo ): ?>
                    <img src="<?= esc_url($logo) ?>" alt="" class="img-fluid" />
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>



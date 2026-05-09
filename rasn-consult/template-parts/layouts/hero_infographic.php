<?php

$title = get_sub_field('title');
$description = get_sub_field('description');
$hi_background_image = get_sub_field('hi_background_image');
$buttons = get_sub_field('buttons');
$sub_title = get_sub_field('sub_title');
$right_title = get_sub_field('right_title');
$info_tabs = get_sub_field('info_tabs');
$right_decription = get_sub_field('right_decription');
$right_buttons = get_sub_field('right_buttons');
$info_counters = get_sub_field('info_counters');
$hi_bottom_image = get_sub_field('hi_bottom_image');
$info_counters = get_sub_field('info_counters');


$section_style = '';
if( $hi_background_image ):
    $section_style .= ' style="background-image: url(' . $hi_background_image . ');"';
endif;



?>

<section class="hero-infographic">
    <div class="hero-info-wrapper container-fluid" <?= $section_style ?>>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center">
                    <div class="left-tab d-flex flex-column gap-4 justify-content-center">
                        <?= wp_kses_post($title) ?>
                        <p><?= $description ?></p>

                        <?php if ($buttons): ?>
                            <div class="d-flex flex-wrap gap-2">
                                <?php foreach ($buttons as $btn): ?>
                                    <?php
                                    $link = $btn['link'];
                                    if ($link):
                                        $link_url = $link['url'];
                                        $link_title = $link['title'] ? $link['title'] : $btn['text'];
                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                        $style = $btn['style'];
                                        ?>
                                        <a class="btn <?php echo esc_attr($style); ?> btn-lg" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                            <?= $btn['text'] ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="right-tab">
                        <div class="right-tab-wrapper">
                            <?php if($sub_title): ?>
                                <div class="sutitle"><?= $sub_title ?></div>
                            <?php endif; ?>

                            <?php if($right_title): ?>
                                <h4><?= $right_title ?></h4>
                            <?php endif; ?>

                            <?php if( !empty($info_tabs) ): ?>
                                <div class="tabs-data">
                                    <?php foreach ($info_tabs as $info_tab): ?>
                                        <div class="tab"> <?= $info_tab['tab_text'] ?> </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <?php if($right_decription): ?>
                                <p><?= $right_decription ?></p>
                            <?php endif; ?>

                            <?php if ($right_buttons): ?>
                                <div class="d-flex flex-wrap gap-2">
                                    <?php foreach ($right_buttons as $btn): ?>
                                        <?php
                                        $link = $btn['link'];
                                        if ($link):
                                            $link_url = $link['url'];
                                            $link_title = $link['title'] ? $link['title'] : $btn['text'];
                                            $link_target = $link['target'] ? $link['target'] : '_self';
                                            $style = $btn['style'];
                                            ?>
                                            <a class="btn <?php echo esc_attr($style); ?> btn-lg" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                                <?= $btn['text'] ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-counters-wrapper">
        <div class="has-wavy-circle"></div>
        <div class="container pt-5 pb-5">
            <div class="row">
                <div class="col-ld-6 col-md-6 col-sm-12 col-xs-12">
                    <?php if( $hi_bottom_image ): ?>
                        <img src="<?= $hi_bottom_image ?>" alt="">
                    <?php endif; ?>
                </div>

                <div class="col-ld-6 col-md-6 col-sm-12 col-xs-12">
                    <?php if(!empty($info_counters)): ?>
                        <div class="counters-grid">
                            <?php foreach ($info_counters as $counter): ?>
                                <div class="counter-card">
                                    <strong><?= $counter['hi_info_counter_number'] ?><?= $counter['hi_info_counter_suffix'] ?></strong>
                                    <span> <?= $counter['hi_info_counter_text'] ?> </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</section>
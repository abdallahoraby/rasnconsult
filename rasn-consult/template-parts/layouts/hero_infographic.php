<?php

    $title = get_sub_field('title');
    $description = get_sub_field('description');
    $hi_background_image = get_sub_field('hi_background_image');
    $buttons = get_sub_field('buttons');

    $section_style = '';
    if( $hi_background_image ):
        $section_style .= ' style="background-image: url(' . $hi_background_image . ');"';
    endif;

?>

<section class="hero-infographic">
    <div class="hero-info-wrapper container-fluid" <?= $section_style ?>>
        <div class="row">
            <div class="left-tab col-lg-6 col-md-6 col-sm-12 col-xs-12 gap-4 d-flex flex-column">
                <?= wp_kses_post($title) ?>
                <p><?= $description ?></p>
                <?php if ($buttons): ?>
                    <div class="d-flex flex-wrap gap-2 mt-4">
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
                                    <?php echo esc_html($link_title); ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="right-tab col-lg-6 col-md-6 col-sm-12 col-xs-12 gap-4 d-flex flex-column">
                <div class="right-tab-wrapper">
                    <div class="subtitle">TECHNOLOGY SERVICES</div>
                    <h4>Streamline and Scale Your Business</h4>
                    <div class="tabs-data">
                        <div class="tab"> Digital Agencies </div>
                        <div class="tab"> Software Companies </div>
                        <div class="tab"> Innovators Ready to Scale </div>
                    </div>
                    <p>
                        At RASN Consult, we specialize in creating tailored technology solutions that help businesses
                        compete and thrive in a digital world. With a team of highly skilled developers, engineers,
                        and strategic consultants, we deliver robust, scalable, and user-centric products that accelerate
                        growth and improve operational efficiency.
                    </p>
                    <a class="btn btn-primary-v2 btn-lg" href="#" target="_self"> Get Started! </a>
                </div>
            </div>

        </div>
    </div>
</section>
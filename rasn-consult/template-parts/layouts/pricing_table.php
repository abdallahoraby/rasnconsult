<?php
$title = get_sub_field('section_title');
$subtitle = get_sub_field('section_subtitle');
$cards = get_sub_field('pricing_cards');

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;

$card_color_style = get_sub_field('card_color_style') ?? '';

?>

<section class="section-pricing-table container card-style-<?= $card_color_style ?>" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >
    <div class="section-header" data-aos="fade-up">
        <?php if ($title) : ?>
            <h2 class="section-title"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>
        <?php if ($subtitle) : ?>
            <p class="section-subtitle"><?php echo str_replace(array("\r\n", "\r", "\n"), '<br/>', esc_html($subtitle)); ?></p>
        <?php endif; ?>
    </div>

    <?php if ($cards) : ?>
        <div class="pricing-grid">
            <?php $delay = 0; ?>
            <?php foreach ($cards as $card) : 
                $type = isset($card['card_type']) ? $card['card_type'] : 'standard';
                $classes = ['pricing-card'];
                if ($type !== 'standard') {
                    $classes[] = $type;
                }
                
                $badge = isset($card['badge_text']) ? $card['badge_text'] : '';
                $icon_url = isset($card['card_svg']) ? $card['card_svg'] : '';
                $tier = isset($card['user_tier']) ? $card['user_tier'] : '';
                
                $price = isset($card['price_amount']) ? $card['price_amount'] : '';
                $unit = isset($card['price_unit']) ? $card['price_unit'] : '';
                
                $talk = isset($card['price_talk']) ? $card['price_talk'] : '';
                $custom = isset($card['price_custom']) ? $card['price_custom'] : '';
                
                $features = isset($card['features']) ? $card['features'] : [];
                
                $btn_text = isset($card['btn_text']) ? $card['btn_text'] : '';
                $btn_link = isset($card['btn_link']) ? $card['btn_link'] : false;
                $btn_icon = isset($card['btn_icon']) ? $card['btn_icon'] : '';

                $url = isset($btn_link['url']) ? $btn_link['url'] : '#';
                $target = isset($btn_link['target']) && $btn_link['target'] ? $btn_link['target'] : '_self';
            ?>
            <div class="<?php echo esc_attr(implode(' ', $classes)); ?>" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                <?php $delay += 150; ?>
                <?php if ($type === 'popular' && $badge !== '') : ?>
                    <div class="popular-badge"><?php echo esc_html($badge); ?></div>
                <?php endif; ?>

                <?php if ($icon_url) : ?>
                    <div class="card-icon">
                        <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($tier); ?>" style="width: 28px; height: 28px; object-fit: contain;">
                    </div>
                <?php endif; ?>

                <?php if ($tier) : ?>
                    <p class="user-tier"><?php echo esc_html($tier); ?></p>
                <?php endif; ?>

                <?php if ($type === 'enterprise') : ?>
                    <?php if ($talk) : ?>
                        <p class="price-talk"><?php echo esc_html($talk); ?></p>
                    <?php endif; ?>
                    <?php if ($custom) : ?>
                        <p class="price-custom"><?php echo esc_html($custom); ?></p>
                    <?php endif; ?>
                <?php else : ?>
                    <div class="price-row">
                        <span class="price-amount"><?php echo esc_html($price); ?></span>
                        <span class="price-unit"><?php echo esc_html($unit); ?></span>
                    </div>
                <?php endif; ?>

                <?php if ($features) : ?>
                    <ul class="feature-list">
                        <?php foreach ($features as $feature) : ?>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                                </svg>
                                <?php echo esc_html($feature['feature_text']); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <?php if ($btn_text || $btn_icon) : ?>
                    <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>" class="card-btn">
                        <?php echo esc_html($btn_text); ?>
                        <?php if ($btn_icon) echo $btn_icon; ?>
                    </a>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

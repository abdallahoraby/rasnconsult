<?php
// Layout: Feature Table
$badge_icon   = get_sub_field('badge_icon');
$badge        = get_sub_field('badge');
$title        = get_sub_field('title');
$subtitle     = get_sub_field('subtitle');
$cards        = get_sub_field('cards');

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>

<section class="feature-table container" data-aos="fade-up" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >

    <!-- Header -->
    <div class="section-header" data-aos="fade-up" data-aos-delay="100">
        <?php if ( $badge ) : ?>
            <span class="badge">
                <?php if ( $badge_icon ) : ?>
                    <i class="<?php echo esc_attr($badge_icon); ?>" style="margin-right:6px;"></i>
                <?php endif; ?>
                <?php echo esc_html($badge); ?>
            </span>
        <?php endif; ?>

        <?php if ( $title ) : ?>
            <h2 class="section-title"><?php echo wp_kses_post($title); ?></h2>
        <?php endif; ?>

        <?php if ( $subtitle ) : ?>
            <p class="section-subtitle">
                <?php echo wp_kses_post($subtitle); ?>
            </p>
        <?php endif; ?>
    </div>

    <!-- Cards -->
    <?php if ( $cards ) : ?>
        <div class="cards-grid">
            <?php
            $delay = 200;
            foreach ( $cards as $card ) :
                $c_icon       = $card['icon'];
                $c_icon_color = $card['icon_color'];
                $c_title      = $card['title'];
                $c_desc       = $card['description'];
                $c_type       = $card['card_type'];
            ?>
                <div class="card" data-aos="zoom-in" data-aos-delay="<?php echo esc_attr($delay); ?>">
                    <?php if ( $c_icon ) : ?>
                        <div class="card-icon <?php echo esc_attr($c_icon_color); ?>">
                            <i class="<?php echo esc_attr($c_icon); ?>"></i>
                        </div>
                    <?php endif; ?>

                    <?php if ( $c_title ) : ?>
                        <h3 class="card-title"><?php echo esc_html($c_title); ?></h3>
                    <?php endif; ?>

                    <?php if ( $c_desc ) : ?>
                        <p class="card-desc"><?php echo wp_kses_post($c_desc); ?></p>
                    <?php endif; ?>

                    <?php
                    // Balance Tracker Rows
                    if ( $c_type === 'balance_rows' && !empty($card['balance_rows']) ) :
                    ?>
                        <div class="balance-rows">
                            <?php foreach ( $card['balance_rows'] as $r ) : ?>
                                <div class="balance-row">
                                    <span class="balance-label"><?php echo esc_html($r['label']); ?></span>
                                    <span class="balance-badge <?php echo esc_attr($r['color']); ?>"><?php echo esc_html($r['value']); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php
                    // Team Availability List
                    elseif ( $c_type === 'team_list' && !empty($card['team_list']) ) :
                    ?>
                        <div class="team-list">
                            <?php foreach ( $card['team_list'] as $m ) : ?>
                                <div class="team-member">
                                    <div class="avatar <?php echo esc_attr($m['avatar_color']); ?>"><?php echo esc_html($m['initials']); ?></div>
                                    <div class="member-info">
                                        <div class="name"><?php echo esc_html($m['name']); ?></div>
                                        <div class="dates"><i class="fa-regular fa-calendar" style="margin-right:4px;"></i><?php echo esc_html($m['dates']); ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php
                    // Holiday Forecaster
                    elseif ( $c_type === 'holiday_list' && !empty($card['holiday_list']) ) :
                    ?>
                        <div class="holiday-list">
                            <?php foreach ( $card['holiday_list'] as $h ) : ?>
                                <div class="holiday-row <?php echo esc_attr($h['color']); ?>">
                                    <?php if ( $h['icon'] ) : ?>
                                        <i class="<?php echo esc_attr($h['icon']); ?>"></i>
                                    <?php endif; ?>
                                    <div>
                                        <div class="holiday-name"><?php echo esc_html($h['name']); ?></div>
                                        <div class="holiday-date"><?php echo esc_html($h['date']); ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php
                $delay += 100;
            endforeach;
            ?>
        </div>
    <?php endif; ?>

</section>

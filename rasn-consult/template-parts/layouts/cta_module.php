<?php
$title          = get_sub_field('cta_title');
$description    = get_sub_field('cta_description');
$btn_text       = get_sub_field('btn_text');
$btn_link       = get_sub_field('btn_link');
$btn_icon       = get_sub_field('btn_icon');
$cta_bg_color    = get_sub_field('background_color');
$btn_bg_color    = get_sub_field('btn_bg_color');
$btn_text_color  = get_sub_field('btn_text_color');
$cta_title_color = get_sub_field('field_cta_title_color');
$cta_desc_color  = get_sub_field('field_cta_desc_color');
$bg_image  = get_sub_field('image');


$url    = isset($btn_link['url']) ? $btn_link['url'] : '#';
$target = isset($btn_link['target']) && $btn_link['target'] ? $btn_link['target'] : '_self';

// Section background style
$section_style = '';
$sanitized_cta_bg = sanitize_hex_color($cta_bg_color);

if ( !empty($bg_image) ){
    $section_style .= ' style="background-image: url('. $bg_image .')' . '; background-color: #00000085; background-blend-mode: multiply; background-position: center; background-size: cover; background-repeat: no-repeat;';
}else if ($sanitized_cta_bg && !$bg_image) {
    $section_style .= ' style="background: ' . esc_attr($sanitized_cta_bg) . ';';
}

$cta_border_radius = get_sub_field('cta_border_radius');
if( $cta_border_radius ):
    $section_style .= ' border-radius: ' . esc_attr($cta_border_radius) . 'px; margin: 2rem auto;';
endif;




// Button inline styles
$btn_style  = '';
$btn_styles = array();
$sanitized_btn_bg   = $btn_bg_color;
$sanitized_btn_text = sanitize_hex_color($btn_text_color);
if ($sanitized_btn_bg) {
    $btn_styles[] = 'background: ' . $sanitized_btn_bg . ';';
}
if ($sanitized_btn_text) {
    $btn_styles[] = 'color: ' . $sanitized_btn_text . ';';
}
if ($btn_styles) {
    $btn_style = ' style="' . esc_attr(implode(' ', $btn_styles)) . '"';
}

// Title inline style
$title_style = '';
$sanitized_title_color = sanitize_hex_color($cta_title_color);
if ($sanitized_title_color) {
    $title_style = ' style="color: ' . esc_attr($sanitized_title_color) . ';"';
}

// Description inline style
$desc_style = '';
$sanitized_desc_color = sanitize_hex_color($cta_desc_color);
if ($sanitized_desc_color) {
    $desc_style = ' style="color: ' . esc_attr($sanitized_desc_color) . ';"';
}


?>

<section class="cta-section container" <?php echo $section_style; ?> id="<?= get_sub_field('section_id') ?? '' ?>" >
    <div class="cta-inner" data-aos="fade-up">
        <?php if ($title) : ?>
            <h2 class="cta-title"<?php echo $title_style; ?>><?php echo wp_kses_post($title); ?></h2>
        <?php endif; ?>

        <?php if ($description) : ?>
            <p class="cta-description"<?php echo $desc_style; ?>>
                <?php echo wp_kses_post($description); ?>
            </p>
        <?php endif; ?>

        <?php if ($btn_text || $btn_icon) : ?>
            <a href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>" class="cta-button"<?php echo $btn_style; ?>>
                <?php echo esc_html($btn_text); ?>
                <?php if ($btn_icon) echo $btn_icon; ?>
            </a>
        <?php endif; ?>
    </div>
</section>

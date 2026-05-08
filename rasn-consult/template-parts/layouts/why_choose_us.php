<?php
/**
 * Layout: Why Choose Section
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

$why_choose_images = get_sub_field('why_choose_images');

?>

<section class="why-choose py-5" <?= $section_style ?> >
    <div class="container">
        <div class="why-choose__panel rounded-4 px-3 px-md-5 py-5 position-relative overflow-hidden" <?= $inner_section_style ?> >
            <div class="row justify-content-center text-center position-relative">
                <div class="col-lg-9">
                    <?php if(!empty($title)): ?>
                        <h2 class="why-choose__title fw-bold mb-3">
                            <?= $title ?>
                        </h2>
                    <?php endif; ?>

                    <?php if(!empty($description)): ?>
                        <p class="why-choose__lead text-secondary mb-4">
                            <?= $description ?>
                        </p>
                    <?php endif; ?>


                    <?php if ( get_sub_field('buttons') ) : ?>
                        <div class="d-flex flex-wrap justify-content-center gap-3 mb-5">
                            <?php foreach ( get_sub_field('buttons') as $button ) :
                                $link = $button['link'];
                                if ( $link ) :
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                    ?>
                                    <a class="btn <?= $button['style'] ?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                        <?= $button['text'] ?>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <?php if( !empty($why_choose_images) ): ?>
            <div class="choose-us-images">
                    <div class="row g-4">
                    <?php foreach ( $why_choose_images as $why_choose_image ): ?>
                        <div class="col-md-4">
                            <figure class="why-choose__card rounded-4 overflow-hidden m-0 shadow-sm">
                                <img
                                    src="<?= $why_choose_image['url'] ?>"
                                    alt="<?= $why_choose_image['alt'] ?>"
                                    class="img-fluid"
                                />
                            </figure>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php
/**
 * Layout: Contact Us V2
 */

$title = get_sub_field('title');
$description = get_sub_field('description');
$form_shortcode = get_sub_field('form_shortcode');
$tiny_text = get_sub_field('tiny_text');

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>
<!-- CTA / CONTACT -->
<section class="section bg-soft anchor px-5" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?>>
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <?php if ($title): ?>
                <h2 class="contact-form-heading fw-bold mb-2"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                
                <?php if ($description): ?>
                <p class="muted mb-0">
                    <?php echo nl2br(esc_html($description)); ?>
                </p>
                <?php endif; ?>
            </div>
            
            <div class="col-lg-5">
                <div class="feature-card-list">
                    <?php 
                    if ($form_shortcode): 
                        echo do_shortcode($form_shortcode);
                    else: 
                    ?>
                        <!-- Fallback Form Output if shortcode not provided -->
                        <form>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Company Name</label>
                                <input type="text" class="form-control" placeholder="e.g., Pro Travel International">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control" placeholder="name@company.com">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Message</label>
                                <textarea class="form-control" rows="3"
                                          placeholder="Tell us what you need (branches, integrations, reports)…"></textarea>
                            </div>
                            <button type="button" class="btn btn-brand w-100">Request Demo</button>
                        </form>
                    <?php endif; ?>
                    
                    <?php if ($tiny_text): ?>
                    <div class="tiny muted mt-2 text-center"><?php echo esc_html($tiny_text); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

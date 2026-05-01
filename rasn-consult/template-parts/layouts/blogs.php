<?php
/**
 * Layout: Blogs Section
 */

$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$posts_per_page = get_sub_field('posts_per_page') ?: 3;

$args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => $posts_per_page,
    'paged'          => 1,
);

$query = new WP_Query($args);
$total_pages = $query->max_num_pages;

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>

<section class="blogs-section" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?>
         data-total-pages="<?php echo esc_attr($total_pages); ?>" 
         data-posts-per-page="<?php echo esc_attr($posts_per_page); ?>"
         data-ajax-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
    <div class="container" >
        <!-- Header -->
        <?php if ($title) : ?>
            <h2 class="blogs-section__heading" data-aos="fade-up"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>
        <?php if ($subtitle) : ?>
            <p class="blogs-section__sub" data-aos="fade-up" >
                <?php echo esc_html($subtitle); ?>
            </p>
        <?php endif; ?>

        <!-- Cards row -->
        <div class="blogs-row" id="blogs-container">
            <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php get_template_part('template-parts/content', 'blog-card'); ?>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>

        <div id="blogs-loader" style="display: none; text-align: center; margin-top: 40px;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</section>

<?php
/**
 * Post Card Partial
 */

$post_id = get_the_ID();
$categories = get_the_category();
$category = !empty($categories) ? $categories[0]->name : 'Uncategorized';
$read_time = rasn_get_read_time(get_the_content());
$author_name = get_the_author();
$permalink = get_the_permalink();
$author_initials = strtoupper(substr($author_name, 0, 1) . substr(strpbrk($author_name, ' '), 1, 1));
if (strlen($author_initials) < 2) $author_initials = strtoupper(substr($author_name, 0, 2));
?>

<div class="blog-card" data-aos="fade-up">
    <a href="<?= $permalink ?>" class="blog-card__img-wrap">
        <span class="blog-card__badge"><?php echo esc_html($category); ?></span>
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('medium_large', array('alt' => get_the_title())); ?>
        <?php else : ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder-blog.jpg" alt="<?php the_title_attribute(); ?>" />
        <?php endif; ?>
    </a>
    <div class="blog-card__body">
        <div class="blog-card__meta">
            <span class="blog-card__date">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                <?php echo get_the_date('M j, Y'); ?>
            </span>
            <span class="blog-card__read-time">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                </svg>
                <?php echo esc_html($read_time); ?>
            </span>
        </div>
        <a href="<?= $permalink ?>"><h3 class="blog-card__title"><?php the_title(); ?></h3></a>
        <p class="blog-card__excerpt">
            <a href="<?= $permalink ?>">
                <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
            </a>
        </p>
        <div class="blog-card__divider"></div>
        <div class="d-flex justify-content-between align-items-center">
            <div class="blog-card__author">
                <div class="blog-card__avatar"><?php echo esc_html($author_initials); ?></div>
                <span class="blog-card__author-name"><?php echo esc_html($author_name); ?></span>
            </div>
            <a href="<?php the_permalink(); ?>" class="blog-card__link">
                Read more
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#1aa8c4" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                </svg>
            </a>
        </div>
    </div>
</div>

<?php
/**
 * Layout: Services V2 Section
 */


$title = get_sub_field('title');
$service_rows = get_sub_field('service_rows');

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . $background_color . ';"';
endif;
?>

<!-- ====== SERVICES V2 SECTION ====== -->
<section class="services-v2-section" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >
    <div class="container">

        <?php if( !empty($title)): ?>
            <h2 class="services__title"><?= $title ?></h2>
        <?php endif; ?>

        <?php if(!empty($service_rows)): ?>
            <div class="services__grid">
                <?php foreach ($service_rows as $key=>$service_row): ?>
                    <?php
                        if( isset($service_row['link']) ):
                            $url_link = $service_row['link']['url'];
                        else:
                            $url_link = '#';
                        endif;
                    ?>
                    <a href="<?= $url_link ?>" class="service-card" data-aos="fade-up" data-aos-duration="<?= ($key+1) * 500 ?>">
                        <div class="service-card__header">
                            <span class="service-card__number"><?= $service_row['number'] ?></span>
                            <div class="service-card__text">
                                <h3 class="service-card__title"><?= $service_row['text'] ?></h3>
                                <p class="service-card__desc">
                                    <?= $service_row['body'] ?>
                                </p>
                            </div>
                        </div>
                        <div class="service-card__media">
                            <img src="<?= $service_row['image'] ?>" alt="Web and app development" />
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif;?>

    </div>
</section>
<!-- ====== END SERVICES V2 SECTION ====== -->



<style>
    .services-v2-section {
        margin: 0 auto;
        padding: 5rem;
    }

    .services__title {
        text-align: center;
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 40px;
        color: #0f172a;
    }

    .services__grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
    }

    .service-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 24px;
        transition: box-shadow 0.25s ease, transform 0.25s ease;
    }

    .service-card:hover {
        box-shadow: 0 10px 25px -10px rgba(15, 23, 42, 0.15);
        transform: translateY(-2px);
    }

    .service-card__header {
        display: flex;
        gap: 16px;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .service-card__number {
        font-size: 2.6rem;
        font-weight: 300;
        color: #93c5fd;
        line-height: 1;
        flex-shrink: 0;
    }

    .service-card__text {
        flex: 1;
    }

    .service-card__title {
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: 8px;
        color: #0f172a;
    }

    .service-card__desc {
        font-size: 0.9rem;
        color: #475569;
        line-height: 1.55;
    }

    .service-card__media {
        overflow: hidden;
        border-radius: 12px ;
    }

    .service-card__media img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
        border-radius: 12px;
    }

    .service-card:hover .service-card__media img {
        transform: scale(1.04);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .services-v2-section {
            padding: 2rem;
        }
        .services__grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        .service-card {
            padding: 20px;
        }
    }
</style>
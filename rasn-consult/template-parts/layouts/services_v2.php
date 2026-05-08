<?php
/**
 * Layout: Services V2 Section
 */

$section_style = '';
$background_color = get_sub_field('background_color');
if( $background_color ):
    $section_style .= ' style="background: ' . esc_attr($background_color) . ';"';
endif;
?>

<!-- ====== SERVICES V2 SECTION ====== -->
<section class="services-v2-section" id="<?= get_sub_field('section_id') ?? '' ?>" <?= $section_style ?> >
    <div class="container">
        <h2 class="services__title">Services Offerings</h2>

        <div class="services__grid">
            <article class="service-card">
                <div class="service-card__header">
                    <span class="service-card__number">01</span>
                    <div class="service-card__text">
                        <h3 class="service-card__title">Web &amp; App Development</h3>
                        <p class="service-card__desc">
                            We deliver full-stack, tailored software development solutions
                            that streamline operations, enhance customer engagement, and
                            accelerate digital transformation.
                        </p>
                    </div>
                </div>
                <div class="service-card__media">
                    <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3?auto=format&fit=crop&w=900&q=70" alt="Web and app development" />
                </div>
            </article>

            <article class="service-card">
                <div class="service-card__header">
                    <span class="service-card__number">02</span>
                    <div class="service-card__text">
                        <h3 class="service-card__title">IT Outsourcing</h3>
                        <p class="service-card__desc">
                            We provide IT outsourcing services that connect your business
                            with senior, dedicated remote developers in Egypt, delivering
                            European-quality software development.
                        </p>
                    </div>
                </div>
                <div class="service-card__media">
                    <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=900&q=70" alt="IT outsourcing" />
                </div>
            </article>

            <article class="service-card">
                <div class="service-card__header">
                    <span class="service-card__number">03</span>
                    <div class="service-card__text">
                        <h3 class="service-card__title">Accounting ERP</h3>
                        <p class="service-card__desc">
                            Transition from manual record-keeping to data-driven strategic
                            insight with our cloud accounting software implementation
                            services.
                        </p>
                    </div>
                </div>
                <div class="service-card__media">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=900&q=70" alt="Accounting ERP" />
                </div>
            </article>

            <article class="service-card">
                <div class="service-card__header">
                    <span class="service-card__number">04</span>
                    <div class="service-card__text">
                        <h3 class="service-card__title">Business Consulting</h3>
                        <p class="service-card__desc">
                            Our expert consultants work closely with your leadership team
                            to design and execute data-driven digital transformation
                            strategies that deliver measurable ROI.
                        </p>
                    </div>
                </div>
                <div class="service-card__media">
                    <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=900&q=70" alt="Business consulting" />
                </div>
            </article>
        </div>
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
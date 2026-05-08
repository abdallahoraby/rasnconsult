<section class="why-choose py-5">
    <div class="container">
        <div class="why-choose__panel rounded-4 px-3 px-md-5 py-5 position-relative overflow-hidden">
            <div class="row justify-content-center text-center position-relative">
                <div class="col-lg-9">
                    <h2 class="why-choose__title fw-bold mb-3">
                        Why Choose RASN Consult for Digital Transformation?
                    </h2>
                    <p class="why-choose__lead text-secondary mb-4">
                        RASN Consult combines strategic consulting expertise with hands-on technology
                        implementation to deliver end-to-end digital transformation solutions. We align
                        business strategy with custom software development, ERP implementation, and secure
                        IT infrastructure to ensure measurable ROI, seamless system integration, and minimal
                        operational disruption. Our proven experience across enterprise environments enables
                        organizations to modernize processes, enhance performance, and achieve sustainable,
                        long-term growth.
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3 mb-5">
                        <a href="#" class="btn btn-primary why-choose__btn-primary px-4">
                            Download Brochure
                        </a>
                        <a href="#" class="btn btn-outline-primary why-choose__btn-outline px-4">
                            Know More
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 choose-us-images">
            <div class="col-md-4">
                <figure class="why-choose__card rounded-4 overflow-hidden m-0 shadow-sm">
                    <img
                        src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=800&q=80"
                        alt="Two professionals reviewing strategy on a tablet"
                        class="img-fluid"
                    />
                </figure>
            </div>
            <div class="col-md-4">
                <figure class="why-choose__card rounded-4 overflow-hidden m-0 shadow-sm">
                    <img
                        src="https://images.unsplash.com/photo-1531545514256-b1400bc00f31?auto=format&fit=crop&w=800&q=80"
                        alt="Developer smiling while working on a laptop"
                        class="img-fluid"
                    />
                </figure>
            </div>
            <div class="col-md-4">
                <figure class="why-choose__card rounded-4 overflow-hidden m-0 shadow-sm">
                    <img
                        src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=800&q=80"
                        alt="Mobile app interface displayed on a smartphone"
                        class="img-fluid"
                    />
                </figure>
            </div>
        </div>
    </div>
</section>

<style>
    :root {
        --wc-bg-start: #eef6ff;
        --wc-bg-end: #f6fbff;
        --wc-primary: #4fb6e6;
        --wc-primary-strong: #2196d4;
    }

    .why-choose__panel {
        background: linear-gradient(135deg, var(--wc-bg-start) 0%, var(--wc-bg-end) 100%);
        border: 1px solid rgba(79, 182, 230, 0.15);
        height: 70vh;
    }

    .choose-us-images {
        margin-top: -15% !important;
        z-index: 2;
        position: relative;
        width: 90%;
        justify-content: center;
        align-items: center;
        display: flex;
        margin: 0 auto;
    }

    .why-choose__card img {
        object-fit: cover;
        transition: transform 0.4s ease;
        width: 364px;
        height: 506px;
        top: 2876px;
        left: 532px;
        border-radius: 18px;
    }

    .choose-us-images .col-md-4:nth-of-type(2) {
        margin-top: -8rem;
    }

    /* Decorative curved lines on the right */
    .why-choose__panel::before,
    .why-choose__panel::after {
        content: "";
        position: absolute;
        right: -120px;
        width: 420px;
        height: 420px;
        border-radius: 50%;
        border: 1px solid rgba(79, 182, 230, 0.25);
        pointer-events: none;
    }
    .why-choose__panel::before { top: -80px; }
    .why-choose__panel::after  { top: 40px; border-color: rgba(79, 182, 230, 0.15); }

    .why-choose__title {
        color: #0b1220;
        font-size: clamp(1.25rem, 2.2vw, 1.75rem);
    }

    .why-choose__lead {
        font-size: 0.95rem;
        line-height: 1.7;
        max-width: 820px;
        margin-inline: auto;
    }

    .why-choose__btn-primary {
        background: linear-gradient(135deg, #6cc5ec, var(--wc-primary-strong));
        border: none;
        color: #fff;
        border-radius: 10px;
        font-weight: 500;
        box-shadow: 0 6px 14px rgba(33, 150, 212, 0.25);
    }
    .why-choose__btn-primary:hover { filter: brightness(1.05); color: #fff; }

    .why-choose__btn-outline {
        border: 1.5px solid var(--wc-primary);
        color: var(--wc-primary-strong);
        background: #fff;
        border-radius: 10px;
        font-weight: 500;
    }
    .why-choose__btn-outline:hover {
        background: var(--wc-primary);
        color: #fff;
    }

    .why-choose__card img {
        aspect-ratio: 4 / 3;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .why-choose__card:hover img { transform: scale(1.04); }

    @media (max-width: 575.98px) {
        .why-choose__panel::before,
        .why-choose__panel::after { display: none; }
    }

</style>